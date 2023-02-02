<!DOCTYPE html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('config/yoyi_db.php');
session_start();
//error_reporting(0);
if (!isset($_SESSION['admin_login'])) {
    echo "<script>alert('Please Login')</script>";
    echo "<meta http-equiv='refresh' content='0;url=index'>";
}

if (isset($_POST['save_content'])) {
    $content = $_POST['content'];
    $img = $_FILES['img'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_about/" . $fileNew1;


    if (in_array($fileActExt1, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath1)) {
                $update_about = $conn->prepare("UPDATE about_en SET content = :content, img = :img");
                $update_about->bindParam(":content", $content);
                $update_about->bindParam(":img", $fileNew1);
                $update_about->execute();
                if ($update_about) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'แก้ไขข้อมูลสำเร็จ',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=about_en'>";
                } else {
                    echo "<script>
                        $(document).ready(function() {
                            Swal.fire({
                                text: 'มีบางอย่างผิดพลาด',
                                icon: 'error',
                                timer: 10000,
                                showConfirmButton: false
                            });
                        })
                        </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=about_en'>";
                }
            }
        }
    } else {
        $update_about = $conn->prepare("UPDATE about_en SET content = :content");
        $update_about->bindParam(":content", $content);
        $update_about->execute();

        if ($update_about) {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    text: 'แก้ไขข้อมูลสำเร็จ',
                    icon: 'success',
                    timer: 10000,
                    showConfirmButton: false
                });
            })
            </script>";
            echo "<meta http-equiv='refresh' content='1.5;url=about_en'>";
        } else {
            echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'มีบางอย่างผิดพลาด',
                icon: 'error',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
            echo "<meta http-equiv='refresh' content='1.5;url=about_en'>";
        }
    }
}


//query content_about
$content_about = $conn->prepare("SELECT * FROM about_en");
$content_about->execute();
$row_about = $content_about->fetch(PDO::FETCH_ASSOC);
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yo Yi Foods Co., Ltd.</title>

    <link rel="stylesheet" href="assets/css/main/app.css?v<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../images/logo.svg" type="image/png">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time();  ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>

</head>

<body style="font-family: 'Kanit', sans-serif;">
    <div id="app">
        <?php include('sidebar.php'); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>เกี่ยวกับเรา</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">เนื้อหาเกี่ยวกับเรา</h4>
                        <div class="btn-lang">
                            <a href="about" style="background-color: #522206; color: #FFFFFF;" class="btn">TH</a>
                        </div>


                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <textarea name="content"><?php echo $row_about['content'] ?></textarea>
                            <div class="col-md-12">
                            <br><h6>Image</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" name="img" id="imgInput" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <div id="gallery d-flex justify-content-center align-item-center">
                                            <img width="100%" id="previewImg" src="uploads/upload_about/<?php echo $row_about['img'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button class="btn" name="save_content" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    tinymce.init({
                        selector: 'textarea',
                        plugins: 'autolink  code  image  lists table   wordcount',
                        toolbar: ' blocks fontfamily fontsize code | bold italic underline strikethrough |  image table  mergetags | addcomment showcomments  | align lineheight | checklist numlist bullist indent outdent | removeformat',
                        images_upload_url: 'upload.php',
                        branding: false,
                        promotion: false,
                        height: 300
                    });
                </script>
            </section>
            <?php include('footer.php'); ?>
        </div>
    </div>
    <script>
        let imgInput1 = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');
        let imgInput_edit = document.getElementById('imgInput1');
        let previewImg_edit = document.getElementById('previewImg1');

        imgInput1.onchange = evt => {
            const [file] = imgInput1.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
        imgInput_edit.onchange = evt => {
            const [file] = imgInput_edit.files;
            if (file) {
                previewImg_edit.src = URL.createObjectURL(file);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#reset').click(function() {
                $('#imgInput').val(null);
                $('#previewImg').attr("src", "");

            });


        });
    </script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>



</body>

</html>