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

if (isset($_POST['addslide'])) {
    $img = $_FILES['img'];
    $status = "on";

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_slide/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath1)) {
                $insert_slide = $conn->prepare("INSERT INTO logo(image,status) VALUES(:image,:status)");
                $insert_slide->bindParam(":image", $fileNew1);
                $insert_slide->bindParam(":status", $status);
                $insert_slide->execute();

                if ($insert_slide) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'เพิ่มภาพสำเร็จ',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=logo'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=logo'>";
                }
            }
        }
    }
}


//del
if (isset($_POST['delete_slide'])) {
    $slide_id = $_POST['delete_slide'];

    $del_slide = $conn->prepare("DELETE FROM logo WHERE id = :id");
    $del_slide->bindParam(":id", $slide_id);
    $del_slide->execute();

    if ($del_slide) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ลบข้อมูลสำเร็จ',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=logo'>";
    } else {
        echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
        echo "<meta http-equiv='refresh' content='1.5;url=logo'>";
    }
}


//change status
if (isset($_POST['change-status'])) {
    $check = $_POST['check'];
    $slide_id = $_POST['slide_id'];
    // echo "<script>alert('dddddd $check')</script>";
    $stmt = $conn->prepare("UPDATE logo SET status = :status WHERE id =  :id");
    $stmt->bindParam(":status", $check);
    $stmt->bindParam(":id", $slide_id);
    $stmt->execute();

    if ($stmt) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'เปลี่ยนสถานะเสร็จสิ้น',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=logo'>";
    } else {
        echo "<script>alert('Something Went Wrong!!!')</script>";
        echo "<meta http-equiv='refresh' content='1.5;url=logo'>";
    }
}

//query slide
$slide = $conn->prepare("SELECT * FROM logo");
$slide->execute();
$row_slide = $slide->fetchAll();
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
                        <h4 class="card-title">จัดการร้านอาหารและบริการ</h4>
                        <div class="btn-lang">
                            <!-- <a href="home" style="background-color: #DB4834; color: #FFFFFF;" class="btn">EN</a> -->
                        </div>


                    </div>
                    <div class="card-body">

                        <div class="mt-2" style="display: flex; justify-content: flex-end;">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addslide" style="background-color: #524340; color: #FFFFFF; margin-right: 5px;">เพิ่มภาพ</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr align="center">

                                        <th scope="col" width="33%">ภาพ</th>
                                        <th scope="col" width="33%">สถานะ</th>
                                        <th scope="col" width="33%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    foreach ($row_slide as $row_slide) { ?>
                                        <tr>
                                            <td><img width="80%" src="uploads/upload_slide/<?php echo $row_slide['image'] ?>" alt=""></td>
                                            <td>
                                                <a type="input" class="btn" <?php if ($row_slide['status'] == "on") {
                                                                                echo " style='background-color: #06c258;color: #FFF;'";
                                                                            } else {
                                                                                echo " style='background-color: #DB4834;color: #FFF;'";
                                                                            } ?> data-bs-toggle="modal" href="#status<?php echo $row_slide['id'] ?>" id="setting"><i class="bi bi-gear"></i></a>
                                            </td>
                                            <td>
                                                <form method="post">
                                                    <a type="input" class="btn" data-bs-toggle="modal" href="#editslide<?php echo $row_slide['id'] ?>" style="background-color:#ffc107; color: #FFFFFF;"><i class="bi bi-pencil-square"></i></a>
                                                    <button class="btn" onclick="return confirm('ต้องการลบกิจกรรมนี้ใช่หรือไม่?');" name="delete_slide" value="<?php echo $row_slide['id'] ?>" style="background-color:#DB4834; color: #FFFFFF;"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modal Status -->
                                        <div class="modal fade" id="status<?php echo $row_slide['id'] ?>" data-bs-backdrop="static" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">จัดการสถานะการมองเห็น</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-check form-switch">
                                                            <form method="post">
                                                                <div class="switch-box">
                                                                    <span>OFF</span>
                                                                    <input type="hidden" name="slide_id" value="<?php echo $row_slide['id']; ?>">
                                                                    <input class="form-check-input" id="switch-check" name="check" type="checkbox" <?php if ($row_slide['status'] == "on") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } else {
                                                                                                                                                        echo "";
                                                                                                                                                    } ?>>
                                                                    <span>ON</span>
                                                                </div>
                                                                <div class="box-btn">
                                                                    <button name="change-status" class="btn" style="background-color: #DB4834; color: #FFFFFF;" type="submit">บันทึก</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Edit slide -->
                                        <div class="modal fade" id="editslide<?php echo $row_slide["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                            แก้ไขภาพ
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-md-12 mt-2">
                                                                    <input type="file" name="img" id="imgInput1" class="form-control">
                                                                    <div id="gallery d-flex justify-content-center align-item-center">
                                                                        <img width="100%" id="previewImg1" src="uploads/upload_slide/<?php echo $row_slide['image'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3">
                                                                <button class="btn" name="addslide" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php  }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Add slide -->
                <div class="modal fade" id="addslide" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                    เพิ่มภาพ
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <input type="file" name="img" id="imgInput" class="form-control">
                                            <div id="gallery d-flex justify-content-center align-item-center">
                                                <img width="100%" id="previewImg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn" name="addslide" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

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