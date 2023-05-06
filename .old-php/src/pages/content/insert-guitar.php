<?php
require_once "src/database/repositories/guitar-type-repository.php";
//$inipath = php_ini_loaded_file();
echo $inipath;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once "src/database/repositories/guitar-repository.php";
  
  try {
    $file_name = $_FILES["file"]["name"] ?? mt_rand(0,10000);
    $file_tpm_path = $_FILES["file"]["tmp_name"];
    $target_path = $_SERVER['DOCUMENT_ROOT'] . "/public/images/guitars/" . $file_name;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
      insert_guitar($_POST, $file_name);
      echo "OK!";
    } else {
      throw new InvalidArgumentException();
    }
  } catch (InvalidArgumentException $ex) {
    include_once "src/pages/errors/400.php";
  }
  catch (Exception $ex) {
    echo "Хз че произошло";
  }
  return;
}

$types = get_guitar_types_dictionary();
?>
<div class='container'>
  <h1>Добавить гитару</h1>
  <form enctype="multipart/form-data" action="" method="POST" class="insert-guitar-form needs-validation">
    <div class="row mb-1">

      <div class="col col-md-6 col-sm-12">
        <div class="mb-3">
          <label for="guitar-name" class="form-label">Название</label>
          <input name="name" type="text" class="form-control" id="guitar-name" placeholder="Название" required>
        </div>
      </div>
      <div class="col col-md-6 col-sm-12">
        <label for="guitar-type" class="form-label">Тип гитары</label>
        <select name="type_id" class="form-select" id="guitar-type" aria-label="Тип гитары" required>

          <? foreach ($types as $item) { ?>
            <option value="<? echo $item["id"] ?>">
              <? echo $item["name"] ?>
            </option>
          <? } ?>

        </select>
      </div>

    </div>

    <div class="mb-3">
      <label for="guitar-description" class="form-label">Описание</label>
      <textarea name="description" class="form-control" id="guitar-description" rows="3" placeholder="Описание" required></textarea>
    </div>

    <div class="row mb-3">
      <div class="col col-md-3">
        <label for="guitar-description" class="form-label">Цена (Руб.)</label>
        <input type="number" name="price" class="form-control" id="guitar-description" rows="3" placeholder="Цена" required></textarea>
      </div>
    </div>

    <div class="d-flex justify-content-between">
      <div class="form-file">
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
        <input name="file" type="file" class="form-file-input" id="customFile" required>
      </div>
      <input class="btn btn-primary" type="submit" value="Добавить">
    </div>

  </form>
</div>
<script>
  (function() {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
  })()
  document.getElementById("customFile").addEventListener("change", (event) => {
    event.stopPropagation();
    event.preventDefault();
    const extension = event.target.value.split(".").reverse()[0].toLowerCase();
    if (["jpeg", "jpg", "png"].findIndex((item) => item == extension) == -1) {
      alert("Некорректный тип файла");
      event.target.value = null;
    }
  });
</script>