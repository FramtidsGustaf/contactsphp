<?php

class Read
{
  private $stmt;
  private $result;

  public function __construct($conn)
  {
    $this->stmt = $conn->prepare("SELECT * FROM contacts");
    $this->stmt->execute();
    $this->result = $this->stmt->fetchAll();
    $this->render();
  }

  private function render()
  {
    $table = "<table class='table'>
    <tr><th>Namn</th><th>Telefon</th><th>Delete</th><th>Update</th></tr>";
    foreach ($this->result as $value) {
      $table .= "<tr>
    <td>$value[name]</td>
    <td>$value[tel]</td>
    <td>
    <a href='delete.php?id=$value[id]'>Delete</a>
    </td>
    <td>
    <a href='update.php?id=$value[id]'>Update</a>
    </td>
    </tr>";
    }
    $table .= '</table>';
    echo $table;
  }
}
