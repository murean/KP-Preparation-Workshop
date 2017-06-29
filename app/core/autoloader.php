<?php



class Autoloader {
    static public function loader($class_name)
    {
        $file_name = __DIR__. '/../controllers/' . str_replace("\\", '/', strtolower($class_name)) . '.php';
        if( file_exists($file_name) ) {
            include($file_name);
            if (class_exists($class_name)) {
                return true;
            }
        }
        return false;
    }
}
