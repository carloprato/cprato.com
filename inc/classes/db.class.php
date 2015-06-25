<?php
  class Db {
    private static $instance = NULL;

    
    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
    global $database;

      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO('mysql:host=' . $database["host"] . ';dbname=' . $database["database"], $database["user"], $database["password"], $pdo_options);
      }
      return self::$instance;
    }
  }