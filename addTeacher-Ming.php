<!doctype html>
<html lang="en">

<head>
    <title>addTeacher</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        #introduce {
            resize: none;
        }
    </style>
</head>

<body>
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="">訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-danger" id="modalError"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>



    <div class="container d-flex justify-content-center align-items-center">
        <div>
            <h1 class="text-center">新增講師</h1>
            <form action="doAddTeacher-Ming.php" method="post" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="name">姓名</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="">性別</label>
                    <div class="d-flex">
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" checked>
                            <label class="form-check-label" for="genderMale">
                                男
                            </label>
                        </div>
                        <div class="form-check mx-2">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                            <label class="form-check-label" for="genderFemale">
                                女
                            </label>
                        </div>
                    </div>

                </div>
                <div class="mb-2">
                    <label for="phone">電話</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="email">信箱</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="expertise">專長</label>
                    <input type="text" name="expertise" id="expertise" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="introduce">介紹</label>
                    <textarea class="form-control" rows="4" cols="50" name="introduce" id="introduce"></textarea>

                </div>
                <div class="mb-2">
                    <label for="photo">頭像</label>
                    <!-- <input type="file" name="file" class="form-control" id="photo" required> -->
                    <input type="file" id="photo" name="file" accept="image/*" class="form-control">
                    <div class="my-2">
                        <img id="previewImage" src="" class="d-none" alt="Preview Image">
                    </div>


                </div>

                <div class="my-2">
                    <div class="text-danger" id="error"></div>
                </div>
                <div class="d-flex justify-content-around">
                    <button  id="send" class="btn btn-info mx-2">送出</button>
                    <a class="btn btn-info mx-2" id="" href="teachers-list-Ming.php">取消</a>
                </div>

            </form>

        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script>
        const photoFile = document.querySelector("#photo");
        const image = document.getElementById("previewImage");
        const send = document.querySelector("#send");


        // 上傳圖預覽
        photoFile.addEventListener("change", function() {
            let file = event.target.files[0];
            let reader = new FileReader();

            if (file == null) {
                image.classList.add("d-none");
            } else {
                reader.onload = function(event) {

                    image.src = event.target.result;
                    image.classList.remove("d-none");
                };

                reader.readAsDataURL(file);
            }

        });

       
       
    </script>


</body>

</html>