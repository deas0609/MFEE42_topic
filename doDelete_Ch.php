<?php

require_once("db_connect.php");


$id=$_GET["id"];

$sql="UPDATE ch SET valid=0 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("location:discountIndex_Ch.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();
?>

