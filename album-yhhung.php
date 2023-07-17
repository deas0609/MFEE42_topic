<?php
if(!isset($_GET["id"])){
    header("location: ../404.php");
}

require_once("db_connect.php");
$id=$_GET["id"];
$sql="SELECT * FROM album WHERE id='$id'";
$result=$conn->query($sql);
$album=$result->fetch_assoc();

?>


<!doctype html>
<html lang="en">

<head>
  <title><?= $album["artist"]." - ".$album["title"]?></title>
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
        <!-- 連結連結連結  -->
            <a class="btn btn-info" href="album-list-yhhung.php">回列表</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10"></div>


                <div class="row">
                    <div class="col-lg-6">
                        <figure>
                            <img class="img-fluid" src="images/alburm/<?= $album["cover_image"] ?>" alt="<?= $album["title"] ?>">
                        </figure>
                    </div>
                    <div class="col-lg-6">
                        <h1><?= $album["artist"]." - ".$album["title"] ?></h1>
                        <div class="text-success h3">$<?=$album["price"]?></div>
                        <div class="">庫存: <?=$album["stock_num"]?></div>
                        <div class="">種類: <?=$album["format"]?></div>
                        <div class="">發行地區: <?=$album["country"]?></div>
                        <div class="">年分: <?=$album["year"]?></div>
                        <div class="">唱片公司: <?=$album["label"]?></div>
                        <div class="">風格: <?=$album["genre_1"]?>
                            <?php if (!empty($album["genre_2"])) : ?>
                                    , <?=$album["genre_2"]?>
                            <?php endif; ?>
                            <?php if (!empty($album["genre_3"])) : ?>
                                    , <?=$album["genre_3"]?>
                            <?php endif; ?>
                        </div>
                        <div class="">描述:<br><?=$album["description"]?></div>
                    </div>
                    <div class="col-lg-6">
                    <div class="py-2">
                    <!-- 連結連結連結  -->
            <a class="btn btn-info"href="album-edit-yhhung.php?id=<?=$album["id"]?>">編輯</a>
        </div>
                        
                    </div>
                </div>

            </div>
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