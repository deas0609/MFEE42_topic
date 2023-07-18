<?php
$name=$_GET["name"];
require_once("db_connect.php");

$sql = "SELECT course_id,img, name, directions, price, up_date, shelf_time FROM course WHERE name LIKE '%$name%'";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
        <div class="py-2 d-flex justify-content-between">
          <?php
          $course_count = $result->num_rows; ?>
          <h5>共計<?= $course_count ?>筆結果</h5>
          <a href="course_Ni.php" class="btn btn-info mb-3">返回首頁</a>
        </div>
        <form action="search_Ni.php">
          <div class="py-2 d-flex">
            <input class="form-control me-2" type="search" placeholder="Search course" aria-label="Search" name="search">
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
              <td class="d-inline-block text-truncate" style="max-width: 600px;"><?php echo $row['directions']; ?></td>
              <td class="text-truncate"><?php echo $row['price']; ?>元</td>
              <td class="text-truncate"><?php echo $row['up_date']; ?></td>
              <td class="text-truncate"><?php echo $row['shelf_time']; ?></td>
              <td><a href="" class="btn btn-info">修改</a></td>
              <td><button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?=$row['course_id']?>">刪除</button></td>
            </tr>
            <div class="modal fade" id="deleteModal<?=$row['course_id']?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
    </div>
  </div>

</body>

</html>