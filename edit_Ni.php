<?php

require_once("db_connect.php");

$id = $_GET["course_id"];

$sql = "SELECT * FROM course WHERE $id=course_id AND valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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

</head>

<body>
    <div class="container">
    <a href="course_Ni.php" class="btn btn-info mb-3">返回首頁</a>
        <form action="update_Ni.php" method="post">
            <thead>  
                <input type="hidden" name="course_id" value="<?= $row["course_id"] ?>">
                <!-- <tr>
                    <th>排序</th>
                    <td><input type="text" class="form-control" value="<?= $row["course_id"]?>" name="course_id"></td>
                </tr> -->
                <tr>
                    <th>圖片</th>
                    
                    <td>
                      <img src="/MFEE42_topic/images/Ni_img/<?=$row["img"]?>" alt="<?= $row["img"]?>"width="100" height="100">  
                      <input type="file" class="form-control"  name="new_img">
                      <input type="hidden" name="old_img" value="<?= $row["img"] ?>">
                    </td>
                </tr>
                <tr>
                     <th>課程名稱</th>
                     <input type="text" class="form-control" value="<?= $row["name"]?>" name="name"></td>
                </tr>
                <tr>
                    <th>課程資訊</th>
                    <td><input type="text" class="form-control" value="<?= $row["directions"]?>" name="directions"></td>
                </tr>
                <tr>

                </tr>
                <tr>
                    <th class="text-truncate">課程價格</th>
                    <td><input type="text" class="form-control" value="<?= $row["price"]?>" name="price"></td>
                </tr>
                <tr>
                     <th class="text-truncate">上架時間</th>
                     <td><input type="date" class="form-control" value="<?= $row["up_date"]?>" name="up_date"></td>
                </tr>
                <tr>
                    <th class="text-truncate">下架時間</th>
                    <td><input type="date" class="form-control" value="<?= $row["shelf_time"]?>" name="shelf_time"></td>
                </tr>
                    
                    
                
                <button type="submit" class="btn btn-info">完成</button> 
                   
        </form>
    </div>



  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>