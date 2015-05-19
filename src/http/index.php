<?php
/**
 * Created by PhpStorm.
 * User: oshry
 * Date: 5/17/15
 * Time: 2:00 PM
 */
define('DOCROOT', realpath(dirname(__FILE__).'/../..').DIRECTORY_SEPARATOR);
define('APPPATH', realpath(DOCROOT.'app').DIRECTORY_SEPARATOR);

require DOCROOT . 'vendor/autoload.php';
$config = include APPPATH.'config/db.php';
$db = Search\Repository\DataRepository::instance($config, 'default');
$query = $_GET['query'];
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];
$paths = explode("/", $path);


try {
        switch ($method) {
            case 'POST':
                die('Post');
                break;
            case 'GET':
                 $list = new Search\Usecase\SearchRes($query, $db);
                 $list->search_result();
                break;
            case 'DELETE':
                die('Delete');
                break;
        }

}catch(Exception $e){
    echo 'Message: ' .$e->getMessage();
    die();
}

