<?php
if (!isset($_GET["id"])) {
    die("資料不存在");
    // header("location:/404.php");
}
$id = $_GET["id"];

require_once("db_connect.php");
$sql = "SELECT * FROM teachers WHERE id=$id";
$result = $conn->query($sql);
// $rows=$result->fetch_all(MYSQLI_ASSOC);
$row = $result->fetch_assoc();
// print_r($row);
// var_dump($row["id"]);
// exit;
?>

<!doctype html>
<html lang="en">

<head>
  <title>teacher</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <style>
   
  </style>
</head>

<body>

  <div class="container">
    <div class="py-2 d-flex justify-content-between align-items-center">
      <h2>講師</h2>
      <a class="btn btn-info" href="teachers-list-Ming.php">回講師列表</a>
    </div>
    <table class="table table-bordered">
      <tr>
        <td rowspan="5">
          
          <img class="" src="images/teachers/<?=$row["photo"]?>" alt="<?=$row["photo"]?>">
        </td>
        <th>名稱</th>
        <td><?=$row["name"]?></td>
        <th>性別</th>
        <td><?=$row["gender"]?></td>
      </tr>
      <tr>
        
        <th>手機</th>
        <td  colspan=3><?=$row["phone"]?></td>
      </tr>
      <tr>
        <th>信箱</th>
        <td colspan=3><?=$row["email"]?></td>
      </tr>
      <tr>
        <th>專長</th>
        <td colspan=3><?=$row["expertise"]?></td>
      </tr>
      <tr>
        <th>介紹</th>
        <td colspan=3><?=$row["introduce"]?></td>
      </tr>
    
    </table>
    <div class="py-2">
            <a class="btn btn-info" href="teacher-edit-Ming.php?id=<?=$row["id"]?>">編輯</a>
        </div>

  </div>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>