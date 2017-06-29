<?php

class View
{
    /**
     * Create View and return error 404 page if view isn't found.
     * @return void
     */
    public static function CreateView()
    {
        try {
            // check if views parameter is exists
            if (!isset($_GET['views'])) { throw new Exception('', 404); }

            $content = VIEW . "/" . $_GET['views'] . ".php";
            // check if file is exists
            if (!file_exists($content)) { throw new Exception('', 404); }
        } catch (Exception $e) {
            // desired view not found? Return 404 instead
            $content = VIEW . '/error/404.php';
        } finally {
            include VIEW . "/head.php";
            include $content;
            include VIEW . "/foot.php";
        }

    }
}
