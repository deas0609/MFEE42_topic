<?php


// 新增以下if else 兩部分 part1
if (isset($_GET["genre"])) {
    $genre = $_GET["genre"];


//2.分頁
$pageOfAlbum = $_GET["page"] ?? 1;
//2.分頁
$perPageOfAlbum = 16;
$startItemOfAlbum = ($pageOfAlbum - 1) * $perPageOfAlbum; //0=(1-1)*5, 5=(2-1)*5 ,10=(3-1)*5



require_once("db_connect.php");
// $sql="SELECT * FROM users WHERE name LIKE '%$name%'";
// 不要* *call全部 其中包含密碼 危險

$sqlGenre1="SELECT id, title,cover_image,price,format,artist, genre_1 FROM album WHERE genre_1 LIKE '%$genre%' AND valid=1";
$resultGenre1=$conn->query($sqlGenre1);
$rowsGenre1=$resultGenre1->fetch_all(MYSQLI_ASSOC);
$genre_1_count = $resultGenre1->num_rows;

$sqlGenre2="SELECT id, title,cover_image,price,format,artist, genre_2 FROM album WHERE genre_2 LIKE '%$genre%' AND valid=1";
$resultGenre2=$conn->query($sqlGenre2);
$rowsGenre2=$resultGenre2->fetch_all(MYSQLI_ASSOC);
$genre_2_count = $resultGenre2->num_rows;

$sqlGenre3="SELECT id, title,cover_image,price,format,artist, genre_3 FROM album WHERE genre_3 LIKE '%$genre%' AND valid=1";
$resultGenre3=$conn->query($sqlGenre3);
$rowsGenre3=$resultGenre3->fetch_all(MYSQLI_ASSOC);
$genre_3_count = $resultGenre3->num_rows;

$totalCountByGenrePlus=$genre_1_count+$genre_2_count+$genre_3_count;


//2.分頁
$totalPageOfAlbum = ceil($totalCountByGenrePlus / $perPageOfAlbum);

// var_dump($rows);
//以陣列回傳


// chatGPT
// 合併三個陣列
$allRows = [...$rowsGenre1, ...$rowsGenre2, ...$rowsGenre3];
// 自訂排序函式
function sortByID($a, $b) {
    return $a['id'] - $b['id'];
}
// 使用 uasort 函式按照 album 的 id 進行排序並保持索引關係
uasort($allRows, 'sortByID');
// 重新組合到新的陣列中並保持索引關係
$newRows = [];
foreach ($allRows as $key => $value) {
    $newRows[$key] = $value;
}

//2.分頁
$newRows = array_slice($allRows, $startItemOfAlbum, $perPageOfAlbum, true);



// 新增以下if else part2
}else{
    $totalCountByGenrePlus = 0;
}





// $newRows = [];

// $index = 0;
// foreach ($allRows as $key => $value) {
//     if ($index >= $startItemOfAlbum && $index < ($startItemOfAlbum + $perPageOfAlbum)) {
//         $newRows[$key] = $value;
//     }
//     $index++;
// }





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

共 <?= $totalCountByGenrePlus ?> 個, 第<?=$pageOfAlbum?> 頁 ,共<?=$totalPageOfAlbum?>頁, $perPageOfAlbum: <?=$perPageOfAlbum?>, $startItemOfAlbum: <?=$startItemOfAlbum?>,
<ul class="pagination">

<?php for($i=1;$i<=$totalPageOfAlbum; $i++): ?>

<li class="page-item <?php
    if($i==$pageOfAlbum)echo "active";
    ?>"><a class="page-link " href="album-search-genre-yhhung.php?genre=<?=$genre?>&page=<?=$i?>"><?=$i?></a></li>
    <!-- 連結連結連結 在上面 -->
<?php endfor;?>
</ul>
</nav>
        <div class="py-2">
        <!-- 連結連結連結  -->
        <a class="btn btn-info" href="album-list-yhhung.php">回唱片列表</a>
        </div>

     
                <!-- 搜尋唱片by genre -->
                <div class="py-2">
            <!-- 3.建立album-search-genre.php -->
            <form action="album-search-genre-yhhung.php" method="get" class="form-control">
            <!-- 連結連結連結 在上面 -->
            <div class="row gx-2">
            <div class="col">
                <select type="text" class="form-control" placeholder="搜尋唱片genre" name="genre" id="genre-select" class="form-control">
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
                <!-- 2.用form包起來 加type  submit 以get回傳-->
                <button class="btn btn-info" type="submit">搜尋</button>
            </div>


            </div>
            </form>
        </div>



        <div class="py-2 d-flex justify-content-between align-items-center">
    
        <!-- 會出錯  所以增加以下判斷   -->
            <?php if(isset($_GET["genre"])):  ?>

    
            <div>
                <!-- 新增以下 -->
            搜尋類型 <?= $genre?> 的結果
            
            ,共有 <?= $totalCountByGenrePlus ?> 筆符合的資料
            </div>
            
            <?php endif; ?>

        </div>

        <!-- 新增以下php 當搜尋筆數不等於0時才跑出下面的表格 ，記得在表格結束的地方加endif-->
        <?php if($totalCountByGenrePlus!=0): ?>
          <div class="row g-3">
          <?php foreach ($newRows as $albumMix) : ?>
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

</body>

</html>