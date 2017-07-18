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
    protected function create(int $type)
    {
        parent::userFilter(1);
        /*
         * 1.  get name, password, image_url, email, type FROM request
         * 2.  insert into user
         * 3.  insert into privilege
         * 4.  upload image
         */
        $data = $this->request->data;

        $encrypted_password = password_hash($data->password, PASSWORD_BCRYPT);

        $query = 'INSERT INTO user (name, password, email, type, created_at)'
            . ' VALUES(:name, :password, :email, :type, NOW())';

        $parameters = [
            'name' => $data->name,
            'password' => $encrypted_password,
            'email' => $data->email,
            'type' => $type
        ];

        $result = Database::TransactionQuery($query, $parameters);

        if (!$result) {
            redirect('/manager/writer/creator', 'Gagal Mendaftarkan Penulis', 'error');
        }
        redirect('/manager/writer/creator', 'Berhasil Mendaftarkan Penulis', 'success');
    }

    /**
     *
     * @return array contains: string query, array parameter
     */
    public function update()
    {
        parent::loggedFilter();
        $data = $this->request->data;
        $image = $this->request->files->image;

        if ($image['size'] > 0) {
            $destination['original'] = $this->image_dir;
            $destination['thumbnail'] = $this->thumbnail_dir;
            $upload_result = uploadImage($image, 'user-' . $this->session['id'] . '.jpg', $destination);
            $this->checkAndRedirectToAccountPage($upload_result, false, 'Gagal Mengganti Foto', 'error');
        }

        if ($data->old_password && $data->new_password) {
            $result = $this->changePassword($data->old_password, $data->new_password);
            $this->checkAndRedirectToAccountPage($result, false, 'Password Lama Tidak Sesuai', 'error');
        }

        $this->checkAndRedirectToAccountPage(true, true, 'Berhasil Mengedit AKun', 'success');
    }

    /**
     * Check if $result value is identics with $expected_value then redirect to
     * certain page
     * @param type $result
     * @param bool $expected_value
     * @param string $message
     * @param string $message_type
     */
    private function checkAndRedirectToAccountPage($result,
        bool $expected_value, string $message, string $message_type)
    {
        if ($result === $expected_value) {
            $user_type = ($this->session['type'] === 1) ? 'manager' : 'writer';
            redirect('/' . $user_type . '/account', $message, $message_type);
            exit();
        }
    }

    /**
     * Delete an User
     * @param int $id
     */
    public function delete(int $id)
    {
        parent::userFilter(1);

        $query = 'UPDATE user SET deleted_at = NOW() WHERE id = :id';
        $parameters = ['id' => $id];

        $result = Database::TransactionQuery($query, $parameters);

        if (!$result) {
            redirect($this->request->query->ref, 'Gagal Mengeluarkan Penulis', 'error');
        }
        redirect($this->request->query->ref, 'Berhasil Mengeluarkan Penulis', 'success');
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
        parent::loggedFilter();
        session_destroy();

        // redirect to home page
        Flight::redirect('/');
    }

    /**
     * Change Password Procedure
     * @param type $old_password
     * @param type $new_password
     * @return boolean
     */
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
        $old_hash = Database::SelectQuery($query_get, $parameters_get, false)['password'];

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
     * Get User data
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
