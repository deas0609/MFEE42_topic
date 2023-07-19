<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-3">
            <a class="btn btn-outline-primary" href="user-list-allen.php">回使用者列表</a>
        </div>
        <form action="doCreate-allen.php" method="post">
            <div class="mb-3">
                <label for="">姓名</label>
                <input type="text" class="form-control" name="name" required maxlength="30">
            </div>
            <div class="mb-3">
                <label for="">帳號</label>
                <input type="text" class="form-control" name="account" required pattern="^[a-zA-Z][a-zA-Z0-9_]{4,15}$">
            </div>
            <div class="mb-3">
                <label class="mb-1" for="">性別</label><br>
                <input type="radio" name="gender" value="male" required>男性
                <input type="radio" name="gender" value="female">女性
            </div>
            <div class="mb-3">
                <label for="">生日</label><br>
                <input type="date"  name="birthday" required pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$">
            </div>
            <div class="mb-3">
                <label for="">信箱</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="">地址</label>
                <input type="text" class="form-control" name="address" required pattern="^[^\.\*\+\?\^\$\{\}\[\]\(\)\|\\]+$">
            </div>
            <div class="mb-3">
                <label for="">電話</label>
                <input type="text" class="form-control" name="phone" required pattern="^(09)[0-9]{8}$">
            </div>
            <div class="d-flex justify-content-end pt-3">
                <button class="btn btn-primary" type="submit">送出</button>
            </div>
        </form>
    </div>
</body>

</html>