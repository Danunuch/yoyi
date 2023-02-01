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

//add event
if (isset($_POST['add_event'])) {
    $img_cover = $_FILES['img_cover'];
    $content = $_POST['content'];
    $link = $_POST['link'];
    $status = "on";

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_event/" . $fileNew1;

    if (empty($link)) {
        echo "<script>alert('กรุณากรอกลิงค์สำหรับไปที่โพสต์')</script>";
    } else {
        try {
            if (in_array($fileActExt1, $allow)) {
                if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
                    if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                        $add_news = $conn->prepare("INSERT INTO news(cover_img,content,link,status) VALUES(:cover_img, :content, :link, :status)");
                        $add_news->bindParam(":cover_img", $fileNew1);
                        $add_news->bindParam(":content", $content);
                        $add_news->bindParam(":link", $link);
                        $add_news->bindParam(":status", $status);
                        $add_news->execute();

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
                    }
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

//edit event
if (isset($_POST['edit_event'])) {
    $news_id = $_POST['event_id'];
    $img_cover = $_FILES['img_cover'];
    $content = $_POST['content'];
    $link = $_POST['link'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_event/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
            if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                $edit_news = $conn->prepare("UPDATE news SET cover_img = :cover_img, content = :content,link = :link WHERE id = :id");
                $edit_news->bindParam(":cover_img", $fileNew1);
                $edit_news->bindParam(":content", $content);
                $edit_news->bindParam(":link", $link);
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
        $edit_news = $conn->prepare("UPDATE news SET  content = :content,link = :link WHERE id = :id");
        $edit_news->bindParam(":content", $content);
        $edit_news->bindParam(":link", $link);
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

//change status

if (isset($_POST['change-status'])) {
    $check = $_POST['check'];
    $event_id = $_POST['event_id'];

    $stmt = $conn->prepare("UPDATE news SET status = :status WHERE id =  :id");
    $stmt->bindParam(":status", $check);
    $stmt->bindParam(":id", $event_id);
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


//delete event all
if (isset($_POST['delete_all'])) {
    if (count((array)$_POST['ids']) > 0) {
        $all = implode(",", $_POST['ids']);

        $del_event = $conn->prepare("DELETE FROM news WHERE id in ($all)");
        $del_event->execute();

        if ($del_event) {
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
            echo "<meta http-equiv='refresh' content='1.5;url=news'>";
        } else {
            echo "<script>alert('Something Went Wrong!!!')</script>";
            echo "<meta http-equiv='refresh' content='1.5;url=news'>";
        }
    } else {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ต้องคลิกเลือกข่าวสารก่อนทำการลบ',
                icon: 'warning',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=news'>";
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
                <h3>ข่าวสาร</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">ข่าวสาร</h4>
                        <div class="btn-lang">
                            <a href="news_en" style="background-color: #DB4834; color: #FFFFFF;" class="btn">EN</a>
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
                                height: 300
                            });
                        </script>

                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mt-4">
                                <div class="mt-2" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addevent" style="background-color: #524340; color: #FFFFFF; margin-right: 5px;">เพิ่มข่าวสาร</button>
                                    <button type="submit" class="btn" onclick="return confirm('ต้องการลบกิจกรรมทั้งหมดใช่หรือไม่?');" name="delete_all" style="background-color: #DB4834; color: #FFFFFF;">ลบทั้งหมด</button>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr align="center">
                                                <th scope="col"><input type="checkbox" class="form-check-input checkbox-select" id="select_all"></th>
                                                <th scope="col">ภาพหน้าปก</th>
                                                <th scope="col">สถานะ</th>
                                                <th scope="col">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (array_reverse($row_news) as $row_news) { ?>
                                                <tr align="center">
                                                    <td> <input type="checkbox" class="form-check-input checkbox checkbox-select" name="ids[]" value=<?php echo $row_news['id'] ?>></td>
                                                    <td width="20%"> <img width="80%" src="uploads/upload_event/<?php echo $row_news['cover_img']; ?>" alt=""></td>
                                                    <td> <a type="input" class="btn" <?php if ($row_news['status'] == "on") {
                                                                                            echo " style='background-color: #06c258; color: #FFF;'";
                                                                                        } else {
                                                                                            echo " style='background-color: #DB4834 ;color: #FFF;'";
                                                                                        } ?> data-bs-toggle="modal" href="#status<?php echo $row_news['id'] ?>" id="setting"><i class="bi bi-gear"></i></a></td>
                                                    <td>
                                                        <a type="input" class="btn" data-bs-toggle="modal" href="#editevent<?php echo $row_news['id'] ?>" style="background-color:#ffc107; color: #FFFFFF;"><i class="bi bi-pencil-square"></i></a>
                                                        <button class="btn" onclick="return confirm('ต้องการลบกิจกรรมนี้ใช่หรือไม่?');" name="delete_all" style="background-color:#DB4834; color: #FFFFFF;"><i class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- Modal Status -->
                                                <div class="modal fade" id="status<?php echo $row_news['id'] ?>" data-bs-backdrop="static" aria-hidden="true">
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
                                                                            <input type="hidden" name="event_id" value="<?php echo $row_news['id']; ?>">
                                                                            <input class="form-check-input" id="switch-check" name="check" type="checkbox" <?php if ($row_news['status'] == "on") {
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

                                                <!-- Modal Edit event  -->
                                                <div class="modal fade" id="editevent<?php echo $row_news['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขข่าวสารภาษาไทย</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" enctype="multipart/form-data">
                                                                    
                                                                        <h6 id="upload-img">ภาพหน้าปก</h6>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <input type="hidden" name="event_id" value="<?php echo $row_news['id']; ?>">
                                                                                <input type="file" name="img_cover" id="imgInput" class="form-control">
                                                                                <span style="color: #DB4834;">ขนาดภาพที่แนะนำ 800 x 600</span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div id="gallery d-flex justify-content-center align-item-center">
                                                                                    <img width="80%" id="previewImg" src="uploads/upload_event/<?php echo $row_news['cover_img'] ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                  
                                                                    <div class="row">
                                                                        <div class="col-md-12 mt-2">
                                                                            <span>เนื้อหาเกริ่น <span style="color: #DB4834;">(ไม่ควรยาวเกินไป)</span></span>
                                                                            <textarea name="content"><?php echo $row_news['content'] ?></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 mt-2">
                                                                            <span>ลิงค์ <span style="color: #DB4834;">(สำหรับไปที่โพสต์กิจกรรม)</span></span>
                                                                            <input type="text" name="link" value="<?php echo $row_news['link'] ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <button class="btn" name="edit_event" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
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
                                        <a class="page-link" href="event?page=<?php echo $page - 1 ?>" tabindex="-1" aria-disabled="true"><span class="material-icons"></span>ก่อนหน้า</a>
                                    </li>

                                    <?php
                                    for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <li <?php if ($page == $i) {
                                                echo "class='page-item active'";
                                            } ?>><a class="page-link" href="event?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php   }
                                    ?>


                                    <li <?php if ($page == $total_page) {
                                            echo "class='page-item disabled'";
                                        } ?>>
                                        <a class="page-link" href="event?page=<?php echo $page + 1 ?>">ถัดไป <span class="material-icons"></span></a>
                                    </li>
                                </ul>
                            </div>

                        </form>


                    </div>

                    <!-- Modal Add event  -->
                    <div class="modal fade" id="addevent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มข่าวสารภาษาไทย</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" enctype="multipart/form-data">
                                       
                                            <h6 id="upload-img">ภาพหน้าปก</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="file" name="img_cover" id="imgInput_add" class="form-control">
                                                    <span style="color: #DB4834;">ขนาดภาพที่แนะนำ 800 x 600</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="gallery d-flex justify-content-center align-item-center">
                                                        <img width="80%" id="previewImg_add">
                                                    </div>
                                                </div>
                                            </div>
                                     
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <span>เนื้อหาเกริ่น <span style="color: #DB4834;">(ไม่ควรยาวเกินไป)</span></span>
                                                <textarea name="content"></textarea>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <span>ลิงค์ <span style="color: #DB4834;">(สำหรับไปที่โพสต์กิจกรรม)</span></span>
                                                <input type="text" name="link" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn" name="add_event" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
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