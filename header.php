<?php require_once('webpanelcw/config/yoyi_db.php');
if (!isset($_SESSION)) {
  session_start();
}

?>

<header>
  <div class="container-xxl text-end">


  </div>
  <!-- Start Navigation -->
  <nav hidden>
    <div class="nav-header">
      <a href="index.php" class="brand"><img src="images/logo.svg" / alt="Yo Yi Foods Co., Ltd."></a>
      <button class="toggle-bar">
        <span class="material-icons-sharp">
          menu
        </span>
        เมนู
      </button>
    </div>
    <ul class="menu">
      <li><a href="index<?php if(isset($_GET['lang'])){if($_GET['lang'] == "en"){echo '?lang=en';}else{echo '?lang=th';}}else{echo "";} ?>"><?php if (isset($_GET['lang'])) {
                              if ($_GET['lang'] == "en") {
                                echo "Home Page";
                              }
                              if ($_GET['lang'] == "th") {
                                echo "หน้าแรก";
                              } else {
                                echo "";
                              }
                            } else {
                              echo "หน้าแรก";
                            } ?></a></li>


      <li><a href="about<?php if(isset($_GET['lang'])){if($_GET['lang'] == "en"){echo '?lang=en';}else{echo '?lang=th';}}else{echo "";} ?>"><?php if (isset($_GET['lang'])) {
                              if ($_GET['lang'] == "en") {
                                echo "About";
                              }
                              if ($_GET['lang'] == "th") {
                                echo "เกี่ยวกับเรา";
                              } else {
                                echo "";
                              }
                            } else {
                              echo "เกี่ยวกับเรา";
                            } ?></a></li>


      <li><a href="product<?php if(isset($_GET['lang'])){if($_GET['lang'] == "en"){echo '?lang=en';}else{echo '?lang=th';}}else{echo "";} ?>"><?php if (isset($_GET['lang'])) {
                              if ($_GET['lang'] == "en") {
                                echo "Product";
                              }
                              if ($_GET['lang'] == "th") {
                                echo "สินค้า";
                              } else {
                                echo "";
                              }
                            } else {
                              echo "สินค้า";
                            } ?></a></li>
    
      <li><a href="new<?php if(isset($_GET['lang'])){if($_GET['lang'] == "en"){echo '?lang=en';}else{echo '?lang=th';}}else{echo "";} ?>"><?php if (isset($_GET['lang'])) {
                              if ($_GET['lang'] == "en") {
                                echo "News";
                              }
                              if ($_GET['lang'] == "th") {
                                echo "ข่าวสาร";
                              } else {
                                echo "";
                              }
                            } else {
                              echo "ข่าวสาร";
                            } ?></a></li>

      <li><a href="cooking<?php if(isset($_GET['lang'])){if($_GET['lang'] == "en"){echo '?lang=en';}else{echo '?lang=th';}}else{echo "";} ?>"><?php if (isset($_GET['lang'])) {
                              if ($_GET['lang'] == "en") {
                                echo "Cooking Time";
                              }
                              if ($_GET['lang'] == "th") {
                                echo "เวลาทำอาหาร";
                              } else {
                                echo "";
                              }
                            } else {
                              echo "เวลาทำอาหาร";
                            } ?></a></li>

      <li><a href="contact<?php if(isset($_GET['lang'])){if($_GET['lang'] == "en"){echo '?lang=en';}else{echo '?lang=th';}}else{echo "";} ?>"><?php if (isset($_GET['lang'])) {
                              if ($_GET['lang'] == "en") {
                                echo "Contact us";
                              }
                              if ($_GET['lang'] == "th") {
                                echo "ติดต่อเรา";
                              } else {
                                echo "";
                              }
                            } else {
                              echo "ติดต่อเรา";
                            } ?></a></li>
    </ul>

    <div class="lang">

      <a href="?lang=th" <?php
                          if (!isset($_GET['lang'])) {
                            echo "class='not_active'";
                          } else if (isset($_GET['lang'])) {
                            $lang = $_GET['lang'];
                            if ($lang == 'th') {
                              echo "class='active'";
                            } else {

                              echo "class='not_active'";
                            }
                          } ?> class="">TH</a>
      <a href="?lang=en" <?php
                          if (!isset($_GET['lang'])) {
                            echo "class='not_active'";
                          } else if (isset($_GET['lang'])) {
                            $lang = $_GET['lang'];
                            if ($lang == 'en') {
                              echo "class='active'";
                            } else {

                              echo "class='not_active'";
                            }
                          } ?> class="active">ENG</a>
    </div>
  </nav>
  <!-- End Navigation -->


</header>