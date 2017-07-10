<?php

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
