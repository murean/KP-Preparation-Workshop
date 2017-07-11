<?php

class Database
{

    /**
     * Create PDO Instance
     * @param  string $driver   [description]
     * @param  string $host     [description]
     * @param  string $database [description]
     * @param  string $username [description]
     * @param  string $password [description]
     * @return [type]           [description]
     */
    public function connect()
    {
        try {
            $set = setting('db');
            if (in_array($set['driver'], PDO::getAvailableDrivers(), TRUE)) {
                return new PDO($set['driver'] . ':host=' . $set['host'] . ';dbname=' . $set['database']
                    . ';charset=utf8', $set['username'], $set['password'], [
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
        $pdo = (new self())->connect();
        try {
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
     * Multi Queries in A Transaction
     * @param array $query_couple
     * @return boolean
     */
    public static function MultiQueryTransaction(array $query_couple): bool
    {
        $pdo = (new self())->connect();
        try {
            $pdo->beginTransaction();

            foreach ($query_couple as $couple) {
                // use last insert id from previous statement
                if (isset($couple['use_last_insert_id'])) {
                    $couple['parameters'][$couple['use_last_insert_id_to']] = $pdo->lastInsertId();
                }
                $pdo->prepare($couple['query'])
                    ->execute($couple['parameters']);
            }
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
    public static function SelectQuery(string $query, array $parameters = [], bool $multiple = true, string $fetch_mode = 'assoc')
    {
        $available_mode = [
            'num' => PDO::FETCH_NUM,
            'assoc' => PDO::FETCH_ASSOC,
            'obj' => PDO::FETCH_OBJ,
        ];

        $pdo = (new self())->connect();

        $st = $pdo->prepare($query);
        $st->execute($parameters);

        $mode = $available_mode[$fetch_mode];

        return ($multiple) ? $st->fetchAll($mode) : $st->fetch($mode);
    }

}
