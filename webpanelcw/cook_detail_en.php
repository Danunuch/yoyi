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


// Query หลัก
$data_detail = $conn->prepare("SELECT * FROM cook_detail_en");
$data_detail->execute();
$row_detail = $data_detail->fetchAll();


//Edit cook detail
if (isset($_POST['edit_detail_cook'])) {
    $detail_id = $_POST['detail_id'];
    $img_cover = $_FILES['img_cover_edit'];
    $detail_name = $_POST['detail_name'];
    $content1 = $_POST['content1'];
    $content2 = $_POST['content2'];
    $content3 = $_POST['content3'];
    $content4 = $_POST['content4'];
    $content5 = $_POST['content5'];
    $content6 = $_POST['content6'];
    $content7 = $_POST['content7'];
    $content8 = $_POST['content8'];
    $content9 = $_POST['content9'];
    $content10 = $_POST['content10'];
    $type_id = $_POST['type_name'];
    $id = $_POST['catalog_name'];



    $select_type = $conn->prepare("SELECT * FROM type_cook_en WHERE type_name= :type_name");
    $select_type->bindParam(':type_name', $type_id);
    $select_type->execute();
    $query =  $select_type->fetch(PDO::FETCH_ASSOC);


    $select_catalog = $conn->prepare("SELECT * FROM catalog_cook_en WHERE catalog_name= :catalog_name");
    $select_catalog->bindParam(':catalog_name', $id);
    $select_catalog->execute();
    $query_catalog =  $select_catalog->fetch(PDO::FETCH_ASSOC);


    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_cooking/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
            if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                $edit_detail = $conn->prepare("UPDATE cook_detail_en SET img_cover = :img_cover,detail_name = :detail_name , content1 = :content1, content2 = :content2, content3 = :content3 , content4 = :content4, content5 = :content5,
                                                        content6 = :content6, content7 = :content7, content8 = :content8 , content9 = :content9, content10 = :content10, type_id = :type_id, id = :id WHERE detail_id = :detail_id");
                $edit_detail->bindParam(":img_cover", $fileNew1);
                $edit_detail->bindParam(":detail_name", $detail_name);
                $edit_detail->bindParam(":content1", $content1);
                $edit_detail->bindParam(":content2", $content2);
                $edit_detail->bindParam(":content3", $content3);
                $edit_detail->bindParam(":content4", $content4);
                $edit_detail->bindParam(":content5", $content5);
                $edit_detail->bindParam(":content6", $content6);
                $edit_detail->bindParam(":content7", $content7);
                $edit_detail->bindParam(":content8", $content8);
                $edit_detail->bindParam(":content9", $content9);
                $edit_detail->bindParam(":content10", $content10);
                $edit_detail->bindParam(":type_id", $query['type_id']);
                $edit_detail->bindParam(":id", $query_catalog['id']);
                $edit_detail->bindParam(":detail_id", $detail_id);
                $edit_detail->execute();

                if ($edit_detail) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'แก้ไขรายละเอียดสำเร็จ',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                    echo "<meta http-equiv='refresh' content='2;url=cook_detail_en'>";
                } else {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'Something Went Wrong!!!',
                            icon: 'error',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                }
            }
        }
    } else {
        $edit_detail = $conn->prepare("UPDATE cook_detail_en SET detail_name = :detail_name, content1 = :content1, content2 = :content2, content3 = :content3 , content4 = :content4, content5 = :content5,
            content6 = :content6, content7 = :content7, content8 = :content8 , content9 = :content9, content10 = :content10, type_id = :type_id, id = :id WHERE detail_id = :detail_id");
        $edit_detail->bindParam(":detail_name", $detail_name);
        $edit_detail->bindParam(":content1", $content1);
        $edit_detail->bindParam(":content2", $content2);
        $edit_detail->bindParam(":content3", $content3);
        $edit_detail->bindParam(":content4", $content4);
        $edit_detail->bindParam(":content5", $content5);
        $edit_detail->bindParam(":content6", $content6);
        $edit_detail->bindParam(":content7", $content7);
        $edit_detail->bindParam(":content8", $content8);
        $edit_detail->bindParam(":content9", $content9);
        $edit_detail->bindParam(":content10", $content10);
        $edit_detail->bindParam(":type_id", $query['type_id']);
        $edit_detail->bindParam(":id", $query_catalog['id']);
        $edit_detail->bindParam(":detail_id", $detail_id);
        $edit_detail->execute();

        if ($edit_detail) {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    text: 'แก้ไขรายละเอียดสำเร็จ',
                    icon: 'success',
                    timer: 10000,
                    showConfirmButton: false
                });
            })
            </script>";
            echo "<meta http-equiv='refresh' content='2;url=cook_detail_en'>";
        } else {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    text: 'Something Went Wrong!!!',
                    icon: 'error',
                    timer: 10000,
                    showConfirmButton: false
                });
            })
            </script>";
        }
    }
}


//add cook detail
if (isset($_POST['add_detail_cook'])) {
    $img_cover = $_FILES['img_cover'];
    $detail_name = $_POST['detail_name'];
    $content1 = $_POST['content1'];
    $content2 = $_POST['content2'];
    $content3 = $_POST['content3'];
    $content4 = $_POST['content4'];
    $content5 = $_POST['content5'];
    $content6 = $_POST['content6'];
    $content7 = $_POST['content7'];
    $content8 = $_POST['content8'];
    $content9 = $_POST['content9'];
    $content10 = $_POST['content10'];
    $type_id = $_POST['type_name'];
    $id = $_POST['catalog_name'];


    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_cooking/" . $fileNew1;

    try {
        if (in_array($fileActExt1, $allow)) {
            if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
                if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                    $add_detail = $conn->prepare("INSERT INTO cook_detail_en(img_cover,detail_name, content1, content2, content3, content4, content5, content6, content7,content8,content9,content10,type_id,id) VALUES( :img_cover, :detail_name, :content1, :content2, :content3, :content4, :content5, :content6, :content7, :content8, :content9, :content10, :type_id ,:id)");
                    $add_detail->bindParam(":img_cover", $fileNew1);
                    $add_detail->bindParam(":detail_name", $detail_name);
                    $add_detail->bindParam(":content1", $content1);
                    $add_detail->bindParam(":content2", $content2);
                    $add_detail->bindParam(":content3", $content3);
                    $add_detail->bindParam(":content4", $content4);
                    $add_detail->bindParam(":content5", $content5);
                    $add_detail->bindParam(":content6", $content6);
                    $add_detail->bindParam(":content7", $content7);
                    $add_detail->bindParam(":content8", $content8);
                    $add_detail->bindParam(":content9", $content9);
                    $add_detail->bindParam(":content10", $content10);
                    $add_detail->bindParam(":type_id", $type_id);
                    $add_detail->bindParam(":id", $id);
                    $add_detail->execute();

                    if ($add_detail) {
                        echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    text: 'เพิ่มข้อมูลสำเร็จ',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                });
                            })
                            </script>";
                        echo "<meta http-equiv='refresh' content='1.5;url=cook_detail_en'>";
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
                        echo "<meta http-equiv='refresh' content='1.5;url=cook_detail_en'>";
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}





//delete detail all
if (isset($_POST['delete_all'])) {
    if (count((array)$_POST['ids']) > 0) {
        $all = implode(",", $_POST['ids']);

        $del_detail = $conn->prepare("DELETE FROM cook_detail_en WHERE detail_id in ($all)");
        $del_detail->execute();

        if ($del_detail) {
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
            echo "<meta http-equiv='refresh' content='1.6;url=cook_detail_en'>";
        } else {
            echo "<script>alert('Something Went Wrong!!!')</script>";
            echo "<meta http-equiv='refresh' content='1.5;url=cook_detail_en'>";
        }
    } else {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'กรุณาคลิกเลือกข้อมูลก่อนทำการลบ',
                icon: 'warning',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.6;url=cook_detail_en'>";
    }
}

// $page = $_GET['page'];
// $cook_detail_count = $conn->prepare("SELECT * FROM cook_detail");
// $cook_detail_count->execute();
// $count_cook_detail = $cook_detail_count->fetchAll();

// $rows = 10;
// if ($page == "") {
//     $page = 1;
// }

// $total_data = count($count_cook_detail);
// $total_page = ceil($total_data / $rows);
// $start = ($page - 1) * $rows;

// $cook_detail = $conn->prepare("SELECT * FROM cook_detail LIMIT $start,10");
// $cook_detail->execute();
// $row_cook_detail = $cook_detail->fetchAll();
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
                <h3>รายละเอียด</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">รายละเอียด</h4>
                        <div class="btn-lang">
                            <a href="cook_detail" style="background-color: #522206; color: #FFFFFF;" class="btn">TH</a>
                        </div>
                        <script>
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

                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mt-4">
                                <div class="mt-2" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#adddetail" style="background-color: #522206; color: #FFFFFF; margin-right: 5px;">เพิ่มข้อมูล</button>
                                    <button type="submit" class="btn" onclick="return confirm('ต้องการลบกิจกรรมทั้งหมดใช่หรือไม่?');" name="delete_all" style="background-color: #dd250c; color: #FFFFFF;">ลบทั้งหมด</button>
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr align="center">
                                                <th scope="col"><input type="checkbox" class="form-check-input checkbox-select" id="select_all"></th>
                                                <th scope="col">ภาพหน้าปก</th>
                                                <th scope="col">เนื้อหา</th>
                                                <th scope="col">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (array_reverse($row_detail) as $row_detail) { ?>
                                                <tr align="center">
                                                    <td> <input type="checkbox" class="form-check-input checkbox checkbox-select" name="ids[]" value=<?php echo $row_detail['detail_id'] ?>></td>
                                                    <td width="20%"> <img width="60%" src="uploads/upload_cooking/<?php echo $row_detail['img_cover']; ?>" alt=""></td>
                                                    <td align="left" width="40%"><?php echo $row_detail['detail_name']; ?>
                                                        <?php echo $row_detail['content1']; ?><br><?php echo $row_detail['content2']; ?><br><?php echo $row_detail['content3']; ?>....</td>
                                                    <td>
                                                        <a type="input" class="btn" data-bs-toggle="modal" href="#editdetail<?php echo $row_detail['detail_id'] ?>" style="background-color:#ffc107; color: #FFFFFF;"><i class="bi bi-pencil-square"></i></a>
                                                        <button class="btn" onclick="return confirm('ต้องการลบกิจกรรมนี้ใช่หรือไม่?');" name="delete_all" style="background-color:#dd250c; color: #FFFFFF;"><i class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>



                                                <!-- Modal Edit detail  -->
                                                <?php

                                                $select_type = $conn->prepare("SELECT * FROM type_cook_en WHERE type_id = :type_id");
                                                $select_type->bindParam(':type_id', $row_detail['type_id']);
                                                $select_type->execute();
                                                $query =  $select_type->fetch(PDO::FETCH_ASSOC);


                                                $select_catalog = $conn->prepare("SELECT * FROM catalog_cook_en WHERE id = :id");
                                                $select_catalog->bindParam(':id', $row_detail['id']);
                                                $select_catalog->execute();
                                                $query_catalog =  $select_catalog->fetch(PDO::FETCH_ASSOC);

                                                ?>
                                                <div class="modal fade" id="editdetail<?php echo $row_detail['detail_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขรายละเอียด (TH)</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mt-2">
                                                                            <input type="hidden" name="detail_id" value="<?php echo $row_detail['detail_id']; ?>">
                                                                            <h6>หัวข้อ </h6>
                                                                            <textarea name="detail_name"><?php echo $row_detail['detail_name'] ?></textarea>

                                                                            <h6>ขั้นตอนที่ 1 </h6>
                                                                            <input type="text" name="content1" class="form-control" value="<?php echo $row_detail['content1']; ?>">

                                                                            <h6>ขั้นตอนที่ 2 </h6>
                                                                            <input type="text" name="content2" class="form-control" value="<?php echo $row_detail['content2']; ?>">

                                                                            <h6>ขั้นตอนที่ 3 </h6>
                                                                            <input type="text" name="content3" class="form-control" value="<?php echo $row_detail['content3']; ?>">

                                                                            <h6>ขั้นตอนที่ 4 </h6>
                                                                            <input type="text" name="content4" class="form-control" value="<?php echo $row_detail['content4']; ?>">

                                                                            <h6>ขั้นตอนที่ 5 </h6>
                                                                            <input type="text" name="content5" class="form-control" value="<?php echo $row_detail['content5']; ?>">

                                                                            <h6>ขั้นตอนที่ 6 </h6>
                                                                            <input type="text" name="content6" class="form-control" value="<?php echo $row_detail['content6']; ?>">

                                                                            <h6>ขั้นตอนที่ 7 </h6>
                                                                            <input type="text" name="content7" class="form-control" value="<?php echo $row_detail['content7']; ?>">

                                                                            <h6>ขั้นตอนที่ 8 </h6>
                                                                            <input type="text" name="content8" class="form-control" value="<?php echo $row_detail['content8']; ?>">

                                                                            <h6>ขั้นตอนที่ 9 </h6>
                                                                            <input type="text" name="content9" class="form-control" value="<?php echo $row_detail['content9']; ?>">

                                                                            <h6>ขั้นตอนที่ 10 </h6>
                                                                            <input type="text" name="content10" class="form-control" value="<?php echo $row_detail['content10']; ?>">

                                                                            <h6 for="type_name" class="col-form-label">ประเภท</h6>
                                                                            <input type="text" name="type_name" value="<?php echo $query['type_name'] ?>" class="form-control">
                                                                            <h6 for="catalog_name" class="col-form-label">แคตตาล็อก</h6>
                                                                            <input type="text" name="catalog_name" value="<?php echo $query_catalog['catalog_name'] ?>" class="form-control">

                                                                            <h6 id="upload-img">ภาพหน้าปก</h6>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input type="hidden" name="detail_id" value="<?php echo $row_detail['detail_id']; ?>">
                                                                                    <input type="file" name="img_cover_edit" id="imgInput" class="form-control">

                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div id="gallery d-flex justify-content-center align-item-center">
                                                                                        <img width="80%" id="previewImg" src="uploads/upload_cooking/<?php echo $row_detail['img_cover'] ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <button class="btn" name="edit_detail_cook" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
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


                                <!-- <ul class="pagination justify-content-center mt-5">
                                    <li <?php if ($page == 1) {
                                            echo "class='page-item disabled'";
                                        }  ?>>
                                        <a class="page-link" href="cook_detail?page=<?php echo $page - 1 ?>" tabindex="-1" aria-disabled="true"><span class="material-icons"></span>ก่อนหน้า</a>
                                    </li>

                                    <?php
                                    for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <li <?php if ($page == $i) {
                                                echo "class='page-item active'";
                                            } ?>><a class="page-link" href="cook_detail?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php   }
                                    ?>


                                    <li <?php if ($page == $total_page) {
                                            echo "class='page-item disabled'";
                                        } ?>>
                                        <a class="page-link" href="cook_detail?page=<?php echo $page + 1 ?>">ถัดไป <span class="material-icons"></span></a>
                                    </li>
                                </ul> -->
                            </div>

                        </form>


                    </div>

                    <!-- Modal Add detail  -->
                    <?php
                    $select_stmt = $conn->prepare("SELECT * FROM type_cook_en");
                    $select_stmt->execute();
                    $query_ty =  $select_stmt->fetchAll();


                    $select_stmt = $conn->prepare("SELECT * FROM catalog_cook_en");
                    $select_stmt->execute();
                    $query_cata =  $select_stmt->fetchAll();
                    ?>

                    <div class="modal fade" id="adddetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มข้อมูล (TH)</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" enctype="multipart/form-data">

                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <h6>หัวข้อ </h6>
                                                <textarea name="detail_name"></textarea>

                                                <h6>ขั้นตอนที่ 1 </h6>
                                                <input type="text" name="content1" class="form-control">

                                                <h6>ขั้นตอนที่ 2 </h6>
                                                <input type="text" name="content2" class="form-control">

                                                <h6>ขั้นตอนที่ 3 </h6>
                                                <input type="text" name="content3" class="form-control">

                                                <h6>ขั้นตอนที่ 4 </h6>
                                                <input type="text" name="content4" class="form-control">

                                                <h6>ขั้นตอนที่ 5 </h6>
                                                <input type="text" name="content5" class="form-control">

                                                <h6>ขั้นตอนที่ 6 </h6>
                                                <input type="text" name="content6" class="form-control">

                                                <h6>ขั้นตอนที่ 7 </h6>
                                                <input type="text" name="content7" class="form-control">

                                                <h6>ขั้นตอนที่ 8 </h6>
                                                <input type="text" name="content8" class="form-control">

                                                <h6>ขั้นตอนที่ 9 </h6>
                                                <input type="text" name="content9" class="form-control">

                                                <h6>ขั้นตอนที่ 10 </h6>
                                                <input type="text" name="content10" class="form-control">

                                                <?php
                                                $stmt1 = $conn->prepare("SELECT* FROM type_cook_en");
                                                $stmt1->execute();
                                                $type_cook = $stmt1->fetchAll();

                                                $stmt2 = $conn->prepare("SELECT* FROM catalog_cook_en");
                                                $stmt2->execute();
                                                $catalog_cook = $stmt2->fetchAll();

                                                ?>


                                                <h6 for="type_name" class="col-form-label">ประเภท</h6>
                                                <select class="form-control" name="type_name" id="">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($query_ty as $value) { ?>
                                                        <option value="<?= $value['type_id'] ?>"><?= $value['type_name'] ?></option>
                                                    <?php } ?>
                                                </select>


                                                <h6 for="catalog_name" class="col-form-label">แคตตาล็อก</h6>
                                                <select class="form-control" name="catalog_name" id="">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($query_cata as $value) { ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['catalog_name'] ?></option>
                                                    <?php } ?>
                                                </select>


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

                                            </div>

                                        </div>
                                        <div class="mt-3">
                                            <button class="btn" name="add_detail_cook" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
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