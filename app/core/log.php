<?php

class Log
{
    public static function write(\Exception $e)
    {
        $log_dir = $_SERVER['DOCUMENT_ROOT'] . '/../log';
        $filename = $log_dir . '/' . (new DateTime())->format('Y-m-d') . '.txt';

        // [CODE] [Filename:Line] Traces
        $data = '[' . $e->getCode() . '] [' . $e->getFile() . ':' . $e->getLine() . '] ' . $e->getTraceAsString();

        file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
    }
}
