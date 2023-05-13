<!DOCTYPE html>
<html lang="ru">

<head>
  <title>Main Page</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/styles.css">
  <link rel="stylesheet" href="/public/libs/bootstrap-5.0.1-dist/css/bootstrap.min.css">
  <link rel="icon" href="/public/favicon.ico">

  <script src="/public/libs/bootstrap-5.0.1-dist/js/bootstrap.min.js"></script>

</head>

<body>
  <?php
  require_once "src/Router.php";
  $url = $_SERVER["REQUEST_URI"];
  $command = Router::route($url);
  $command->execute();
  ?>
</body>

</html>