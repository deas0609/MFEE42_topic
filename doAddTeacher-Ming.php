<?php
require_once("db_connect.php");
if (!isset($_POST["name"]) || !isset($_POST["gender"]) || !isset($_POST["phone"]) || !isset($_POST["email"]) || !isset($_POST["expertise"]) || !isset($_POST["introduce"]) ) {
    die("請依正常管道進入");
}

if (empty($_POST["name"])) {
    die("請輸入姓名");
}
if (empty($_POST["gender"])) {
    die("請輸入性別");
}
if (empty($_POST["phone"])) {
    die("請輸入電話");
}
if (empty($_POST["email"])) {
    die("請輸入信箱");
}
if (empty($_POST["expertise"])) {
    die("請輸入專長");
}
if (empty($_POST["introduce"])) {
    die("請輸入介紹");
}

$name=$_POST["name"];
$gender=$_POST["gender"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$introduce=$_POST["introduce"];
// $photo=$_POST["photo"];
$expertise=$_POST["expertise"];






if ($_FILES["file"]["error"] == 0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/teachers/" . $_FILES["file"]["name"])) {
        $fileName = $_FILES["file"]["name"];

        echo "上傳成功, 檔名為" . $fileName;

        $sql = "INSERT INTO product_images (product_id, name) VALUES ('$product_id', '$fileName')";

        $sql="INSERT INTO teachers (name, gender,phone,email, introduce,expertise,photo) VALUES ('$name', '$gender','$phone','$email','$introduce','$expertise','$fileName')";
// var_dump($_FILES["file"]);
        // -> 代表子方法 
        if ($conn->query($sql) === TRUE) {
            

            header("location:teachers-list-Ming.php");
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
    } else {
        echo "上傳失敗";
    }
} else {
    var_dump($_FILES["file"]["error"]);
}
?>