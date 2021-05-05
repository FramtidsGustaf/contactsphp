<?php

require_once "Form.php";

class Create
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
    new Form();
    $this->post();
  }

  public function post()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Hämta data från post-arrayen
      $name = htmlspecialchars($_POST['name']);
      $tel = htmlspecialchars($_POST['tel']);
      // Förbered en SQL-sats and binda parametrar
      $stmt = $this->conn->prepare("INSERT INTO contacts (name, tel)
    VALUES (:name, :tel)");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':tel', $tel);
      // Kör SQL-satsen (infoga en rad)
      $stmt->execute();
      $last_id = $this->conn->lastInsertId();
      echo "<p>New record created successfully.
    <br>Last inserted ID is: $last_id </p>";
    }
  }
}
