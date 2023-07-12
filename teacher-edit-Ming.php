<?php
if (!isset($_GET["id"])) {
    die("資料不存在");
    // header("location:/404.php");
}
$id = $_GET["id"];

require_once("db_connect.php");
$sql = "SELECT * FROM teachers WHERE id=$id";
$result = $conn->query($sql);
// $rows=$result->fetch_all(MYSQLI_ASSOC);
$row = $result->fetch_assoc();
// print_r($row);
// var_dump($row["id"]);
// exit;
?>
<!doctype html>
<html lang="en">

<head>
    <title>teacher-edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <!-- id 要對到data-bs-target="#deleteModal" -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a class="btn btn-danger" href="doTeacherDelete-Ming.php?id=<?= $row["id"] ?>">確認</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="py-2 d-flex justify-content-between align-items-center">
            <h2>編輯</h2>

        </div>
        <form action="doTeacherUpdate-Ming.php" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
            <input type="hidden" name="id" value="<?=$row["id"]?>">  
            <input type="hidden" name="photo" value="<?=$row["photo"]?>">  
                <tr>
                    <td rowspan="5">



                        <label for="file">
                            <img class="" id="editImage" src="images/teachers/<?= $row["photo"] ?>" alt="<?= $row["photo"] ?>">
                            
                        </label>
                        <input type="file" id="file" accept="image/*" name="file" class="form-control d-none">
                    </td>
                    <th>名稱</th>
                    <td><input type="text" class="form-control" value="<?= $row["name"] ?>" name="name"></td>
                    <th>性別</th>
                    <td>
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" <?php if ($row["gender"] == "male") echo "checked" ?>>
                            <label class="form-check-label" for="genderMale">
                                男
                            </label>
                        </div>
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" <?php if ($row["gender"] == "female") echo "checked" ?>>
                            <label class="form-check-label" for="genderFemale">
                                女
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>

                    <th>手機</th>
                    <td colspan=3><input type="text" class="form-control" value="<?= $row["phone"] ?>" name="phone"></td>
                </tr>
                <tr>
                    <th>信箱</th>
                    <td colspan=3><input type="text" class="form-control" value="<?= $row["email"] ?>" name="email"></td>
                </tr>
                <tr>
                    <th>專長</th>
                    <td colspan=3><input type="text" class="form-control" value="<?= $row["expertise"] ?>" name="expertise"></td>
                </tr>
                <tr>
                    <th>介紹</th>
                    <td colspan=3> <textarea class="form-control" rows="4" cols="50" name="introduce"><?= $row["introduce"] ?></textarea></td>
                </tr>

            </table>
            <div class="py-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-info" type="submit">儲存</button>
                    <a href="teacher-Ming.php?id=<?= $row["id"] ?>" class="btn btn-info">取消</a>
                </div>
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">刪除</a>
            </div>

    </div>
    </form>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script>

        const photoFile=document.querySelector("#file");
        const image=document.querySelector("#editImage");
        
        photoFile.addEventListener("change",function(){
            let file = event.target.files[0];
            let reader = new FileReader();
            // console.log("A");
            if(file==null){

                image.src="images/teachers/<?= $row["photo"] ?>";   
            }else{
                reader.onload = function(event) {
                
                    image.src = event.target.result;
                
            };

            reader.readAsDataURL(file);
            }

        });

    </script>
</body>

</html>