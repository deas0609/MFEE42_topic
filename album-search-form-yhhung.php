<!doctype html>
<html lang="en">

<head>
  <title>album-search-form</title>
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
    <!-- 連結連結連結  -->
      <a class="btn btn-info" href="album-list-yhhung.php">回列表</a>
    </div>
    <!-- 連結連結連結  -->
    <form action="album-search-advanced-yhhung.php" method="get" class="form-control">
      
        <table class="table table-bordered ">
            
            <tr>
                <th>唱片名稱</th>
                <td><input type="text" class="form-control"  name="title" placeholder="請輸入唱片名稱"></td>
            </tr>
            <tr>
                <th>歌手/團體</th>
                <td><input type="text" class="form-control"  name="artist" placeholder="請輸入專輯歌手"></td>
            </tr>
            <tr>
                <th>唱片種類</th>
                <td><select type="text" class="form-control"  name="format">
                            <option value=""></option>
                            <option value="CD">CD</option>
                            <option value="Vinyl">黑膠</option>
                            <option value="Cassette">錄音帶</option>
                            <option value="Others">其他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>年分</th>
                <td><input type="text" class="form-control"  name="startyear" placeholder="請輸入查詢年分範圍">~<input type="text" class="form-control"  name="endyear" placeholder="請輸入查詢年分範圍"></td>
            </tr>
            <tr>
                <th>種類1</th>
                <td><select type="text" class="form-control"  name="genre" >
                            <option value=""></option>
                            <option value="Electronic">電子音樂</option>
                            <option value="Rock">搖滾</option>
                            <option value="Pop">流行</option>
                            <option value="Folk, World, & Country">鄉村和民謠音樂</option>
                            <option value="Jazz">爵士</option>
                            <option value="Hip Hop">嘻哈</option>
                            <option value="Funk / Soul">放克 / 靈魂樂</option>
                            <option value="Reggae">雷鬼</option>
                            <option value="Blues">藍調</option>
                            <option value="Stage & Screen">舞台和電影音樂</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>價格</th>
                <td><input type="text" class="form-control"  name="min" placeholder="請輸入查詢價錢範圍">~<input type="text" class="form-control"  name="max" placeholder="請輸入查詢價錢範圍"></td>
            </tr>
        </table>
        <div class="py-2 d-flex justify-content-between">
            <div>
            
            <button class="btn btn-info" type="submit">查詢</button>
            <!-- 連結連結連結  -->
            <a class="btn btn-info" href="album-list-yhhung.php">取消</a>
            </div>
        </div>
        </form>
  </div>
</body>

</html>