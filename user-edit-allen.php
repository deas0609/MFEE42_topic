<?php
if (!isset($_GET["id"])) {
    // die("資料不存在");
    header("location: /404.php");
}
$id = $_GET["id"];

require_once("db_connect.php");
$sql = "SELECT * FROM member WHERE id=$id AND status=1";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
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
        <a href="doDelete-allen.php?id=<?=$id?>" class="btn btn-danger">確認</a>
      </div>
    </div>
  </div>
</div>

    <div class="container">
        <form action="doUpdate-allen.php" method="post">
            <table class="table table-bordered ">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <tr>
                    <th>姓名</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["name"] ?>" name="name">
                    </td>
                </tr>
                <tr>
                    <th>帳號</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["account"] ?>" name="account">
                    </td>
                </tr>
                <tr>
                    <th>生日</th>
                    <td>
                        <input type="date" value="<?= $row["birthday"] ?>" name="birthday">
                    </td>
                </tr>
                <tr>
                    <th>email</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["email"] ?>" name="email">
                    </td>
                </tr>
                <tr>
                    <th>地址</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["address"] ?>" name="address">
                    </td>
                </tr>
                <tr>
                    <th>電話</th>
                    <td>
                    <input type="tel" class="form-control" value="<?= $row["phone"] ?>" name="phone">
                    </td>
                </tr>
                <tr>
                    <th>註冊時間</th>
                    <td><?= $row["created_at"] ?></td>
                </tr>
            </table>
            <div class="py-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-primary" type="submit">儲存</button>
                    <a class="btn btn-secondary" href="user-allen.php?id=<?=$row["id"]?>">取消</a>
                </div>
                <button class="btn btn-danger" 
                type="button"
                data-bs-toggle="modal" data-bs-target="#deleteModal">刪除</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>

    </script>
</body>

</html>