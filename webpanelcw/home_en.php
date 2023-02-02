<!DOCTYPE html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('config/yoyi_db.php');
session_start();
// error_reporting(0);
if (!isset($_SESSION['admin_login'])) {
    echo "<script>alert('Please Login')</script>";
    echo "<meta http-equiv='refresh' content='0;url=index'>";
}

if (isset($_POST['save_content'])) {
    $intro = $_POST['intro'];
    $topic = $_POST['topic'];
    $content1 = $_POST['content1'];
    $content2 = $_POST['content2'];
    $content3 = $_POST['content3'];
    $content4 = $_POST['content4'];
    $img_cover = $_FILES['img_cover'];

    // $link = $_POST['link'];
    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_intro/" . $fileNew1;


    if (in_array($fileActExt1, $allow)) {
        if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
            if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                $update_home = $conn->prepare("UPDATE intro_content_en SET intro = :intro, topic = :topic, content1 = :content1, content2 = :content2 ,content3 = :content3, content4 = :content4 ,img_cover = :img_cover");
                $update_home->bindParam(":intro", $intro);
                $update_home->bindParam(":topic", $topic);
                $update_home->bindParam(":content1", $content1);
                $update_home->bindParam(":content2", $content2);
                $update_home->bindParam(":content3", $content3);
                $update_home->bindParam(":content4", $content4);
                $update_home->bindParam(":img_cover", $fileNew1);
                $update_home->execute();

                if ($update_home) {
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
                    echo "<meta http-equiv='refresh' content='1.5;url=home_en'>";
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
                    echo "<meta http-equiv='refresh' content='1.5;url=home_en'>";
                }
            }
        }
    } else {
        $update_home = $conn->prepare("UPDATE intro_content_en SET intro = :intro, topic = :topic, content1 = :content1, content2 = :content2 ,content3 = :content3, content4 = :content4");
        $update_home->bindParam(":intro", $intro);
        $update_home->bindParam(":topic", $topic);
        $update_home->bindParam(":content1", $content1);
        $update_home->bindParam(":content2", $content2);
        $update_home->bindParam(":content3", $content3);
        $update_home->bindParam(":content4", $content4);
        $update_home->execute();

        if ($update_home) {
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
            echo "<meta http-equiv='refresh' content='1.5;url=home_en'>";
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
            echo "<meta http-equiv='refresh' content='1.5;url=home_en'>";
        }
    }
}


//query content_home
$content_home = $conn->prepare("SELECT * FROM intro_content_en");
$content_home->execute();
$row_content_home = $content_home->fetch(PDO::FETCH_ASSOC);
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yo Yi Foods Co., Ltd.</title>

    <link rel="stylesheet" href="assets/css/main/app.css?v<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon"> -->
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
                <h3>หน้าแรก</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">เนื้อหาหน้าเเรก</h4>
                        <div class="btn-lang">
                            <a href="home" style="background-color: #522206; color: #FFFFFF;" class="btn">TH</a>
                        </div>


                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <textarea name="intro"><?php echo $row_content_home['intro'] ?></textarea>
                            <br><textarea name="topic"><?php echo $row_content_home['topic'] ?></textarea>
                            <br><textarea name="content1"><?php echo $row_content_home['content1'] ?></textarea>
                            <br><textarea name="content2"><?php echo $row_content_home['content2'] ?></textarea>
                            <br><textarea name="content3"><?php echo $row_content_home['content3'] ?></textarea>
                            <br><textarea name="content4"><?php echo $row_content_home['content4'] ?></textarea>

                            <div class="col-md-12">
                            <br><h6>Image</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" name="img_cover" id="imgInput" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <div id="gallery d-flex justify-content-center align-item-center">
                                            <img width="60%" id="previewImg" src="uploads/upload_intro/<?php echo $row_content_home['img_cover'] ?>">
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