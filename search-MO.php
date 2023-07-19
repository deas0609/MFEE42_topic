<?php
// Check if the search form has been submitted
if (isset($_GET["name"])) {
    $name = $_GET["name"];
    $minPrice = $_GET["minPrice"] ?? null;
    $maxPrice = $_GET["maxPrice"] ?? null;
    $startDate = $_GET["startDate"] ?? null;
    $endDate = $_GET["endDate"] ?? null;

    require_once("db_connect.php");

    // Build the SQL query with search conditions
    $whereClause = "WHERE names LIKE '%$name%'";

    if (!empty($minPrice)) {
        $whereClause .= " AND price >= $minPrice";
    }
    if (!empty($maxPrice)) {
        $whereClause .= " AND price <= $maxPrice";
    }
    if (!empty($startDate) && !empty($endDate)) {
        // Check if the dates are valid and then convert to YYYY-MM-DD format for proper SQL comparison
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));
        if ($startDate && $endDate) {
            $whereClause .= " AND dates BETWEEN '$startDate' AND '$endDate'";
        }
    } elseif (!empty($startDate)) {
        // Only start date is given
        $startDate = date('Y-m-d', strtotime($startDate));
        if ($startDate) {
            $whereClause .= " AND dates >= '$startDate'";
        }
    } elseif (!empty($endDate)) {
        // Only end date is given
        $endDate = date('Y-m-d', strtotime($endDate));
        if ($endDate) {
            $whereClause .= " AND dates <= '$endDate'";
        }
    }

    $page = $_GET["page"] ?? 1;
    $perPage = 5;
    $startItem = ($page - 1) * $perPage;

    $sql = "SELECT id, images, names, dates, locations, price, statuss, launch_date, descriptions FROM Event_Management_MO $whereClause ORDER BY id ASC LIMIT $startItem, $perPage";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $user_count = $result->num_rows;

    $sql_count = "SELECT COUNT(*) AS total FROM Event_Management_MO $whereClause";
    $count_result = $conn->query($sql_count);
    $totalUser = $count_result->fetch_assoc()["total"];
    $totalPage = ceil($totalUser / $perPage);
} else {
    $user_count = 0;
}
?>

<!doctype html>
<html lang="en">

<style>
    .event-image {
        width: 25vw;
        height: 25vh;
    }
</style>

<head>
    <title>Search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-info" href="Events-list-MO.php">回活動列表</a>
        </div>
        <div class="py-2">
            <form action="search-MO.php">
                <div class="row gx-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="搜尋活動" name="name">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-info" type="submit">搜尋</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="py-2 d-flex justify-content-between align-items-center">

        <?php if (isset($_GET["name"])) : ?>
                <div>
                    共有 <?= $user_count ?> 筆符合的資料
                </div>
            <?php endif; ?>
            
        </div>
        <?php if ($user_count != 0) : ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>音樂祭編號ID</th>
                        <th>圖片</th>
                        <th>名稱</th>
                        <th>活動日</th>
                        <th>地點</th>
                        <th>票價</th>
                        <th>上架日</th>
                        <th>說明</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?name=<?= $name ?>&amp;page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</body>

</html>
