<div class="header-section">
  <div class="container ">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a href="/" class="navbar-brand logo">
          <img src="/public/images/logo.png" alt="logo">
          <p>Gitarshop</p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/">Гатары</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/insertGuitar">Добавить</a>
            </li>
          </ul>
          <span class="navbar-text">
            <?
            require_once "src/Auth.php";
            getComponent();
            ?>
          </span>
        </div>
      </div>
    </nav>
  </div>
</div>