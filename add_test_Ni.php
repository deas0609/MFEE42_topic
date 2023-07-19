
<!doctype html>
<html lang="en">

<head>
  <title>新增課程</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
<div class="container">
    <div class="py-2 ">
        <a href="course_Ni.php" class="btn btn-info">回課程頁面</a>
    </div>
    <div class="row ">
        <form action="course.doCreate_Ni.php" method="post" enctype="multipart/form-data">
            <div class="py-2">
                <!-- 請輸入課程編號： <input type="text" name="course_id" > <br> -->
                請選擇圖片：<input type="file" class="p-3" name="file"> <br>
                請輸入課程名稱： <input type="text" class="m-3" name="name" > <br>
                請輸入課程資訊： <input type="text" class="m-3" name="directions" id="directions"> <br>
                請輸入課程價格： <input type="text" class="m-3" name="price" > <br>
                請輸入上架時間： <input type="date" class="m-3" name="up_date" > <br>
                請輸入下架時間： <input type="date" class="m-3" name="shelf_time"><br>
                <button class="btn btn-info " type="submit">送出</button>
            </div>
         </form>
    </div>
</div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>