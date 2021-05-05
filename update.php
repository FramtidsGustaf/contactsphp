<?php
require_once "pdo.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
  $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : false;
  if (!$id) header('Location: http://localhost/backend2php/contacts/');
  $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : false;
  $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : false;
  $tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : false;
  if (!$id) header('Location: http://localhost/backend2php/contacts/');
  $stmt = $conn->prepare("UPDATE contacts SET name = :name, tel = :tel WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':tel', $tel);
  $stmt->execute();
  header('Location: http://localhost/backend2php/contacts/');
}

include_once "header.php";

echo "
    <form action='#' method='post' class='row'>
      <div class='col-md-5'>
        <input type='text' name='name' class='form-control mt-2' value=$result[name]>
      </div>
      <div class='col-md-5'>
        <input type='text' name='tel' class='form-control mt-2' value=$result[tel]>
      </div>
      <div class='col-md-2'>
        <input type='submit' class='form-control mt-2 btn btn-primary' value='Update'>
      </div>
      <input type='hidden' name='id' value=$result[id]>
    </form> ";
include_once "footer.php";
