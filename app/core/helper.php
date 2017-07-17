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

function redirect(string $url)
{
    Flight::redirect($url);
}

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
 * Upload Image to Certain Dir
 * @param type $image
 * @param type $destination
 * @return bool
 */
//function uploadImage($image, $destination): bool
//{
//    // only jpg
//    return ($image['type'] !== 'image/jpeg') ? false : move_uploaded_file($image['tmp_name'], $destination);
//}

/**
 * Get `message` Query String From URL
 * @return string
 */
function getProcessMessage(): string
{
    $message = Flight::request()->query->message;
    return ($message) ?: '';
}

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
