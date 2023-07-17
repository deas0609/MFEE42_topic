<?php

require_once("db_connect.php");

if(!isset($_GET["id"])){
  header("location:404page_Ch.php");
}

$id = $_GET["id"];
$sql = "SELECT * FROM ch WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);；

?>

<!doctype html>
<html lang="en">

<head>
  <title>優惠券內容</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container">
    <h2 class="my-2">優惠券內容</h2>
    <div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>優惠券名稱</th>
            <td><?= $row["discountName"] ?></td>
          </tr>
          <tr>
            <th>折扣內容</th>
            <td><?= $row["discount"] ?></td>
          </tr>
          <tr>
            <th>折扣種類</th>
            <td><?php if ($row["countType"] == 1) {
                  echo "元";
                } else {
                  echo "%";
                } ?></td>
          </tr>
          <tr>
            <th>最低消費</th>
            <td><?= $row["minimum"] ?></td>
          </tr>
          <tr>
            <th>折扣代碼</th>
            <td><?= $row["discountCode"] ?></td>
          </tr>
          <tr>
            <th>開始日期</th>
            <td><?= $row["startDate"] ?></td>
          </tr>
          <tr>
            <th>結束日期</th>
            <td><?= $row["endDate"] ?></td>
          </tr>
          <tr>
            <th>啟用/停用</th>
            <td><?php if($row["enable"]==1) {echo "啟用"; }else{echo "停用";}?></td>
          </tr>
        </thead>
      </table>
    </div>
    <a href="editPage_Ch.php?id=<?= $id ?>" class="btn btn-primary"> <i class="fa-solid fa-pen-to-square"></i> 編輯</a>
    <a href="discountIndex_Ch.php" class="btn btn-primary"> <i class="fa-solid fa-reply"></i> 返回列表 </a>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>