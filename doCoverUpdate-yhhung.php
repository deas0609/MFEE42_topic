<?php
$id=$_POST["id"];
// if(!isset($_POST["title"])){
//     die("請依正常管道到此頁");
// }

require_once("db_connect.php");




if ($_FILES["file"]["error"] == 0) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/alburm/".$_FILES["file"]["name"])) {
        echo "上傳成功, 檔名為 ".$_FILES["file"]["name"];

        $coverImage = $_FILES["file"]["name"];


        $sql = "UPDATE album SET cover_image = '$coverImage' WHERE id = $id";
        

        if ($conn->query($sql) === true) {
            echo "檔案名稱成功存入資料庫";
  
            //連結連結連結 
            header("Location: album-edit-yhhung.php?id=".$id);
            
        } else {
            echo "存入資料庫時發生錯誤: " . $conn->error;
        }

    } else {
        echo "上傳失敗";
    }
}elseif($_FILES["file"]["error"] == 4){
    echo "無附加圖檔";
//連結連結連結 
    header("Location: album-edit-yhhung.php?id=".$id);

}else{
    var_dump($_FILES["file"]["error"]);
}


$conn->close();