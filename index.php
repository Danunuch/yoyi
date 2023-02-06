<?php
require_once('webpanelcw/config/yoyi_db.php');
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}


if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$stmt = $conn->prepare("SELECT * FROM intro_content_en");
		$stmt->execute();
		$row_intro_content = $stmt->fetchAll();
	} else {
		$stmt = $conn->prepare("SELECT * FROM intro_content");
		$stmt->execute();
		$row_intro_content = $stmt->fetchAll();
	}
} else {
	$stmt = $conn->prepare("SELECT * FROM intro_content");
	$stmt->execute();
	$row_intro_content = $stmt->fetchAll();
}



if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$stmt = $conn->prepare("SELECT * FROM news_en");
		$stmt->execute();
		$row_news = $stmt->fetchAll();
	} else {
		$stmt = $conn->prepare("SELECT * FROM news");
		$stmt->execute();
		$row_news = $stmt->fetchAll();
	}
} else {
	$stmt = $conn->prepare("SELECT * FROM news");
	$stmt->execute();
	$row_news = $stmt->fetchAll();
}


if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$stmt = $conn->prepare("SELECT * FROM cook_detail_en");
		$stmt->execute();
		$row_cook_detail = $stmt->fetchAll();
	} else {
		$stmt = $conn->prepare("SELECT * FROM cook_detail");
		$stmt->execute();
		$row_cook_detail = $stmt->fetchAll();
	}
} else {
	$stmt = $conn->prepare("SELECT * FROM cook_detail");
	$stmt->execute();
	$row_cook_detail = $stmt->fetchAll();
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
		<?php include("vdo.php"); ?>

		<section id="intro-section">
			<div class="container-xxl">
				<div class="row align-items-center">
					<div class="col-md-6 order-md-2 text-md-end">
						<div class="mb-5 text-center text-md-end">
							<?php echo $row_intro_content[0]['intro'] ?>
						</div>




						<a class="rm-btn" href="about?<?php if (isset($_GET['lang'])) {
															if ($_GET['lang'] == "en") {
																echo 'lang=en';
															} else {
																echo 'lang=th';
															}
														} else {
															echo "";
														} ?>" class="btn btn-dark btn-lg px-5 "><?php if (isset($_GET['lang'])) {
																									if ($_GET['lang'] == "en") {
																										echo 'Read more';
																									} else {
																										echo 'อ่านเพิ่มเติม';
																									}
																								} else {
																									echo "อ่านเพิ่มเติม";
																								} ?></a>
						<br>

						<img class="img-fluid mb-5 drop-shadow" src="webpanelcw/uploads/upload_intro/<?php echo $row_intro_content[0]['img_cover']; ?>">

					</div>
					<div class="col-md-6 order-md-1">
						<div class="mb-5 text-center text-md-start">
							<h2><span class="text-warning"><?php echo $row_intro_content[0]['topic'] ?></h2>
						</div>





						<div class="item-philosophy text-center text-md-start">
							<div class="row align-items-center">
								<div class="col-md-3">
									<img class="img-fluid " src="upload/philosophy01.png">
								</div>
								<div class="col-md-9">
									<p><?php echo $row_intro_content[0]['content1'] ?></p>
								</div>
							</div>
						</div>



						<div class="item-philosophy text-center text-md-start">
							<div class="row align-items-center">
								<div class="col-md-3">
									<img class="img-fluid " src="upload/philosophy02.png">
								</div>
								<div class="col-md-9">
									<p><?php echo $row_intro_content[0]['content2'] ?></p>
								</div>
							</div>
						</div>



						<div class="item-philosophy text-center text-md-start">
							<div class="row align-items-center">
								<div class="col-md-3">
									<img class="img-fluid " src="upload/philosophy03.png">
								</div>
								<div class="col-md-9">
									<p><?php echo $row_intro_content[0]['content3'] ?></p>
								</div>
							</div>
						</div>






						<p class="text-info"><?php echo $row_intro_content[0]['content4'] ?></p>



					</div>
				</div>
			</div>
		</section>



		<section id="product-section">
			<div class="container-xxl">
				<div class="my-5 text-center">
					<h2><span class="text-warning"><?php if (isset($_GET['lang'])) {
														if ($_GET['lang'] == "en") {
															echo 'Our';
														} else {
															echo 'สินค้า';
														}
													} else {
														echo "สินค้า";
													} ?></span><?php if (isset($_GET['lang'])) {
																				if ($_GET['lang'] == "en") {
																					echo ' Products';
																				} else {
																					echo 'ของเรา';
																				}
																			} else {
																				echo "ของเรา";
																			} ?></h2>
				</div>
			</div>

			<div class="bg-parallax" style="background:url(images/product-section.jpg) no-repeat top center; background-size:cover;">

				<div class="container-xxl py-5">
					<div class="row justify-content-center">
						<div class="col-md-6 col-lg-4 text-end">
							<a href="product" class="btn-product"><?php if (isset($_GET['lang'])) {
																		if ($_GET['lang'] == "en") {
																			echo 'Pearl';
																		} else {
																			echo 'เม็ดไข่มุก';
																		}
																	} else {
																		echo "เม็ดไข่มุก";
																	} ?></a>
							<a class="rm-btn" href="product"><?php if (isset($_GET['lang'])) {
																	if ($_GET['lang'] == "en") {
																		echo 'Read More';
																	} else {
																		echo 'อ่านเพิ่มเติม';
																	}
																} else {
																	echo "อ่านเพิ่มเติม";
																} ?></a>
						</div>
					</div>
				</div>

			</div>
		</section>

		<section id="new-section">
			<div class="container-xxl">
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-5 text-center text-md-start">
							<h2><span class="text-warning"><?php if (isset($_GET['lang'])) {
																if ($_GET['lang'] == "en") {
																	echo 'New';
																} else {
																	echo 'ข่าว';
																}
															} else {
																echo "ข่าว";
															} ?></span><?php if (isset($_GET['lang'])) {
																					if ($_GET['lang'] == "en") {
																						echo 's';
																					} else {
																						echo 'สาร';
																					}
																				} else {
																					echo "สาร";
																				} ?></h2>
						</div>




						<?php for ($i = 0; $i <= 2; $i++) { ?>

							<a class="item-new" href="new-detail?news_id=<?php echo $row_news[$i]['id_news']; ?>&<?php if (isset($_GET['lang'])) {
																														if ($_GET['lang'] == "en") {
																															echo 'lang=en';
																														} else {
																															echo 'lang=th';
																														}
																													} else {
																														echo "";
																													} ?>">
								<div class="row align-items-center">
									<div class="col-md-3">
										<div class="img-new">
											<img class="img-fluid " src="webpanelcw/uploads/upload_news/<?php echo $row_news[$i]['img_cover']; ?>">
										</div>
									</div>
									<div class="col-md-9">
										<div class="text-new">
											<?php echo $row_news[$i]['title'] ?>
											<?php echo $row_news[$i]['content'] ?>
											
											<span class="text-warning"><?php if (isset($_GET['lang'])) {
																			if ($_GET['lang'] == "en") {
																				echo 'Read More ++';
																			} else {
																				echo 'อ่านเพิ่มเติม ++';
																			}
																		} else {
																			echo "อ่านเพิ่มเติม ++";
																		} ?></span>
										</div>
									</div>
								</div>
							</a>

						<?php } ?>



					</div>
					<div class="col-lg-6">

						<div class="mb-5 text-center text-md-start">
							<h2><span class="text-warning"><?php if (isset($_GET['lang'])) {
																			if ($_GET['lang'] == "en") {
																				echo 'Cooking';
																			} else {
																				echo 'เวลาทำ';
																			}
																		} else {
																			echo "เวลาทำ";
																		} ?></span><?php if (isset($_GET['lang'])) {
																			if ($_GET['lang'] == "en") {
																				echo ' Time';
																			} else {
																				echo 'อาหาร';
																			}
																		} else {
																			echo "อาหาร";
																		} ?></h2>
						</div>



						<div class="row">

							<?php for ($i = 1; $i <= 2; $i++) { ?>

								<div class="col-md-6">
									<a class="item-cooking" href="cooking-detail?detail_id=<?php echo $row_cook_detail[$i]['detail_id']; ?>&<?php if (isset($_GET['lang'])) {
																														if ($_GET['lang'] == "en") {
																															echo 'lang=en';
																														} else {
																															echo 'lang=th';
																														}
																													} else {
																														echo "";
																													} ?>">

										<div class="img-cooking">
											<img class="img-fluid " src="webpanelcw/uploads/upload_cooking/<?php echo $row_cook_detail[$i]['img_cover']; ?>">
										</div>

										<div class="text-cooking">
											<h4 class="text-warning"><?php echo $row_cook_detail[$i]['detail_name']; ?></h4>
											<p><?php echo $row_cook_detail[$i]['content1']; ?>
											<?php echo $row_cook_detail[$i]['content2']; ?>
											<?php echo $row_cook_detail[$i]['content3']; ?></p>
											<span class="text-warning"><?php if (isset($_GET['lang'])) {
																			if ($_GET['lang'] == "en") {
																				echo 'Read More ++';
																			} else {
																				echo 'อ่านเพิ่มเติม ++';
																			}
																		} else {
																			echo "อ่านเพิ่มเติม ++";
																		} ?></span>
										</div>

									</a>
								</div>
							<?php } ?>

						</div>


					</div>
				</div>
			</div>
		</section>

		<div class="ratio ratio-21x9">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15462.642775777771!2d100.6906684!3d14.3311312!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1bb8b9ea894b7a72!2sYo%20Yi%20Foods%20Co.%2CLtd.!5e0!3m2!1sth!2sth!4v1673338842131!5m2!1sth!2sth" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>

	</main>





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