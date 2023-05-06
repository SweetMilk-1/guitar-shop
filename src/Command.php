<?php
abstract class Command {

  function header() {
    require_once "templates/header.php";
  }
  function footer() {
    require_once "templates/footer.php";
  }
  function execute() {
    $this->header();
    $this->doExecute();
    $this->footer();
  }
  abstract function doExecute();
}