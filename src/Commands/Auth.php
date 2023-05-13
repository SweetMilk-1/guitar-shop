<?php
include_once "src/Command.php";
class Auth extends Command
{
  private $is_wrong;
  function __construct()
  {
    $this->is_wrong = false;
  }
  function header()
  {
  }
  function footer()
  {
  }

  function doExecute()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      include_once "src/Auth.php";
      try {
        $user_id=getUserId($_POST["login"], $_POST["password"]);
        if ($user_id != null) {
          session_start();
          $_SESSION["login"]=$_POST["login"];
          $_SESSION["user_id"]=$user_id;
          header("Location: http://guitar-shop/");
          exit(); 
        } else {
          $this->is_wrong = true;
        }
      } catch (Exception $ex) {
        echo $ex->getMessage();
      }
    }
?>
    <div class="d-flex justify-content-center align-items-center auth-form">
      <form name="auth" action="/Auth" method="POST" class="needs-validation">
        <div class="mb-1">
          <label for="login" class="form-label">Логин</label>
          <input name="login" type="login" class="form-control" id="login" placeholder="Логин" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Пароль" required>
        </div>
        <?
        if ($this->is_wrong) {
        ?>
          <div class="text-fanger mb-3">
            Неправильный логин или пароль!
          </div>
        <?
        }
        ?>
        <div class="d-flex justify-content-center">
          <input class="btn btn-primary" type="submit" value="Войти">
        </div>
      </form>
    </div>
    <script>
      (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
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
    </script>
<?
  }
}
