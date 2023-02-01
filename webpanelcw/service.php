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

if (isset($_POST['save_service'])) {
    $status = "on";
    $area1 = $_POST['area1'];
    $area2 = $_POST['area2'];
    $area3 = $_POST['area3'];
    $area4 = $_POST['area4'];
    $area5 = $_POST['area5'];
    $area6 = $_POST['area6'];
    $area7 = $_POST['area7'];
    $area8 = $_POST['area8'];


    foreach ($_FILES['img']['tmp_name'] as $key => $value) {
        $file_names = $_FILES['img']['name'];

        $extension = strtolower(pathinfo($file_names[$key], PATHINFO_EXTENSION));
        $supported = array('jpg', 'jpeg', 'png', 'webp');
        if (in_array($extension, $supported)) {
            $new_name = rand() . '.' . "webp";
            if (move_uploaded_file($_FILES['img']['tmp_name'][$key], "uploads/upload_service/" . $new_name)) {
                $sql = "INSERT INTO service_img (image, status) VALUES(:image, :status)";
                $upload_img = $conn->prepare($sql);
                $params = array(
                    'image' => $new_name,
                    'status' => $status

                );
                $upload_img->execute($params);
            }
        }
    }

    $update_service = $conn->prepare("UPDATE service SET area1 = :area1,area2 = :area2,area3 = :area3, area4 = :area4, area5 = :area5,area6 = :area6, area7 = :area7, area8 = :area8");
    $update_service->bindParam(":area1",$area1);
    $update_service->bindParam(":area2",$area2);
    $update_service->bindParam(":area3",$area3);
    $update_service->bindParam(":area4",$area4);
    $update_service->bindParam(":area5",$area5);
    $update_service->bindParam(":area6",$area6);
    $update_service->bindParam(":area7",$area7);
    $update_service->bindParam(":area8",$area8);
    $update_service->execute();

    if ($update_service) {
        echo "<script>
            $(document).ready(function() {
            Swal.fire({
            text: 'แก้ไขข้อมูลสำเร็จแล้ว',
            icon: 'success',
            timer: 10000,
            showConfirmButton: false
            });
            })
        </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=service'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=service'>";
    }
}

//del-img
if (isset($_POST['del-img'])) {
    $del_id = $_POST['del-img'];

    $del_img = $conn->prepare("DELETE FROM service_img WHERE id = :id");
    $del_img->bindParam(":id", $del_id);
    $del_img->execute();

    if ($del_img) {
        echo "<script>
            $(document).ready(function() {
            Swal.fire({
            text: 'ลบข้อมูลสำเร็จแล้ว',
            icon: 'success',
            timer: 10000,
            showConfirmButton: false
            });
            })
        </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=service'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=service'>";
    }
}

//query service_img
$service_img = $conn->prepare("SELECT * FROM service_img");
$service_img->execute();
$row_service_img = $service_img->fetchAll();

//query service
$service = $conn->prepare("SELECT * FROM service");
$service->execute();
$row_service = $service->fetch(PDO::FETCH_ASSOC);
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
                        <h4 class="card-title">บริการ</h4>
                        <div class="btn-lang">
                            <a href="service_en" style="background-color: #DB4834; color: #FFFFFF;" class="btn">EN</a>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="content-img-intro1" style="margin: 0px;">
                                        <span id="upload-img">ภาพโชว์</span>
                                        
                                        <div class="group-pos">
                                            
                                            <input type="file" name="img[]" id="imgInput-add" onchange="preview_image();" class="form-control" multiple>
                                            <button type="button" class="btn reset" id="reset3">Reset</button>
                                        </div>
                                        <!-- <span style="color: #DB4834;">ขนาดภาพที่แนะนำ 2000 x 1000</span> -->
                                        <!-- <span class="file-support">Only file are support ('jpg', 'jpeg', 'png', 'webp').</span> -->
                                        <div id="gallery">
                                            <?php
                                            foreach ($row_service_img as $row_service_img) { ?>
                                                <div class="box-edit-img">
                                                    <span class="del-edit-img"><button type="submit" onclick="return confirm('ต้องการลบรูปภาพนี้ใช่หรือไม่?')" name="del-img" value="<?php echo $row_service_img['id'] ?>" class="btn-edit-del-img"><i class="bi bi-x-lg"></button></i></span>
                                                    <img class='previewImg' id='edit-img' src="uploads/upload_service/<?php echo $row_service_img['image'] ?>" alt="">
                                                </div>
                                            <?php  }
                                            ?>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6 mt-2">
                                    <h6>พื้นที่ใช้สอย</h6>
                                    <textarea name="area1"><?php echo $row_service['area1'] ?></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h6>พื้นที่จอดรถ</h6>
                                    <textarea name="area2"><?php echo $row_service['area2'] ?></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h6>พื้นที่ให้เช่า</h6>
                                    <textarea name="area3"><?php echo $row_service['area3'] ?></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h6>เวลา เปิด - ปิด</h6>
                                    <textarea name="area4"><?php echo $row_service['area4'] ?></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h6>จำนวนร้านค้า</h6>
                                    <textarea name="area5"><?php echo $row_service['area5'] ?></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h6>ห้องน้ำสะอาด</h6>
                                    <textarea name="area6"><?php echo $row_service['area6'] ?></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h6>รวมทั้งหมด 6 ZONE</h6>
                                    <textarea name="area7"><?php echo $row_service['area7'] ?></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <h6>อีเวนส์</h6>
                                    <textarea name="area8"><?php echo $row_service['area8'] ?></textarea>
                                </div>

                               
                            </div>
                            <div class="mt-3">
                                <button class="btn" name="save_service" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <?php include('footer.php'); ?>
        </div>
    </div>
    <script>
        function preview_image() {
            var total_file = document.getElementById("imgInput-add").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#gallery').append("<div class='box-edit-img'> <img class='previewImg' id='edit-img' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
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