<?
require_once "DbClient.php";
function getUserId($login, $password)
{
  $client = DbClient::getClient();
  $cursor = $client->prepare("SELECT id FROM users WHERE login='$login' AND password='$password'");
  $cursor->execute();
  return $cursor->fetch();
}

function isAuthorized()
{
  return isset($_SESSION["user_id"]); 
}


function getComponent()
{
  session_start();
  if (isset($_SESSION["user_id"]) && isset($_SESSION["login"])) {
?>
  <a href="/Logout">Выйти (<?echo $_SESSION["login"]?>)</a>
<?
  } else {
?>
  <a href="/Auth">Войти</a>
<?
  }
}


