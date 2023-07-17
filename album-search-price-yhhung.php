<?php

require_once("../db_connect.php");

//2.分頁
$pageOfAlbum =$_GET["page"] ?? 1;
// $min = $_GET["min"];
// $max = $_GET["max"];

if (isset($_GET["min"]) && isset($_GET["max"])) {
    $min = $_GET["min"];
    if ($min == "") $min = 0;
    $max = $_GET["max"];
    if ($max == "") $max = 999999;
  
    $whereClouse = "WHERE album.price>=$min AND album.price <=$max";
}else{

    $whereClouse = "";
}

// echo $min .",".$max;
// exit;


//2.分頁
$sqlAlbumTotalNum="SELECT price FROM album WHERE album.price >= $min AND album.price <= $max AND valid=1";
$resultAlbumTotalNum = $conn->query($sqlAlbumTotalNum);
$totalAlbum = $resultAlbumTotalNum->num_rows;

//2.分頁
$perPageOfAlbum=16;
$startItemOfAlbum=($pageOfAlbum-1)*$perPageOfAlbum;//0=(1-1)*5, 5=(2-1)*5 ,10=(3-1)*5
$totalPageOfAlbum=ceil($totalAlbum/$perPageOfAlbum);



$sql = "SELECT id, title, cover_image, price, format, artist FROM album 
    $whereClouse
    ORDER BY album.id ASC  LIMIT $startItemOfAlbum , $perPageOfAlbum ";


// echo"$sql";
// var_dump($sql);

$result = $conn->query($sql);
$resultCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);

//2.分頁


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

<!-- 2.分頁 -->
<nav aria-label="Page navigation example">

共 <?= $totalAlbum ?> 個, 第<?=$pageOfAlbum?> 頁 ,共<?=$totalPageOfAlbum?>頁
<ul class="pagination">

<?php for($i=1;$i<=$totalPageOfAlbum; $i++): ?>

<li class="page-item <?php
    if($i==$pageOfAlbum)echo "active";
    ?>"><a class="page-link " href="album-search-price-yhhung.php?min=<?=$min?>&max=<?=$max?>&page=<?=$i?>"><?=$i?></a></li>
    <!-- 連結連結連結 在上面 -->
<?php endfor;?>
</ul>


<a class="btn btn-info" href="album-list-yhhung.php">回唱片列表</a>
<br>

</nav>
        <!-- 連結連結連結  -->
        <form action="album-search-price-yhhung.php"  class="form-control">
                <div class="row gx-3">
                    <!-- 0630-1加個判斷 如果有篩選結果才顯示回產品列表按鈕 -->
                    <?php if (isset($_GET["min"])) :  ?>
                        <!-- 連結連結連結  -->
                        <!-- <div class="col-auto">
                            <a class="btn btn-info" href="album-list-yhhung.php">回唱片列表</a>
                        </div> -->

                    <?php endif; ?>
                    <div class="col-auto">
                        <input type="number" class="form-control" name="min" value="<?php if (isset($_GET["min"])) echo $_GET["min"] ?>">
                    </div>
               
                    <div class="col-auto">
                        ~
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control" name="max" value="<?php if (isset($_GET["max"])) echo $_GET["max"]   ?>">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-info">價錢篩選</button>
                    </div>
                </div>
            </form>



            <div class="row g-3">
            <?php foreach ($rows as $album) : ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                    <!-- 連結連結連結 -->
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