<?php

$course_id=$_POST["course_id"];
$img2=$_POST["new_img"];
$img=$_POST["old_img"];
$name=$_POST["name"];
$name=htmlspecialchars($name,ENT_QUOTES,"UTF-8");
$directions=$_POST["directions"];
$price=$_POST["price"];
$up_date=$_POST["up_date"];
$shelf_time=$_POST["shelf_time"];
// var_dump($img2,$img);
$directions = str_replace("'", "\\'", $directions);

require_once("db_connect.php");
// var_dump($_FILES["new_img"]["tmp_name"]);

if(!empty($img2)){
    $img2=$_POST["new_img"];
    $sql="UPDATE course SET img='$img2', name='$name',directions='$directions',price='$price' ,up_date='$up_date',shelf_time='$shelf_time' WHERE course_id=$course_id";
    
// var_dump($sql);

}else{
    $img=$_POST["old_img"];
    // var_dump($img);
    $sql="UPDATE course SET  name='$name',directions='$directions',price='$price' ,up_date='$up_date',shelf_time='$shelf_time' WHERE course_id=$course_id";
}



if ($conn->query($sql) === TRUE) {

    header("location: course_Ni.php?id=". $course_id);
    exit();

} else {
    echo "修改增資料錯誤: " . $conn->error;
}