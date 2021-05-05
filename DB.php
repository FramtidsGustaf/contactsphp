<?php

class DB
{
  private static $servername = "localhost";
  private static $username = "root";
  private static $password = "root";
  private static $db = "contactdb";

  public static function conn()
  {
    try {
      $conn = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$db,  self::$username, self::$password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
      return $conn;
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}
