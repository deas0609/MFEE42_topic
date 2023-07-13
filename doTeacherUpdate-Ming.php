<?php

if (!isset($_POST["name"]) || !isset($_POST["gender"]) || !isset($_POST["phone"]) || !isset($_POST["email"]) || !isset($_POST["expertise"]) || !isset($_POST["introduce"]) ) {
    die("請依正常管道進入");
    
   
}

$id=$_POST["id"];
$name=$_POST["name"];
$gender=$_POST["gender"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$introduce=$_POST["introduce"];
$photo=$_POST["photo"];
$expertise=$_POST["expertise"];
// echo "$id, $name, $phone, $email,$photo";

$emailFormat="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$phoneFormat="/^09\d{8}$/";

require_once("db_connect.php");

function DelaytoAddTeacher($num){
    $id=$_POST["id"];
    header("Refresh:$num;url= teacher-edit-Ming.php?id=$id");
    exit;
}

if (empty($_POST["name"])) {
    // die("請輸入姓名");
    echo "請輸入姓名";

    DelaytoAddTeacher(1);
    // $data=[
    //     "status"=>0,
    //     "message"=>"請輸入姓名"
    // ];
    // echo json_encode($data);
    // exit;
    
}
if (empty($_POST["gender"])) {
    // die("請輸入性別");
    echo "輸入性別";

    DelaytoAddTeacher(1);
}
if (empty($_POST["phone"])) {
    // die("請輸入電話");
    echo "請輸入電話";
    DelaytoAddTeacher(1);
}
if (empty($_POST["email"])) {
    // die("請輸入信箱");
    echo "請輸入信箱";
    DelaytoAddTeacher(1);
}
if (empty($_POST["expertise"])) {
    // die("請輸入專長");
    echo "請輸入專長";
    DelaytoAddTeacher(1);
}
if (empty($_POST["introduce"])) {
    // die("請輸入介紹");
    echo "請輸入介紹";
    DelaytoAddTeacher(1);
}

// 為了判斷是否有人創建過帳號 抓取NAME的數據
$sqlNameRepeatcheck="SELECT * FROM teachers WHERE name='$name'";
$resultNameRepeatcheck=$conn->query($sqlNameRepeatcheck);

$teacherCount=$resultNameRepeatcheck->num_rows;
$sqlID="SELECT * FROM teachers WHERE id='$id'";
$resultID=$conn->query($sqlID);
$rowID=$resultID->fetch_assoc();


if($teacherCount==1 && $name<>$rowID["name"]){
   echo "該名稱已有人使用";
  
    DelaytoAddTeacher(1);
    //  die("該名稱已有人使用");
    
}


if(!preg_match($emailFormat,$email)){
    echo "信箱格式不正確";
    DelaytoAddTeacher(1);
    
    // die("信箱格式不正確");
}
if(!preg_match($phoneFormat,$phone)){
    echo "電話格式不正確";
    DelaytoAddTeacher(1);
    // die("電話格式不正確");
}

// var_dump($_FILES["file"]);
// exit;


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

