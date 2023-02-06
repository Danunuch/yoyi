<?php
require_once('webpanelcw/config/yoyi_db.php');
error_reporting(0);
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == "en") {
        $stmt = $conn->prepare("SELECT * FROM about_en");
        $stmt->execute();
        $row_about = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $stmt = $conn->prepare("SELECT * FROM about");
        $stmt->execute();
        $row_about = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM about");
    $stmt->execute();
    $row_about = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en" class="desktop">
<head>

	<link rel="shortcut icon" href="images/favicon.ico">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=0.85">
	<meta name="description" content="Yo Yi Foods Co., Ltd.">
	<meta name="keyword" content="Yo Yi Foods Co., Ltd.">
	<meta name="author" content="Yo Yi Foods Co., Ltd.">

	<title>Yo Yi Foods Co., Ltd.</title>





	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500;600;700;800;900&display=swap">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
	<link rel="stylesheet" type="text/css" href="css/fontello.css?v=1001">
	<link rel="stylesheet" type="text/css" href="css/icofont.css?v=1001">
	<link href="css/spinner.css?v=1001" rel="stylesheet">
	<!-- CSS only -->
	<link href="css/bootstrap.min.css?v=1001" rel="stylesheet" >

	<link rel="stylesheet" href="css/coreNavigation.css?v=1001" />
	<link rel="stylesheet" href="css/typography.css?v=1001" />
	<link rel="stylesheet" href="css/custom.css?v=1001" />
	<link rel="stylesheet" href="css/header.css?v=1001" />
	<link rel="stylesheet" href="css/vdo.css?v=1001" />
	<link rel="stylesheet" href="css/intro.css?v=1001" />
	<link rel="stylesheet" href="css/product.css?v=1001" />
	<link rel="stylesheet" href="css/new.css?v=1001" />
	<link rel="stylesheet" href="css/page.css?v=1001" />


	<link rel="stylesheet" href="css/footer.css?v=1001" />
	<link href="css/slick.min.css?v=1001" rel="stylesheet">
	<link href="css/slick-custom.css?v=1001" rel="stylesheet">

</head>
<body>
	<main>

		<!-- Pre loader -->
		<div class="spinner" id="loading-body">
			<div>
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
		</div>



		<?php include("header.php");?>













		<section id="page-section" >

			<img class="img-fluid" src="images/page.png">

			<div class="container-xxl">



		


					<?php include("navigator.php");?>


					<div class="mb-5 text-center">
						<h2><span class="text-warning"><?php if (isset($_GET['lang'])) {
                                                        if ($_GET['lang'] == "en") {
                                                            echo 'About';
                                                        } else {
                                                            echo 'เกี่ยวกับ';
                                                        }
                                                    } else {
                                                        echo "เกี่ยวกับ";
                                                    } ?></span><?php if (isset($_GET['lang'])) {
                                                        if ($_GET['lang'] == "en") {
                                                            echo 'Us';
                                                        } else {
                                                            echo 'เรา';
                                                        }
                                                    } else {
                                                        echo "เรา";
                                                    } ?></h2>
					</div>






					<p><?php echo $row_about['content'] ?></p>


					<img class="img-fluid" src="webpanelcw/uploads/upload_about/<?php echo $row_about['img']; ?>">


				</div>


			</section>


		</main>





		<?php include("footer.php");?>


		<script src="js/bootstrap.bundle.min.js?v=1001"></script>
		<script src="js/jquery.min.js?v=1001"></script>
		<script src="js/coreNavigation.js?v=1001"></script>
		<script>
			$('nav').coreNavigation({
				menuPosition: "center", 
				container: true,
			responsideSlide: true, // true or false
			mode: 'sticky',
			onStartSticky: function() {
				console.log('Start Sticky');
			},
			onEndSticky: function() {
				console.log('End Sticky');
			},
			dropdownEvent: 'accordion',
			dropdownEvent: 'hover',
			onOpenDropdown: function() {
				console.log('open');
			},
			onCloseDropdown: function() {
				console.log('close');
			}
		});
	</script>

	<script type="text/javascript">

		'use strict'; 
		var $window = $(window); 
		$window.on({
			'load': function () {

				/* Preloader */ 
				$('.spinner').fadeOut(1500);



			},

		});
  function myFunctionDos() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
	</script>

	<script src="js/jquery.youtubebackground.js?v=1001"></script>

	<script type="text/javascript">

        //======= Youtube Video Background ========//
		$('.video-bg').YTPlayer({
			fitToBackground: true,
            videoId: 'Dr6JVIs6hgc'//Set Your Youtube Video ID
        });








    </script>
    <script type="text/javascript" src="js/slick.min.js?v=1001"></script>
    <script type="text/javascript" src="js/slick-custom.js?v=1001"></script>



    <script type="text/javascript" src="js/main.js?v=1001"></script>
    <!-- Vendors -->
    <script src="js/jarallax.min.js?v=1001"></script>
    <!-- Template Functions -->
    <script src="js/functions.js?v=1001"></script>

    <script  src="js/lazyload.js?v=1001"></script>
</body>
</body>
</html>