<?php
include_once "src/Command.php";
class Logout extends Command {
  function doExecute() {
    session_destroy();
    header("Location: http://guitar-shop/");
    exit();
  }
}