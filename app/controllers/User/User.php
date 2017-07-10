<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User;

use Controller;
use Database;
use Session;

/**
 * Description of User
 *
 * @author rezy
 */
class User extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create an User
     * @param int $type 1 = Manager; 2 = Writer;
     */
    public function create(int $type)
    {
        /*
         * 1.  get name, password, image_url, email, type FROM request
         * 2.  insert into user
         * 3.  insert into privilege
         * 4.  upload image
         */
        $data = $this->request->data;

        $encrypted_password = password_hash($data->password, PASSWORD_BCRYPT);

        $queries = [];

        $queries[0]['query'] = 'INSERT INTO user (name, password, email, type)'
            . ' VALUES(:name, :password, :email, :type)';

        $queries[0]['parameters'] = [
            'name' => $data->name,
            'password' => $encrypted_password,
            'email' => $data->email,
            'type' => $type
        ];

        $queries[1]['query'] = 'INSERT INTO privilege (user_id, code, created_at)'
            . ' VALUES(:user_id, :code, NOW())';

        $queries[1]['parameters'] = [
            'code' => $data->code
        ];

        $queries[1]['use_last_insert_id'] = true;
        $queries[1]['use_last_insert_id_to'] = 'user_id';

        $result = Database::MultiQueryTransaction($queries);

        // to upload image, use library
    }

    /**
     *
     * @return array contains: string query, array parameter
     */
    public function update(): array
    {
        $data = $this->request->data;
        // update into user
        $query = 'UPDATE user SET name = :name, email = :email';
        $parameters = [
            'name' => $data->name,
            'email' => $data->email
        ];

        $result = Database::TransactionQuery($query, $parameters);
    }

    public function changeProfilePicture()
    {
        /*
         * 1.  get uploaded file
         * 2.  get user id
         */
        $profile_picture = $this->request->file->image;
        $user_id = $this->session->id;

        $destination = $_SERVER['DOCUMENT_ROOT'] . '/img/user/profile-' . $user_id . '.jpg';

        $result = move_uploaded_file($profile_picture, $destination);
    }

    public function delete()
    {
        $query = 'UPDATE user SET deleted_at = NOW() WHERE id = :id';
        $parameters = ['id' => $this->request->data->id];

        $result = Database::TransactionQuery($query, $parameters);
    }

    public function login()
    {
        $data = $this->request->data;
        /*
         * 1.  select password from user where have same email as in the request
         * 2.  compare password hash with the one in the request
         */
        $query = 'SELECT password FROM user WHERE email = :email';
        $parameters = ['email' => $data->email];

        $result = Database::SelectQuery($query, $parameters);

        if (password_verify($data->password, $result['password'])) {
            Session::create();
            // redirect to dashboard
        } else {
            // redirect to login page again
        }
    }

    public function logout()
    {
        session_destroy();
        // redirect to home page
    }

    public function changePassword()
    {
        /*
         * 1.  get old password
         * 2.  match it with current hash
         * 3.  if matchs, create new hash based on new password
         */
        $user_id = $this->session->id;
        $query = 'SELECT password FROM user WHERE id = :id';
        $parameters = ['id' => $user_id];
        $old_hash = Database::SelectQuery($query, $parameters)['password'];

        if (password_verify($this->request->data->old_password, $old_hash)) {
            $new_hash = password_hash($this->request->data->new_password, PASSWORD_BCRYPT);
            $query = 'UPDATE user SET password = :password';
            $parameters = ['password' => $new_hash];
            $result = Database::TransactionQuery($query, $parameters);

            // if success redirect to another page
        } else {
            // back to password page
        }
    }

}
