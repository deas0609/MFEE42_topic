<?php

if(!isset($_POST["title"])){
    die("請依正常管道到此頁");
}

require_once("db_connect.php");


$title=$_POST["title"];
$title = addslashes($title); // 處理單引號
$artist=$_POST["artist"];
$artist = addslashes($artist); // 處理單引號
$label=$_POST["label"];
$label = addslashes($label); // 處理單引號
$format=$_POST["format"];
$country=$_POST["country"];

$patternOfReleasedDate= '/((((19|20)\d{2})-(0?(1|[3-9])|1[012])-(0?[1-9]|[12]\d|30))|(((19|20)\d{2})-(0?[13578]|1[02])-31)|(((19|20)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|((((19|20)([13579][26]|[2468][048]|0[48]))|(2000))-0?2-29))$/';

$released_date=$_POST["released_date"];
if (preg_match($patternOfReleasedDate, $released_date)) {
    echo "匹配成功";
  } else {
    echo "請輸入有效的時間(1900-01-01~2099-12-31)";
    die("無法作業");
  }

$year=$_POST["year"];
$genre_1=$_POST["genre_1"];
$genre_2=$_POST["genre_2"];
$genre_3=$_POST["genre_3"];
// genre_1 欄位 required
if ($genre_1 == $genre_2) {
    echo "錯誤genre_1 = genre_2";
      die("無法作業");
  }elseif($genre_1 == $genre_3){
    echo "錯誤genre_1 = genre_3";
    die("無法作業");
  }elseif($genre_2 == $genre_3){
        if ($genre_2 == '' && $genre_3 == ''){
         echo "成功";
          }else{
             echo "錯誤genre_2 = genre_3";
             die("無法作業");
          }
  }elseif($genre_2 == '' && $genre_3 !== ''){
    echo "請給種類2一個類別";
    die("無法作業");
  }else{
    echo "成功";
  }
$discogs_id=$_POST["discogs_id"];
$price=$_POST["price"];
$stock_num=$_POST["stock_num"];
$description=$_POST["description"];
$description = addslashes($description); // 處理單引號
$now=date('Y-m-d H:i:s');


$sql="INSERT INTO album (title, artist, label, format, country, released_date, year, genre_1, genre_2, genre_3, discogs_id, price, stock_num, description, created_at,valid) VALUES 
                        ('$title', '$artist', '$label', '$format', '$country', '$released_date', '$year', '$genre_1', '$genre_2', '$genre_3', '$discogs_id', '$price', '$stock_num', '$description', '$now', 1)";



if ($conn->query($sql) === TRUE) {

    $latestId=$conn->insert_id;
    echo "資料表 album 新增資料完成, id 為 $latestId";
    // 連結連結連結 
    // 連結連結連結 
    header("location: album-list-yhhung.php");

} else {
    echo "新增資料錯誤: " . $conn->error;
}



if ($_FILES["file"]["error"] == 0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/alburm/".$_FILES["file"]["name"])) {
        echo "上傳成功, 檔名為 ".$_FILES["file"]["name"];

        $coverImage = $_FILES["file"]["name"];


        $sql = "UPDATE album SET cover_image = '$coverImage' WHERE id = $latestId";

        if ($conn->query($sql) === true) {
            echo "檔案名稱成功存入資料庫";
        } else {
            echo "存入資料庫時發生錯誤: " . $conn->error;
        }



    } else {
        echo "上傳失敗";
    }
} else {
    var_dump($_FILES["file"]["error"]);
}


$conn->close();