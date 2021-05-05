<?php

require_once "DB.php";

class Delete
{
  private $id;
  private $db;

  public function __construct()
  {
    $this->id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false;
    $this->db = new DB();
  }

  public function contact()
  {
    if ($this->id) {
      $this->db->delete_contact($this->id);
    }
    header('Location: http://localhost/backend2php/contacts/');
  }
}

$delete = new Delete;
$delete->contact();
