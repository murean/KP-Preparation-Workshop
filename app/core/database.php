<?php

class Database
{

    private $driver = 'mysql',
        $host = 'localhost',
        $db = 'kppw',
        $username = 'root',
        $password = 'root';

    public function __construct()
    {
        return $this->connect($this->driver, $this->host, $this->db, $this->username, $this->password);
    }

    /**
     * Create PDO Instance
     * @param  string $driver   [description]
     * @param  string $host     [description]
     * @param  string $database [description]
     * @param  string $username [description]
     * @param  string $password [description]
     * @return [type]           [description]
     */
    protected function connect(string $driver, string $host, string $database, string $username, string $password)
    {
        try {
            if (in_array($driver, PDO::getAvailableDrivers(), TRUE)) {
                return new PDO($driver . ':host=' . $host . ';dbname=' . $database
                    . ';charset=utf8', $username, $password, [
                    // does not need legacy system support
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } else {
                throw new PDOException('Server tidak mendukung PDO');
            }
        } catch (PDOException $e) {
            return 'Pesan: ' . $e->getMessage();
        }
    }

    /**
     * Template For Writing Prepared Statement with PDO
     * @param  string $query      [description]
     * @param  array  $parameters [description]
     * @return bool               [description]
     */
    public static function TransactionQuery(string $query, array $parameters): bool
    {
        try {
            $pdo = new self();
            $pdo->beginTransaction();
            $pdo->prepare($query)->execute($parameters);
            $pdo->commit();
            return true;
        } catch (\PDOException $e) {
            $pdo->rollback();
            Log::write($e);
            return false;
        }
    }

    /**
     * Select Query With Desired Return Type
     * @param string $query      [description]
     * @param array  $parameters [description]
     * @param string $fetch_mode [description]
     */
    public static function SelectQuery(string $query, array $parameters, string $fetch_mode = 'assoc')
    {
        $available_mode = [
            'num' => PDO::FETCH_NUM,
            'assoc' => PDO::FETCH_ASSOC,
            'obj' => PDO::FETCH_OBJ,
        ];

        $pdo = new self();
        $st = $pdo->prepare($query);
        $st->execute($parameters);

        return $st->fetch($available_mode[$fetch_mode]);
    }

}
