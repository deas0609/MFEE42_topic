<?php
require_once("db_connect.php");

// 每頁幾筆
$page = $_GET["page"] ?? 1;
$countPerPage=$_GET["countPerPage"]??10;
$start = ($page - 1) * $countPerPage;

// 計算頁數
$sqlPage = "SELECT * FROM ch WHERE valid=1";
$resultPage = $conn->query($sqlPage);
$numDiscount = $resultPage->num_rows;
$totalPageCount = ceil($numDiscount / $countPerPage);

//升冪降冪控制
include("./modal/sortType_Ch.php");


$sql = "SELECT * FROM ch WHERE valid=1 ORDER BY $where LIMIT $start,$countPerPage ";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
  <title>優惠券目錄</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!-- modal -->
  <?php include("./modal/searchbar_Ch.php") ?><!-- 搜尋 -->
  <!-- modal -->

  <div class="container">

    <div class="mt-2">
      <a href="./discountIndex_Ch.php" class="h2 text-decoration-none">優惠券目錄</a>
    </div>

    <div class="my-3">
      <div class="d-flex">
        <button class="btn btn-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-magnifying-glass"></i> 搜尋</button>
        <div>
          <a href="discountCreat_Ch.php" class="btn btn-primary"><i class="fa-solid fa-file-circle-plus"></i> 新增</a>
        </div>
      </div>

      <div class="d-flex justify-content-end mb-4">
      <div class="btn-group me-2">
          <button class="form-select " data-bs-toggle="dropdown" aria-expanded="false">
            單頁筆數
          </button>
          <ul class="dropdown-menu">
            <?php for($i=10;$i<=50;$i+=10): ?>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?countPerPage=<?=$i?>"><?=$i?></a></li>
            <?php endfor; ?>
          </ul>
        </div>
        <div class="btn-group float-end">
          <button class="form-select " data-bs-toggle="dropdown" aria-expanded="false">
            排序條件
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=1">id升冪</a></li>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=2">id降冪</a></li>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=3">折扣升冪</a></li>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=4">折扣降冪</a></li>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=5">有效日期升冪</a></li>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=6">有效日期降冪</a></li>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=7">啟用</a></li>
            <li><a class="dropdown-item" href="discountIndex_Ch.php?type=8">停用</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">優惠券名稱</th>
            <th class="text-center">折扣內容</th>
            <th class="text-center">最低消費</th>
            <th class="text-center">折扣代碼</th>
            <th class="text-center">有效期限</th>
            <th class="text-center">啟用/停用</th>
            <th class="text-center">最後更新時間</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $row) : ?>
            <tr>
              <td class="text-center"><?= $row["id"] ?></td>
              <td class="text-center text-truncate" style="max-width:20px"><?= $row["discountName"] ?></td>
              <td class="text-center"><?php 
              if ($row["countType"] == 1) {
                 echo $row["discount"] . "元";
              } else {echo $row["discount"] . "%";
              } ?></td>
              <td class="text-center"><?= $row["minimum"] ?></td>
              <td class="text-center text-truncate" style="max-width:20px"><?= $row["discountCode"] ?></td>
              <td class="text-center"><?= $row["startDate"] ?> ~ <?= $row["endDate"] ?></td>
              <td class="text-center <?php if($row["enable"]==1) {echo "text-success"; }else{echo "text-danger";}?>">
                  <?php if($row["enable"]==1) {echo "啟用"; }else{echo "停用";}?>
              </td>
              <td class="text-center"><?= $row["created_at"] ?></td>
              <td class="d-flex justify-content-evenly">
                <a href="discountDetail_Ch.php?id=<?= $row["id"] ?>" class="btn btn-primary">查看 <i class="fa-solid fa-right-to-bracket"></i> </a>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row["id"] ?>">刪除 <i class="fa-solid fa-trash-can"></i> </button>
              </td>
            </tr>

             <!-- 以下刪除提示 -->
               <?php include("./modal/deleteMessage_Ch.php"); ?>
              <!-- 以上刪除提示 -->

          <?php endforeach ?>
        </tbody>
      </table>
    </div>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item <?php if (!isset($_GET["page"]) || $_GET["page"] == 1) {
                                echo "disabled";} ?>">
          <a class="page-link " href="discountIndex_Ch.php?page=<?= $page - 1 ?>&<?php if (isset($type)) {
                                                                                echo "type=$type";} ?>&<?php if(isset($countPerPage)){ echo "countPerPage=$countPerPage";} ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php for ($i = 1; $i <= $totalPageCount; $i++) : ?>
          <li class="page-item <?php if ($page == $i) { echo "active";} ?>"><a class="page-link" href="discountIndex_Ch.php?page=<?= $i ?> &<?php if (isset($type)) { echo "type=$type";} ?>&<?php if(isset($countPerPage)){ echo "countPerPage=$countPerPage";} ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php if (isset($_GET["page"]) && $_GET["page"] == $totalPageCount) {echo "disabled";} ?> ">
          <a class="page-link" href="discountIndex_Ch.php?page=<?= $page + 1 ?>&<?php if (isset($type)) { echo "type=$type";} ?>&<?php if(isset($countPerPage)){ echo "countPerPage=$countPerPage";} ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>

    <div>共 <?= $numDiscount ?> 筆</div>


  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

</body>

</html>