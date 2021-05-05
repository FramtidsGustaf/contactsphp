<?php

require_once "Form.php";
require_once "DB.php";
class Create
{
  private $db;

  public function __construct()
  {
    $this->db = new DB();
    new Form();
    $this->post();
  }

  public function post()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $name = htmlspecialchars($_POST['name']);
      $tel = htmlspecialchars($_POST['tel']);
      $this->db->create_contact($name, $tel);
    }
  }
}
