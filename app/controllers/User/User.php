<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User;

use Controller;
use Database;
use Flight;
use Session;

/**
 * Description of User
 *
 * @author rezy
 */
class User extends Controller
{

    private $image_dir = 'img/user/original',
        $thumbnail_dir = 'img/user/thumbnail';

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
    public function update()
    {
        $data = $this->request->data;
        $image = $this->request->files->image;

        if ($image['size'] > 0) {
            $destination['original'] = $this->image_dir;
            $destination['thumbnail'] = $this->thumbnail_dir;
            uploadImage($image, 'user-' . $data->id . '.jpg', $destination);
        }

        if ($data->old_password && $data->new_password) {
            $result = $this->changePassword();
            if (!$result) {
                redirect('/error');
            }
        }
        redirect('/user/account');
    }

    /**
     *
     */
    public function changeProfilePicture()
    {
        /*
         * 1.  get uploaded file
         * 2.  get user id
         */
        $profile_picture = $this->request->file->image['tmp_name'];
        $user_id = $this->session['id'];

        $destination = $_SERVER['DOCUMENT_ROOT'] . '/img/user/profile-' . $user_id . '.jpg';

        $result = move_uploaded_file($profile_picture, $destination);
    }

    public function delete()
    {
        $query = 'UPDATE user SET deleted_at = NOW() WHERE id = :id';
        $parameters = ['id' => $this->request->data->id];

        $result = Database::TransactionQuery($query, $parameters);
    }

    /**
     * User Login
     */
    public function login()
    {
        $data = $this->request->data;

        /*
         * 1.  select password from user where have same email as in the request
         * 2.  compare password hash with the one in the request
         */
        $query = 'SELECT id, name, password, type FROM user WHERE email = :email';
        $parameters = ['email' => $data->email];

        $result = Database::SelectQuery($query, $parameters, false);

        // redirect to login page again if inputted password and hash dont match
        if (!password_verify($data->password, $result['password'])) {
            redirect('/login/retry');
        }

        Session::create($result['id'], $result['name'], $result['type']);
        // redirect to suitable dashboard
        ($result['type'] === 1) ? redirect('/manager/dashboard') : redirect('/writer/dashboard');
    }

    public function logout()
    {
        session_destroy();

        // redirect to home page
        Flight::redirect('/');
    }

    private function changePassword($old_password, $new_password)
    {
        /*
         * 1.  get old password
         * 2.  match it with current hash
         * 3.  if matchs, create new hash based on new password
         */
        $user_id = $this->session['id'];
        $query_get = 'SELECT password FROM user WHERE id = :id';
        $parameters_get = ['id' => $user_id];
        $old_hash = Database::SelectQuery($query_get, $parameters_get)['password'];

        if (!password_verify($old_password, $old_hash)) {
            return false;
        }

        $new_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $query = 'UPDATE user SET password = :password';
        $parameters = ['password' => $new_hash];
        $result = Database::TransactionQuery($query, $parameters);

        return $result;
    }

    /**
     *
     * @param int $id
     * @return array|
     */
    public function getData(int $id = null)
    {
        $user_id = ($id) ?: $this->session['id'];
        $query = 'SELECT name, email, id FROM user WHERE id = :id';
        $parameters = ['id' => $user_id];

        return Database::SelectQuery($query, $parameters, false);
    }

}
