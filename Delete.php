<?php

require_once "DB.php";

class Delete
{
  private $id;
  private $conn;

  public function __construct()
  {
    $this->id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false;
    $this->conn = DB::conn();
  }

  public function contact()
  {
    if ($this->id) {
      $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");
      $stmt->bindParam(':id', $this->id);
      $stmt->execute();
      header('Location: http://localhost/backend2php/contacts/');
    }
  }
}

$delete = new Delete;
$delete->contact();
