<?php

require_once "DB.php";
class Read
{

  private $result;

  public function __construct()
  {
    $db = new DB();
    $this->result = $db->get_all_contacts();
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
