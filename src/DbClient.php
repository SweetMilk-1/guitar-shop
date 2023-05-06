<?php
class DbClient
{
  private static $instance = null;
  private static function setInstance()
  {
    require_once ("configuration.php");
    $DBH = new PDO("mysql:host=" . $host . ";dbname=" . $base, $user, $pswd);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DBH->prepare("set character_set_client='utf8'")->execute();
    $DBH->prepare("set character_set_results='utf8'")->execute();
    $DBH->prepare("set collation_connection='utf8_general_ci'")->execute();
    self::$instance=$DBH;
  }
  public static function getClient() {
    if (is_null(self::$instance))
      self::setInstance();
    return self::$instance;
  }
}
