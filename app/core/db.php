<?php
class DB
{
    public static function connect($driver, $host, $database, $username, $password){
        try{
            if (in_array($driver,PDO::getAvailableDrivers(),TRUE)) {
                return new PDO($driver . ':host=' . $host . ';dbname=' . $database
                    . ';charset=utf8',
                    $username, $password);
            }
            else {
                throw new PDOException('Server tidak mendukung PDO');
            }
        } catch(PDOException $e){
            echo 'Pesan: '. $e->getMessage();
        }
    }
}
