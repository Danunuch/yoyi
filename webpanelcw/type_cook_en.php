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
$data_type = $conn->prepare("SELECT * FROM type_cook_en");
$data_type->execute();
$row_type = $data_type->fetchAll();


// Query ย่อย
$data_catalog = $conn->prepare("SELECT * FROM catalog_cook_en");
$data_catalog->execute();
$row_catalog = $data_catalog->fetchAll();


//edit type cook (หลัก)
if (isset($_POST['edit-type-cook'])) {
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];

    $edit_type = $conn->prepare("UPDATE type_cook_en SET type_name = :type_name WHERE type_id = :type_id");
    $edit_type->bindParam(":type_name", $type_name);
    $edit_type->bindParam(":type_id", $type_id);
    $edit_type->execute();

    if ($edit_type) {
        echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'แก้ไขหมวดหมู่สำเร็จ',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
        echo "<meta http-equiv='refresh' content='2;url=type_cook_en'>";
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


//add type cook (หลัก)
if (isset($_POST['add_type'])) {
    $type_name = $_POST['type_name'];

    $add_type = $conn->prepare("INSERT INTO type_cook_en(type_name) VALUES(:type_name)");
    $add_type->bindParam(":type_name", $type_name);
    $add_type->execute();

    if ($add_type) {
        echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    text: 'เพิ่มประเภทสำเร็จ',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                });
                            })
                            </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=type_cook_en'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=type_cook_en'>";
    }
}





//add catalog (ย่อย)
if (isset($_POST['add_catalog'])) {
    $catalog_name = $_POST['catalog_name'];
    $type_id = $_POST['type_name'];


    if (empty($catalog_name)) {
        echo "<script>alert('กรุณากรอกชื่อแคตตาล็อก')</script>";
    } else if (empty($type_id)) {
        echo "<script>alert('กรุณากรอกเลือกประเภท')</script>";
    } else {
        $add_catalog = $conn->prepare("INSERT INTO catalog_cook_en(catalog_name, type_id) VALUES(:catalog_name, :type_id)");
        $add_catalog->bindParam(":catalog_name", $catalog_name);
        $add_catalog->bindParam(":type_id", $type_id);
        $add_catalog->execute();
    }

    
    if ($add_catalog) {
        echo "<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    text: 'เพิ่มแคตตาล็อกสำเร็จ',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                });
                            })
                            </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=type_cook_en'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=type_cook_en'>";
    }
}


//edit catalog cook (ย่อย)
if (isset($_POST['edit-catalog-cook'])) {
    $id = $_POST['id'];
    $catalog_name = $_POST['catalog_name'];

    $edit_catalog = $conn->prepare("UPDATE catalog_cook_en SET catalog_name = :catalog_name WHERE id = :id");
    $edit_catalog->bindParam(":catalog_name", $catalog_name);
    $edit_catalog->bindParam(":id", $id);
    $edit_catalog->execute();

    if ($edit_catalog) {
        echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'แก้ไขแคตตาล็อกสำเร็จ',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
        echo "<meta http-equiv='refresh' content='2;url=type_cook_en'>";
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


//delete type (หลัก))
if (isset($_POST['delete_type'])) {
    $type_id = $_POST['delete_type'];

    $q_type = $conn->prepare("SELECT * FROM type_cook_en WHERE type_id = :id");
    $q_type->bindParam(":id", $type_id);
    $q_type->execute();
    $row_type_cook = $q_type->fetchAll();

    //delete main
    $del_type_cook = $conn->prepare("DELETE FROM type_cook_en WHERE type_id = :id");
    $del_type_cook->bindParam(":id", $type_id);
    $del_type_cook->execute();

    //delete catalog
    for ($i = 0; $i < count($row_type_cook); $i++) {
        $del_in_catalog = $conn->prepare("DELETE FROM catalog_cook_en WHERE type_id = :type_id");
        $del_in_catalog->bindParam(":type_id", $row_type_cook[$i]['type_id']);
        $del_in_catalog->execute();
    }

    if ($del_in_catalog) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ลบแคตตาล็อกสำเร็จ',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='2;url=type_cook_en'>";
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

// delete catalog cook
if (isset($_POST['delete_catalog'])) {
    $id = $_POST['delete_catalog'];
    $del_catalog = $conn->prepare("DELETE FROM catalog_cook_en WHERE id = :id");
    $del_catalog->bindParam(":id", $id);
    $del_catalog->execute();

    if ($del_catalog) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ลบแคตตาล็อกสำเร็จ',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='2;url=type_cook_en'>";
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
                <h3>หมวดหมู่</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">หมวดหมู่</h4>
                        <div class="btn-lang">
                            <a href="type_cook" style="background-color: #522206; color: #FFFFFF;" class="btn">TH</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mt-4">
                                <div class="mt-2" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addtype" style="background-color: #522206; color: #FFFFFF; margin-right: 5px;">เพิ่มประเภท</button>
                                    <!-- <button type="submit" class="btn" onclick="return confirm('ต้องการลบกิจกรรมทั้งหมดใช่หรือไม่?');" name="delete_all" style="background-color: #dd250c; color: #FFFFFF;">ลบทั้งหมด</button> -->
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr align="center">
                                                <!-- <th scope="col"><input type="checkbox" class="form-check-input checkbox-select" id="select_all"></th> -->
                                                <th scope="col">ชื่อหมวดหมู่</th>
                                                <th scope="col">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (array_reverse($row_type) as $row_type) { ?>
                                                <tr align="center">
                                                    <!-- <td> <input type="checkbox" class="form-check-input checkbox checkbox-select" name="ids[]" value=<?php echo $row_type['type_id'] ?>></td> -->
                                                    <td align="center" width="50%"><?php echo $row_type['type_name']; ?></td>
                                                    <td>
                                                        <a type="input" class="btn" data-bs-toggle="modal" href="#edittype<?php echo $row_type['type_id'] ?>" style="background-color:#ffc107; color: #FFFFFF;"><i class="bi bi-pencil-square"></i></a>
                                                        <!-- <button class="btn" onclick="return confirm('ต้องการลบกิจกรรมนี้ใช่หรือไม่?');" name="delete_all" style="background-color:#dd250c; color: #FFFFFF;"><i class="bi bi-trash"></i></button> -->
                                                        <button type="submit" class="btn" name="delete_type" value="<?php echo $row_type['type_id'] ?>" onclick="return confirm('ต้องการลบใช่หรือไม่?')" style="background-color:red; color: #FFFFFF;"><i class="bi bi-trash3"></i></button>
                                                    </td>
                                                </tr>


                                                <!-- Modal Edit type  -->
                                                <div class="modal fade" id="edittype<?php echo $row_type['type_id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขประเภท (TH)</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mt-2">
                                                                            <input type="hidden" name="type_id" value="<?php echo $row_type['type_id']; ?>">
                                                                            <h6>ชื่อประเภท </h6>
                                                                            <input type="text" name="type_name" class="form-control" value="<?php echo $row_type['type_name']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <button class="btn" name="edit-type-cook" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
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
                        </form>
                    </div>

                    <!-- Modal Add type  -->
                    <div class="modal fade" id="addtype" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มประเภท (TH)</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <span>ชื่อประเภท</span>
                                                <input type="text" name="type_name" class="form-control">
                                            </div>

                                        </div>
                                        <div class="mt-3">
                                            <button class="btn" name="add_type" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>




            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">แคตตาล็อก</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mt-4">
                                <div class="mt-2" style="display: flex; justify-content: flex-end;">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addcatalog" style="background-color: #522206; color: #FFFFFF; margin-right: 5px;">เพิ่มประเภท</button>
                                    <!-- <button type="submit" class="btn" onclick="return confirm('ต้องการลบกิจกรรมทั้งหมดใช่หรือไม่?');" name="delete_all" style="background-color: #dd250c; color: #FFFFFF;">ลบทั้งหมด</button> -->
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table">
                                        <thead>
                                            <tr align="center">
                                                <!-- <th scope="col"><input type="checkbox" class="form-check-input checkbox-select" id="select_all"></th> -->
                                                <th scope="col">ชื่อแคตตาล็อก</th>
                                                <th scope="col">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (array_reverse($row_catalog) as $row_catalog) { ?>
                                                <tr align="center">
                                                    <!-- <td> <input type="checkbox" class="form-check-input checkbox checkbox-select" name="ids[]" value=<?php echo $row_catalog['type_id'] ?>></td> -->
                                                    <td align="center" width="50%"><?php echo $row_catalog['catalog_name']; ?></td>
                                                    <td>
                                                        <a type="input" class="btn" data-bs-toggle="modal" href="#editcatalog<?php echo $row_catalog['id'] ?>" style="background-color:#ffc107; color: #FFFFFF;"><i class="bi bi-pencil-square"></i></a>
                                                        <!-- <button class="btn" onclick="return confirm('ต้องการลบกิจกรรมนี้ใช่หรือไม่?');" name="delete_all" style="background-color:#dd250c; color: #FFFFFF;"><i class="bi bi-trash"></i></button> -->
                                                        <button type="submit" class="btn" name="delete_catalog" value="<?php echo $row_catalog['id'] ?>" onclick="return confirm('ต้องการลบใช่หรือไม่?')" style="background-color:red; color: #FFFFFF;"><i class="bi bi-trash3"></i></button>
                                                    </td>
                                                </tr>


                                                <!-- Modal Edit type  -->
                                                <div class="modal fade" id="editcatalog<?php echo $row_catalog['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขประเภท (TH)</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <div class="row">
                                                                        <div class="col-md-12 mt-2">
                                                                            <input type="hidden" name="id" value="<?php echo $row_catalog['id']; ?>">
                                                                            <h6>ชื่อแคตตาล็อก </h6>
                                                                            <input type="text" name="catalog_name" class="form-control" value="<?php echo $row_catalog['catalog_name']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        <button class="btn" name="edit-catalog-cook" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
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
                        </form>
                    </div>


                   
                    <!-- Modal Add catalog  --> 
                    <?php
                    $select_stmt = $conn->prepare("SELECT * FROM type_cook_en");
                    $select_stmt->execute();
                    $query =  $select_stmt->fetchAll();

                    ?>
                    <div class="modal fade" id="addcatalog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มแคตตาล็อก(TH)</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <h6>ชื่อประเภท</h6>
                                                <input type="text" name="catalog_name" class="form-control">

                                                <?php
                                                $stmt = $conn->prepare("SELECT* FROM type_cook_en");
                                                $stmt->execute();
                                                $type_cook = $stmt->fetchAll();

                                                ?>

                                                <h6 for="type_name" class="col-form-label">แคตตาล็อก</h6>
                                                <select class="form-control" name="type_name" id="">
                                                    <option value="" selected disabled>Select</option>
                                                    <?php foreach ($query as $value) { ?>
                                                        <option value="<?= $value['type_id'] ?>"><?= $value['type_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn" name="add_catalog" type="submit" style="background-color: #ff962d; color: #522206;">บันทึก</button>
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

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

</body>
</html>