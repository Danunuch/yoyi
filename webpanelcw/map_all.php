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

//add map
if (isset($_POST['add_map'])) {
    $name = $_POST['name'];

    if (empty($name)) {
        echo "<script>alert('กรุณากรอกชื่อชั้น')</script>";
    } else {
        try {
            $insert_map = $conn->prepare("INSERT INTO master_map(name) VALUES(:name)");
            $insert_map->bindParam(":name", $name);
            $insert_map->execute();

            if ($insert_map) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        text: 'เพิ่มชั้นหลักสำเร็จ',
                        icon: 'success',
                        timer: 10000,
                        showConfirmButton: false
                    });
                })
                </script>";
                echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

//edit map
if (isset($_POST['edit_map'])) {
    $id_map = $_POST['id_map'];
    $name = $_POST['name'];

    $update_map = $conn->prepare("UPDATE master_map SET name = :name WHERE id = :id");
    $update_map->bindParam(":name", $name);
    $update_map->bindParam(":id", $id_map);
    $update_map->execute();

    if ($update_map) {
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
        echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
    }
}


//del main map
if (isset($_POST['del_mainmap'])) {
    $id_map = $_POST['del_mainmap'];

    $del_main = $conn->prepare("DELETE FROM master_map WHERE id = :id");
    $del_main->bindParam(":id", $id_map);
    $del_main->execute();

    if ($del_main) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ลบชั้นหลักสำเร็จ',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
    }
}

//del store
if (isset($_POST['del_store'])) {
    $id_store = $_POST['del_store'];

    $del_store = $conn->prepare("DELETE FROM store WHERE id = :id");
    $del_store->bindParam(":id", $id_store);
    $del_store->execute();

    if ($del_store) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'ลบร้านสำเร็จ',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
        echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
    }
}

//addres
if (isset($_POST['add_res'])) {
    $id_master_map = $_POST['master_map'];
    $name_res = $_POST['name_res'];
    $img1 = $_FILES['img1'];
    $img2 = $_FILES['img2'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $fax = $_POST['fax'];
    $tmp_img = "";

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention2 = explode(".", $img2['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt2 = strtolower(end($extention2)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $fileNew2 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_store/" . $fileNew1;
    $filePath2 = "uploads/upload_store/" . $fileNew2;

    if (empty($name_res)) {
        echo "<script>alert('กรุณากรอกชื่อร้าน')</script>";
    } else if (empty($date)) {
        echo "<script>alert('กรุณากรอกวันเปิด - ปิด')</script>";
    } else if (empty($time)) {
        echo "<script>alert('กรุณากรอกเวลาเปิด - ปิด')</script>";
    } else if (empty($email)) {
        echo "<script>alert('กรุณากรอกอีเมล')</script>";
    } else if (empty($phone)) {
        echo "<script>alert('กรุณากรอกโทรศัพท์')</script>";
    } else {
        try {
            if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2)) {
                        $insert_store = $conn->prepare("INSERT INTO store(name_store,img1,img2,content,date,time,email,phone,fax,master_map) 
                        VALUES(:name_store, :img1, :img2, :content, :date, :time, :email, :phone, :fax, :master_map)");
                        $insert_store->bindParam(":name_store", $name_res);
                        $insert_store->bindParam(":img1", $fileNew1);
                        $insert_store->bindParam(":img2", $fileNew2);
                        $insert_store->bindParam(":content", $content);
                        $insert_store->bindParam(":date", $date);
                        $insert_store->bindParam(":time", $time);
                        $insert_store->bindParam(":email", $email);
                        $insert_store->bindParam(":phone", $phone);
                        $insert_store->bindParam(":fax", $fax);
                        $insert_store->bindParam(":master_map", $id_master_map);
                        $insert_store->execute();

                        if ($insert_store) {
                            echo "<script>
                                    $(document).ready(function() {
                                    Swal.fire({
                                    text: 'เพิ่มร้านสำเร็จแล้ว',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                    });
                                    })
                                </script>";
                            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
                        }
                    }
                }
            } else  if (in_array($fileActExt1, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                        $insert_store = $conn->prepare("INSERT INTO store(name_store,img1,img2,content,date,time,email,phone,fax,master_map) 
                        VALUES(:name_store, :img1, :img2, :content, :date, :time, :email, :phone, :fax, :master_map)");
                        $insert_store->bindParam(":name_store", $name_res);
                        $insert_store->bindParam(":img1", $fileNew1);
                        $insert_store->bindParam(":img2", $tmp_img);
                        $insert_store->bindParam(":content", $content);
                        $insert_store->bindParam(":date", $date);
                        $insert_store->bindParam(":time", $time);
                        $insert_store->bindParam(":email", $email);
                        $insert_store->bindParam(":phone", $phone);
                        $insert_store->bindParam(":fax", $fax);
                        $insert_store->bindParam(":master_map", $id_master_map);
                        $insert_store->execute();

                        if ($insert_store) {
                            echo "<script>
                                    $(document).ready(function() {
                                    Swal.fire({
                                    text: 'เพิ่มร้านสำเร็จแล้ว',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                    });
                                    })
                                </script>";
                            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
                        }
                    }
                }
            } else if (in_array($fileActExt2, $allow)) {
                if ($img2['size'] > 0 && $img2['error'] == 0) {
                    if (move_uploaded_file($img2['tmp_name'], $filePath2)) {
                        $insert_store = $conn->prepare("INSERT INTO store(name_store,img1,img2,content,date,time,email,phone,fax,master_map) 
                        VALUES(:name_store, :img1, :img2, :content, :date, :time, :email, :phone, :fax, :master_map)");
                        $insert_store->bindParam(":name_store", $name_res);
                        $insert_store->bindParam(":img1", $tmp_img);
                        $insert_store->bindParam(":img2", $fileNew2);
                        $insert_store->bindParam(":content", $content);
                        $insert_store->bindParam(":date", $date);
                        $insert_store->bindParam(":time", $time);
                        $insert_store->bindParam(":email", $email);
                        $insert_store->bindParam(":phone", $phone);
                        $insert_store->bindParam(":fax", $fax);
                        $insert_store->bindParam(":master_map", $id_master_map);
                        $insert_store->execute();

                        if ($insert_store) {
                            echo "<script>
                                    $(document).ready(function() {
                                    Swal.fire({
                                    text: 'เพิ่มร้านสำเร็จแล้ว',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                    });
                                    })
                                </script>";
                            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
                        }
                    }
                }
            } else {
                $insert_store = $conn->prepare("INSERT INTO store(name_store,img1,img2,content,date,time,email,phone,fax,master_map) 
                VALUES(:name_store, :img1, :img2, :content, :date, :time, :email, :phone, :fax, :master_map)");
                $insert_store->bindParam(":name_store", $name_res);
                $insert_store->bindParam(":img1", $tmp_img);
                $insert_store->bindParam(":img2", $tmp_img);
                $insert_store->bindParam(":content", $content);
                $insert_store->bindParam(":date", $date);
                $insert_store->bindParam(":time", $time);
                $insert_store->bindParam(":email", $email);
                $insert_store->bindParam(":phone", $phone);
                $insert_store->bindParam(":fax", $fax);
                $insert_store->bindParam(":master_map", $id_master_map);
                $insert_store->execute();

                if ($insert_store) {
                    echo "<script>
                            $(document).ready(function() {
                            Swal.fire({
                            text: 'เพิ่มร้านสำเร็จแล้ว',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                            });
                            })
                        </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


//editres
if (isset($_POST['edit_res'])) {
    $id_res = $_POST['id_res'];
    $id_master_map = $_POST['master_map'];
    $name_res = $_POST['name_res'];
    $img1 = $_FILES['img1'];
    $img2 = $_FILES['img2'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $fax = $_POST['fax'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention2 = explode(".", $img2['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt2 = strtolower(end($extention2)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $fileNew2 = rand() . "." . "webp";
    $filePath1 = "uploads/upload_store/" . $fileNew1;
    $filePath2 = "uploads/upload_store/" . $fileNew2;

    if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2)) {
                $update_store = $conn->prepare("UPDATE store SET name_store = :name_store,img1 = :img1,img2 = :img2,content = :content,date = :date,time = :time,
                                    email = :email,phone = :phone,fax = :fax,master_map = :master_map WHERE id = :id");

                $update_store->bindParam(":name_store", $name_res);
                $update_store->bindParam(":img1", $fileNew1);
                $update_store->bindParam(":img2", $fileNew2);
                $update_store->bindParam(":content", $content);
                $update_store->bindParam(":date", $date);
                $update_store->bindParam(":time", $time);
                $update_store->bindParam(":email", $email);
                $update_store->bindParam(":phone", $phone);
                $update_store->bindParam(":fax", $fax);
                $update_store->bindParam(":master_map", $id_master_map);
                $update_store->bindParam(":id", $id_res);
                $update_store->execute();

                if ($update_store) {
                    echo "<script>
                                    $(document).ready(function() {
                                    Swal.fire({
                                    text: 'แก้ไขข้อมูลร้านสำเร็จแล้ว',
                                    icon: 'success',
                                    timer: 10000,
                                    showConfirmButton: false
                                    });
                                    })
                                </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
                }
            }
        }
    } else  if (in_array($fileActExt1, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                $update_store = $conn->prepare("UPDATE store SET name_store = :name_store,img1 = :img1,content = :content,date = :date,time = :time,
                email = :email,phone = :phone,fax = :fax,master_map = :master_map WHERE id = :id");

                $update_store->bindParam(":name_store", $name_res);
                $update_store->bindParam(":img1", $fileNew1);
                $update_store->bindParam(":content", $content);
                $update_store->bindParam(":date", $date);
                $update_store->bindParam(":time", $time);
                $update_store->bindParam(":email", $email);
                $update_store->bindParam(":phone", $phone);
                $update_store->bindParam(":fax", $fax);
                $update_store->bindParam(":master_map", $id_master_map);
                $update_store->bindParam(":id", $id_res);
                $update_store->execute();

                if ($update_store) {
                    echo "<script>
                $(document).ready(function() {
                Swal.fire({
                text: 'แก้ไขข้อมูลร้านสำเร็จแล้ว',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
                });
                })
            </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
                }
            }
        }
    } else if (in_array($fileActExt2, $allow)) {
        if ($img2['size'] > 0 && $img2['error'] == 0) {
            if (move_uploaded_file($img2['tmp_name'], $filePath2)) {
                $update_store = $conn->prepare("UPDATE store SET name_store = :name_store,img2 = :img2,content = :content,date = :date,time = :time,
                email = :email,phone = :phone,fax = :fax,master_map = :master_map WHERE id = :id");

                $update_store->bindParam(":name_store", $name_res);
                $update_store->bindParam(":img2", $fileNew2);
                $update_store->bindParam(":content", $content);
                $update_store->bindParam(":date", $date);
                $update_store->bindParam(":time", $time);
                $update_store->bindParam(":email", $email);
                $update_store->bindParam(":phone", $phone);
                $update_store->bindParam(":fax", $fax);
                $update_store->bindParam(":master_map", $id_master_map);
                $update_store->bindParam(":id", $id_res);
                $update_store->execute();

                if ($update_store) {
                    echo "<script>
                $(document).ready(function() {
                Swal.fire({
                text: 'แก้ไขข้อมูลร้านสำเร็จแล้ว',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
                });
                })
            </script>";
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
                    echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
                }
            }
        }
    } else {
        $update_store = $conn->prepare("UPDATE store SET name_store = :name_store,content = :content,date = :date,time = :time,
        email = :email,phone = :phone,fax = :fax,master_map = :master_map WHERE id = :id");

        $update_store->bindParam(":name_store", $name_res);
        $update_store->bindParam(":content", $content);
        $update_store->bindParam(":date", $date);
        $update_store->bindParam(":time", $time);
        $update_store->bindParam(":email", $email);
        $update_store->bindParam(":phone", $phone);
        $update_store->bindParam(":fax", $fax);
        $update_store->bindParam(":master_map", $id_master_map);
        $update_store->bindParam(":id", $id_res);
        $update_store->execute();

        if ($update_store) {
            echo "<script>
        $(document).ready(function() {
        Swal.fire({
        text: 'แก้ไขข้อมูลร้านสำเร็จแล้ว',
        icon: 'success',
        timer: 10000,
        showConfirmButton: false
        });
        })
    </script>";
            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
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
            echo "<meta http-equiv='refresh' content='1.5;url=map_all'>";
        }
    }
}

//query master map
$master_map = $conn->prepare("SELECT * FROM master_map");
$master_map->execute();
$row_master_map = $master_map->fetchAll();

//query store
$store = $conn->prepare("SELECT * FROM store");
$store->execute();
$row_store = $store->fetchAll();
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
    <link rel="stylesheet" href="css/map.css?v=<?php echo time();  ?>">
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
                <h3>แผนผัง</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">แผนผังทั้งหมด (ชั้น) </h4>
                        <div class="btn-lang">
                            <a href="map_all_en" style="background-color: #DB4834; color: #FFFFFF;" class="btn">EN</a>
                        </div>


                    </div>
                    <div class="card-body">
                        <div class="mt-4">
                            <div class="mt-2" style="display: flex; justify-content: flex-end;">
                                <!-- <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addmap" style="background-color: #524340; color: #FFFFFF; margin-right: 5px;">เพิ่มชั้นหลัก</button> -->
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addrestaurant" style="background-color: #524340; color: #FFFFFF; margin-right: 5px;">เพิ่มร้าน</button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="d-flex">
                                        <h5>ชั้นหลัก</h5>
                                        <span>&nbsp; (คลิกชื่อชั้นเพื่อแก้ไข)</span>
                                    </div>
                                    <div class="pos">
                                        <?php
                                        for ($i = 0; $i < count($row_master_map); $i++) { ?>
                                            <div class="main-bax-res">
                                                <button class="btn box-master" data-bs-toggle="modal" data-bs-target="#editmap<?php echo $row_master_map[$i]['id'] ?>">
                                                    <span><?php echo $row_master_map[$i]['name'] ?></span>
                                                </button>
                                                <form method="post">
                                                    <button class="btn btn-del-main" type="submit" name="del_mainmap" value="<?php echo $row_master_map[$i]['id'] ?>" onclick="return confirm('ต้องการลบชั้นนี้ใช่หรือไม่');">ลบ</button>
                                                </form>
                                            </div>

                                            <!-- Modal Edit Master map  -->
                                            <div class="modal fade" id="editmap<?php echo $row_master_map[$i]['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                แก้ไขข้อมูลชั้น<?php echo $row_master_map[$i]['name'] ?>
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post">

                                                                <div class="row">
                                                                    <div class="col-md-12 mt-2">
                                                                        <span>ชื่อชั้น</span>
                                                                        <input type="hidden" name="id_map" value="<?php echo $row_master_map[$i]['id'] ?>">
                                                                        <input type="text" name="name" value="<?php echo $row_master_map[$i]['name'] ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <button class="btn" name="edit_map" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php   }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Store -->
                        <div class="mt-5">

                            <div class="d-flex">
                                <h5>ร้าน</h5>
                                <span>&nbsp; (คลิกชื่อร้านเพื่อแก้ไข)</span>
                            </div>


                            <div class="pos">
                                <?php
                                for ($i = 0; $i < count($row_store); $i++) { ?>
                                    <div class="main-bax-res">
                                        <button class="btn box-master-store" data-bs-toggle="modal" data-bs-target="#editrestaurant<?php echo $row_store[$i]['id'] ?>">
                                            <span><?php echo $row_store[$i]['name_store'] ?></span>
                                        </button>
                                        <form method="post">
                                            <button class="btn btn-del-main" type="submit" name="del_store" value="<?php echo $row_store[$i]['id'] ?>" onclick="return confirm('ต้องการลบร้านนี้ใช่หรือไม่');">ลบ</button>
                                        </form>
                                    </div>
                                    <!-- Modal Edit restaurant  -->
                                    <div class="modal fade" id="editrestaurant<?php echo $row_store[$i]['id']  ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขร้าน</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <span>ชั้น</span><span style="color: #DB4834;">*</span>
                                                                <select class="form-select" name="master_map">
                                                                    <option selected value="<?php echo $row_store[$i]['master_map'] ?>">
                                                                        <?php echo $row_store[$i]['master_map'] ?></option>
                                                                    <?php
                                                                    for ($j = 0; $j < count($row_master_map); $j++) { ?>
                                                                        <option value="<?php echo $row_master_map[$j]['name'] ?>">
                                                                            <?php echo $row_master_map[$j]['name'] ?></option>
                                                                    <?php  }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="id_res" value="<?php echo $row_store[$i]['id'] ?>">
                                                                <span>ชื่อร้าน</span><span style="color: #DB4834;">*</span>
                                                                <input type="text" name="name_res" value="<?php echo $row_store[$i]['name_store'] ?>" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>ภาพหน้าร้าน</span><span style="color: #DB4834;">*</span>
                                                                <input type="file" name="img1" id="img1" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>พรีวิวภาพหน้าร้าน</span>
                                                                <div id="gallery d-flex justify-content-center align-item-center">
                                                                    <img width="50%" id="previewImg1" src="uploads/upload_store/<?php echo $row_store[$i]['img1'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>ภาพแผนผัง</span><span style="color: #DB4834;">*</span>
                                                                <input type="file" name="img2" id="img2" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>พรีวิวแผนผัง</span>
                                                                <div id="gallery d-flex justify-content-center align-item-center">
                                                                    <img width="50%" id="previewImg2" src="uploads/upload_store/<?php echo $row_store[$i]['img2'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <span>เนื้อหา</span><span style="color: #DB4834;">*</span>
                                                                <textarea name="content"><?php echo $row_store[$i]['content'] ?></textarea>
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>วันเปิด - ปิด</span><span style="color: #DB4834;">*</span>
                                                                <input type="text" name="date" value="<?php echo $row_store[$i]['date'] ?>" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>เวลาเปิด - ปิด</span><span style="color: #DB4834;">*</span>
                                                                <input type="text" name="time" value="<?php echo $row_store[$i]['time'] ?>" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>อีเมล</span><span style="color: #DB4834;">*</span>
                                                                <input type="text" name="email" value="<?php echo $row_store[$i]['email'] ?>" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>โทรศัพท์</span><span style="color: #DB4834;">*</span>
                                                                <input type="text" name="phone" value="<?php echo $row_store[$i]['phone'] ?>" class="form-control">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <span>Fax</span>
                                                                <input type="text" name="fax" value="<?php echo $row_store[$i]['fax'] ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <button class="btn" name="edit_res" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php   }
                                ?>
                            </div>
                        </div>

                        <!-- Modal Add Master map  -->
                        <div class="modal fade" id="addmap" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มชั้นหลัก</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post">

                                            <div class="row">
                                                <div class="col-md-12 mt-2">
                                                    <span>ชื่อชั้น</span>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button class="btn" name="add_map" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
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
                                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr
                                        .status);
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


                        <!-- Modal Add restaurant  -->
                        <div class="modal fade" id="addrestaurant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มร้าน</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span>ชั้น</span><span style="color: #DB4834;">*</span>
                                                    <select class="form-select" name="master_map">
                                                        <option selected disabled>กรุณาเลือกชั้น</option>
                                                        <?php
                                                        for ($i = 0; $i < count($row_master_map); $i++) { ?>
                                                            <option value="<?php echo $row_master_map[$i]['name'] ?>">
                                                                <?php echo $row_master_map[$i]['name'] ?></option>
                                                        <?php  }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>ชื่อร้าน</span><span style="color: #DB4834;">*</span>
                                                    <input type="text" name="name_res" class="form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>ภาพหน้าร้าน</span><span style="color: #DB4834;">*</span>
                                                    <input type="file" name="img1" id="img1_add" class="form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>พรีวิวภาพหน้าร้าน</span>
                                                    <div id="gallery d-flex justify-content-center align-item-center">
                                                        <img width="50%" id="previewImg1_add">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>ภาพแผนผัง</span><span style="color: #DB4834;">*</span>
                                                    <input type="file" name="img2" id="img2_add" class="form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>พรีวิวแผนผัง</span>
                                                    <div id="gallery d-flex justify-content-center align-item-center">
                                                        <img width="50%" id="previewImg2_add">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <span>เนื้อหา</span><span style="color: #DB4834;">*</span>
                                                    <textarea name="content"></textarea>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>วันเปิด - ปิด</span><span style="color: #DB4834;">*</span>
                                                    <input type="text" name="date" class="form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>เวลาเปิด - ปิด</span><span style="color: #DB4834;">*</span>
                                                    <input type="text" name="time" class="form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>อีเมล</span><span style="color: #DB4834;">*</span>
                                                    <input type="text" name="email" class="form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>โทรศัพท์</span><span style="color: #DB4834;">*</span>
                                                    <input type="text" name="phone" class="form-control">
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <span>Fax</span>
                                                    <input type="text" name="fax" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button class="btn" name="add_res" type="submit" style="background-color: #DB4834; color: #FFFFFF;">บันทึก</button>
                                            </div>
                                        </form>
                                    </div>

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
        let imgInput1 = document.getElementById('img1');
        let previewImg1 = document.getElementById('previewImg1');
        let imgInput2 = document.getElementById('img2');
        let previewImg2 = document.getElementById('previewImg2');
        let imgInput1_add = document.getElementById('img1_add');
        let previewImg1_add = document.getElementById('previewImg1_add');
        let imgInput2_add = document.getElementById('img2_add');
        let previewImg2_add = document.getElementById('previewImg2_add');

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
        imgInput1_add.onchange = evt => {
            const [file] = imgInput1_add.files;
            if (file) {
                previewImg1_add.src = URL.createObjectURL(file);
            }
        }
        imgInput2_add.onchange = evt => {
            const [file] = imgInput2_add.files;
            if (file) {
                previewImg2_add.src = URL.createObjectURL(file);
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