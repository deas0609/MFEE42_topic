<?php
if(!isset($_GET["id"])){
    die("無法作業");
}
require_once("db_connect.php");

$id=$_GET["id"];

$sql="UPDATE album SET valid=0 WHERE id = '$id' ";

if($conn->query($sql) === TRUE){
    //連結連結連結 
    header("location: album-list-yhhung.php");
}else{
    echo "資造刪除錯誤: ".$conn->error;
}
$conn->close();
?>