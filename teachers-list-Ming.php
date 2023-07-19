<?php
require_once("db_connect.php");

$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$type=$_GET["type"] ?? 1;
$sqlTotal = "SELECT * FROM teachers"; //所有

$resultTotal = $conn->query($sqlTotal);
// $rows = $resultTotal->fetch_all(MYSQLI_ASSOC); //總數資料
$rowsTotalCount = $resultTotal->num_rows;  //總數

$perPage = 5; //一頁幾個
$StartItem = ($page - 1) * $perPage;

$totalPage = ceil($rowsTotalCount / $perPage);  //總頁數=總數目/一頁幾個 後無條件進位

// print_r($result);
// echo "<br>";
// print_r($rows);
if ($type==1) {
 
  $orderBy="ORDER BY id ASC";
}elseif ($type==2) {
 
  $orderBy="ORDER BY id DESC";
}elseif ($type==3) {
  $orderBy="ORDER BY name ASC";
}elseif ($type==4) {
  $orderBy="ORDER BY name DESC";
}else{
  // header("location: ../404.php");
  exit("404");
}




$sqlPage = "SELECT * FROM teachers $orderBy  LIMIT $StartItem,$perPage"; //分頁
$resultPage = $conn->query($sqlPage);
$rowPage = $resultPage->fetch_all(MYSQLI_ASSOC);
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
  <!-- font awesome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
  <div class="container">
    <h2>講師列表</h2>
    <!-- 搜尋 -->
    <div class="py-2">
      <form action="searenTeacher-Ming.php">
        <div class="row gx-2">
          <div class="col">
            <input type="text" class="form-control" placeholder="搜尋講師" name="name">
          </div>
          <div class="col-auto">
            <button class="btn btn-info" type="submit">搜尋</button>
          </div>
        </div>
      </form>
    </div>

    <div class="py-2 d-flex justify-content-between align-items-center">
      <a class="btn btn-info" href="addTeacher-Ming.php">新增</a>
      <div>
        共 <?= $rowsTotalCount ?> 人, 第 <?= $page ?> 頁
      </div>
    </div>

    <!-- 篩選 -->
    <div class="py-2 d-flex justify-content-end">
      <div class="btn-group">
        <a href="teachers-list-Ming.php?page=<?= $page ?>&type=1" class="btn btn-info <?php if ($type == 1) echo "active"; ?> ">id <i class="fa-solid fa-arrow-down-short-wide"></i></a>

        <a href="teachers-list-Ming.php?page=<?= $page ?>&type=2" class="btn btn-info <?php if ($type == 2) echo "active"; ?>">id <i class="fa-solid fa-arrow-down-wide-short"></i></a>

        <a href="teachers-list-Ming.php?page=<?= $page ?>&type=3" class="btn btn-info <?php if ($type == 3) echo "active"; ?> ">姓名 <i class="fa-solid fa-arrow-down-short-wide"></i></a>

        <a href="teachers-list-Ming.php?page=<?= $page ?>&type=4" class="btn btn-info <?php if ($type == 4) echo "active"; ?>">姓名 <i class="fa-solid fa-arrow-down-wide-short"></i></a>

      </div>

    </div>

    <!-- 顯示資料 -->
    <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>id</th>
          <th>名稱</th>
          <th>性別</th>
          <th>手機</th>
          <th>email</th>
          <th>專長</th>
          <!-- <th>介紹</th> -->
          <th>圖片</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($rowPage as $row) : ?>
          <tr>
            <td><?= $row["id"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><?= $row["gender"] ?></td>
            <td><?= $row["phone"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["expertise"] ?></td>
            <!-- <td><?= $row["introduce"] ?></td> -->
            <td><img src="images/teachers/<?= $row["photo"] ?>" alt=""></td>
            <td>
              <a href="teacher-Ming.php?id=<?= $row["id"] ?>" class="btn btn-info">顯示</a>

            </td>

          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
    </div>
    <!-- 分頁 -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="teachers-list-Ming.php?page=1&type=<?=$type?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>

          <li class="page-item <?php if ($i == $page) echo "active"; ?>">
            <a class="page-link" href="teachers-list-Ming.php?page=<?= $i ?>&type=<?=$type?>"><?= $i ?></a>
          </li>

        <?php endfor; ?>

        <li class="page-item">
          <a class="page-link" href="teachers-list-Ming.php?page=<?= $totalPage ?>&type=<?=$type?>" aria-label="Next">
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