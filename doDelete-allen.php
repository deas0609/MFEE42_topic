<?php

if(!isset($_GET["id"])){
    die("無法作業");
}

require_once("db_connect.php");


$id=$_GET["id"];
// echo $id;

$sql="UPDATE member SET status=0 WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {

    header("location: user-list-allen.php");

} else {
    echo "刪除資料錯誤: " . $conn->error;
}
