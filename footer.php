<?php
require_once('webpanelcw/config/yoyi_db.php');
error_reporting(0);
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == "en") {
        $stmt = $conn->prepare("SELECT * FROM contact_en");
        $stmt->execute();
        $row_contact = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $stmt = $conn->prepare("SELECT * FROM contact");
        $stmt->execute();
        $row_contact = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM contact");
    $stmt->execute();
    $row_contact = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>






<footer>




    <section id="footer-section">
        <div class="container-xxl text-center">
            <div class="row align-items-center">



                <div class="col-md-4 order-lg-3">

                    <h2>Yo Yi Foods Co., Ltd.</h2>
                    <a class="footer-btn" href=""><?php if (isset($_GET['lang'])) {
                                                        if ($_GET['lang'] == "en") {
                                                            echo 'Contact to inquire / Request a quote';
                                                        } else {
                                                            echo 'ติดต่อสอบถาม / ขอใบเสนอราคา';
                                                        }
                                                    } else {
                                                        echo "ติดต่อสอบถาม / ขอใบเสนอราคา";
                                                    } ?></a>
                    <h4 class="text-warning"><i class="icofont-ui-dial-phone text-secondary h4"></i> <?php echo $row_contact['tel'] ?></h4>
                    <p><?php echo $row_contact['address'] ?></p>
                    <h5 class="text-warning"><i class="icofont-paper-plane text-secondary h4"></i> <?php echo $row_contact['email'] ?></h5>


                    <div class="box-social-icon ">
                        <a href="<?php echo $row_contact['facebook']; ?>" target="_blank"><i class="demo-icon icon-fi"></i></a>
                        <a href="<?php echo $row_contact['instragram']; ?>" target="_blank"><i class="demo-icon icon-ii"></i></a>
                    </div>

                </div>
                <div class="col-md-4 order-lg-2">

                    <!--   <img class="img-fluid" src="images/qr.png" alt="ยกับเราทาง Line">

                <p class="mt-4 mt-lg-0"><span class="text-warning">คุยกับเราทาง Line<br>Line ID</span> : waynebruce0808</p> -->

                </div>
                <div class="col-md-4 order-lg-1">

                    <img class="img-fluid" src="webpanelcw/uploads/upload_contact/<?php echo $row_contact['img']; ?>">

                </div>







            </div>
        </div>
    </section>




    <section id="section-copy">
        <div class="container-xxl text-center text-lg-start">

            <div class="float-none float-md-end d-inline-block">
                <div class="payment-list box-copyright">
                    <span><span class="material-icons-sharp">person</span> วันนี้ : 54</span>
                    <span><span class="material-icons-sharp">people</span> เดือนนี้ : 954</span>
                    <span><span class="material-icons-sharp">leaderboard</span> ทั้งหมด : 6972</span>

                </div>
            </div>
            <div class="float-none float-md-start d-inline-block">
                <div class="box-copyright">






                    <p class="mt-2 mt-lg-0">
                        <span>
                            <img src="images/logocw.webp" alt="บริษัทรับทำเว็บไซต์" title="บริษัทรับทำเว็บไซต์">
                        </span> Engine by <a class="text-secondary" href="http://www.cw.in.th/" title="บริษัทรับทำเว็บไซต์" target="_blank">CW</a> © 2023 By www.yoyi-foods.com All Rights Reserved
                    </p>
                </div>
            </div>



        </div>
    </section>










    <!-- Back to top -->
    <div class="back-top">
        <div class="scroll-line"></div>
        <span class="scoll-text text-uppercase">กลับขึ้นข้างบน</span>
    </div>









    <div class="left-btn">
        <div id="myDIV">
            <a href="<?php echo $row_contact['facebook']; ?>" target="_blank"><img class="img-fluid" src="images/l-icon01.png"></a>
            <a href="<?php echo $row_contact['line']; ?>" target="_blank"><img class="img-fluid" src="images/l-icon02.png"></a>
            <a href="<?php echo $row_contact['instragram']; ?>" target="_blank"><img class="img-fluid" src="images/l-icon03.png"></a>
            <a href="tel:<?php echo $row_contact['tel']; ?>" target="_blank"><img class="img-fluid" src="images/l-icon04.png"></a>
            <a href="mailto:<?php echo $row_contact['email']; ?>" target="_blank"><img class="img-fluid" src="images/l-icon05.png"></a>
        </div>


        <a onclick="myFunctionDos()"><img class="img-fluid" src="images/l-icon06.png"></a>

    </div>



</footer>