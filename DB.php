<?php

class DB
{
  private  $servername = "localhost";
  private  $username = "root";
  private  $password = "root";
  private  $db = "contactdb";
  private $conn;

  public function __construct()
  {
    $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->db,  $this->username, $this->password);
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function get_all_contacts()
  {
    $stmt = $this->conn->prepare("SELECT * FROM contacts");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function get_specific_contact($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM contacts WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create_contact($name, $tel)
  {
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

  public function delete_contact($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM contacts WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }

  public function update_user_info($id, $name, $tel)
  {
    $stmt = $this->conn->prepare("UPDATE contacts SET name = :name, tel = :tel WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':tel', $tel);
    $stmt->execute();
  }
}
