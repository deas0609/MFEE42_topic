<?php
require_once("db_connect.php");

$page=isset($_GET["page"]) ? $_GET["page"] : 1;

$sqlTotal = "SELECT * FROM teachers";

$resultTotal = $conn->query($sqlTotal);
$rows = $resultTotal->fetch_all(MYSQLI_ASSOC);
$rowsCount=$resultTotal->num_rows;  //總數

$perPage=5; //一頁幾個
$StartItem = ($page - 1) * $perPage;

$totalPage = ceil($rowsCount / $perPage);  //總頁數=總數目/一頁幾個 後無條件進位

// print_r($result);
// echo "<br>";
// print_r($rows);
?>

<!doctype html>
<html lang="en">

<head>
  <title>teachers-list</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">


</head>

<body>
  <div class="container">
    <h2>講師列表</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>id</th>
          <th>姓名</th>
          <th>性別</th>
          <th>手機</th>
          <th>email</th>
          <th>專長</th>
          <th>介紹</th>
          <th>圖片</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($rows as $row) : ?>
          <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><?= $row["gender"] ?></td>
            <td><?= $row["phone"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["expertise"] ?></td>
            <td><?= $row["introduce"] ?></td>
            <td><img src="images/teachers/<?= $row["photo"] ?>" alt=""></td>
            <td>
              <a href="" class="btn btn-info">編輯</a>

            </td>

          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
    <!-- 分頁 -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php for ($i=1; $i <= $totalPage ; $i++) :?>
        
        <li class="page-item">
          <a class="page-link" href="teachers-list-Ming?pag=<?=$i?>"><?=$i?></a>
      </li>
        
        <?php  endfor; ?>

        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>

  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>