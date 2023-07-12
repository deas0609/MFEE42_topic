<?php

if (!isset($_GET["id"])) {
    die("無法作業");
}
require_once("db_connect.php");
$id=$_GET["id"];
$sqlDelete="DELETE FROM teachers WHERE id = '$id'";
$sql = "SELECT * FROM teachers WHERE id=$id";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$image=$row["photo"];
// var_dump($row['photo']);
// exit;
// -> 代表子方法 
if ($conn->query($sqlDelete) === TRUE) { 
    $latestId=$conn->insert_id; 
    
    $imagePath="images/teachers/$image";
            if (file_exists($imagePath)) {
                unlink($imagePath);
                // echo "图片已成功删除。";
            }
   
    header("location: teachers-list-Ming.php");
} else {
    echo "刪除資料錯誤: ". $conn->error;
}
$conn->close();  //關閉資料庫