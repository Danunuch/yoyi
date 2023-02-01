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

if (isset($_POST['save_attention'])) {
    $name1 = $_POST['name1'];
    $name2 = $_POST['name2'];
    $name3 = $_POST['name3'];
    $img1 = $_FILES['img1'];
    $img2 = $_FILES['img2'];
    $img3 = $_FILES['img3'];


    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention2 = explode(".", $img2['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention3 = explode(".", $img3['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt2 = strtolower(end($extention2)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt3 = strtolower(end($extention3)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $fileNew2 = rand() . "." . "webp";
    $fileNew3 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_attention/" . $fileNew1;
    $filePath2 = "uploads/upload_attention/" . $fileNew2;
    $filePath3 = "uploads/upload_attention/" . $fileNew3;


    if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3)) {
                $update_attention = $conn->prepare("UPDATE attention SET name1 = :name1, img1 = :img1,name2 = :name2, img2 = :img2,name3 = :name3, img3 = :img3");
                $update_attention->bindParam(":name1", $name1);
                $update_attention->bindParam(":img1", $fileNew1);
                $update_attention->bindParam(":name2", $name2);
                $update_attention->bindParam(":img2", $fileNew2);
                $update_attention->bindParam(":name3", $name3);
                $update_attention->bindParam(":img3", $fileNew3);
                $update_attention->execute();

                if ($update_attention) {
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
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                }
            }
        }
    } else if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2)) {
                $update_attention = $conn->prepare("UPDATE attention SET name1 = :name1, img1 = :img1,name2 = :name2, img2 = :img2,name3 = :name3");
                $update_attention->bindParam(":name1", $name1);
                $update_attention->bindParam(":img1", $fileNew1);
                $update_attention->bindParam(":name2", $name2);
                $update_attention->bindParam(":img2", $fileNew2);
                $update_attention->bindParam(":name3", $name3);
                // $update_attention->bindParam(":img3", $fileNew3);
                $update_attention->execute();

                if ($update_attention) {
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
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                }
            }
        }
    } else   if (in_array($fileActExt1, $allow) && in_array($fileActExt3, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img3['tmp_name'], $filePath3)) {
                $update_attention = $conn->prepare("UPDATE attention SET name1 = :name1, img1 = :img1,name2 = :name2,name3 = :name3, img3 = :img3");
                $update_attention->bindParam(":name1", $name1);
                $update_attention->bindParam(":img1", $fileNew1);
                $update_attention->bindParam(":name2", $name2);
                // $update_attention->bindParam(":img2", $fileNew2);
                $update_attention->bindParam(":name3", $name3);
                $update_attention->bindParam(":img3", $fileNew3);
                $update_attention->execute();

                if ($update_attention) {
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
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                }
            }
        }
    } else if (in_array($fileActExt1, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                $update_attention = $conn->prepare("UPDATE attention SET name1 = :name1, img1 = :img1,name2 = :name2,name3 = :name3");
                $update_attention->bindParam(":name1", $name1);
                $update_attention->bindParam(":img1", $fileNew1);
                $update_attention->bindParam(":name2", $name2);
                // $update_attention->bindParam(":img2", $fileNew2);
                $update_attention->bindParam(":name3", $name3);
                // $update_attention->bindParam(":img3", $fileNew3);
                $update_attention->execute();

                if ($update_attention) {
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
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                }
            }
        }
    } else if (in_array($fileActExt2, $allow)) {
        if ($img2['size'] > 0 && $img2['error'] == 0) {
            if (move_uploaded_file($img2['tmp_name'], $filePath2)) {
                $update_attention = $conn->prepare("UPDATE attention SET name1 = :name1,name2 = :name2, img2 = :img2,name3 = :name3");
                $update_attention->bindParam(":name1", $name1);

                $update_attention->bindParam(":name2", $name2);
                $update_attention->bindParam(":img2", $fileNew2);
                $update_attention->bindParam(":name3", $name3);

                $update_attention->execute();

                if ($update_attention) {
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
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                }
            }
        }
    } else  if (in_array($fileActExt3, $allow)) {
        if ($img3['size'] > 0 && $img3['error'] == 0) {
            if (move_uploaded_file($img3['tmp_name'], $filePath3)) {
                $update_attention = $conn->prepare("UPDATE attention SET name1 = :name1,name2 = :name2,name3 = :name3, img3 = :img3");
                $update_attention->bindParam(":name1", $name1);

                $update_attention->bindParam(":name2", $name2);

                $update_attention->bindParam(":name3", $name3);
                $update_attention->bindParam(":img3", $fileNew3);
                $update_attention->execute();

                if ($update_attention) {
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
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
                }
            }
        }
    } else {
        $update_attention = $conn->prepare("UPDATE attention SET name1 = :name1,name2 = :name2,name3 = :name3");
        $update_attention->bindParam(":name1", $name1);
        $update_attention->bindParam(":name2", $name2);
        $update_attention->bindParam(":name3", $name3);
        $update_attention->execute();

        if ($update_attention) {
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
            echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
        } else {
            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
            echo "<meta http-equiv='refresh' content='1.5;url=attention'>";
        }
    }
}



//query attention
$attention = $conn->prepare("SELECT * FROM attention");
$attention->execute();
$row_attention = $attention->fetch(PDO::FETCH_ASSOC);
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
                        <h4 class="card-title">ความสนใจ</h4>
                        <div class="btn-lang">
                            <a href="attention_en" style="background-color: #DB4834; color: #FFFFFF;" class="btn">EN</a>
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
                            height: 200
                        });
                    </script>

                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">


                            <div class="mt-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <span>ชื่อ</span>
                                        <textarea name="name1"><?php echo $row_attention['name1'] ?></textarea>
                                        <!-- <input type="text" name="name1" value="<?php echo $row_attention['name1'] ?>" class="form-control"> -->

                                        <div class="mt-2">
                                            <span style="color: #DB4834;">ขนาดภาพที่แนะนำ 800 x 1000</span>
                                            <input type="file" name="img1" id="img1" class="form-control">
                                        </div>
                                        <img width="50%" id="previewImg1" src="uploads/upload_attention/<?php echo $row_attention['img1'] ?>" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <span>ชื่อ</span>
                                        <textarea name="name2"><?php echo $row_attention['name2'] ?></textarea>
                                        <!-- <input type="text" name="name2" value="<?php echo $row_attention['name2'] ?>" class="form-control"> -->
                                        <div class="mt-2">
                                            <span style="color: #DB4834;">ขนาดภาพที่แนะนำ 800 x 1000</span>
                                            <input type="file" name="img2" id="img2" class="form-control">
                                        </div>
                                        <img width="50%" id="previewImg2" src="uploads/upload_attention/<?php echo $row_attention['img2'] ?>" alt="">

                                    </div>
                                    <div class="col-md-4">
                                        <span>ชื่อ</span>
                                        <textarea name="name3"><?php echo $row_attention['name3'] ?></textarea>
                                        <!-- <input type="text" name="name3" value="<?php echo $row_attention['name3'] ?>" class="form-control"> -->
                                        <div class="mt-2">
                                            <span style="color: #DB4834;">ขนาดภาพที่แนะนำ 800 x 1000</span>
                                            <input type="file" name="img3" id="img3" class="form-control">
                                        </div>
                                        <img width="50%" id="previewImg3" src="uploads/upload_attention/<?php echo $row_attention['img3'] ?>" alt="">

                                    </div>
                                </div>

                            </div>
                            <div class="mt-3">
                                <button class="btn" name="save_attention" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <?php include('footer.php'); ?>
        </div>
    </div>
    <script>
        let imgInput1 = document.getElementById('img1');
        let previewImg1 = document.getElementById('previewImg1');
        let imgInput2 = document.getElementById('img2');
        let previewImg2 = document.getElementById('previewImg2');
        let imgInput3 = document.getElementById('img3');
        let previewImg3 = document.getElementById('previewImg3');

        imgInput1.onchange = evt => {
            const [file] = imgInput1.files;
            if (file) {
                previewImg1.src = URL.createObjectURL(file);
            }
        }
        imgInput2.onchange = evt => {
            const [file] = imgInput2.files;
            if (file) {
                previewImg2.src = URL.createObjectURL(file);
            }
        }
        imgInput3.onchange = evt => {
            const [file] = imgInput3.files;
            if (file) {
                previewImg3.src = URL.createObjectURL(file);
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