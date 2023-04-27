<?php
  require_once "/OSPanel/domains/guitar-shop/src/database/database-connection.php";
  function get_guitar_by_id(int $id) {
    $conn = get_connection();
    $cursor=$conn->prepare("SELECT g.*, gt.name AS type_name FROM guitars g JOIN guitar_types gt ON g.type_id=gt.id WHERE g.id=$id");
    $cursor->execute();
    $cursor->setFetchMode(PDO::FETCH_ASSOC);
    return $cursor->fetch();
  }
?>