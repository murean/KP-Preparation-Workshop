<?php
class Session
{
    public static function ValidateUser()
    {
        // allowed_page for public:login, article/list, and article/read
        $allowed_page = '/(login|article\/(list|read))/';

        // $_SESSION['user'] not set or empty, and current view is allowed
        if ((!isset($_SESSION['user']) || empty($_SESSION['user']))
            && !preg_match($allowed_page, $_GET['views'])) {
            header('Location: /login');
        }
    }
}
