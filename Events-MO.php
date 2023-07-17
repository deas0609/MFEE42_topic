
<!doctype html>
<html lang="en">

<head>
    <title>Events</title>
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
            <a class="btn btn-info" href="user-list.php">回活動列表</a>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>音樂祭編號ID</th>
                <td><?= $row["id"] ?></td>
            </tr>
            <tr>
                <th>圖片</th>
                <td><img src="/Midterm_Project/images/<?= $row["images"] ?>" alt=""></td>
            </tr>
            <tr>
                <th>名稱</th>
                <td><?= $row["names"] ?></td>
            </tr>
            <tr>
                <th>日期</th>
                <td><?= $row["日期"] ?></td>
            </tr>
            <tr>
                <th>地點</th>
                <td><?= $row["dates"] ?></td>
            </tr>
            <tr>
                <th>票價</th>
                <td><?= $row["price"] ?></td>
            </tr>
            <tr>
                <th>上架日期</th>
                <td><?= $row["launch_date"] ?></td>
            </tr>
            <tr>
                <th>說明</th>
                <td style="overflow: hidden;"><?= $row["descriptions"] ?></td>
            </tr>
        </table>
        <div class="py-2">
            <a class="btn btn-info" href="user-edit.php?id=<?= $row["id"] ?>">編輯</a>
        </div>
        <h2 class="pt-4">收藏商品</h2>
        <?php
        $userLikeCount = count($rowsLike);
        if ($userLikeCount != 0) :
        ?>
            <ul>
                <?php foreach ($rowsLike as $product) : ?>
                    <li>
                        <a href="/product/product.php?id=<?= $product["product_id"] ?>">
                            <?= $product["product_name"] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>尚未有收藏</p>
        <?php endif; ?>
    </div>
</body>

</html>
