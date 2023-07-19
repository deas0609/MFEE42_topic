<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET["id"])) {
    header("location: /404.php");
    exit;
}

$id = $_GET["id"];

require_once("db_connect.php");

$sql = "SELECT * FROM Event_Management_MO WHERE id = $id";
$result = $conn->query($sql);

if (!$result) {
    echo "查詢失敗: " . $conn->error;
    exit;
}

$row = $result->fetch_assoc();
$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="doDelete-MO.php?id=<?= $id ?>" class="btn btn-danger">確認</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="doUpdate-MO.php" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <tr>
                    <th>音樂祭編號ID</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["id"] ?>" name="id" readonly>
                    </td>
                </tr>
                <tr>
                    <th>圖片</th>
                    <td>
                    <?php if (!empty($row["images"])) : ?>
                            <img id="previewImage" src="<?= $row["images"] ?>" width="200" />
                        <?php else : ?>
                            <div id="previewDiv" style="width: 150px; height: 150px; border: 1px solid #ccc;"></div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="images" onchange="previewFile(event)">
                    </td>
                </tr>
                <tr>
                    <th>名稱</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["names"] ?>" name="names" required>
                    </td>
                </tr>
                <tr>
                    <th>日期</th>
                    <td>
                        <input type="date" class="form-control" value="<?= $row["dates"] ?>" name="dates" required>
                    </td>
                </tr>
                <tr>
                    <th>地點</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["locations"] ?>" name="locations" required>
                    </td>
                </tr>
                <tr>
                    <th>票價</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["price"] ?>" name="price" required>
                    </td>
                </tr>
                <tr>
                    <th>上架日期</th>
                    <td>
                        <input type="date" class="form-control" value="<?= $row["launch_date"] ?>" name="launch_date">
                    </td>
                </tr>
                <tr>
                    <th>說明</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["descriptions"] ?>" name="descriptions">
                    </td>
                </tr>
            </table>
            <div class="py-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-info" type="submit">儲存</button>
                    <a class="btn btn-info" href="Events-list-MO.php?id=<?= $row["id"] ?>">取消</a>
                </div>
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">刪除</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        function previewFile(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    if (input.files[0].type.includes('image')) {
                        document.getElementById('previewImage').src = e.target.result;
                        document.getElementById('previewImage').style.display = 'block';
                        document.getElementById('previewDiv').style.display = 'none';
                    } else {
                        document.getElementById('previewImage').style.display = 'none';
                        const previewDiv = document.getElementById('previewDiv');
                        previewDiv.style.backgroundImage = `url('${e.target.result}')`;
                        previewDiv.style.backgroundSize = 'cover';
                        previewDiv.style.display = 'block';
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
