<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('webpanelcw/config/yoyi_db.php');
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}

// error_reporting(0);


$secret = "6Lep9WYkAAAAAOl7o3Vd8zzS-8kl-s7nX-0tE8DG";


if (isset($_POST['g-recaptcha-response'])) {

	$captcha = $_POST['g-recaptcha-response'];
	$veifyResponse = file_get_contents('https://google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
	$responseData = json_decode($veifyResponse);

	if (!$captcha) {

		echo "<script>alert('คุณไม่ได้ป้อน reCAPTCHA อย่างถูกต้อง')</script>";
	}

	if (isset($_POST['submit']) && $responseData->success) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$message = $_POST['message'];



		if (empty($name)) {
			echo "<script>alert('Please Enter Name')</script>";
		} else if (empty($email)) {
			echo "<script>alert('Please Enter Email')</script>";
		} else if (empty($message)) {
			echo "<script>alert('Please Enter Message')</script>";
		} else if (empty($tel)) {
			echo "<script>alert('Please Enter Tel')</script>";
		} else {
			try {
				$send_message = $conn->prepare("INSERT INTO message(name,email,tel,message) VALUES(:name,:email,:message ,:tel)");
				$send_message->bindParam(":name", $name);
				$send_message->bindParam(":email", $email);
				$send_message->bindParam(":tel", $tel);
				$send_message->bindParam(":message", $message);
				$send_message->bindParam(":tel", $tel);
				$send_message->execute();

				if ($send_message) {
					echo "<script>
          $(document).ready(function() {
              Swal.fire({
                  text: 'Send Message Success',
                  icon: 'success',
                  timer: 10000,
                  showConfirmButton: false
              });
          })
          </script>";
					echo "<meta http-equiv='refresh' content='1;url=contact'>";
				} else {
					echo "<script>
          $(document).ready(function() {
              Swal.fire({
                  text: 'Something Went Wrong',
                  icon: 'error',
                  timer: 10000,
                  showConfirmButton: false
              });
          })
          </script>";
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}



if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$message = $conn->prepare("SELECT * FROM message");
		$message->execute();
		$row_message = $message->fetch(PDO::FETCH_ASSOC);
	} else if ($lang == "cn") {
		$message = $conn->prepare("SELECT * FROM message");
		$message->execute();
		$row_message = $message->fetch(PDO::FETCH_ASSOC);
	} else {
		$message = $conn->prepare("SELECT * FROM message");
		$message->execute();
		$row_message = $message->fetch(PDO::FETCH_ASSOC);
	}
} else {
	$message = $conn->prepare("SELECT * FROM message");
	$message->execute();
	$row_message = $message->fetch(PDO::FETCH_ASSOC);
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
	<link href="css/bootstrap.min.css?v=1001" rel="stylesheet">

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



		<?php include("header.php"); ?>













		<section id="page-section">

			<img class="img-fluid" src="images/page.png">

			<div class="container-xxl">



				<div class="pb-5">


					<?php include("navigator.php"); ?>


					<div class="mb-5 text-center">
						<h2><span class="text-warning"><?php if (isset($_GET['lang'])) {
															if ($_GET['lang'] == "en") {
																echo 'Contact';
															} else {
																echo 'ติดต่อ';
															}
														} else {
															echo "ติดต่อ";
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











					<form id="form_message" method="post"  enctype="multipart/form-data">
						<input type="hidden" name="_token" value="CuWWbZneZurP9giDfyM1iIKn0uHmfoXbkD1dQnhM">
						<div class="row">

							<div class="col-lg-4">
								<div class="form-group mb-4">
									<input type="text" class="form-control" id="text" name="name" placeholder="<?php if (isset($_GET['lang'])) {
																													if ($_GET['lang'] == "en") {
																														echo 'Fill in your name - surname';
																													} else {
																														echo 'กรอกชื่อ-นามสกุล';
																													}
																												} else {
																													echo "กรอกชื่อ-นามสกุล";
																												} ?>">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group mb-4">
									<input type="email" class="form-control" id="text" name="email" placeholder="<?php if (isset($_GET['lang'])) {
																													if ($_GET['lang'] == "en") {
																														echo 'Enter email';
																													} else {
																														echo 'กรอกอีเมล';
																													}
																												} else {
																													echo "กรอกอีเมล";
																												} ?>">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group mb-4">
									<input type="text" class="form-control" id="text" name="tel" placeholder="<?php if (isset($_GET['lang'])) {
																													if ($_GET['lang'] == "en") {
																														echo 'Fill in phone number';
																													} else {
																														echo 'กรอกเบอร์โทร';
																													}
																												} else {
																													echo "กรอกเบอร์โทร";
																												} ?>" onkeypress="validate(event)" maxlength="10">
								</div>
							</div>


							<div class="col-lg-12">
								<div class="form-group mb-4">
									<textarea class="form-control" rows="5" id="comment" name="message" placeholder="<?php if (isset($_GET['lang'])) {
																													if ($_GET['lang'] == "en") {
																														echo 'Enter additional text.';
																													} else {
																														echo 'กรอกข้อความเพิ่มเติม';
																													}
																												} else {
																													echo "กรอกข้อความเพิ่มเติม";
																												} ?>"></textarea>
								</div>
							</div>

						</div>


						<div class="text-center">
							<div class="g-recaptcha" data-sitekey="6Lep9WYkAAAAANUhiMya34_HRLreMhAsalzygz0V" style="display: flex;justify-content: center;"></div>
							<div class="clearfix"></div>
							<button type="submit" name="submit" class="btn btn-warning btn-lg mt-4 px-5 rounded-0">
								<span class="material-icons-sharp">
									send
								</span>

								<?php if (isset($_GET['lang'])) {
									if ($_GET['lang'] == "en") {
										echo 'Send a message';
									} else {
										echo 'ส่งข้อความ';
									}
								} else {
									echo "ส่งข้อความ";
								} ?></button>
						</div>
					</form>



				</div>


		</section>

		<div class="ratio ratio-21x9">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15462.642775777771!2d100.6906684!3d14.3311312!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1bb8b9ea894b7a72!2sYo%20Yi%20Foods%20Co.%2CLtd.!5e0!3m2!1sth!2sth!4v1673338842131!5m2!1sth!2sth" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>

	</main>


	<script src="https://www.google.com/recaptcha/api.js" async defer></script>


	<?php include("footer.php"); ?>


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
			'load': function() {

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
			videoId: 'Dr6JVIs6hgc' //Set Your Youtube Video ID
		});
	</script>
	<script type="text/javascript" src="js/slick.min.js?v=1001"></script>
	<script type="text/javascript" src="js/slick-custom.js?v=1001"></script>



	<script type="text/javascript" src="js/main.js?v=1001"></script>
	<!-- Vendors -->
	<script src="js/jarallax.min.js?v=1001"></script>
	<!-- Template Functions -->
	<script src="js/functions.js?v=1001"></script>

	<script src="js/lazyload.js?v=1001"></script>
</body>
</body>

</html>