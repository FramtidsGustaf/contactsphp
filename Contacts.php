<?php

require_once "Create.php";
require_once "Read.php";
require_once "HTML.php";

class Contacts
{
  public static function main()
  {
    HTML::header('Contacts');
    new Create();
    new Read();
    HTML::footer();
  }
}
