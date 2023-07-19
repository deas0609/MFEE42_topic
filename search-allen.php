<?php

$name = $_GET["name"];
require_once("db_connect.php");

if(empty($name)){
    $name=null;
    $sql = "SELECT * FROM member";
    
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $user_count = 0;
}

if (isset($name)) {

    $sql = "SELECT id, name, account, gender, birthday, email, address, phone FROM member WHERE name LIKE'%$name%' AND status=1";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $user_count = $result->num_rows;
} else {
    $user_count = 0;
}

// var_dump($row);
?>




<!doctype html>
<html lang="en">

<head>
    <title>search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <form action="search-allen.php">
                <div class="row gx-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="搜尋使用者" name="name">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-success" type="submit">搜尋
                        </button>
                    </div>
                </div>
            </form>

        </div>



        <?php if (isset($_GET["name"])) : ?>
            <div>
                搜尋 <?= $name ?> 的結果, 共有<?= $user_count ?> 筆符合的資料
            </div>
        <?php endif ?>
        <?php if ($user_count != 0) : ?>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>姓名</th>
                        <th>帳號</th>
                        <th>性別</th>
                        <th>生日</th>
                        <th>email</th>
                        <th>地址</th>
                        <th>電話</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["name"] ?></td>
                            <td><?= $row["account"] ?></td>
                            <td><?= $row["gender"] ?></td>
                            <td><?= $row["birthday"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td><?= $row["address"] ?></td>
                            <td><?= $row["phone"] ?></td>
                            <td>
                                <a href="user-allen.php?id=<?= $row["id"] ?>" class="btn btn-info">顯示</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>