<?php

class Session
{

    const SESSION_ID = 'id';
    const SESSION_NAME = 'name';
    const SESSION_TYPE = 'type';

    public static function ValidateUser()
    {
// allowed_page for public:login, article/list, and article/read
        $allowed_page = '/(login|article\/(list|read))/';

// $_SESSION['user'] not set or empty, and current view is allowed
        if ((!isset($_SESSION['user']) || empty($_SESSION['user'])) && !preg_match($allowed_page, $_GET['views'])) {
            header('Location: /login');
        }
    }

    /**
     *
     * @return \stdClass
     */
    public static function GetSessionData(): array
    {
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
    }

    public static function create(int $id, string $name, int $type)
    {
        // Create SESSION
        $_SESSION['user'] = [
            self::SESSION_ID => $id,
            self::SESSION_NAME => $name,
            self::SESSION_TYPE => $type,
        ];
//        var_dump($_SESSION['user']);
    }

}
