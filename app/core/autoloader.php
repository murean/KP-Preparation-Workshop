<?php

class Autoloader
{

    static public function ControllerLoader($class_name)
    {
        // change namespace format into directory format
        $filename = str_replace("\\", '/', $class_name) . '.php';
        $file = $_SERVER['DOCUMENT_ROOT'] . '/../app/controllers/' . $filename;
        if (!file_exists($file)) {
            return false;
        }
        include $file;
    }

    public static function CoreLoader($class_name)
    {
        // change namespace format into directory format
        $filename = str_replace("\\", '/', $class_name) . '.php';
        $file = $_SERVER['DOCUMENT_ROOT'] . '/../app/core/' . strtolower($filename);
        if (!file_exists($file)) {
            return false;
        }
        include $file;
    }

}
