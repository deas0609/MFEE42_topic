<!doctype html>
<html lang="en">

<head>
  <title>Create Album</title>
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
    <form action="doAlbumCreate-yhhung.php" method="post" enctype="multipart/form-data" class="form-control">
      
        <table class="table table-bordered ">
            
            <tr>
                <th>唱片名稱</th>
                <td><input type="text" class="form-control"  name="title"></td>
            </tr>
            <tr>
                <th>歌手/團體</th>
                <td><input type="text" class="form-control"  name="artist"></td>
            </tr>
            <tr>
                <th>唱片公司</th>
                <td><input type="text" class="form-control" name="label"></td>
            </tr>
            <tr>
                <th>唱片種類</th>
                <td><select type="text" class="form-control"  name="format">
                            <option value="CD">CD</option>
                            <option value="Vinyl">黑膠</option>
                            <option value="Cassette">錄音帶</option>
                            <option value="Others">其他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>發行地區</th>
                <td><input type="text" class="form-control"  name="country"></td>
            </tr>
            <tr>
                <th>發行日期</th>
                <td><input type="text" class="form-control"  name="released_date" placeholder="請輸入 YYYYY-MM-DD的日期格式"></td>
            </tr>
            <tr>
                <th>年分</th>
                <td><input type="text" class="form-control"  name="year"></td>
            </tr>
            <tr>
                <th>種類1</th>
                <td><select type="text" class="form-control"  name="genre_1" required>
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
                <th>種類2</th>
                <td><select type="text" class="form-control"  name="genre_2">
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
                <th>種類3</th>
                <td><select type="text" class="form-control"  name="genre_3">
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
                <th>選取檔案</th>
                <td><input type="file" class="form-control" name="file"></td>
            </tr>
            <tr>
                <th>discogs_id</th>
                <td><input type="text" class="form-control"  name="discogs_id"></td>
            </tr>
            <tr>
                <th>價格</th>
                <td><input type="text" class="form-control"  name="price"></td>
            </tr>
            <tr>
                <th>庫存</th>
                <td><input type="text" class="form-control"  name="stock_num"></td>
            </tr>
            <tr>
                <th>描述</th>
                <td><textarea class="form-control" name="description" rows="20"></textarea></td>
            </tr>
        </table>
        <div class="py-2 d-flex justify-content-between">
            <div>
            
            <button class="btn btn-info" type="submit">儲存</button>
            <!-- 連結連結連結  -->
            <a class="btn btn-info" href="album-list-yhhung.php">取消</a>
            </div>
        </div>
        </form>
  </div>
</body>

</html>