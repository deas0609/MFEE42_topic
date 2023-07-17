<?php

if(!isset($_GET["id"])){
    die("無法作業");
}
require_once("db_connect.php");

$id=$_GET["id"];
// var_dump($id);

$sql="UPDATE course SET valid=0 WHERE course_id='$id'";

if ($conn->query($sql) === TRUE) {
    header("location: course_Ni.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}