<?php
require_once "/OSPanel/domains/guitar-shop/src/database/database-connection.php";
function get_guitar_types_dictionary() {
  $conn = get_connection();
  $cursor = $conn->prepare("SELECT name, id FROM guitar_types");
  $cursor->execute();
  $cursor->setFetchMode(PDO::FETCH_ASSOC);
  return $cursor->fetchAll();
}
