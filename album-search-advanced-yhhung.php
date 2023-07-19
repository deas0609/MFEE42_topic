<?php

//排序
$type =$_GET["type"] ?? 1;

// 新增以下if else 兩部分 part1
if (isset($_GET["genre"])) {
    $genre = $_GET["genre"];

//2.分頁
$pageOfAlbum = $_GET["page"] ?? 1;
//2.分頁
$perPageOfAlbum = 16;
$startItemOfAlbum = ($pageOfAlbum - 1) * $perPageOfAlbum; //0=(1-1)*5, 5=(2-1)*5 ,10=(3-1)*5


require_once("db_connect.php");

$title = $_GET["title"] ?? "";
$artist = $_GET["artist"] ?? "";
$format = $_GET["format"] ?? "";



$priceMin = $_GET["min"];
$priceMax = $_GET["max"];
if (empty($priceMin)) {
    $priceMin = 0;
}
if (empty($priceMax)) {
    $priceMax = 99999;
}
$priceRange = "price >= $priceMin AND price <= $priceMax AND";

$yearStart = $_GET["startyear"];
$yearEnd = $_GET["endyear"];

if (empty($yearStart) && empty($yearEnd)) {
    $yearStart = 1900;
    $yearEnd = 2099;
} elseif (!empty($yearStart) && empty($yearEnd)) {
    $yearEnd = $yearStart;
} elseif (empty($yearStart) && !empty($yearEnd)) {
    $yearStart = $yearEnd;
} else {
    // $yearStart 和 $yearEnd 都有值的情況下的處理邏輯
    // 在這裡添加您想要執行的程式碼
}

$yearRange = "year >= $yearStart AND year <= $yearEnd AND";



$sqlGenre1="SELECT id, title,cover_image,price,format,artist, genre_1, year, released_date FROM album WHERE $priceRange $yearRange format LIKE '%$format%' AND artist LIKE '%$artist%' AND title LIKE '%$title%' AND genre_1 LIKE '%$genre%' AND valid=1";
$resultGenre1=$conn->query($sqlGenre1);
$rowsGenre1=$resultGenre1->fetch_all(MYSQLI_ASSOC);
$genre_1_count = $resultGenre1->num_rows;

$sqlGenre2="SELECT id, title,cover_image,price,format,artist, genre_2, year, released_date FROM album WHERE $priceRange $yearRange format LIKE '%$format%' AND artist LIKE '%$artist%' AND title LIKE '%$title%' AND genre_2 LIKE '%$genre%' AND valid=1";
$resultGenre2=$conn->query($sqlGenre2);
$rowsGenre2=$resultGenre2->fetch_all(MYSQLI_ASSOC);
$genre_2_count = $resultGenre2->num_rows;

$sqlGenre3="SELECT id, title,cover_image,price,format,artist, genre_3, year, released_date FROM album WHERE $priceRange $yearRange format LIKE '%$format%' AND artist LIKE '%$artist%' AND title LIKE '%$title%' AND genre_3 LIKE '%$genre%' AND valid=1";
$resultGenre3=$conn->query($sqlGenre3);
$rowsGenre3=$resultGenre3->fetch_all(MYSQLI_ASSOC);
$genre_3_count = $resultGenre3->num_rows;

// $totalCountByGenrePlus=$genre_1_count+$genre_2_count+$genre_3_count;
$totalCountByGenrePlus = 0;

if ($genre === '') {
    $totalCountByGenrePlus = $genre_1_count;
} else {
    $totalCountByGenrePlus = $genre_1_count + $genre_2_count + $genre_3_count;
}






//2.分頁
$totalPageOfAlbum = ceil($totalCountByGenrePlus / $perPageOfAlbum);



// // 合併三個陣列
$allRows = [];

if ($genre === '') {
    $allRows = $rowsGenre1;
} else {
    $allRows = [...$rowsGenre1, ...$rowsGenre2, ...$rowsGenre3];
}


// 選擇排序函數
$sortFunction = function ($a, $b) use ($type) {
    switch ($type) {
        case 2: // ID降冪排序
            return $b['id'] - $a['id'];
        case 3: // 標題升冪排序
            return strcmp($a['title'], $b['title']);
        case 4: // 標題降冪排序
            return strcmp($b['title'], $a['title']);
        case 5: // 年份升冪排序
            return $a['year'] - $b['year'];
        case 6: // 年份降冪排序
            return $b['year'] - $a['year'];
        case 7: // 價格升冪排序
            return $a['price'] - $b['price'];
        case 8: // 價格降冪排序
            return $b['price'] - $a['price'];
        case 9: // 發行日期升冪排序
            $dateA = strtotime($a['released_date']);
            $dateB = strtotime($b['released_date']);
            return $dateA - $dateB;
        case 10: // 發行日期降冪排序
            $dateA = strtotime($a['released_date']);
            $dateB = strtotime($b['released_date']);
            return $dateB - $dateA;
        default: // 預設ID升冪排序
            return $a['id'] - $b['id'];
    }
};

// 排序
uasort($allRows, $sortFunction);
// 分割
$newRowsType = array_slice($allRows, $startItemOfAlbum, $perPageOfAlbum, true);





}else{
    $totalCountByGenrePlus = 0;
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







<nav aria-label="Page navigation example">

共 <?= $totalCountByGenrePlus ?> 個, 第<?=$pageOfAlbum?> 頁 ,共<?=$totalPageOfAlbum?>頁
<ul class="pagination">

<?php for($i=1;$i<=$totalPageOfAlbum; $i++): ?>

<li class="page-item <?php
    if($i==$pageOfAlbum)echo "active";
    ?>"><a class="page-link " href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$i?>&type=<?=$type?>"><?=$i?></a></li>
    <!-- 連結連結連結 在上面 -->
<?php endfor;?>
</ul>
</nav>



<div class="col-1  ">
                            <!-- test -->
            <div class="btn-group ">
    <!-- 連結連結連結*8 -->
            <button class="form-select " data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-primary">
                排序
            </button>
                <ul class="dropdown-menu">
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=1" class="dropdown-item <?php if($type==1)echo "active"; ?>">依上架日期(舊到新)</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=2" class="dropdown-item <?php if($type==2)echo "active"; ?>">依上架日期(新到舊)</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=3" class="dropdown-item <?php if($type==3)echo "active"; ?>">title↑</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=4" class="dropdown-item <?php if($type==4)echo "active"; ?>">title↓</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=5" class="dropdown-item <?php if($type==5)echo "active"; ?>">依年分(舊到新)</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=6" class="dropdown-item <?php if($type==6)echo "active"; ?>">依年分(新到舊)</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=7" class="dropdown-item <?php if($type==7)echo "active"; ?>">價格(低到高)</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=8" class="dropdown-item <?php if($type==8)echo "active"; ?>">價格(高到低)</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=9" class="dropdown-item <?php if($type==9)echo "active"; ?>">依發行日期(舊到新)</a></li>
                    <li><a href="album-search-advanced-yhhung.php?genre=<?=$genre?>&title=<?=$title?>&artist=<?=$artist?>&format=<?=$format?>&min=<?=$priceMin?>&max=<?=$priceMax?>&startyear=<?=$yearStart?>&endyear=<?=$yearEnd?>&page=<?=$pageOfAlbum?>&type=10" class="dropdown-item <?php if($type==10)echo "active"; ?>">依發行日期(新到舊)</a></li>
                </ul>
            </div>
        </div>













        <div class="py-2 ">
        <!-- 連結連結連結  -->
        <a class="btn btn-info" href="album-list-yhhung.php">回唱片列表</a>
        <a class="btn btn-info" href="album-search-form-yhhung.php">回進階搜尋</a>
        


        <div class="py-2 d-flex justify-content-between align-items-center">
    
        <!-- 會出錯  所以增加以下判斷   -->
            <?php if(isset($_GET["genre"])):  ?>

    
            <div>
                <!-- 新增以下 -->
         依據搜尋條件，共有 <?= $totalCountByGenrePlus ?> 筆符合的資料
            </div>
            
            <?php endif; ?>

        </div>

        <!-- 新增以下php 當搜尋筆數不等於0時才跑出下面的表格 ，記得在表格結束的地方加endif-->
        <?php if($totalCountByGenrePlus!=0): ?>
          <div class="row g-3">
          <?php foreach ($newRowsType as $albumMix) : ?>
          <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <!-- 連結連結連結 -->
                        <a href="album-yhhung.php?id=<?= $albumMix["id"] ?>">
                            <figure class="ratio ratio-1x1 ">
                                <img src="images/alburm/<?= $albumMix["cover_image"] ?>" alt="<?= $albumMix["title"] ?>" class="object-fit-cover card-img-top">
                            </figure>
                        
                        </a>
                        <div class="px-3 mb-3">

                            <div class="pb-2 ">
                                <p class="text-success text-decoration-none" ><?= $albumMix["format"] ?></p>
                            </div>


                            <!--連結連結連結 -->
                            <h3 class="h4"><a href="album-yhhung.php?id=<?= $albumMix["id"] ?>"><?= $albumMix["title"] ?></a></h3>
                            <h3 class="h5"><?= $albumMix["artist"] ?></h3>
                            <div class="price text-end h5 text-success">$<?= $albumMix["price"] ?></div>


                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
          
            </div>
           
        <?php endif; ?>

    </div>




    <script>
  // 獲取網址中的參數
  const urlParams = new URLSearchParams(window.location.search);
  const genreValue = urlParams.get('genre');

  // 選取對應的選項
  const genreSelect = document.getElementById('genre-select');
  genreSelect.value = genreValue;
</script>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

</body>

</html>