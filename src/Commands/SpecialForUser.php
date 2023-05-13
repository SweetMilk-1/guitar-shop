<?php
include_once "src/Command.php";
class SpecialForUser extends Command
{
  function doExecute()
  {
    require_once "src/Auth.php";
    if (!isAuthorized()) {
      header("Location: http://guitar-shop/auth");
      exit();
    }
    ?>
      <h1>Это страница только для юзера</h1>
    <?
  }
}
