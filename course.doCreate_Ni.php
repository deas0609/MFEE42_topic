<?php

if(!isset($_POST["name"])){
    die("請依正常管道到此頁");
}

require_once("db_connect.php");

  // $course_id=$_POST["course_id"];
  // $img=$_POST["img"];
  $name=$_POST["name"];
  $directions=$_POST["directions"];
  $price=$_POST["price"];
  $up_date=$_POST["up_date"];
  $shelf_time=$_POST["shelf_time"];

  $directions = str_replace("'", "\\'", $directions);

if (empty($_POST["name"]) ) {
  echo "請輸入名稱";
  exit;
}elseif(empty($_POST["directions"])){
  echo "請輸入資訊";
  exit;
}elseif(empty($_POST["up_date"])){
  echo "請輸入上架日期";
  exit;
}elseif(empty($_POST["shelf_time"])){
  echo "請輸入下架日期";
  exit;
}
  // $valid = isset($_POST["valid"]) ? $_POST["valid"] : 1;
  if($_FILES["file"]["error"] == 0){

  if (!empty($_FILES["file"]["tmp_name"])) {
    $imagePath = "images/Ni_img/"; // 指定圖片資料夾路徑
    $imageName = $_FILES["file"]["name"];
    $imageTmp = $_FILES["file"]["tmp_name"];
    $imageDestination = $imagePath . $imageName;

    

    // Move the uploaded image to the destination folder
    if (move_uploaded_file($imageTmp, $imageDestination)) {
        // Insert the record into the database with the image path
        $sql="INSERT INTO course (img,name, directions, price, up_date,shelf_time,valid ) VALUES('$imageName','$name','$directions','$price','$up_date','$shelf_time','1')"; 

        if ($conn->query($sql) === TRUE) {
            $latestId = $conn->insert_id;
            echo "資料表 course 新增資料完成, id 為 $latestId";
            header("location: course_Ni.php");
            exit;
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
    } else {
        echo "圖片上傳失敗";
        exit;
    }
}
}elseif ($_FILES["file"]["error"] == 4) {
  echo "為選擇圖片";
}else{
  echo "新增資料失敗";
}

// var_dump($name,$directions,$price,$up_date,$shelf_date);
  // $sql="INSERT INTO course (name, directions, price, up_date,shelf_time ) VALUES('$name','$directions','$price','$up_date','$shelf_time')"; 

  // if($conn->query($sql)===True){

  //   // $latestId=$conn->insert_id;
  //   // echo "資料表 course 新增資料完成, id 為 $latestId";
  //   header("Location:course_Ni.php");
  //   // exit();
  // } else{
  //   echo "新增課程失敗". $conn->error;
  // }
