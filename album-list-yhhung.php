<?php
require_once("db_connect.php");


//2.分頁
$pageOfAlbum =$_GET["page"] ?? 1;

//test
$type =$_GET["type"] ?? 1;


//2.分頁
$sqlAlbumTotalNum="SELECT id FROM album WHERE valid=1 ";
$resultAlbumTotalNum = $conn->query($sqlAlbumTotalNum);
$totalAlbum = $resultAlbumTotalNum->num_rows;

//2.分頁
$perPageOfAlbum=16;
$startItemOfAlbum=($pageOfAlbum-1)*$perPageOfAlbum;//0=(1-1)*5, 5=(2-1)*5 ,10=(3-1)*5
$totalPageOfAlbum=ceil($totalAlbum/$perPageOfAlbum);

//1.唱片
$sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.id ASC LIMIT $startItemOfAlbum , $perPageOfAlbum";

if($type==1){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.id ASC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}elseif($type==2){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.id DESC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}elseif($type==3){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.title ASC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}elseif($type==4){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.title DESC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}elseif($type==5){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.year ASC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}elseif($type==6){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.year DESC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}elseif($type==7){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.price ASC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}elseif($type==8){
    $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid=1 ORDER BY album.price DESC LIMIT $startItemOfAlbum , $perPageOfAlbum";
}else{
    header("locaction: ../404.php");
}



// $valid = 1;
// $order = '';

// switch ($type) {
//     case 1:
//         $order = 'ORDER BY album.id ASC';
//         break;
//     case 2:
//         $order = 'ORDER BY album.id DESC';
//         break;
//     case 3:
//         $order = 'ORDER BY album.title ASC';
//         break;
//     case 4:
//         $order = 'ORDER BY album.title DESC';
//         break;
//     case 5:
//         $order = 'ORDER BY album.year ASC';
//         break;
//     case 6:
//         $order = 'ORDER BY album.year DESC';
//         break;
//     case 7:
//         $order = 'ORDER BY album.price ASC';
//         break;
//     case 8:
//         $order = 'ORDER BY album.price DESC';
//         break;
//     default:
//         header("Location: ../404.php");
//         exit();
// }

// $sql = "SELECT id, title, artist, format, cover_image, price, year FROM album WHERE valid = $valid $order LIMIT $startItemOfAlbum, $perPageOfAlbum";

$result = $conn->query($sql);



//1.唱片
$result = $conn->query($sql);
$resultCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);






?>

<!doctype html>
<html lang="en">

<head>
  <title>album-list</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">




    <!-- 搜尋唱片by title -->
    <div class="py-2">
    <!-- 連結連結連結 -->
      <!-- <form action="album-search-title-yhhung.php" method="get" class="form-control">
        <div class="row gx-2">
            <div class="col">
                <input type="text" class="form-control" placeholder="請搜尋專輯標題" name="title" required>
            </div>
            <div class="col-auto">
                
                <button class="btn btn-info" type="submit">搜尋標題</button>
            </div>


        </div>
      </form>
    </div> -->




        <div class="row ">
        <div class="col-6">
                                <!-- 搜尋唱片by price -->
                <form action="album-search-price-yhhung.php"  class="form-control" class="form-control ">
                    <div class="row gx-3 ">
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

        </div>

                    <!-- 搜尋唱片by genre -->
        <div class="col-4">
        <!-- 連結連結連結 -->
            <form action="album-search-genre-yhhung.php" method="get" class="form-control">
            <div class="row gx-2">
            <div class="col">
                <select type="text" class="form-control" placeholder="搜尋唱片genre" name="genre" placeholder="請選擇音樂類型" required>
                            <option value="">請選擇音樂類型</option>
                            <option value="Electronic">電子音樂</option>
                            <option value="Rock">搖滾</option>
                            <option value="Pop">流行</option>
                            <option value="Folk, World, & Country">鄉村和民謠音樂</option>
                            <option value="Jazz">爵士</option>
                            <option value="Hip Hop">嘻哈</option>
                            <option value="Funk / Soul">放克 / 靈魂樂</option>
                            <option value="Reggae">雷鬼</option>
                            <option value="Blues">藍調</option>
                            <option value="Stage & Screen">舞台和電影音樂</option>
                </select>
            </div>
            <div class="col-auto">
                
                <button class="btn btn-info" type="submit">搜尋類別</button>
            </div>


            </div>
            </form>
        </div>

            <div class="col-2 d-flex flex-row-reverse">
                         <!-- 進階搜尋的連結 -->
                        <!-- 連結連結連結 -->
                        <a class="btn btn-info" href="album-search-form-yhhung.php">進階搜尋</a>

            </div>
        </div>





<div class="row mt-2">
        <div class="col-2 ">
                        <!-- create-album-info.php的連結 -->
                    <div class="py-2">
                        <!-- 連結連結連結 -->
                        <a class="btn btn-success"href="create-album-info-yhhung.php">新增唱片</a>
                    </div>

        </div>
        <div class="col-7">
            &nbsp;
        </div>
        <div class="col-2">
            

        </div>

        <div class="col-1">
                            <!-- test -->
            <div class="btn-group ">
    <!-- 連結連結連結*8 -->
            <button class="form-select " data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-primary">
                排序
            </button>
                <ul class="dropdown-menu">
                    <li><a href="album-list-yhhung.php?page=<?=$pageOfAlbum?>&type=1" class="dropdown-item <?php if($type==1)echo "active"; ?>">依上架日期(舊到新)</a></li>
                    <li><a href="album-list-yhhung.php?page=<?=$pageOfAlbum?>&type=2" class="dropdown-item <?php if($type==2)echo "active"; ?>">依上架日期(新到舊)</a></li>
                    <li><a href="album-list-yhhung.php?page=<?=$pageOfAlbum?>&type=3" class="dropdown-item <?php if($type==3)echo "active"; ?>">title↑</a></li>
                    <li><a href="album-list-yhhung.php?page=<?= $pageOfAlbum ?>&type=4" class="dropdown-item <?php if($type==4)echo "active"; ?>">title↓</a></li>
                    <li><a href="album-list-yhhung.php?page=<?=$pageOfAlbum?>&type=5" class="dropdown-item <?php if($type==5)echo "active"; ?>">依年分(舊到新)</a></li>
                    <li><a href="album-list-yhhung.php?page=<?= $pageOfAlbum ?>&type=6" class="dropdown-item <?php if($type==6)echo "active"; ?>">依年分(新到舊)</a></li>
                    <li><a href="album-list-yhhung.php?page=<?=$pageOfAlbum?>&type=7" class="dropdown-item <?php if($type==7)echo "active"; ?>">價格(低到高)</a></li>
                    <li><a href="album-list-yhhung.php?page=<?= $pageOfAlbum ?>&type=8" class="dropdown-item <?php if($type==8)echo "active"; ?>">價格(高到低)</a></li>
                </ul>
            </div>
        </div>
    </div>









                        






        <!-- 1.唱片 -->
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

         <!-- 2.分頁 -->
        <nav aria-label="Page navigation example">

                共 <?= $totalAlbum ?> 個, 第<?=$pageOfAlbum?> 頁 ,共<?=$totalPageOfAlbum?>頁
            <ul class="pagination">
                
            <?php for($i=1;$i<=$totalPageOfAlbum; $i++): ?>

                <li class="page-item <?php
                    if($i==$pageOfAlbum)echo "active";
                    ?>"><a class="page-link " href="album-list-yhhung.php?page=<?=$i?>&type=<?=$type?>"><?=$i?></a></li>
                    <!-- 連結連結連結 在上面 -->
            <?php endfor;?>
            </ul>
        </nav>
        
        
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