<?php

require_once "Create.php";
require_once "Read.php";
require_once "HTML.php";
require_once "DB.php";

class Contacts
{
  public static function main()
  {
    $conn = DB::conn();
    HTML::header('Contacts');
    new Create($conn);
    new Read($conn);
    HTML::footer();
  }
}
