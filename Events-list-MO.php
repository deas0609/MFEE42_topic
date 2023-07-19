<?php
$page = $_GET["page"] ?? 1;
$type = $_GET["type"] ?? 1;
require_once("db_connect.php");
$perPage = 5;
$startItem = ($page - 1) * $perPage;
if ($type == 1) {
    $orderBy = "ORDER BY id ASC";
} elseif ($type == 2) {
    $orderBy = "ORDER BY id DESC";
} elseif ($type == 3) {
    $orderBy = "ORDER BY dates ASC";
} elseif ($type == 4) {
    $orderBy = "ORDER BY dates DESC";
} elseif ($type == 5) {
    $orderBy = "ORDER BY price ASC";
} elseif ($type == 6) {
    $orderBy = "ORDER BY price DESC";
} elseif ($type == 7) {
    $orderBy = "ORDER BY launch_date ASC";
} elseif ($type == 8) {
    $orderBy = "ORDER BY launch_date DESC";
} else {
    header("location:404.php");
    exit;
}
$sql = "SELECT id, images, names, dates, locations, price, statuss, launch_date, descriptions 
            FROM Event_Management_MO WHERE statuss <> 0 $orderBy 
            LIMIT $startItem, $perPage";
$result = $conn->query($sql);
$sql_count = "SELECT COUNT(*) AS total FROM Event_Management_MO WHERE statuss <> 0";
$count_result = $conn->query($sql_count);
$totalUser = $count_result->fetch_assoc()["total"];
$totalPage = ceil($totalUser / $perPage);
?>


<style>
    .event-image {
        width: 25vw;
        height: 25vh;
    }

    .custom-btn {
        margin-right: 5px;
        /* 自定義間距，此值應該與 custom-btn-group 的負值相等，以保持兩個按鈕之間的間距不變 */
    }
</style>

<!doctype html>
<html lang="en">

<head>
    <title>Events list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                    <a href="#" class="btn btn-danger" id="confirmDeleteBtn">確認</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">


    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">搜尋活動</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 搜尋表單 -->
                <form action="search-MO.php" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="請輸入活動名稱" name="name">
                        <button class="btn btn-primary" type="submit">確定</button>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">價格</span>
                        <input type="number" class="form-control" placeholder="最低價格" name="minPrice">
                        <span class="input-group-text">至</span>
                        <input type="number" class="form-control" placeholder="最高價格" name="maxPrice">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">活動日</span>
                        <input type="date" class="form-control" name="startDate">
                        <span class="input-group-text">至</span>
                        <input type="date" class="form-control" name="endDate">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


        <?php
        $user_count = $result->num_rows;
        ?>

        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <a href="?page=<?= $page ?>&amp;type=1" class="btn btn-info <?= ($type == 1) ? 'active' : ''; ?>">編號 <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="?page=<?= $page ?>&amp;type=2" class="btn btn-info <?= ($type == 2) ? 'active' : ''; ?>">編號 <i class="fa-solid fa-arrow-down-wide-short"></i></a>
                <a href="?page=<?= $page ?>&amp;type=5" class="btn btn-info <?= ($type == 5) ? 'active' : ''; ?>">票價 <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="?page=<?= $page ?>&amp;type=6" class="btn btn-info <?= ($type == 6) ? 'active' : ''; ?>">票價 <i class="fa-solid fa-arrow-down-wide-short"></i></a>
                <a href="?page=<?= $page ?>&amp;type=3" class="btn btn-info <?= ($type == 3) ? 'active' : ''; ?>">活動日 <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="?page=<?= $page ?>&amp;type=4" class="btn btn-info <?= ($type == 4) ? 'active' : ''; ?>">活動日 <i class="fa-solid fa-arrow-down-wide-short"></i></a>
                <a href="?page=<?= $page ?>&amp;type=7" class="btn btn-info <?= ($type == 7) ? 'active' : ''; ?>">上架日 <i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="?page=<?= $page ?>&amp;type=8" class="btn btn-info <?= ($type == 8) ? 'active' : ''; ?>">上架日 <i class="fa-solid fa-arrow-down-wide-short"></i></a>
            </div>
            <div class="ms-2 d-flex align-items-center">
                <div class="custom-btn-group">
                    <button class="btn btn-success custom-btn" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">搜尋</button>
                    <a class="btn btn-success custom-btn" href="create-Events-MO.php">新增</a>
                </div>
                <div class="ms-2">
                    共 <?= $totalUser ?> 筆, 第 <?= $page ?> 頁
                </div>
            </div>
        </div>



        <?php
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">編號</th>
                    <th class="text-center">圖片</th>
                    <th class="text-center">名稱</th>
                    <th class="text-center">活動日</th>
                    <th class="text-center">地點</th>
                    <th class="text-center">票價</th>
                    <th class="text-center">上架日</th>
                    <th class="text-center">說明</th>
                    <th class="text-center">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td class="table-light"><?= $row["id"] ?></td>
                        <td>
                            <img src="images/MidtermProjectImages/<?= $row["images"] ?>" alt="" class="event-image">
                        </td>
                        <td><?= $row["names"] ?></td>
                        <td><?= $row["dates"] ?></td>
                        <td><?= $row["locations"] ?></td>
                        <td><?= $row["price"] ?></td>
                        <td><?= $row["launch_date"] ?></td>
                        <td style="overflow: hidden;">
                            <?php
                            $maxCharacters = 50; // 設定最大文字數

                            // 檢查說明欄位是否超過最大文字數
                            if (mb_strlen($row["descriptions"]) > $maxCharacters) {
                                $trimmedDescription = mb_substr($row["descriptions"], 0, $maxCharacters) . '...'; // 截斷說明文字並加上省略號
                            } else {
                                $trimmedDescription = $row["descriptions"]; // 若說明文字未超過最大文字數，則不進行截斷
                            }
                            echo $trimmedDescription;
                            ?>
                        </td>
                        <td>
                            <?php if ($row["statuss"] != 0) : ?>
                                <a href="Events-edit-MO.php?id=<?= $row["id"] ?>" class="btn btn-info mb-2">編輯</a><br>
                                <button class="btn btn-danger deleteBtn" data-id="<?= $row["id"] ?>">刪除</button>
                            <?php else : ?>
                        <td>已刪除</td>
                    <?php endif; ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <nav aria-label="Page navigation example">
            <div class="pagination-container d-flex justify-content-between">
                <ul class="pagination">
                    <li class="page-item <?= ($page == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?page=1&type=<?= $type ?>">最前頁</a>
                    </li>
                    <li class="page-item <?= ($page == 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= ($page - 1) ?>&type=<?= $type ?>">上一頁</a>
                    </li>
                    <?php for ($i = max(1, $page - 2); $i <= min($page + 2, $totalPage); $i++) : ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($page == $totalPage) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= ($page + 1) ?>&type=<?= $type ?>">下一頁</a>
                    </li>
                    <li class="page-item <?= ($page == $totalPage) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $totalPage ?>&type=<?= $type ?>">最後頁</a>
                    </li>
                </ul>
                <ul class="pagination">
                    <li class="page-item disabled">
                        <span class="page-link font-weight-bold text-primary">共 <?= $totalPage ?> 頁</span>
                    </li>
                </ul>
            </div>
        </nav>





    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        const deleteButtons = document.querySelectorAll('.deleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                const confirmDeleteLink = document.querySelector('#deleteModal .modal-footer a');
                confirmDeleteLink.href = `doDelete-MO.php?id=${id}`;
                deleteModal.show();
            });
        });
    </script>
</body>

</html>