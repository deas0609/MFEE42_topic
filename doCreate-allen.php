<?php

if(!isset($_POST["name"])){
    die("請依正常管道到此頁");
}

require_once("db_connect.php");

$name=$_POST["name"];
$account=$_POST["account"];
$gender=$_POST["gender"];
$birthday=$_POST["birthday"];
$email=$_POST["email"];
$address=$_POST["address"];
$phone=$_POST["phone"];
$now=date('Y-m-d H:i:s');

// echo "$name, $phone, $email";
$sql="INSERT INTO member (name, account, gender, birthday, email, address, phone, created_at, status) VALUES ('$name','$account','$gender','$birthday','$email','$address','$phone','$now',1)";

// echo $sql;


if ($conn->query($sql) === TRUE) {
    $latestId=$conn->insert_id;
    echo "資料表 member 新增資料完成, id為$latestId";
    header("location: user-list-allen.php");

} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();