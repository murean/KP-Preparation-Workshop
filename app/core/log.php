<?php

class Log
{

    public static function write(\Exception $e)
    {
        $log_dir = $_SERVER['DOCUMENT_ROOT'] . '/../log';
        $filename = $log_dir . '/' . (new DateTime())->format('Y-m-d') . '.txt';

        // [CODE] [Filename:Line] Traces
        $data = "---\n"
            . date('Y-m-d H:i:s') . "\n"
            . '[' . $e->getCode() . "] \n [ "
            . $e->getMessage() . " ] \n ["
            . $e->getFile() .
            ':' . $e->getLine() . '] ' . "\n" . $e->getTraceAsString() . "\n";

        file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
//        echo '[' . $e->getCode() . '] [ ' . $e->getMessage() . ' ] [' . $e->getFile() . ':' . $e->getLine() . '] ' . $e->getTraceAsString();
    }

}
