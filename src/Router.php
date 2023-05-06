<?php
require_once "src/Command.php";
class Router
{
  public static function route(string $url)
  {
    $urlArray = explode('/', $url);
    $commandName = null;
    $tryUrl = ucfirst($urlArray[1]);
    if (strlen($tryUrl) > 0 && $tryUrl[0] != '?' && file_exists("src/Commands/" . $tryUrl . ".php")) {
      $commandName = $tryUrl;
    } else
      $commandName = "Main";
    require_once "src/Commands/" . $commandName . ".php";
    return new $commandName();
  }
}
