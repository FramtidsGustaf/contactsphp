<?php

require_once "DB.php";
require_once "Form.php";
require_once "HTML.php";

class Update
{
  private static $conn;
  public static function main()
  {
    self::$conn = DB::conn();
    if ($_SERVER['REQUEST_METHOD'] === "GET") self::get_user_info();
    if ($_SERVER['REQUEST_METHOD'] === "POST") self::update_user_info();
  }

  private static function get_user_info()
  {
    $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false;
    if (!$id) header('Location: http://localhost/backend2php/contacts/');
    $stmt = self::$conn->prepare("SELECT * FROM contacts WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    HTML::header("Update Contact");
    new Form($result['name'], $result['tel'], $result['id']);
    HTML::footer();
  }

  private static function update_user_info()
  {
    $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : false;
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : false;
    $tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : false;
    if (!$id) header('Location: http://localhost/backend2php/contacts/');
    $stmt = self::$conn->prepare("UPDATE contacts SET name = :name, tel = :tel WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':tel', $tel);
    $stmt->execute();
    header('Location: http://localhost/backend2php/contacts/');
  }
}

Update::main();
