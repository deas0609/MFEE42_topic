<?php
if(!isset($_GET["id"])){
    header("location: /404.php");
}
$id=$_GET["id"];


require_once("db_connect.php");
$sql="SELECT * FROM album WHERE id=$id AND valid=1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();



?>

<!doctype html>
<html lang="en">

<head>
  <title></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

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
        確認刪除
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <!-- 連結連結連結 -->
        <a href="doAlbumDelete-yhhung.php?id=<?=$id?>"  type="button" class="btn btn-primary btn-danger">確認</a>
      </div>
    </div>
  </div>
</div>

    <div class="container">
        <div class="row">
        <div class="col-lg-4">
            <br>
            <!-- 連結連結連結 -->
            <a class="btn btn-info" href="album-yhhung.php?id=<?=$row["id"]?>">回商品頁</a>
            <hr>
                        <figure>
                            <img class="img-fluid" src="images/alburm/<?= $row["cover_image"] ?>" alt="<?= $row["title"] ?>">
                        </figure>
                        <!-- 連結連結連結 -->
                        <form action="doCoverUpdate-yhhung.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            <input type="file" class="form-control" name="file">
                            <br>
                            <button class="btn btn-info" type="submit">更新圖片</button>
                        </form>

        </div>
    <div class="col-lg-8">
        <br>
        <!-- 連結連結連結 -->
        <form action="doAlbumUpdate-yhhung.php" method="post">
      
        <table class="table table-bordered ">
            
            <input type="hidden" name="id" value="<?= $row["id"] ?>">
            <tr>
                <th>唱片名稱</th>
                <td><input type="text" class="form-control" value="<?=$row["title"]?>" name="title"></td>
            </tr>
            <tr>
                <th>歌手/團體</th>
                <td><input type="text" class="form-control" value="<?=$row["artist"]?>" name="artist"></td>
            </tr>
            <tr>
                <th>唱片公司</th>
                <td><input type="text" class="form-control" value="<?=$row["label"]?>" name="label"></td>
            </tr>
            <tr>
                <th>唱片種類(CD/黑膠/其他)</th>
                <td><select type="text" class="form-control" value="<?=$row["format"]?>" name="format" required>
                            <option value=""></option>
                            <option value="CD"<?php if ($row["format"] === "CD") echo "selected"; ?>>CD</option>
                            <option value="Vinyl"<?php if ($row["format"] === "Vinyl") echo "selected"; ?>>黑膠</option>
                            <option value="Cassette"<?php if ($row["format"] === "Cassette") echo "selected"; ?>>錄音帶</option>
                            <option value="Others"<?php if ($row["format"] === "Others") echo "selected"; ?>>其他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>發行地區</th>
                <td><input type="text" class="form-control" value="<?=$row["country"]?>" name="country"></td>
            </tr>
            <tr>
                <th>發行日期</th>
                <td><input type="text" class="form-control" value="<?=$row["released_date"]?>" name="released_date"></td>
            </tr>
            <tr>
                <th>年分</th>
                <td><input type="text" class="form-control" value="<?=$row["year"]?>" name="year" required></td>
            </tr>
            <tr>
                <th>種類1</th>
                <td><select type="text" class="form-control" name="genre_1" required>
  <option value=""></option>
  <option value="Electronic" <?php echo ($row["genre_1"] === "Electronic") ? "selected" : ""; ?>>電子音樂</option>
  <option value="Rock" <?php if ($row["genre_1"] === "Rock") echo "selected"; ?>>搖滾</option>
  <option value="Pop" <?php if ($row["genre_1"] === "Pop") echo "selected"; ?>>流行</option>
  <option value="Folk, World, & Country" <?php if ($row["genre_1"] === "Folk, World, & Country") echo "selected"; ?>>鄉村和民謠音樂</option>
  <option value="Jazz" <?php if ($row["genre_1"] === "Jazz") echo "selected"; ?>>爵士</option>
  <option value="Hip Hop" <?php if ($row["genre_1"] === "Hip Hop") echo "selected"; ?>>嘻哈</option>
  <option value="Funk / Soul" <?php if ($row["genre_1"] === "Funk / Soul") echo "selected"; ?>>放克 / 靈魂樂</option>
  <option value="Reggae" <?php if ($row["genre_1"] === "Reggae") echo "selected"; ?>>雷鬼</option>
  <option value="Blues" <?php if ($row["genre_1"] === "Blues") echo "selected"; ?>>藍調</option>
  <option value="Stage & Screen" <?php if ($row["genre_1"] === "Stage & Screen") echo "selected"; ?>>舞台和電影音樂</option>
</select>
                </td>
            </tr>
            <tr>
                <th>種類2</th>
                <td><select type="text" class="form-control" name="genre_2">
  <option value=""></option>
  <option value="Electronic" <?php if ($row["genre_2"] === "Electronic") echo "selected"; ?>>電子音樂</option>
  <option value="Rock" <?php if ($row["genre_2"] === "Rock") echo "selected"; ?>>搖滾</option>
  <option value="Pop" <?php if ($row["genre_2"] === "Pop") echo "selected"; ?>>流行</option>
  <option value="Folk, World, & Country" <?php if ($row["genre_2"] === "Folk, World, & Country") echo "selected"; ?>>鄉村和民謠音樂</option>
  <option value="Jazz" <?php if ($row["genre_2"] === "Jazz") echo "selected"; ?>>爵士</option>
  <option value="Hip Hop" <?php if ($row["genre_2"] === "Hip Hop") echo "selected"; ?>>嘻哈</option>
  <option value="Funk / Soul" <?php if ($row["genre_2"] === "Funk / Soul") echo "selected"; ?>>放克 / 靈魂樂</option>
  <option value="Reggae" <?php if ($row["genre_2"] === "Reggae") echo "selected"; ?>>雷鬼</option>
  <option value="Blues" <?php if ($row["genre_2"] === "Blues") echo "selected"; ?>>藍調</option>
  <option value="Stage & Screen" <?php if ($row["genre_2"] === "Stage & Screen") echo "selected"; ?>>舞台和電影音樂</option>
</select>

                </td>
            </tr>
            <tr>
                <th>種類3</th>
                <td><select type="text" class="form-control" name="genre_3">
  <option value=""></option>
  <option value="Electronic" <?php echo ($row["genre_3"] === "Electronic") ? "selected" : ""; ?>>電子音樂</option>
  <option value="Rock" <?php echo ($row["genre_3"] === "Rock") ? "selected" : ""; ?>>搖滾</option>
  <option value="Pop" <?php echo ($row["genre_3"] === "Pop") ? "selected" : ""; ?>>流行</option>
  <option value="Folk, World, & Country" <?php echo ($row["genre_3"] === "Folk, World, & Country") ? "selected" : ""; ?>>鄉村和民謠音樂</option>
  <option value="Jazz" <?php echo ($row["genre_3"] === "Jazz") ? "selected" : ""; ?>>爵士</option>
  <option value="Hip Hop" <?php echo ($row["genre_3"] === "Hip Hop") ? "selected" : ""; ?>>嘻哈</option>
  <option value="Funk / Soul" <?php echo ($row["genre_3"] === "Funk / Soul") ? "selected" : ""; ?>>放克 / 靈魂樂</option>
  <option value="Reggae" <?php echo ($row["genre_3"] === "Reggae") ? "selected" : ""; ?>>雷鬼</option>
  <option value="Blues" <?php echo ($row["genre_3"] === "Blues") ? "selected" : ""; ?>>藍調</option>
  <option value="Stage & Screen" <?php echo ($row["genre_3"] === "Stage & Screen") ? "selected" : ""; ?>>舞台和電影音樂</option>
</select>


                </td>
            </tr>
            <tr>
                <th>價格</th>
                <td><input type="text" class="form-control" value="<?=$row["price"]?>" name="price"></td>
            </tr>
            <tr>
                <th>庫存</th>
                <td><input type="text" class="form-control" value="<?=$row["stock_num"]?>" name="stock_num"></td>
            </tr>
            <tr>
                <th>描述</th>
                <td><textarea class="form-control" name="description" rows="20"><?=$row["description"]?></textarea></td>
            </tr>
            <tr>
                <th>資料上傳日期</th>
                <td><?=$row["created_at"]?></td>
            </tr>
        </table>
        <div class="py-2 d-flex justify-content-between">
            <div>
      
            <button class="btn btn-info" type="submit">儲存</button>
            <!-- 連結連結連結 -->
            <a class="btn btn-info" href="album-yhhung.php?id=<?=$row["id"]?>">取消</a>
            </div>
            <!-- 連結連結連結 -->
            <button href="doDelete-yhhung.php?id=<?=$row["id"]?>" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#deleteModal" type="button">刪除</button>
        </div>
        </form>
    </div>
    </div>


  
    </div>
          <!-- 8加回去bootstrap的js -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>