<?php
class DbClient
{
  private function DbClient()
  {
    $DBH = new PDO("mysql:host=" . $host . ";dbname=" . $base, $user, $pswd);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DBH->prepare("set character_set_client='utf8'")->execute();
    $DBH->prepare("set character_set_results='utf8'")->execute();
    $DBH->prepare("set collation_connection='utf8_general_ci'")->execute();
  }
}
$base = "guitars";
$user = "root";
$pswd = "";
$host = "localhost";

function get_connection()
{
  global $DBH;
  return $DBH;
}
