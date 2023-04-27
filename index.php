<!DOCTYPE html>
<html lang="en">
<head>

  <title>Main Page</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="./public/css/styles.css">
  <link rel="stylesheet" href="./public/libs/bootstrap-5.0.1-dist/css/bootstrap.min.css">
  <link rel="icon" href="favicon.ico">

  <script src="./templates/libs/bootstrap-5.0.1-dist/js/bootstrap.min.js"></script>
 
</head>
<body>
  <?php include_once("./templates/header.php")?>
    
  <?php
    include "./src/pages/guitar.php"
  ?>

  <?php include_once("./templates/footer.php")?>
</body>
</html>
