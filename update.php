<?php

require_once "DB.php";
require_once "Form.php";
require_once "HTML.php";

class Update
{
  private static $db;
  public static function main()
  {
    self::$db = new DB();
    if ($_SERVER['REQUEST_METHOD'] === "GET") self::get_user_info();
    if ($_SERVER['REQUEST_METHOD'] === "POST") self::update_user_info();
  }

  private static function get_user_info()
  {
    $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false;
    if (!$id) header('Location: http://localhost/backend2php/contacts/');
    $result = self::$db->get_specific_contact($id);
    HTML::header("Update Contact");
    new Form($result['name'], $result['tel'], $result['id']);
    HTML::footer();
  }

  private static function update_user_info()
  {
    $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : false;
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : false;
    $tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : false;
    if ($id) self::$db->update_user_info($id, $name, $tel);
    header('Location: http://localhost/backend2php/contacts/');
  }
}

Update::main();
