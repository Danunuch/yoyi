<!DOCTYPE html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('config/tonsak_db.php');
session_start();
error_reporting(0);
if (!isset($_SESSION['admin_login'])) {
    echo "<script>alert('Please Login')</script>";
    echo "<meta http-equiv='refresh' content='0;url=index'>";
}

if (isset($_POST['save_content'])) {
    $content = $_POST['content'];
    $link = $_POST['link'];

    $update_content = $conn->prepare("UPDATE content_1_home_en SET content = :content, link = :link");
    $update_content->bindParam(":content", $content);
    $update_content->bindParam(":link", $link);
    $update_content->execute();

    if ($update_content) {
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
        echo "<meta http-equiv='refresh' content='1.5;url=home_content_en'>";
    } else {
        echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
        echo "<meta http-equiv='refresh' content='1.5;url=home_content_en'>";
    }
}



//query content_home
$content_home = $conn->prepare("SELECT * FROM content_1_home");
$content_home->execute();
$row_content_home = $content_home->fetch(PDO::FETCH_ASSOC);
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TONSAKCORNER</title>

    <link rel="stylesheet" href="assets/css/main/app.css?v<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon"> -->
    <link rel="shortcut icon" href="../images/icon-logo.png" type="image/png">
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
                        <h4 class="card-title">เนื้อหาหน้าเเรกภาษาอังกฤษ</h4>
                        <div class="btn-lang">
                            <a href="home_content" style="background-color: #DB4834; color: #FFFFFF;" class="btn">TH</a>
                        </div>


                    </div>
                    <div class="card-body">
                        <form method="post">
                            <textarea name="content"><?php echo $row_content_home['content'] ?></textarea>

                            <div class="mt-2">
                                <span>ลิงค์ Youtube</span>
                                <input type="text" name="link" value="<?php echo $row_content_home['link'] ?>" class="form-control">
                            </div>
                            <div class="mt-3">
                                <button class="btn" name="save_content" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
                        const xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', 'upload.php');

                        xhr.upload.onprogress = (e) => {
                            progress(e.loaded / e.total * 100);
                        };

                        xhr.onload = () => {
                            if (xhr.status === 403) {
                                reject({
                                    message: 'HTTP Error: ' + xhr.status,
                                    remove: true
                                });
                                return;
                            }

                            if (xhr.status < 200 || xhr.status >= 300) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }

                            const json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location != 'string') {
                                reject('Invalid JSON: ' + xhr.responseText);
                                return;
                            }

                            resolve(json.location);
                        };

                        xhr.onerror = () => {
                            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                        };

                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());

                        xhr.send(formData);
                    });
                    tinymce.init({
                        selector: 'textarea',
                        plugins: 'autolink  code  image  lists table   wordcount',
                        toolbar: ' blocks fontfamily fontsize code | bold italic underline strikethrough |  image table  mergetags | addcomment showcomments  | align lineheight | checklist numlist bullist indent outdent | removeformat',
                        images_upload_url: 'upload.php',
                        branding: false,
                        promotion: false,
                        height: 400
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