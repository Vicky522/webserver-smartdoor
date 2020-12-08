<?php

define('DEVELOPMENT',true);
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'core');
define('DB_USER', 'root');
define('DB_PASS', '');
 
define('BASEPATH', 'http://localhost:8080/');

define('MODELPATH','models/');
define('CONTROLLERPATH','controllers/');
define('VIEWPATH','views/');
define('LIBPATH','libs/');
class DB
{
    private static $instance = NULl;
    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO('mysql:host=localhost;dbname=door', 'root', '');
          self::$instance->exec("SET NAMES 'utf8'");
        } catch (PDOException $ex) {
          die($ex->getMessage());
        }
      }
      return self::$instance;
    }
}