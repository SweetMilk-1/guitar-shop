<?php
require_once 'src/database/repositories/guitar-repository.php';

$page = (int)$_GET["page"] ?? 0;
$limit = (int)$_GET["limit"] <= 0 ? 5 : (int)$_GET["limit"];
$page = ($page + 1) * $limit > $guitars_cnt ? 0 : $page;

$guitars = get_all_guitars($page, $limit);

$guitars_cnt = get_guitars_cnt();
?>


<div class="description-section">
  <div class="container description-container">
    <h1>Гитара</h1>
    <p>
      Гита́ра — струнный щипковый музыкальный инструмент. Применяется в
      качестве аккомпанирующего или сольного инструмента во многих стилях и
      направлениях музыки, среди которых романс, блюз, кантри, фламенко,
      рок, джаз. Изобретённая в XX веке электрическая гитара произвела
      значительные изменения в музыке и тем самым оказала сильное влияние на
      массовую культуру. Также есть классическая гитара, гитара фламенко,
      испанская гитара и некоторые другие виды.
    </p>
  </div>
</div>

<div class="table-section">
  <div class="container table-container">
    <h2>Справочник гитар с сайта Muztorg.ru</h2>
    <table class="table table-hover">
      <thead>
        <tr class="table-guitar-header">
          <th>Название</th>
          <th>Тип</th>
          <th>Цена</th>
        </tr>
      </thead>
      <tbody>

        <?php
        foreach ($guitars as $item) {
          $guitar_id = $item["id"];
          $name = $item["name"];
          $price = $item["price"];
          $name = $item["name"];
          $type_id = $item["type_id"];
          $type_name = $item["type_name"];
          $type_path_image = $item["type_path_image"];
        ?>

          <tr>
            <td class="table-guitar-title">
              <a href="/guitar?guitar_id=<?php echo $guitar_id ?>">
                <?php echo $name ?>
              </a>
            </td>
            <td class="table-guitar-type">
              <a href="#"><img class="rounded" src="/public/<?php echo $type_path_image ?>" alt="вид">
                <p>
                  <?php echo $type_name ?>
                </p>
              </a>
            </td>
            <td class="table-guitar-price">
              <?php echo $price ?> руб.
            </td>
          </tr>

        <?php } ?>

      </tbody>
    </table>
    <div class="d-flex table-pagination">

      <?php
      $pages_cnt = (int)(($guitars_cnt + $limit - 1) / $limit);

      $left = $page - 1;
      $right = $page + 1;

      $skip = false;

      for ($i = 0; $i < $pages_cnt; $i++) {
        if ($i != 0 && ($i < $left || $i > $right) && $i != $pages_cnt - 1) {
          if (!$skip) {
            echo "<div class=\"table-pagination-item\">
                      <a href=\"#\">...</a>
                    </div>";
            $skip = true;
          }
          continue;
        }
        $skip = false;
        $href = "/?page=$i&limit=$limit";
      ?>

        <div class="table-pagination-item <?php if ($page == $i) echo "table-pagination-item-current" ?>">
          <a href="<?php echo $href ?>">
            <?php echo $i + 1 ?>
          </a>
        </div>

      <?php
      }
      ?>
    </div>
  </div>
</div>