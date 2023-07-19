<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST["id"];
$names = $_POST["names"];
$dates = $_POST["dates"];
$locations = $_POST["locations"];
$price = $_POST["price"];
$launch_date = $_POST["launch_date"];
$descriptions = $_POST["descriptions"];

//$descriptions = str_replace("‘", "\\", $descriptions);

require_once("db_connect.php");

// Check if an image file was uploaded
if (!empty($_FILES["images"]["tmp_name"])) {
    $imagePath = "images/MidtermProjectImages/"; // Specify the folder path to store images
    $imageName = $_FILES["images"]["name"];
    $imageTmp = $_FILES["images"]["tmp_name"];
    $imageDestination = $imagePath . $imageName;

    // Move the uploaded image to the destination folder
    if (move_uploaded_file($imageTmp, $imageDestination)) {
        // Update the image path in the database (Remove the path and keep only the filename)
        $imageName = basename($imageDestination);
        $sql = "UPDATE Event_Management_MO SET images=?, names=?, dates=?, locations=?, price=?, launch_date=?, descriptions=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $imageName, $names, $dates, $locations, $price, $launch_date, $descriptions, $id);
    } else {
        echo "圖片上傳失敗";
        exit;
    }
} else {
    // No image file was uploaded, update the record without modifying the image
    $sql = "UPDATE Event_Management_MO SET names=?, dates=?, locations=?, price=?, launch_date=?, descriptions=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $names, $dates, $locations, $price, $launch_date, $descriptions, $id);
}

if ($stmt->execute()) {
    header("location: Events-list-MO.php?id=" . $id);
    exit;
} else {
    echo "修改資料錯誤: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
