<?php

// if(isset($_GET["page"])){
//     $page=$_GET["page"];
// }else{
//     $page=1;
// }

// $page=isset($_GET["page"]) ? $_GET["page"] : 1;
//PHP 7.0 新增的寫法
$page = $_GET["page"] ?? 1;

$type=$_GET["type"] ?? 1;
// $page=$_GET["page"];


require_once("db_connect.php");

$sqlTotal = "SELECT * FROM member WHERE status=1";
$resultTotal = $conn->query($sqlTotal);
$totalUser = $resultTotal->num_rows;

$perPage = 5;
$startItem = ($page - 1) * $perPage;

//計算總共頁數
$totalPage=ceil($totalUser/$perPage);

if($type==1){
    // $sql = "SELECT id, name, phone, email FROM users WHERE valid=1 ORDER BY id ASC LIMIT $startItem, $perPage"; 
    $orderBy="ORDER BY id ASC";
}elseif($type==2){
    // $sql = "SELECT id, name, phone, email FROM users WHERE valid=1 ORDER BY id DESC LIMIT $startItem, $perPage"; 
    $orderBy="ORDER BY id DESC";
}elseif($type==3){
    $orderBy="ORDER BY name ASC";
}elseif($type==4){
    $orderBy="ORDER BY name DESC";
}else{
    header("location:../404.php");
}

$sql = "SELECT * FROM member WHERE status=1 $orderBy LIMIT $startItem, $perPage"; 

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>User list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <button class="btn btn-info" type="submit">搜尋</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        $user_count = $result->num_rows;
        ?>
        <div class="py-2 d-flex justify-content-between align-items-center">
            <a class="btn btn-info" href="create-user-allen.php">新增</a>
            <div>
                共 <?= $totalUser ?> 人, 第 <?= $page ?> 頁
            </div>
        </div>
        <div class="py-2 d-flex justify-content-end">
            <div class="btn-group">
                <a href="user-list-allen.php?page=<?= $page ?>&type=1" class="btn btn-info <?php if($type===1)echo "active"; ?>">id <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="user-list-allen.php?page=<?= $page ?>&type=2" class="btn btn-info <?php if($type===2)echo "active"; ?>">id <i class="fa-solid fa-arrow-down-wide-short"></i></i></a>
                <a href="user-list-allen.php?page=<?= $page ?>&type=3" class="btn btn-info <?php if($type===3)echo "active"; ?>">姓名 <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="user-list-allen.php?page=<?= $page ?>&type=4" class="btn btn-info <?php if($type===4)echo "active"; ?>">姓名 <i class="fa-solid fa-arrow-down-wide-short"></i></i></a>
            </div>
        </div>
        <?php
        // var_dump($rows);
        // exit;
        ?>
        <table class="table table-bordered">
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
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for($i=1; $i<=$totalPage; $i++): ?>
                <li class="page-item <?php
                    if($i==$page)echo "active";
                    ?>"><a class="page-link " href="user-list-allen.php?page=<?=$i?>&type=<?=$type?>"><?=$i?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>

</body>

</html>