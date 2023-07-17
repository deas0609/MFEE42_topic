<?php
if (!isset($_POST["names"])) {
    die("請依正常管道到此頁");
}

require_once("db_connect.php");

$names = $_POST["names"];
$dates = $_POST["dates"];
$locations = $_POST["locations"];
$price = $_POST["price"];
$launch_date = $_POST["launch_date"];
$descriptions = $_POST["descriptions"];

$statuss = isset($_POST["statuss"]) ? $_POST["statuss"] : 1;

// $imagePath = "/images/Midterm_Project_images/"; // 指定圖片資料夾路徑
// $imageName = $_FILES["file"]["name"];
// $imageDestination = $imagePath . $imageName;
// echo $imageDestination;
// exit;

// Midterm_Project_images
// Check if an image file was uploaded
if (!empty($_FILES["file"]["tmp_name"])) {
    $imagePath = "images/MidtermProjectImages/"; // 指定圖片資料夾路徑
    $imageName = $_FILES["file"]["name"];
    $imageTmp = $_FILES["file"]["tmp_name"];
    $imageDestination = $imagePath . $imageName;

    

    // Move the uploaded image to the destination folder
    if (move_uploaded_file($imageTmp, $imageDestination)) {
        // Insert the record into the database with the image path
        $sql = "INSERT INTO Event_Management_MO (images, names, dates, locations, price, launch_date, descriptions, statuss) 
                VALUES ('$imageName', '$names', '$dates', '$locations', '$price', '$launch_date', '$descriptions', '$statuss')";

        if ($conn->query($sql) === TRUE) {
            $latestId = $conn->insert_id;
            echo "資料表 Event_Management_MO 新增資料完成, id 為 $latestId";
            header("location: Events-list-MO.php");
            exit;
        } else {
            echo "新增資料錯誤: " . $conn->error;
        }
    } else {
        echo "圖片上傳失敗";
        exit;
    }
} else {
    // No image file was uploaded, insert the record without an image
    $sql = "INSERT INTO Event_Management_MO (names, dates, locations, price, launch_date, descriptions, statuss) 
            VALUES ('$names', '$dates', '$locations', '$price', '$launch_date', '$descriptions', '$statuss')";

    if ($conn->query($sql) === TRUE) {
        $latestId = $conn->insert_id;
        echo "資料表 Event_Management_MO 新增資料完成, id 為 $latestId";
        header("location: Events-list-MO.php");
        exit;
    } else {
        echo "新增資料錯誤: " . $conn->error;
    }
}

$conn->close();
