<?php
  require_once "src/database/repositories/guitar-repository.php";
  $guitar_id=$_GET["id"];
  $item=get_guitar_by_id((int)$guitar_id);
  if ($item == null) {
    include_once "src/pages/errors/404.php";
    return;
  }

  $name=$item["name"];
  $type_name=$item["type_name"];
  $price=$item["price"];
  $path_image=$item["path_image"];
  $descr=str_replace("\n", "</p><p>", $item["description"]); 
?>

<div class="container">
  <h1>
    <?php echo $name?>
  </h1>
  <p>
    <?php echo $type_name?>
  </p>
  <h2>
    <?php echo $price?> руб.
  </h2>
  <div class="row">
    <div class="col col-12 col-md-4 d-flex left-column">
      <img alt="тут гитара" src="/public<?php echo $path_image?>" class="rounded" width="300px">
    </div>
    <div class="col right-column col-12 col-md-8">
      <p>
        <?php echo $descr?>
      </p>
    </div>
  </div>
</div>

