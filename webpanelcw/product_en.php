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

//add product
if (isset($_POST['add_product'])) {
    $img_cover = $_FILES['img_cover'];
    $product_name = $_POST['product_name'];
    $content = $_POST['content'];
    $detail = $_POST['detail'];
    $link_video = $_POST['link_video'];
    $link_catalog = $_POST['link_catalog'];
    $status = "on";

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_product/" . $fileNew1;

    try {
        if (in_array($fileActExt1, $allow)) {
            if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
                if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                    $add_product = $conn->prepare("INSERT INTO product_en(img_cover, product_name, content, detail, link_video, link_catalog, status) VALUES(:img_cover, :product_name, :content, :detail, :link_video, :link_catalog, :status)");
                    $add_product->bindParam(":img_cover", $fileNew1);
                    $add_product->bindParam(":product_name", $product_name);
                    $add_product->bindParam(":content", $content);
                    $add_product->bindParam(":detail", $detail);
                    $add_product->bindParam(":link_video", $link_video);
                    $add_product->bindParam(":link_catalog", $link_catalog);
                    $add_product->bindParam(":status", $status);
                    $add_product->execute();

                    if ($add_product) {
                        echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    text: 'เพิ่มผลิตภัณฑ์สำเร็จ',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                });
                            })
                            </script>";
                        echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
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
                        echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


//edit product
if (isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $img_cover = $_FILES['img_cover'];
    $product_name = $_POST['product_name'];
    $content = $_POST['content'];
    $detail = $_POST['detail'];
    $link_video = $_POST['link_video'];
    $link_catalog = $_POST['link_catalog'];
    $status = "on";



    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img_cover['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_product/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($img_cover['size'] > 0 && $img_cover['error'] == 0) {
            if (move_uploaded_file($img_cover['tmp_name'], $filePath1)) {
                $edit_product = $conn->prepare("UPDATE product_en SET img_cover = :img_cover, product_name = :product_name, content = :content, detail = :detail, link_video = :link_video, link_catalog = :link_catalog , status = :status WHERE id_product = :id");
                $edit_product->bindParam(":img_cover", $fileNew1);
                $edit_product->bindParam(":product_name", $product_name);
                $edit_product->bindParam(":content", $content);
                $edit_product->bindParam(":detail", $detail);
                $edit_product->bindParam(":link_video", $link_video);
                $edit_product->bindParam(":link_catalog", $link_catalog);
                $edit_product->bindParam(":status", $status);
                $edit_product->bindParam(":id", $product_id);
                $edit_product->execute();

                if ($edit_product) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'แก้ไขข้อมูลผลิตภัณฑ์สำเร็จ',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
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
                    echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
                }
            }
        }
    } else {
        $edit_product = $conn->prepare("UPDATE product_en SET product_name = :product_name, content = :content, detail = :detail, link_video = :link_video, link_catalog = :link_catalog , status = :status WHERE id_product = :id");
        $edit_product->bindParam(":product_name", $product_name);
        $edit_product->bindParam(":content", $content);
        $edit_product->bindParam(":detail", $detail);
        $edit_product->bindParam(":link_video", $link_video);
        $edit_product->bindParam(":link_catalog", $link_catalog);
        $edit_product->bindParam(":status", $status);
        $edit_product->bindParam(":id", $product_id);
        $edit_product->execute();

        if ($edit_product) {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    text: 'แก้ไขข้อมูลผลิตภัณฑ์สำเร็จ',
                    icon: 'success',
                    timer: 10000,
                    showConfirmButton: false
                });
            })
            </script>";
            echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
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
            echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
        }
    }
}

//change status
if (isset($_POST['change-status'])) {
    $check = $_POST['check'];
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("UPDATE product_en SET status = :status WHERE id_product =  :id_product");
    $stmt->bindParam(":status", $check);
    $stmt->bindParam(":id_product", $product_id);
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
        echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
    } else {
        echo "<script>alert('Something Went Wrong!!!')</script>";
        echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
    }
}


//delete product all
if (isset($_POST['delete_all'])) {
    if (count((array)$_POST['ids']) > 0) {
        $all = implode(",", $_POST['ids']);

        $del_product = $conn->prepare("DELETE FROM product_en WHERE id_product in ($all)");
        $del_product->execute();

        if ($del_product) {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    text: 'ลบผลิตภัณฑ์สำเร็จ',
                    icon: 'success',
                    timer: 10000,
                    showConfirmButton: false
                });
            })
            </script>";
            echo "<meta http-equiv='refresh' content='1.6;url=product_en'>";
        } else {
            echo "<script>alert('Something Went Wrong!!!')</script>";
            echo "<meta http-equiv='refresh' content='1.5;url=product_en'>";
        }
    } else {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'กรุณาคลิกเลือกผลิตภัณฑ์ก่อนทำการลบ',
                icon: 'warning',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.6;url=product_en'>";
    }
}



$page = $_GET['page'];
$product_count = $conn->prepare("SELECT * FROM product_en");
$product_count->execute();
$count_product = $product_count->fetchAll();

$rows = 10;
if ($page == "") {
    $page = 1;
}

$total_data = count($count_product);
$total_page = ceil($total_data / $rows);
$start = ($page - 1) * $rows;

$product = $conn->prepare("SELECT * FROM product_en LIMIT $start,10");
$product->execute();
$row_product = $product->fetchAll();
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
                <h3>ผลิตภัณฑ์</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">ผลิตภัณฑ์</h4>
                        <div class="btn-lang">
                            <a href="product" style="background-color: #522206; color: #FFFFFF;" class="btn">TH</a>
                        </div>
                        <script>
                            tinymce.init({
                                selector: 'textarea',
                                plugins: 'autolink  code  image  lists table   wordcount',
                                toolbar: ' blocks fontfamily fontsize code | bold italic underline strikethrough |  image table  mergetags | addcomment showcomments  | align lineheight | checklist numlist bullist indent outdent | removeformat',
                                images_upload_url: 'upload.php',
                                branding: false,
                                promotion: false,
                                height: 270
                            });
                        </script>

                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mt-4">
                                <div class="mt-2" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addproduct" style="background-color: #522206; color: #FFFFFF; margin-right: 5px;">เพิ่มผลิตภัณฑ์</button>
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
                                            foreach (array_reverse($row_product) as $row_product) { ?>
                                                <tr align="center">
                                                    <td> <input type="checkbox" class="form-check-input checkbox checkbox-select" name="ids[]" value=<?php echo $row_product['id_product'] ?>></td>
                                                    <td width="20%"> <img width="60%" src="uploads/upload_product/<?php echo $row_product['img_cover']; ?>" alt=""></td>
                                                    <td align="left" width="50%"><?php echo $row_product['product_name']; ?><?php echo $row_product['content']; ?></td>
                                                    <td> <a type="input" class="btn" <?php if ($row_product['status'] == "on") {
                                                                                            echo " style='background-color: #06c258; color: #FFF;'";
                                                                                        } else {
                                                                                            echo " style='background-color: #dd250c ;color: #FFF;'";
                                                                                        } ?> data-bs-toggle="modal" href="#status<?php echo $row_product['id_product'] ?>" id="setting"><i class="bi bi-gear"></i></a></td>
                                                    <td>
                                                        <a type="input" class="btn" data-bs-toggle="modal" href="#editproduct<?php echo $row_product['id_product'] ?>" style="background-color:#ffc107; color: #FFFFFF;"><i class="bi bi-pencil-square"></i></a>
                                                        <button class="btn" onclick="return confirm('ต้องการลบกิจกรรมนี้ใช่หรือไม่?');" name="delete_all" style="background-color:#dd250c; color: #FFFFFF;"><i class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>

                                                <!-- Modal Status -->
                                                <div class="modal fade" id="status<?php echo $row_product['id_product'] ?>" data-bs-backdrop="static" aria-hidden="true">
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
                                                                            <input type="hidden" name="product_id" value="<?php echo $row_product['id_product']; ?>">
                                                                            <input class="form-check-input" id="switch-check" name="check" type="checkbox" <?php if ($row_product['status'] == "on") {
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

                                                <!-- Modal Edit product  -->
                                                <div class="modal fade" id="editproduct<?php echo $row_product['id_product'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                                            <input type="hidden" name="product_id" value="<?php echo $row_product['id_product']; ?>">
                                                                            <input type="file" name="img_cover" id="imgInput" class="form-control">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div id="gallery d-flex justify-content-center align-item-center">
                                                                                <img width="80%" id="previewImg" src="uploads/upload_product/<?php echo $row_product['img_cover'] ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-12 mt-2">
                                                                            <h6>ชื่อผลิตภัณฑ์</h6>
                                                                            <textarea name="product_name"><?php echo $row_product['product_name'] ?></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 mt-2">
                                                                            <h6>เนื้อหา </h6>
                                                                            <textarea name="content"><?php echo $row_product['content'] ?></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 mt-2">
                                                                            <h6>รายละเอียด </h6>
                                                                            <textarea name="detail"><?php echo $row_product['detail'] ?></textarea>
                                                                        </div>
                                                                        <div class="col-md-12 mt-2">
                                                                            <h6>Link Video</h6>
                                                                            <input type="text" name="link_video" value="<?php echo $row_product['link_video']; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="col-md-12 mt-2">
                                                                            <h6>Link catalog</h6>
                                                                            <input type="text" name="link_catalog" value="<?php echo $row_product['link_catalog']; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <button class="btn" name="edit_product" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
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
                                        <a class="page-link" href="product?page=<?php echo $page - 1 ?>" tabindex="-1" aria-disabled="true"><span class="material-icons"></span>ก่อนหน้า</a>
                                    </li>

                                    <?php
                                    for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <li <?php if ($page == $i) {
                                                echo "class='page-item active'";
                                            } ?>><a class="page-link" href="product?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                    <?php   }
                                    ?>


                                    <li <?php if ($page == $total_page) {
                                            echo "class='page-item disabled'";
                                        } ?>>
                                        <a class="page-link" href="product?page=<?php echo $page + 1 ?>">ถัดไป <span class="material-icons"></span></a>
                                    </li>
                                </ul>
                            </div>

                        </form>


                    </div>

                    <!-- Modal Add product  -->
                    <div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มผลิตภัณฑ์ (TH)</h1>
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
                                                <h6>ชื่อผลิตภัณฑ์</h6>
                                                <textarea name="product_name"></textarea>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <h6>เนื้อหา</h6>
                                                <textarea name="content"></textarea>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <h6>รายละเอียด</h6>
                                                <textarea name="detail"></textarea>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <h6>Link video</h6>
                                                <input type="text" name="link_video" class="form-control">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <h6>Link catalog</h6>
                                                <input type="text" name="link_catalog" class="form-control">
                                            </div>

                                        </div>
                                        <div class="mt-3">
                                            <button class="btn" name="add_product" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
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