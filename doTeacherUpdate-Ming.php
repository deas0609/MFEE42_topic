<?php
$id=$_POST["id"];
$name=$_POST["name"];
$gender=$_POST["gender"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$introduce=$_POST["introduce"];
$photo=$_POST["photo"];
$expertise=$_POST["expertise"];
// echo "$id, $name, $phone, $email,$photo";

require_once("db_connect.php");




if ($_FILES["file"]["error"] == 0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/teachers/" . $_FILES["file"]["name"])) {
        $fileName = $_FILES["file"]["name"];

        echo "上傳成功, 檔名為" . $fileName;
       
        $sql = "UPDATE teachers SET name='$name',gender='$gender',phone='$phone',email='$email',introduce='$introduce',photo='$fileName',expertise='$expertise' WHERE id=$id";

// var_dump($_FILES["file"]);
        // -> 代表子方法 
        if ($conn->query($sql) === TRUE) {
            $imagePath="images/teachers/$photo";
            if (file_exists($imagePath)) {
                unlink($imagePath);
                // echo "图片已成功删除。";
            }

            header("location:teacher-Ming.php?id=$id");
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
    } else {
        echo "上傳失敗";
    }
} else if($_FILES["file"]["error"] == 4){
    $sql = "UPDATE teachers SET name='$name',gender='$gender',phone='$phone',email='$email',introduce='$introduce',expertise='$expertise' WHERE id=$id";

     // -> 代表子方法 
     if ($conn->query($sql) === TRUE) {
            

        header("location:teacher-Ming.php?id=$id");
    } else {
        echo "新增資料錯誤: " . $conn->error;
    }
}else{
    var_dump($_FILES["file"]["error"]);
}

