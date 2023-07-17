<?php



if (isset($_GET["title"])) {
    $title = $_GET["title"];



$title=$_GET["title"];
require_once("db_connect.php");


$sql="SELECT id, title,cover_image,price,format,artist FROM album WHERE title LIKE '%$title%' AND valid=1";

$result=$conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);

$album_count = $result->num_rows;


}else{
    $album_count=0;
}


?>





<!doctype html>
<html lang="en">

<head>
  <title>Search</title>
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
            <!-- 連結連結連結 -->
        <a class="btn btn-info" href="album-list-yhhung.php">回唱片列表</a>
        </div>
        <div class="py-2">
        <!-- 連結連結連結  -->
            <form action="album-search-title-yhhung.php" method="get" class="form-control">
            <div class="row gx-2">
                <div class="col">
                    <input type="text" class="form-control" 
                    placeholder="搜尋唱片"
                    name="title"
                    >
                </div>
                <div class="col-auto">
                    <button class="btn btn-info" type="submit">搜尋</button>
                </div>
            </div>
            </form>
        </div>
     
        <div class="py-2 d-flex justify-content-between align-items-center">
    
        <!-- 會出錯  所以增加以下判斷   -->
            <?php if(isset($_GET["title"])):  ?>

    
            <div>
                <!-- 新增以下 -->
            搜尋的 <?= $title?>結果
            
            ,共有 <?= $album_count ?> 筆符合的資料
            </div>
            
            <?php endif; ?>

        </div>

        <!-- 新增以下php 當搜尋筆數不等於0時才跑出下面的表格 ，記得在表格結束的地方加endif-->
        <?php if($album_count!=0): ?>
          <div class="row g-3">
          <?php foreach ($rows as $album) : ?>
          <div class="col-lg-3 col-md-6">
                    <div class="card">
                    <!-- 連結連結連結  -->
                        <a href="album-yhhung.php?id=<?= $album["id"] ?>">
                            <figure class="ratio ratio-1x1 ">
                                <img src="images/alburm/<?= $album["cover_image"] ?>" alt="<?= $album["title"] ?>" class="object-fit-cover card-img-top">
                            </figure>
                      
                        </a>
                        <div class="px-3 mb-3">

                            <div class="pb-2 ">
                                <p class="text-success text-decoration-none" ><?= $album["format"] ?></p>
                            </div>


                            <!-- 連結連結連結  -->
                            <h3 class="h4"><a href="album-yhhung.php?id=<?= $album["id"] ?>"><?= $album["title"] ?></a></h3>
                            <h3 class="h5"><?= $album["artist"] ?></h3>
                            <div class="price text-end h5 text-success">$<?= $album["price"] ?></div>


                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
           
        <?php endif; ?>

    </div>
</body>

</html>