<?php

$course_id=$_POST["course_id"];
// $img2=$_POST["new_img"];
$img=$_POST["old_img"];
$name=$_POST["name"];
$name=htmlspecialchars($name,ENT_QUOTES,"UTF-8");
$directions=$_POST["directions"];
$price=$_POST["price"];
$up_date=$_POST["up_date"];
$shelf_time=$_POST["shelf_time"];
// var_dump($img2,$img);
// exit;
$directions = str_replace("'", "\\'", $directions);


require_once("db_connect.php");
// var_dump($_FILES["new_img"]["tmp_name"]);
if($_FILES["new_img"]["error"] == 0){

    if (!empty($_FILES["new_img"]["tmp_name"])) {
      $imagePath = "images/Ni_img/"; // 指定圖片資料夾路徑
      $imageName = $_FILES["new_img"]["name"];
      $imageTmp = $_FILES["new_img"]["tmp_name"];
      $imageDestination = $imagePath . $imageName;
  
      
  
      // Move the uploaded image to the destination folder
      if (move_uploaded_file($imageTmp, $imageDestination)) {
          // Insert the record into the database with the image path
          $sql="UPDATE course SET img='$imageName', name='$name',directions='$directions',price='$price' ,up_date='$up_date',shelf_time='$shelf_time' WHERE course_id=$course_id";

          if ($conn->query($sql) === TRUE) {
            //   $latestId = $conn->insert_id;
            //   echo "資料表 course 新增資料完成, id 為 $latestId";
            echo "a";
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
  }elseif ($_FILES["new_img"]["error"] == 4) {
    // echo "為選擇圖片";


    $sql="UPDATE course SET img='$img', name='$name',directions='$directions',price='$price' ,up_date='$up_date',shelf_time='$shelf_time' WHERE course_id=$course_id";
    if ($conn->query($sql) === TRUE) {
        //   $latestId = $conn->insert_id;
        //   echo "資料表 course 新增資料完成, id 為 $latestId";
        echo"a";
          header("location: course_Ni.php");
          exit;
    }
  }else{
    echo "上傳圖檔錯誤";
  }



  


// if(!empty($img2)){
//     $img2=$_POST["new_img"];
//     $sql="UPDATE course SET img='$img2', name='$name',directions='$directions',price='$price' ,up_date='$up_date',shelf_time='$shelf_time' WHERE course_id=$course_id";
    
// // var_dump($sql);

// }else{
//     $img=$_POST["old_img"];
//     // var_dump($img);
//     $sql="UPDATE course SET  name='$name',directions='$directions',price='$price' ,up_date='$up_date',shelf_time='$shelf_time' WHERE course_id=$course_id";
// }



// if ($conn->query($sql) === TRUE) {

//     header("location: course_Ni.php?id=". $course_id);
//     exit();

// } else {
//     echo "修改增資料錯誤: " . $conn->error;
// }