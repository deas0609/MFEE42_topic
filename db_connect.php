<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "topic";

$conn=new mysqli($servername,$username,$password,$dbname); //連線資料庫

if($conn->connect_error){   //檢查資料庫連線
    die("連線失敗: ".$conn->connect_error);
}else{
// echo "連線成功";   
//會引響到資料庫操作
}

