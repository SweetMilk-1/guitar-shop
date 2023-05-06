<?php
require_once "src/DbClient.php";
class GuitarTypeRepos
{
  private $client;
  function __construct() {
    $this->client=DbClient::getClient();
  } 
  public function getAll()
  {
    $cursor = $this->client->prepare("SELECT name, id FROM guitar_types");
    $cursor->execute();
    $cursor->setFetchMode(PDO::FETCH_ASSOC);
    return $cursor->fetchAll();
  }
}
