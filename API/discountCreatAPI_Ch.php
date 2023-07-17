<?php
require_once("../db_connect.php");

if (!isset($_POST["discountName"])) {
    // echo"請依正常管道進入此頁";
    $data = [
        "status" => 0, //狀態碼，判斷是否連線成功
        "message" => "無有效參數" //失敗的訊息
    ];
    echo json_encode($data);
    die;
}


$discountName = $_POST["discountName"];
$countType = $_POST["countType"];
$discount = $_POST["discount"];
$minimum = $_POST["minimum"];
$discountCode = $_POST["discountCode"];
$startDate = $_POST["startDate"];
$endDate = $_POST["endDate"];
$enable =$_POST["enable"];

if (empty($_POST["discountName"])) {
    $data = [
        "status" => 0, //狀態碼，判斷是否連線成功
        "message" => "請填寫優惠券名稱" //失敗的訊息
    ];
    echo json_encode($data);
    die;
}

if (empty($_POST["discount"])) {
    $data = [
        "status" => 0, //狀態碼，判斷是否連線成功
        "message" => "請填寫額度" //失敗的訊息
    ];
    echo json_encode($data);
    die;
}

if ($countType == 2) {
    $percentDiscountJudge = "/^(100|[1-9]?\d)$/";
    if (!preg_match($percentDiscountJudge, $discount)) {
        $data = [
            "status" => 0, //狀態碼，判斷是否連線成功
            "message" => "百分比折扣請填寫數字1~100以內" //失敗的訊息
        ];
        echo json_encode($data);
        die;
    }
}

if(empty($minimum)){
    $minimum="0";
}

if (empty($_POST["discountCode"])) {
    $data = [
        "status" => 0, //狀態碼，判斷是否連線成功
        "message" => "請填寫折扣碼" //失敗的訊息
    ];
    echo json_encode($data);
    die;
}

if (empty($_POST["startDate"])) {
    $data = [
        "status" => 0, //狀態碼，判斷是否連線成功
        "message" => "請選擇開始日期" //失敗的訊息
    ];
    echo json_encode($data);
    die;
}

if (empty($_POST["endDate"])) {
    $data = [
        "status" => 0, //狀態碼，判斷是否連線成功
        "message" => "請選擇結束日期" //失敗的訊息
    ];
    echo json_encode($data);
    die;
}

if ($startDate > $endDate) {
    $data = [
        "status" => 0, //狀態碼，判斷是否連線成功
        "message" => "結束日期不能大於開始日期" //失敗的訊息
    ];
    echo json_encode($data);
    die;
}


$now = date('Y-m-d H:i:s');
// var_dump($discountname,$countType,$discount,$discountCode,$startDate,$endDate,$now);


$sql = "INSERT INTO ch (discountName,counTtype,discount,minimum,discountCode,startDate,endDate,enable,created_at,valid) VALUES ('$discountName','$countType','$discount','$minimum','$discountCode','$startDate','$endDate','$enable','$now','1')";



if ($conn->query($sql) === TRUE) {
    $data = [
        "status" => 1,
        "message" => "新增優惠券成功"
    ];
    echo json_encode($data);
} else {
    $data = [
        "status" => 0,
        "message" => "新增資料錯誤"
    ];
    echo json_encode($data);
}

$conn->close();
