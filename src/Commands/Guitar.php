<?php
include_once "src/Command.php";
class Guitar extends Command
{
  function doExecute()
  {
    require_once "src/Repositories/GuitarRepos.php";
    $guitarRepos = new GuitarRepos();
    $guitar_id = $_GET["guitar_id"];
    $item = $guitarRepos->getById((int)$guitar_id);
    if ($item == null) {
      include_once "templates/errors/404.php";
      return;
    }

    $name = $item["name"];
    $type_name = $item["type_name"];
    $price = $item["price"];
    $path_image = $item["path_image"];
    $descr = str_replace("\n", "</p><p>", $item["description"]);
?>

    <div class="container">
      <h1>
        <?php echo $name ?>
      </h1>
      <p>
        <?php echo $type_name ?>
      </p>
      <h2>
        <?php echo $price ?> руб.
      </h2>
      <div class="row">
        <div class="col col-12 col-md-4 d-flex left-column">
          <img alt="тут гитара" src="/public<?php echo $path_image ?>" class="rounded" width="300px">
        </div>
        <div class="col right-column col-12 col-md-8">
          <p>
            <?php echo $descr ?>
          </p>
        </div>
      </div>
    </div>
<?

  }
}
