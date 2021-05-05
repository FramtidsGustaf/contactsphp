<?php

class Form
{
  private $name;
  private $tel;
  private $submit;
  private $id;
  private $hidden;

  public function __construct($name = "placeholder='Ange namn'", $tel = "placeholder='Ange telefon'", $id = false)
  {
    $this->name = $name;
    $this->tel = $tel;
    $this->id = $id;
    $this->update_or_add();
    $this->hidden_or_not();
    $this->renderForm();
  }

  private function update_or_add()
  {
    if($this->id){
      $this->submit = "Update";
      $this->name = "value=$this->name";
      $this->tel = "value=$this->tel";
    } else $this->submit = "Add";
  }

  private function hidden_or_not()
  {
    $this->hidden = $this->id ? "<input type='hidden' name='id' value='$this->id'>" : "";
  }

  public function renderForm()
  {
    echo "
    <form action='#' method='post' class='row'>
      <div class='col-md-5'>
        <input type='text' name='name' class='form-control mt-2' $this->name>
      </div>
      <div class='col-md-5'>
        <input type='text' name='tel' class='form-control mt-2' $this->tel>
      </div>
      <div class='col-md-2'>
        <input type='submit' class='form-control mt-2 btn btn-primary' value='$this->submit'>
      </div>
      $this->hidden
    </form>
    ";
  }
}
