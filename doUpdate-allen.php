<?php

$id=$_POST["id"];
$name=$_POST["name"];
$account=$_POST["account"];
$birthday=$_POST["birthday"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$address=$_POST["address"];





require_once("db_connect.php");

$sql="UPDATE member SET name='$name', account='$account',birthday='$birthday', email='$email', phone='$phone', address='$address' WHERE id=$id";


if ($conn->query($sql) === TRUE) {
    header("location: user-allen.php?id=".$id);
    echo "修改資料完成";
    // echo '<a class="btn btn-info" href="user-list-allen.php">回使用者列表</a>';
    

} else {
    echo "修改增資料錯誤: " . $conn->error;
}

echo $sql;

$conn->close();
