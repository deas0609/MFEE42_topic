<!doctype html>
<html lang="en">

<head>
  <title>優惠券建立</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
  <div class="container">
    <h2 class="my-2">新增優惠券</h2>

    <div class="my-3">
      <div class="my-2">
      <label for="discountName">優惠券名稱</label>
      <input type="text" class="form-control" name="discountName" placeholder="例:感恩回饋季、歡迎新會員優惠券" id="discountName">
      </div>

      <div class="my-2">
      <label for="countType">折扣種類</label>
      <select type="text" class="form-select" name="countType" id="countType">
        <option value="1">固定折扣</option>
        <option value="2">百分比折扣</option>
      </select>
      </div>

      <div class="my-2">
      <label for="discount">折扣</label>
      <input type="text" class="form-control" name="discount" placeholder="固定金額請輸入任意數字、百分比金額請輸入1~100" id="discount">
      </div>

      <div class="my-2">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault">最低消費金額(可選)</label>
        </div>
        <input type="text" class="form-control minimum" name="minimum" id="minimum" placeholder="請輸入最低消費金額" disabled>
      </div>

      <div class="my-2">
      <label for="discountCode">折扣代碼</label>
      <input type="text" class="form-control my-2" name="discountCode" id="discountCode" placeholder="最多可輸入20個字元，含數字、大寫或小寫字母">
      <button id="randomCode" class="btn btn-outline-primary">產生隨機代碼</button>
      </div>

      <div class="row my-3 align-items-center">
        <label for="startDate" class="col-auto">起始日期:</label>
        <div class="col-3">
          <input type="date" class="form-control" name="startDate" id="startDate">
        </div>
        <label for="endDate" class="col-auto">結束日期:</label>
        <div class="col-3">
          <input type="date" class="form-control" name="endDate" id="endDate">
        </div>
      </div>

      <div class="row my-3">
        <label class="col-auto" for="">啟用/停用: </label>
        <div class="form-check col-auto">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="enable" checked>
          <label class="form-check-label" for="flexRadioDefault1">啟用</label>
        </div>
        <div class="form-check col-auto">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="disable">
          <label class="form-check-label" for="flexRadioDefault2">停用</label>
        </div>
      </div>

      <div class="d-flex align-items-center">
        <button type="submit" class="btn btn-primary" id="send"> <i class="fa-solid fa-plus"></i> 新增</button>
        <div class="ms-2">
          <a href="discountIndex_Ch.php" class="btn btn-primary"> <i class="fa-solid fa-reply"></i> 返回列表</a>
        </div>
        <div class="ms-2"><span class="text-danger" id="warningText"></span></div>
      </div>

      <!-- 新增成功訊息 -->
      <?php include("./modal/createSuccess_Ch.php") ?>
      <!-- 新增成功訊息 -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
      // 資料input
      const discountName = document.querySelector("#discountName")
      const countType = document.querySelector("#countType")
      const discount = document.querySelector("#discount")
      const minimum = document.querySelector("#minimum")
      const discountCode = document.querySelector("#discountCode")
      const startDate = document.querySelector("#startDate")
      const endDate = document.querySelector("#endDate")
      const enable = document.querySelector("#enable")
      const disable = document.querySelector("#disable")
      const flexSwitchCheckDefault = document.querySelector("#flexSwitchCheckDefault")
      const minimumChange = document.querySelector(".minimum")
      
      const warningText = document.querySelector("#warningText")

      // 指定是否可輸入最低消費金額
      flexSwitchCheckDefault.addEventListener("click",function(){
        if(minimumChange.disabled){
          minimumChange.removeAttribute("disabled")}
        else{  
            minimumChange.setAttribute("disabled","disabled")
          }
      })

       // 隨機產生代碼
       const randomCode=document.querySelector("#randomCode");
          randomCode.addEventListener("click",function(){
          let code="";
          for(let i=0;i<20;i++){
          let codeSelectIndex=[ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',  'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',  'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',  'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd',  'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',  'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x',  'y', 'z' ];
          let randomCount=Math.floor(Math.random()*61);
          code+=codeSelectIndex[randomCount]
          // console.log(codeSelectIndex[randomCount]);
          }
          discountCode.value = code
           })
        
        
        let enableValue = 1;
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
        

      send.addEventListener("click", function() {

        let discountNameValue = discountName.value
        let countTypeValue = countType.value
        let discountValue = discount.value
        let minimumValue = minimum.value
        let discountCodeValue = discountCode.value
        let startDateValue = startDate.value
        let endDateValue = endDate.value

        if(minimumChange.disabled){//如果最低消費金額
          minimumValue=0;
        }
    
        $.ajax({
            method: "POST", //or GET
            url: "API/discountCreatAPI_Ch.php",
            dataType: "json",
            data: {
              discountName: discountNameValue,
              countType: countTypeValue,
              discount: discountValue,
              minimum:minimumValue,
              discountCode: discountCodeValue,
              startDate: startDateValue,
              endDate: endDateValue,
              enable: enableValue
            }

          })
          .done(function(response) {
            // console.log(response)
            let status = response.status
            if (status == 0) {
              warningText.innerText = response.message
            } else {
              // console.log("success")
              // $('#myModal').modal('show');
              const modal = new bootstrap.Modal(document.getElementById('myModal'));
              modal.show();

            }
          }).fail(function(jqXHR, textStatus) {


          });
      })

    </script>

</body>

</html>