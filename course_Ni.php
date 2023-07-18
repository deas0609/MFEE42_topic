<?php

require_once("db_connect.php");

$sqlTotal="SELECT * FROM course WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);
$TotalCourse=$resultTotal->num_rows;

$perPage = 5;
$page=$_GET["page"] ?? 1;
$startItem = ($page - 1) * $perPage;
//計算頁數
$totalPage=ceil($TotalCourse/$perPage);
 
$type=$_GET["type"] ?? 1;

if($type==1){
  $sql = "SELECT * FROM course WHERE valid=1 ORDER BY course_id ASC  LIMIT $startItem,$perPage";
}elseif($type==2){
  $sql = "SELECT * FROM course WHERE valid=1 ORDER BY course_id DESC  LIMIT $startItem,$perPage";
}

// $id = $_GET["id"];
// $sql = "SELECT * FROM course WHERE valid=1 LIMIT $startItem,$perPage";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['search'])) {
  $searchKeyword = $_POST['search'];
} elseif (isset($_GET['search'])) {
  $searchKeyword = $_GET['search'];
}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Course</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .cimg {
      height: 60px;
    }
  </style>
</head>

<body>


  <div class="container">
    <div class="row">
      <h1 class="mt-3 mp-3 text-info ">課程管理</h1>
      <table class="table table-striped table-hover">
        <div class="p-2 d-flex justify-content-between">
          <?php
          $course_count = $result->num_rows; ?>
          <h5>共計<?= $TotalCourse ?>筆結果, 第<?=$page?>頁</h5>
          
          <a href="add_test_Ni.php" class="btn btn-info mb-1">新增課程</a>
        </div>
        <div class="p-2 d-flex ">
            <div>
              <a href="course_Ni.php?page=<?= $page ?>&type=1" class="btn btn-info">id<i class="fa-solid fa-angles-down"></i></a>
              <a href="course_Ni.php?page=<?= $page ?>&type=2" class="btn btn-info">id<i class="fa-solid fa-angles-up"></i></a>
            </div>
          </div>

        <form action="search_Ni.php">
          <div class="py-2 d-flex">
            <input class="form-control me-2" type="search" placeholder="Search course" aria-label="Search" name="name">
            <button class="btn btn-outline-info" type="submit">Search</button>
          </div>
        </form>

        <thead>
          <tr>
            <th>ID</th>
            <th>圖片</th>
            <th>課程名稱</th>
            <th>課程資訊</th>
            <th class="text-truncate">課程價格</th>
            <th class="text-truncate">上架時間</th>
            <th class="text-truncate">下架時間</th>
            <th>修改</th>
            <th>刪除</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $row) : ?>
            <tr>
              <td>
                <?php echo $row['course_id']; ?>
              </td>
              <td><img class="cimg" src="images/Ni_img/<?= $row["img"] ?>" alt="圖片"></td>
              <td><?php echo $row['name']; ?></td>
              <td class="d-inline-block text-truncate" style="max-width: 550px; height:100px"><?php echo $row['directions']; ?></td>
              <td class="text-truncate"><?php echo $row['price']; ?>元</td>
              <td class="text-truncate"><?php echo $row['up_date']; ?></td>
              <td class="text-truncate"><?php echo $row['shelf_time']; ?></td>
              <td><a href="edit_Ni.php?course_id=<?=$row['course_id'] ?>" class="btn btn-info">修改</a></td>
              <td><button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['course_id'] ?>">刪除</button></td>
            </tr>
            <div class="modal fade" id="deleteModal<?= $row['course_id'] ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    確認刪除?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="delete_Ni.php?id=<?= $row['course_id'] ?>" class="btn btn-danger">確認</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
            <li class="page-item <?php if($i==$page) echo 'active';?>"><a class="page-link" href="course_Ni.php?page=<?= $i ?>&type=<?=$type?>"><?= $i ?></a></li>
          <?php endfor; ?>
        </ul>
      </nav>

    </div>
  </div>





  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>