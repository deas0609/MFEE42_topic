<?php
// $name=$_POST["name"];
// echo $name;
// 0.用POST 1.回到user-edit按儲存button測試接不接得到
//2.註解掉上面




$id=$_POST["id"];
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
  echo "發行日期符合格式";
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



// $discogs_id=$_POST["discogs_id"];
$price=$_POST["price"];
$stock_num=$_POST["stock_num"];
$description=$_POST["description"];

$description = addslashes($description); // 處理單引號


//這裡跟資料庫連線
require_once("db_connect.php");




$sql="UPDATE album SET 
title='$title', 
artist='$artist', 
label='$label' ,
format='$format',
released_date='$released_date',
year='$year',
genre_1='$genre_1',
genre_2='$genre_2',
genre_3='$genre_3',
price='$price',
stock_num='$stock_num',
description='$description' WHERE id=$id";



if ($conn->query($sql) === TRUE) {
  // 連結連結連結 
  // 連結連結連結 
    header("location: album-list-yhhung.php?id=".$id);
  }elseif($_FILES["file"]["error"] == 4){
    echo "無附加圖檔";
    // 連結連結連結 
    //連結連結連結 
    header("Location: album-edit-yhhung.php?id=".$id);

}   else {
    echo "修改增資料錯誤: " . $conn->error;
}
$conn->close();