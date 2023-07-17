<?php

require_once("db_connect.php");
if (!isset($_GET["id"])) {
    header("location:404page_Ch.php");
    die;
}

$id = $_GET["id"];
$sql = "SELECT * FROM ch WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);

?>

<!doctype html>
<html lang="en">

<head>
    <title>優惠券編輯</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php include("./modal/updateSuccess_Ch.php") ?>

    <div class="container">
        <h2 class="my-2">優惠券編輯</h2>
        <div>

            <table class="table table-bordered">
                <thead>
                    <input type="hidden" value="<?= $row["id"] ?>" name="id" id="id">
                    <tr>
                        <th class="align-middle">優惠券名稱</th>
                        <td>
                            <input type="text" class="form-control" id="discountName" name="discountName" value="<?= $row["discountName"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">折扣內容</th>
                        <td><input type="text" class="form-control" id="discount" name="discount" value="<?= $row["discount"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">折扣種類</th>
                        <td>
                            <select type="text" class="form-select" id="countType" name="countType" id="CountType">
                                <?php if ($row["countType"] == 1) : ?>
                                    <option value="1">元</option>
                                    <option value="2">%</option>
                                <?php else : ?>
                                    <option value="2">%</option>
                                    <option value="1">元</option>
                                <?php endif ?>
                            </select>
                    </tr>
                    <tr>
                        <th class="align-middle">最低消費</th>
                        <td><input type="text" class="form-control" id="minimum" name="minimum" value="<?= $row["minimum"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">折扣代碼</th>
                        <td><input type="text" class="form-control" id="discountCode" name="discountCode" value="<?= $row["discountCode"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">開始日期</th>
                        <td><input type="date" class="form-control" id="startDate" name="startDate" value="<?= $row["startDate"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">結束日期</th>
                        <td><input type="date" class="form-control" id="endDate" name="endDate" value="<?= $row["endDate"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">啟用/停用</th>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="enable" <?php if($row["enable"]==1){echo "checked";}?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    啟用
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="disable" <?php if($row["enable"]==0){echo "checked";}?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    停用
                                </label>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>

        </div>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary me-2" id="send"> <i class="fa-regular fa-square-check"></i> 編輯完成</button>
            <a href="discountDetail_Ch.php?id=<?= $row["id"] ?>" class="btn btn-primary me-2"> <i class="fa-solid fa-reply"></i> 返回</a>
            <div class="text-danger" id="warningText"></div>
        </div>

    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        const id = document.querySelector("#id")
        const discountName = document.querySelector("#discountName")
        const countType = document.querySelector("#countType")
        const discount = document.querySelector("#discount")
        const minimum = document.querySelector("#minimum")
        const discountCode = document.querySelector("#discountCode")
        const startDate = document.querySelector("#startDate")
        const endDate = document.querySelector("#endDate")
        const enable = document.querySelector("#enable")
        const disable = document.querySelector("#disable")
        const send = document.querySelector("#send")
        const warningText = document.querySelector("#warningText")

        let enableValue = <?=$row["enable"] ?>;
        
        enable.addEventListener("change",function(){
            if(this.checked){
                enableValue=1
            }
        })
        disable.addEventListener("change",function(){
            if(this.checked){
                enableValue=0
            }
        })
        
        // console.log(enableValue)
        
                            

        send.addEventListener("click", function() {
            let idvalue = id.value
            let discountNameValue = discountName.value
            let countTypeValue = countType.value
            let discountValue = discount.value
            let minimumValue = minimum.value
            let discountCodeValue = discountCode.value
            let startDateValue = startDate.value
            let endDateValue = endDate.value
            // console.log(idvalue)
            
            

            $.ajax({
                    method: "POST", //or GET
                    url: "API/discountUpdateAPI_Ch.php",
                    dataType: "json",
                    data: {
                        id: idvalue,
                        discountName: discountNameValue,
                        countType: countTypeValue,
                        discount: discountValue,
                        minimum: minimumValue,
                        discountCode: discountCodeValue,
                        startDate: startDateValue,
                        endDate: endDateValue,
                        enable: enableValue
                    }
                })
                .done(function(response) {
                    console.log(response)
                    let status = response.status
                    if (status == 0) {
                        warningText.innerText = response.message
                    } else {
                        // console.log("success")
                        // $('#myModal').modal('show');
                        const modal = new bootstrap.Modal(document.getElementById('myModal'));
                        modal.show();
                    }
                }).fail(function(jqXHR, textStatus) {});
        })
    </script>


</body>

</html>