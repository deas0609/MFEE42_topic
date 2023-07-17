<?php

if (!isset($_GET["id"])) {
   die("無法操作"); 
}

require_once("db_connect.php");



if ($conn->connect_error) {
    die("資料庫連接錯誤：" . $conn->connect_error);
}

$id = $_GET["id"];

$sql = "UPDATE Event_Management_MO SET statuss = 0 WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: Events-list-MO.php");
    exit();
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();
?>
