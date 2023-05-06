<?php
require_once "src/DbClient.php";
class GuitarRepos
{
  private $client;
  function __construct() {
    $this->client = DbClient::getClient();
  }
  function getById(int $id)
  {
    $cursor = $this->client->prepare("SELECT g.*, gt.name AS type_name FROM guitars g JOIN guitar_types gt ON g.type_id=gt.id WHERE g.id=$id");
    $cursor->execute();
    $cursor->setFetchMode(PDO::FETCH_ASSOC);
    return $cursor->fetch();
  }
  function count()
  {
    $cursor = $this->client->prepare("SELECT COUNT(*) AS cnt FROM guitars");
    $cursor->execute();
    $cursor->setFetchMode(PDO::FETCH_ASSOC);
    return $cursor->fetch()["cnt"];
  }
  function getAll(int $page=0, int $limit=5)
  {
    $start = $page * $limit + 1;
    $end = ($page + 1) * $limit;
    $cursor = $this->client->prepare("SELECT * FROM (
    SELECT 	ROW_NUMBER() OVER (ORDER BY g.id) AS num,
    		g.id as id, 
    		g.name AS name,
    		g.price AS price,
    		g.type_id as type_id,
    		gt.name as type_name,
    		gt.path_image as type_path_image
    FROM  guitars g 
    JOIN guitar_types gt 
    ON g.type_id=gt.id) 
t WHERE t.num BETWEEN $start AND $end");
    $cursor->execute();
    $cursor->setFetchMode(PDO::FETCH_ASSOC);
    return $cursor->fetchAll();
  }
  function insert($data) {
    $name=$data["name"];
    $description=$data["description"];
    $price=$data["price"];
    $type_id=$data["type_id"];
    $file_ext=$data["FILE_EXTENSION"];
  
    $cursor = $this->client->prepare("INSERT INTO guitars(name, description, type_id, price) 
    VALUES ('$name', '$description', $type_id, $price)");
    $cursor->execute();
    $cursor = $this->client->prepare("SELECT LAST_INSERT_ID() as lid;");
    $cursor->execute();
    $cursor->setFetchMode(PDO::FETCH_ASSOC);
    $lid=$cursor->fetch()["lid"];
    $cursor = $this->client->prepare("UPDATE guitars SET path_image='/images/guitars/guitar_$lid.$file_ext' WHERE id=$lid");
    $cursor->execute();
    return $lid;
  }

}
