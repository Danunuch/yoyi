<!DOCTYPE html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('config/yoyi_db.php');
session_start();
error_reporting(0);
if (!isset($_SESSION['admin_login'])) {
    echo "<script>alert('Please Login')</script>";
    echo "<meta http-equiv='refresh' content='0;url=index'>";
}

//add news
if (isset($_POST['add_news'])) {
    $img_cover = $_FILES['img_cover'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = "on";

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_news/" . $fileNew1;

    try {
        if (in_array($fileActExt1, $allow)) {
            if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
                if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                    $add_news = $conn->prepare("INSERT INTO news(img_cover, title, content, status) VALUES(:img_cover, :title,  :content, :status)");
                    $add_news->bindParam(":img_cover", $fileNew1);
                    $add_news->bindParam(":title", $title);
                    $add_news->bindParam(":content", $content);
                    $add_news->bindParam(":status", $status);
                    $add_news->execute();

                    $id_news = $conn->lastInsertId();
                }
            }
        }

        foreach ($_FILES['img']['tmp_name'] as $key => $value) {
            $file_names = $_FILES['img']['name'];

            $extension = strtolower(pathinfo($file_names[$key], PATHINFO_EXTENSION));
            $supported = array('jpg', 'jpeg', 'png', 'webp', 'mp4');
            if (in_array($extension, $supported)) {
                $new_name = rand() . '.' . "webp";
                if (move_uploaded_file($_FILES['img']['tmp_name'][$key], "uploads/upload_news/" . $new_name)) {
                    $sql = "INSERT INTO news_img (img, id_news) VALUES(:img, :id_news)";
                    $upload_img = $conn->prepare($sql);
                    $params = array(
                        'img' => $new_name,
                        'id_news' => $id_news
                    );
                    $upload_img->execute($params);
                }
            } else {
                echo "<script>alert('ไม่รองรับนามสกุลไฟล์นี้')</script>";
            }
        }
        if ($add_news) {
            echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    text: 'เพิ่มข่าวสารสำเร็จ',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                });
                            })
                            </script>";
            echo "<meta http-equiv='refresh' content='1.5;url=news'>";
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
            echo "<meta http-equiv='refresh' content='1.5;url=news'>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//edit news
if (isset($_GET['news_id'])) {
    $id_news = $_GET['news_id'];

    $stmt = $conn->prepare("SELECT * FROM news WHERE id_news = :id_news");
    $stmt->bindParam(":id_news", $news_id);
    $stmt->execute();
    $row_news = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['del-img'])) {
    $img_id = $_POST['del-img'];

    $delete_img = $conn->prepare("DELETE FROM news_img WHERE id = :id");
    $delete_img->bindParam(":id", $img_id);
    $delete_img->execute();

    if ($delete_img) {
        echo "<meta http-equiv='refresh' content='0;url=news?news_id=$id_news'>";
    }
}


if (isset($_POST['edit_news'])) {
    $news_id = $_POST['news_id'];
    $img_cover = $_FILES['img_cover'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_news/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
            if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                $edit_news = $conn->prepare("UPDATE news SET img_cover = :img_cover, title = :title, content = :content WHERE id_news = :id");
                $edit_news->bindParam(":img_cover", $fileNew1);
                $edit_news->bindParam(":title", $title);
                $edit_news->bindParam(":content", $content);
                $edit_news->bindParam(":id", $news_id);
                $edit_news->execute();

                if ($edit_news) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'แก้ไขข้อมูลข่าวสารสำเร็จ',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=news'>";
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
                    echo "<meta http-equiv='refresh' content='1.5;url=news'>";
                }
            }
        }
    } else {
        $edit_news = $conn->prepare("UPDATE news SET content = :content, title = :title WHERE id_news = :id");
        $edit_news->bindParam(":title", $title);
        $edit_news->bindParam(":content", $content);
        $edit_news->bindParam(":id", $news_id);
        $edit_news->execute();
    }
    foreach ($_FILES['img']['tmp_name'] as $key => $value) {
        $file_names = $_FILES['img']['name'];

        $extension = strtolower(pathinfo($file_names[$key], PATHINFO_EXTENSION));
        $supported = array('jpg', 'jpeg', 'png', 'webp', 'mp4');
        if (in_array($extension, $supported)) {
            $new_name = rand() . '.' . "webp";
            if (move_uploaded_file($_FILES['img']['tmp_name'][$key], "uploads/upload_news/" . $new_name)) {
                $sql = "INSERT INTO news_img (img, id_news) VALUES(:img, :id_news)";
                $upload_img = $conn->prepare($sql);
                $params = array(
                    'img' => $new_name,
                    'id_news' => $news_id
                );
                $upload_img->execute($params);
            }
        }
    }
    if ($edit_news) {
        echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    text: 'แก้ไขข้อมูลข่าวสารสำเร็จ',
                    icon: 'success',
                    timer: 10000,
                    showConfirmButton: false
                });
            })
            </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=news'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=news'>";
    }
}


//change status
if (isset($_POST['change-status'])) {
    $check = $_POST['check'];
    $news_id = $_POST['news_id'];

    $stmt = $conn->prepare("UPDATE news SET status = :status WHERE id_news =  :id_news");
    $stmt->bindParam(":status", $check);
    $stmt->bindParam(":id_news", $news_id);
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
        echo "<meta http-equiv='refresh' content='1.5;url=news'>";
    } else {
        echo "<script>alert('Something Went Wrong!!!')</script>";
        echo "<meta http-equiv='refresh' content='1.5;url=news'>";
    }
}


//delete news all
if (isset($_POST['delete_all'])) {
    if (count((array)$_POST['ids']) > 0) {
        $all = implode(",", $_POST['ids']);

        $del_news = $conn->prepare("DELETE FROM news WHERE id_news in ($all)");
        $del_news->execute();

        if ($del_news) {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    text: 'ลบข่าวสารสำเร็จ',
                    icon: 'success',
                    timer: 10000,
                    showConfirmButton: false
                });
            })
            </script>";
            echo "<meta http-equiv='refresh' content='1.6;url=news'>";
        } else {
            echo "<script>alert('Something Went Wrong!!!')</script>";
            echo "<meta http-equiv='refresh' content='1.5;url=news'>";
        }
    } else {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'กรุณาคลิกเลือกข่าวสารก่อนทำการลบ',
                icon: 'warning',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.6;url=news'>";
    }
}



$page = $_GET['page'];
$news_count = $conn->prepare("SELECT * FROM news");
$news_count->execute();
$count_news = $news_count->fetchAll();

$rows = 10;
if ($page == "") {
    $page = 1;
}

$total_data = count($count_news);
$total_page = ceil($total_data / $rows);
$start = ($page - 1) * $rows;

$news = $conn->prepare("SELECT * FROM news LIMIT $start,10");
$news->execute();
$row_news = $news->fetchAll();
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
                <h3>ข่าวสาร</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">ข่าวสาร</h4>
                        <div class="btn-lang">
                            <a href="news_en" style="background-color: #522206; color: #FFFFFF;" class="btn">EN</a>
                        </div>
                        <script>
                            tinymce.init({
                                selector: 'textarea',
                                plugins: 'autolink  code  image  lists table   wordcount',
                                toolbar: ' blocks fontfamily fontsize code | bold italic underline strikethrough |  image table  mergetags | addcomment showcomments  | align lineheight | checklist numlist bullist indent outdent | removeformat',
                                images_upload_url: 'upload.php',
                                branding: false,
                                promotion: false,
                                height: 250
                            });
                        </script>

                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mt-4">
                                <div class="mt-2" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addnews" style="background-color: #522206; color: #FFFFFF; margin-right: 5px;">เพิ่มข่าวสาร</button>
                                    <button type="submit" class="btn" onclick="return confirm('ต้องการลบกิจกรรมทั้งหมดใช่หรือไม่?');" name="delete_all" style="background-color: #dd250c; color: #FFFFFF;">ลบทั้งหมด</button>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr align="center">
                                                <th scope="col"><input type="checkbox" class="form-check-input checkbox-select" id="select_all"></th>
                                                <th scope="col">ภาพหน้าปก</th>
                                                <th scope="col">เนื้อหา</th>
                                                <th scope="col">สถานะ</th>
                                                <th scope="col">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (array_reverse($row_news) as $row_news) { ?>
                                                <tr align="center">
                                                    <td> <input type="checkbox" class="form-check-input checkbox checkbox-select" name="ids[]" value=<?php echo $row_news['id_news'] ?>></td>
                                                    <td width="20%"> <img width="60%" src="uploads/upload_news/<?php echo $row_news['img_cover']; ?>" alt=""></td>
                                                    <td align="left" width="50%"><?php echo $row_news['title']; ?><?php echo $row_news['content']; ?></td>
                                                    <td> <a type="input" class="btn" <?php if ($row_news['status'] == "on") {
                                                                                            echo " style='background-color: #06c258; color: #FFF;'";
                                                                                        } else {
                                                                                            echo " style='background-color: #dd250c ;color: #FFF;'";
                                                                                        } ?> data-bs-toggle="modal" href="#status<?php echo $row_news['id_news'] ?>" id="setting"><i class="bi bi-gear"></i></a></td>
                                                    <td>
                                                        <a type="input" class="btn" data-bs-toggle="modal" href="#editnews<?php echo $row_news['id_news'] ?>" style="background-color:#ffc107; color: #FFFFFF;"><i class="bi bi-pencil-square"></i></a>
                                                        <button class="btn" onclick="return confirm('ต้องการลบกิจกรรมนี้ใช่หรือไม่?');" name="delete_all" style="background-color:#dd250c; color: #FFFFFF;"><i class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- Modal Status -->
                                                <div class="modal fade" id="status<?php echo $row_news['id_news'] ?>" data-bs-backdrop="static" aria-hidden="true">
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
                                                                            <input type="hidden" name="news_id" value="<?php echo $row_news['id_news']; ?>">
                                                                            <input class="form-check-input" id="switch-check" name="check" type="checkbox" <?php if ($row_news['status'] == "on") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } else {
                                                                                                                                                                echo "";
                                                                                                                                                            } ?>>
                                                                            <span>ON</span>
                                                                        </div>
                                                                        <div class="box-btn">
                                                                            <button name="change-status" class="btn" style="background-color: #ff962d; color: #522206;" type="submit">บันทึก</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Edit news  -->
                                                <div class="modal fade" id="editnews<?php echo $row_news['id_news'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขข่าวสาร (TH)</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" enctype="multipart/form-data">

                                                                    <h6 id="upload-img">ภาพหน้าปก</h6>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <input type="hidden" name="news_id" value="<?php echo $row_news['id_news']; ?>">
                                                                            <input type="file" name="img_cover" id="imgInput" class="form-control">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div id="gallery d-flex justify-content-center align-item-center">
                                                                                <img width="80%" id="previewImg" src="uploads/upload_news/<?php echo $row_news['img_cover'] ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-12 mt-2">
                                                                            <span>หัวข้อ </span>
                                                                            <textarea name="title"><?php echo $row_news['title'] ?></textarea>
                                                                            <span>เนื้อหา </span>
                                                                            <textarea name="content"><?php echo $row_news['content'] ?></textarea>
                                                                        </div>

                                                                        <div class="content">
                                                                            <div class="content-img">
                                                                                <span id="upload-img">Upload Image</span>
                                                                                <div class="group-pos">
                                                                                    <input type="file" name="img[]" id="imgInput4" onchange="preview_image_edit();" class="form-control" multiple>
                                                                                    <button type="button" class="btn reset" id="reset2">Reset</button>
                                                                                </div>
                                                                                <span class="file-support">Only file are support ('jpg', 'jpeg', 'png', 'webp').</span>
                                                                                <div id="gallery_edit">
                                                                                    <?php

                                                                                    $img = $conn->prepare("SELECT * FROM news_img WHERE id_news = :id_news");
                                                                                    $img->bindParam(":id_news", $row_news['id_news']);
                                                                                    $img->execute();
                                                                                    $row_img = $img->fetchAll();

                                                                                    for ($i = 0; $i < count($row_img); $i++) { ?>
                                                                                        <div class="box-edit-img">
                                                                                            <span class="del-edit-img"><button type="submit" onclick="return confirm('Do you want to delete this image?')" name="del-img" value="<?php echo $row_img[$i]['id'] ?>" class="btn-edit-del-img"><i class="bi bi-x-lg"></button></i></span>
                                                                                            <img class='previewImg' id='edit-img' src="uploads/upload_news/<?php echo $row_img[$i]['img'] ?>" alt="">
                                                                                        </div>
                                                                                    <?php  }
                                                                                    ?>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <button class="btn" name="edit_news" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
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



                                <ul class="pagination justify-content-center mt-5">
                                    <li <?php if ($page == 1) {
                                            echo "class='page-item disabled'";
                                        }  ?>>
                                        <a class="page-link" href="news?page=<?php echo $page - 1 ?>" tabindex="-1" aria-disabled="true"><span class="material-icons"></span>ก่อนหน้า</a>
                                    </li>

                                    <?php
                                    for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <li <?php if ($page == $i) {
                                                echo "class='page-item active'";
                                            } ?>><a class="page-link" href="news?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php   }
                                    ?>


                                    <li <?php if ($page == $total_page) {
                                            echo "class='page-item disabled'";
                                        } ?>>
                                        <a class="page-link" href="news?page=<?php echo $page + 1 ?>">ถัดไป <span class="material-icons"></span></a>
                                    </li>
                                </ul>
                            </div>

                        </form>


                    </div>

                    <!-- Modal Add news  -->
                    <div class="modal fade" id="addnews" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มข่าวสาร (TH)</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" enctype="multipart/form-data">

                                        <h6 id="upload-img">ภาพหน้าปก</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="file" name="img_cover" id="imgInput_add" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <div id="gallery d-flex justify-content-center align-item-center">
                                                    <img width="80%" id="previewImg_add">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <span>หัวข้อ</span>
                                                <textarea name="title"></textarea>
                                                <span>เนื้อหา</span>
                                                <textarea name="content"></textarea>
                                            </div>

                                            <div class="content">
                                                <div class="content-img">
                                                    <span id="upload-img">Content Image</span>
                                                    <div class="group-pos">
                                                        <input type="file" name="img[]" id="imgInput3" onchange="preview_image_add();" class="form-control" multiple>
                                                        <button type="button" class="btn reset" id="reset2">Reset</button>
                                                    </div>
                                                    <span class="file-support">Only file are support ('jpg', 'jpeg', 'png', 'webp').</span>
                                                    <div id="gallery_add"></div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="mt-3">
                                            <button class="btn" name="add_news" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



            </section>
            <?php include('footer.php'); ?>
        </div>
    </div>

    <script>
        function preview_image_add() {
            var total_file = document.getElementById("imgInput3").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#gallery_add').append("<div class='box-edit-img'>  <span class='del-edit-img'></span>  <img class='previewImg' id='edit-img' src='" + URL.createObjectURL(event.target.files[i]) + "'> </div>");
            }
        }
    </script>

    <script>
        function preview_image() {
            var total_file = document.getElementById("imgInput4").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#gallery').append("<div class='box-edit-img'>  <span class='del-edit-img'></span>  <img class='previewImg' id='edit-img' src='" + URL.createObjectURL(event.target.files[i]) + "'> </div>");
            }
        }
    </script>
    <script>
        let imgInput1 = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');
        let imgInput2 = document.getElementById('imgInput_add');
        let previewImg2 = document.getElementById('previewImg_add');

        imgInput1.onchange = evt => {
            const [file] = imgInput1.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
        imgInput2.onchange = evt => {
            const [file] = imgInput2.files;
            if (file) {
                previewImg2.src = URL.createObjectURL(file);
            }
        }
    </script>

    <script>
        //for checkbox
        $(document).ready(function() {
            $('#select_all').on('click', function() {
                if (this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    })
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    })
                }
            })
            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#select_all').prop('checked', true);
                } else {
                    $('#select_all').prop('checked', false);
                }
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#reset2').click(function() {
                $('#imgInput').val(null);
                $('.previewImg').attr("src", "");
                $('.previewImg').addClass('none');
                $('.box-edit-img').addClass('none');
            });
            $('#reset1').click(function() {
                $('#imgInput-cover').val(null);
                $('#previewImg-cover').attr("src", "");
                // $('.previewImg').addClass('none');
                // $('.box-edit-img').addClass('none');
            });
            $('#imgout').click(function() {
                $('#imgInput').val(null);
            });

        });
    </script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>



</body>

</html>