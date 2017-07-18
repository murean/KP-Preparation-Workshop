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
        'list_limit' => 15
    ];

    return $settings[$setting];
}

/**
 * Create Snippet for Create limit and offset for SQL Query
 * @param int $offset
 * @param int $limit
 * @return string
 */
function SQLOffset(int $offset): string
{
    $limit = setting('list_limit');
    return ' LIMIT ' . $limit . ' OFFSET ' . (($offset - 1) * $limit);
}

/**
 * Redirect with optional message
 * @param string $url
 * @param string $message
 * @param string $message_type
 */
function redirect(string $url, string $message = null,
    string $message_type = null)
{
    if ($message && $message_type) {
        $url .= '?m=' . $message . '&mt=' . $message_type;
    }
    Flight::redirect($url);
}

function getMessage()
{
    return (isset($_GET['m'])) ? 'toastr.' . $_GET['mt'] . '("' . $_GET['m'] . '");'
            : '';
}

/**
 * Reformat datetime from SQL to Indonesian
 * @param type $time
 * @return type
 */
function readableTime($time)
{
    if ($time === null) {
        return null;
    }
    return date('d-m-Y H:i:s', strtotime($time));
}

function fixNullValue(&$value, $default)
{
    $value = (!$value) ? $default : $value;
}

/**
 * Get `message` Query String From URL
 * @return string
 */
function getProcessMessage(): string
{
    $message = Flight::request()->query->message;
    return ($message) ?: '';
}

/**
 * Count how many page to display all records
 * @param type $total_record
 * @return type
 */
function paginationCounter($total_record)
{
    return ceil($total_record / setting('list_limit'));
}

/**
 * Upload Image with Thumbnail
 * @param type $file
 * @param string $basename
 * @param array $destination
 * @return boolean
 */
function uploadImage($file, string $basename, array $destination)
{
    include VENDOR . '/class.upload.php/src/class.upload.php';
    $handle = new upload($file);
    if ($handle->uploaded) {
        // original
        $handle->file_new_name_body = $basename;
        $handle->allowed = array('image/jpeg');
        $handle->mime_check = true;
        $handle->file_auto_rename = false;
        $handle->file_overwrite = true;
        $handle->dir_chmod = 0777;
        $handle->process($destination['original']);
        if (!$handle->processed) {
            echo $handle->error;
            return false;
        }
        // thumbnail
        $handle->allowed = array('image/jpeg');
        $handle->dir_chmod = 0777;
        $handle->file_new_name_body = $basename;
        $handle->file_name_body_pre = 'thumb-';
        $handle->image_resize = true;
        $handle->image_x = 300;
        $handle->image_y = 300;
        $handle->image_ratio_crop = true;
        $handle->file_overwrite = true;
        $handle->process($destination['thumbnail']);
        if (!$handle->processed) {
            echo $handle->error;
            return false;
        } else {
            $handle->clean();
            return true;
        }
    }
}
