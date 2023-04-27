<?php
require_once "/OSPanel/domains/guitar-shop/src/database/database-connection.php";
function get_guitar_by_id(int $id)
{
  $conn = get_connection();
  $cursor = $conn->prepare("SELECT g.*, gt.name AS type_name FROM guitars g JOIN guitar_types gt ON g.type_id=gt.id WHERE g.id=$id");
  $cursor->execute();
  $cursor->setFetchMode(PDO::FETCH_ASSOC);
  return $cursor->fetch();
}
function get_guitars_cnt()
{
  $conn = get_connection();
  $cursor = $conn->prepare("SELECT COUNT(*) AS cnt FROM guitars");
  $cursor->execute();
  $cursor->setFetchMode(PDO::FETCH_ASSOC);
  return $cursor->fetch()["cnt"];
}
function get_all_guitars(int $page, int $limit)
{
  $conn = get_connection();
  $start = $page * $limit + 1;
  $end = ($page + 1) * $limit;
  $cursor = $conn->prepare("SELECT * FROM (
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
