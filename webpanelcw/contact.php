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


//update contact
if (isset($_POST['save_contact'])) {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $facebook = $_POST['facebook'];
    $line = $_POST['line'];
    $instragram = $_POST['instragram'];
    $map = $_POST['map'];

    $update_contact = $conn->prepare("UPDATE contact SET address = :address, phone = :phone, email = :email, facebook = :facebook, line = :line, instragram = :instragram, map = :map");
    $update_contact->bindParam(":address", $address);
    $update_contact->bindParam(":phone", $phone);
    $update_contact->bindParam(":email", $email);
    $update_contact->bindParam(":facebook", $facebook);
    $update_contact->bindParam(":line", $line);
    $update_contact->bindParam(":instragram", $instragram);
    $update_contact->bindParam(":map", $map);
    $update_contact->execute();

    if ($update_contact) {
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
        echo "<meta http-equiv='refresh' content='1.5;url=contact'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=contact'>";
    }
}


//query contact
$contact = $conn->prepare("SELECT * FROM contact");
$contact->execute();
$row_contact = $contact->fetch(PDO::FETCH_ASSOC);
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TONSAKCORNER</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
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
                <h3>ติดต่อเรา</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">จัดการติดต่อเรา</h4>
                        <div class="btn-lang">
                            <a href="contact_en" style="background-color: #DB4834; color: #FFFFFF;" class="btn">EN</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>ที่อยู่</h6>
                                        <input type="text" name="address" value="<?php echo $row_contact['address']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>เบอร์โทรศัพท์</h6>
                                        <input type="text" name="phone" value="<?php echo $row_contact['phone']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>อีเมล</h6>
                                        <input type="text" name="email" value="<?php echo $row_contact['email']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Facebook</h6>
                                        <input type="text" name="facebook" value="<?php echo $row_contact['facebook']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Line</h6>
                                        <input type="text" name="line" value="<?php echo $row_contact['line']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Instragram</h6>
                                        <input type="text" name="instragram" value="<?php echo $row_contact['instragram']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <h6>Google Map (Embedded)</h6>
                                        <input type="text" name="map" value='<?php echo $row_contact['map']; ?>' class="form-control">
                                    </div>
                                </div>


                            </div>
                            <div class="mt-3">
                                <button class="btn" name="save_contact" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                            </div>
                        </form>


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