<?php

/**
 *
 * @param string $setting available: db, list
 * @return array
 */
function setting(string $setting)
{
    $settings = [
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'kppw',
            'username' => 'root',
            'password' => 'root'
        ],
        'list' => [
            'limit' => 15
        ]
    ];

    return $settings[$setting];
}

/**
 * Create Snippet for Create limit and offset for SQL Query
 * @param int $offset
 * @param int $limit
 * @return string
 */
function SQLOffset(int $offset, int $limit = 15): string
{
    return ' LIMIT ' . $limit . ' OFFSET ' . (($offset - 1) * $limit);
}
