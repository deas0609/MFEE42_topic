<?php
if(!isset($_GET["id"])){
    // die("資料不存在");
    header("location: /404.php");
}
$id=$_GET["id"];

require_once("db_connect.php");
$sql="SELECT * FROM member WHERE id=$id AND status=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);




?>

<!doctype html>
<html lang="en">
<head>
  <title>User</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-info" href="user-list-allen.php">回使用者列表</a>
        </div>
        <table class="table table-bordered ">
            <tr>
                <th>姓名</th>
                <td><?=$row["name"]?></td>
            </tr>
            <tr>
                <th>帳號</th>
                <td><?=$row["account"]?></td>
            </tr>
            <tr>
                <th>性別</th>
                <td><?=$row["gender"]?></td>
            </tr>
            <tr>
                <th>生日</th>
                <td><?=$row["birthday"]?></td>
            </tr>
            <tr>
                <th>email</th>
                <td><?=$row["email"]?></td>
            </tr>
            <tr>
                <th>地址</th>
                <td><?=$row["address"]?></td>
            </tr>
            <tr>
                <th>電話</th>
                <td><?=$row["phone"]?></td>
            </tr>
            <tr>
                <th>註冊時間</th>
                <td><?=$row["created_at"]?></td>
            </tr>
        </table>
        <div class="py-2">
            <a class="btn btn-info" href="user-edit-allen.php?id=<?=$row["id"]?>">編輯</a>
        </div>
      

    </div>
</body>

</html>