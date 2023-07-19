<?php

$course_id=$_POST["course_id"];
$img=$_POST["img"];
$name=$_POST["name"];
$name=htmlspecialchars($name,ENT_QUOTES,"UTF-8");
$directions=$_POST["directions"];
$price=$_POST["price"];
$up_date=$_POST["up_date"];
$shelf_time=$_POST["shelf_time"];

require_once("db_connect.php");



$sql="UPDATE course SET img='$img', name='$name',directions='$directions',price='$price' ,up_date='$up_date',shelf_time='$shelf_time' WHERE course_id=$course_id";

if(!empty($_FILES["img"]["tmp_name"])){

}else{
    $img=$_POST["old_img"];
}

if ($conn->query($sql) === TRUE) {

    header("location: course_Ni.php?id=". $course_id);
    exit();

} else {
    echo "修改增資料錯誤: " . $conn->error;
}