<!doctype html>
<html lang="en">

<head>
    <title>Create Events</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-info" href="Events-list-MO.php">回活動列表</a>
        </div>
        <form action="doCreate-MO.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row["id"] ?>">

            <div class="mb-2 w-25">
                <label for="">日期</label>
                <input type="date" class="form-control" name="dates" required>
            </div>

            <div class="mb-2">
                <label for="">名稱</label>
                <input type="text" class="form-control" name="names" required>
            </div>

            <div class="mb-2">
                <label for="">地點</label>
                <input type="text" class="form-control" name="locations" required>
            </div>

            <div class="mb-2">
                <label for="">票價</label>
                <input type="text" class="form-control" name="price" required>
            </div>

            <div class="mb-2">
                <label for="">說明</label>
                <input type="text" class="form-control" name="descriptions">
            </div>

            <!-- 新增圖片預覽區域 -->
            <div class="mb-3 w-25">
                <label for="formFile" class="form-label">上傳圖片</label>
                <input type="file" name="file" class="form-control" required onchange="previewImage(event)">
                <div class="mt-2">
                    <img id="preview" src="" alt="" style="max-width: 200px; max-height: 200px;">
                </div>
            </div>

            <!-- 待更新 -->
            <div class="mb-2 w-25">
                <label for="" class="text-danger">上架日期</label>
                <input type="date" class="form-control" name="launch_date" value="<?= date('Y-m-d') ?>" readonly required>
            </div>

            <button class="btn btn-info" type="submit">送出</button>
        </form>
    </div>

    <script>
        function validateForm() {
            const datesInput = document.querySelector('input[name="dates"]');
            const namesInput = document.querySelector('input[name="names"]');
            const locationsInput = document.querySelector('input[name="locations"]');
            const priceInput = document.querySelector('input[name="price"]');

            if (
                datesInput.value.trim() === '' ||
                namesInput.value.trim() === '' ||
                locationsInput.value.trim() === '' ||
                priceInput.value.trim() === ''
            ) {
                alert('請填寫必填欄位');
                return false; // 阻止表單提交
            }

            return true; // 表單驗證通過，允許提交
        }

        // 圖片預覽函式
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
    <script>
        // 取得今日日期
        const today = new Date().toISOString().split('T')[0];

        // 找到上架日期的輸入欄位
        const launchDateInput = document.querySelector('input[name="launch_date"]');

        // 將上架日期欄位的值設為今日日期
        launchDateInput.value = today;
    </script>


</body>

</html>
