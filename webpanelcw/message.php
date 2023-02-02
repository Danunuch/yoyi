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


if (isset($_POST['delete_message'])) {
    $delete_message = $_POST['delete_message'];

    $del = $conn->prepare("DELETE FROM message WHERE id = :id");
    $del->bindParam(":id", $delete_message);
    $del->execute();

    if ($del) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ลบข้อความสำเร็จ',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";

        echo "<meta http-equiv='refresh' content='1.5;url=message'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=message'>";
    }
}

if (isset($_POST['change-status'])) {
    $message_id =  $_POST['message_id'];
    $check = $_POST['check'];
    $edit_status = $conn->prepare("UPDATE message SET status = :status WHERE id = :id");
    $edit_status->bindParam(":status", $check);
    $edit_status->bindParam(":id", $message_id);
    $edit_status->execute();

    if ($edit_status) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'เปลี่ยนสถานะเรียบร้อยแล้ว',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";

        echo "<meta http-equiv='refresh' content='1.5;url=message'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=message'>";
    }
}


//query message
$data_message = $conn->prepare("SELECT * FROM message");
$data_message->execute();
$row_message = $data_message->fetchAll();
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yo Yi Foods Co., Ltd.</title>

    <link rel="stylesheet" href="assets/css/main/app.css?v=<?php echo time();  ?>">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time();  ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <link rel="shortcut icon" href="../images/logo.svg" type="image/png">
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
                <h3>ข้อความจากลูกค้า</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">จัดการข้อความ</h4>



                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr align="center">
                                        <th scope="col">จาก</th>
                                        <th scope="col">อีเมล</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col">จัดการ</th>

                                    </tr>
                                </thead>
                                <tbody>


                                    <!-- Show Slide -->
                                    <?php
                                    foreach (array_reverse($row_message)  as $row_message) { ?>
                                        <tr align="center">
                                            <td width="20%"><?php echo $row_message['name']; ?></td>
                                            <td width="20%"><?php echo $row_message['email']; ?></td>
                                            <td width="20%"><a type="input" data-bs-toggle="modal" href="#status<?php echo $row_message['id'] ?>" class="btn btn-gear" <?php if ($row_message['status'] == "on") {
                                                                                                                                                                            echo " style='background-color: #06c258;color:#FFF;'";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo " style='background-color: #DB4834;color:#FFF;'";
                                                                                                                                                                        } ?>><i class="bi bi-gear"></i></a></td>
                                            <td width="20%">
                                                <form method="post">
                                                    <a type="input" class="btn btn-info" data-bs-toggle="modal" href="#message<?php echo $row_message['id'] ?>"><i class="bi bi-eye"></i></button></a>
                                                    <button class="btn" type="submit" onclick="return confirm('ต้องการลบข้อความนี้ใช่หรือไม่?');" name="delete_message" value="<?php echo $row_message['id'] ?>" style="background-color:#DB4834; color: #FFFFFF;"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>


                                        <!-- Modal message -->
                                        <div class="modal fade" id="message<?php echo $row_message['id']; ?>" data-bs-backdrop="static" aria-hidden="true">

                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">ข้อความจากคุณ <?php echo $row_message['name']; ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-message">
                                                            <h6>ติดต่อกลับ : <?php echo $row_message['tel']; ?></h6>
                                                            <h6>ข้อความ : </h6>
                                                            <p><?php echo $row_message['message']; ?></p>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Status -->
                                        <div class="modal fade" id="status<?php echo $row_message['id'] ?>" data-bs-backdrop="static" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">จัดการข้อความ</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-check form-switch">
                                                            <form method="post">
                                                                <div class="switch-box">
                                                                    <span>ยังไม่อ่าน</span>
                                                                    <input type="hidden" name="message_id" value="<?php echo $row_message['id']; ?>">
                                                                    <input class="form-check-input" id="switch-check" name="check" type="checkbox" <?php if ($row_message['status'] == "on") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } else {
                                                                                                                                                        echo "";
                                                                                                                                                    } ?>>
                                                                    <span>อ่านแล้ว</span>
                                                                </div>
                                                                <div class="box-btn">
                                                                    <button name="change-status" class="btn " style="background-color: #DB4834; color: #FFFFFF;" type="submit">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
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
        let imgInput_edit = document.getElementById('imgInput-edit');
        let previewImg_edit = document.getElementById('previewImg-edit');

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