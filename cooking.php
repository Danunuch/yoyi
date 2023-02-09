<?php
require_once('webpanelcw/config/yoyi_db.php');
error_reporting(0);
if (!isset($_SESSION)) {
	session_start();
}


if (isset($_GET['detail_id'])) {
	$detail = $_GET['detail_id'];

	

	if (isset($_GET['lang'])) {
		$lang = $_GET['lang'];
		if ($lang == "en") {
			$stmt = $conn->prepare("SELECT * FROM cook_detail_en WHERE id = :id");
			$stmt->bindParam(':id', $detail);
			$stmt->execute();
			$row_cook_detail = $stmt->fetch(PDO::FETCH_ASSOC);
		} else if ($lang == "th") {
			$stmt = $conn->prepare("SELECT * FROM cook_detail WHERE id = :id");
			$stmt->bindParam(':id', $detail);
			$stmt->execute();
			$row_cook_detail = $stmt->fetch(PDO::FETCH_ASSOC);
		}
	} else {
		$stmt = $conn->prepare("SELECT * FROM cook_detail WHERE id = :id");
		$stmt->bindParam(':id', $detail);
		$stmt->execute();
		$row_cook_detail = $stmt->fetch(PDO::FETCH_ASSOC);
	}

}
//Query cook Img
if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$stmt_img = $conn->prepare("SELECT * FROM cook_detail_img_en WHERE id = :id");
		$stmt_img->bindParam(":id", $detail);
		$stmt_img->execute();
		$row_cook_img = $stmt_img->fetchAll();
	} else if ($lang == "th") {
		$stmt_img = $conn->prepare("SELECT * FROM cook_detail_img WHERE id = :id");
		$stmt_img->bindParam(":id", $detail);
		$stmt_img->execute();
		$row_cook_img = $stmt_img->fetchAll();
	}
} else {
	$stmt_img = $conn->prepare("SELECT * FROM cook_detail_img WHERE id = :id");
	$stmt_img->bindParam(":id", $detail);
	$stmt_img->execute();
	$row_cook_img = $stmt_img->fetchAll();
}

//Query type
if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$stmt = $conn->prepare("SELECT * FROM type_cook_en");
		$stmt->execute();
		$row_type_cook = $stmt->fetchAll();
	} else if ($lang == "th") {
		$stmt = $conn->prepare("SELECT * FROM type_cook");
		$stmt->execute();
		$row_type_cook = $stmt->fetchAll();
	}
} else {
	$stmt = $conn->prepare("SELECT * FROM type_cook");
	$stmt->execute();
	$row_type_cook = $stmt->fetchAll();
}


//Query sub
if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$stmt = $conn->prepare("SELECT * FROM catalog_cook_en WHERE type_id = :type_id");
		$stmt->bindParam(":type_id", $type_id);
		$stmt->execute();
		$row_catalog_cook = $stmt->fetchAll();
	} else if ($lang == "th") {
		$stmt = $conn->prepare("SELECT * FROM catalog_cook WHERE type_id = :type_id");
		$stmt->bindParam(":type_id", $type_id);
		$stmt->execute();
		$row_catalog_cook = $stmt->fetchAll();
	}
} else {
	$stmt = $conn->prepare("SELECT * FROM catalog_cook WHERE type_id = :type_id");
	$stmt->bindParam(":type_id", $type_id);
	$stmt->execute();
	$row_catalog_cook = $stmt->fetchAll();
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
	<link rel="stylesheet" href="css/category.css?v=1001" />

	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/footer.css?v=1001" />
	<link href="css/slick.min.css?v=1001" rel="stylesheet">
	<link href="css/slick-custom.css?v=1001" rel="stylesheet">

</head>
<style>
	.none {
		display: none;
	}
</style>

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






				<?php include("navigator.php"); ?>


				<div class="mb-5 text-center">
					<h2><span class="text-warning"><?php if (isset($_GET['lang'])) {
														if ($_GET['lang'] == "en") {
															echo 'Cooking';
														} else {
															echo 'เวลาทำ';
														}
													} else {
														echo "เวลาทำ";
													} ?></span> <?php if (isset($_GET['lang'])) {
																	if ($_GET['lang'] == "en") {
																		echo 'Time';
																	} else {
																		echo 'อาหาร';
																	}
																} else {
																	echo "อาหาร";
																} ?></h2>
				</div>

				<div class="row">
					<div class="col-lg-3">
						<h4 class="text-info"><?php if (isset($_GET['lang'])) {
													if ($_GET['lang'] == "en") {
														echo 'How to cook';
													} else {
														echo 'วิธีการปรุงอาหาร';
													}
												} else {
													echo "วิธีการปรุงอาหาร";
												} ?></h4>



						<div id='cssmenu'>
							<ul>

								<?php for ($i = 0; $i < count($row_type_cook); $i++) {

									if ($lang == 'en') {
										$a = $conn->prepare("SELECT * FROM catalog_cook_en WHERE type_id = :id");
										$a->bindParam(":id", $row_type_cook[$i]['type_id']);
										$a->execute();
										$row_a = $a->fetchAll();
									} else if ($lang == 'th') {
										$a = $conn->prepare("SELECT * FROM catalog_cook WHERE type_id = :id");
										$a->bindParam(":id", $row_type_cook[$i]['type_id']);
										$a->execute();
										$row_a = $a->fetchAll();
									} else {
										$a = $conn->prepare("SELECT * FROM catalog_cook WHERE type_id = :id");
										$a->bindParam(":id", $row_type_cook[$i]['type_id']);
										$a->execute();
										$row_a = $a->fetchAll();
									}

								?>


									<li class='active has-sub'><a href='#'><?php echo $row_type_cook[$i]['type_name']; ?></a>
										<ul>
											<?php for ($j = 0; $j < count($row_a); $j++) {

												if (isset($_GET['catasub_id'])) {
													$catalog = $_GET['catasub_id'];
													if ($lang == "en") {
														$stmt = $conn->prepare("SELECT * FROM catalog_cook_en WHERE id = :id");
														$stmt->bindParam(":id", $catalog);
														$stmt->execute();
														$row_catalog_cook = $stmt->fetchAll();
													} else if ($lang == "th") {
														$stmt = $conn->prepare("SELECT * FROM catalog_cook WHERE id = :id");
														$stmt->bindParam(":id", $catalog);
														$stmt->execute();
														$row_catalog_cook = $stmt->fetchAll();
													} else {
														$stmt = $conn->prepare("SELECT * FROM catalog_cook WHERE id = :id");
														$stmt->bindParam(":id", $catalog);
														$stmt->execute();
														$row_catalog_cook = $stmt->fetchAll();
													}
												} else if (!isset($_GET['catasub_id']) && isset($_GET['lang'])) {
													if ($_GET['lang'] == "en") {
														$stmt = $conn->prepare("SELECT * FROM catalog_cook_en ");
														$stmt->execute();
														$row_catalog_cook = $stmt->fetchAll();
													} else if ($_GET['lang'] == "th") {
														$stmt = $conn->prepare("SELECT * FROM catalog_cook ");
														$stmt->execute();
														$row_catalog_cook = $stmt->fetchAll();
													}
												} else {
													$stmt = $conn->prepare("SELECT * FROM catalog_cook ");
													$stmt->execute();
													$row_catalog_cook = $stmt->fetchAll();
												}

											?>

												<li><a href='cooking?detail_id=<?php echo $row_a[$j]['id'] ?><?php if (isset($_GET['lang'])) {
																													if ($_GET['lang'] == "en") {
																														echo '&lang=en';
																													} else {
																														echo '&lang=th';
																													}
																												} else {
																													echo "";
																												} ?>'><?php echo $row_a[$j]['catalog_name']; ?></a></li>
											<?php } ?>
										</ul>

									</li>

								<?php } ?>
							</ul>
						</div>





					</div>
					<div class="col-lg-9">
						<h4 class="text-info" ><?php echo $row_cook_detail['detail_name']; ?></h4>
						<div class="row mb-4">


							<?php for ($i = 0; $i < count($row_cook_img); $i++) { ?>
								<div class="col-6 col-md-4">
									<div class="view-seventh mb-4">
										<a href="webpanelcw/uploads/upload_cooking/<?php echo $row_cook_img[$i]['img']; ?>" class="b-link-stripe b-animate-go thickbox" title="ชาเขียวไข่มุก">
											<div class="box-gallery">
												<div class="bg-img">
													<img class="img-fluid" src="webpanelcw/uploads/upload_cooking/<?php echo $row_cook_img[$i]['img']; ?>" alt="ชาเขียวไข่มุก">
												</div>

											</div>
										</a>
									</div>
								</div>
							<?php } ?>

						</div>


						<div class="cooking-ol">
							<ol>
								<li <?php if ($row_cook_detail['content1'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content1']; ?></li>


								<li <?php if ($row_cook_detail['content2'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content2']; ?></li>


								<li <?php if ($row_cook_detail['content3'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content3']; ?></li>


								<li <?php if ($row_cook_detail['content4'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content4']; ?></li>

								<li <?php if ($row_cook_detail['content5'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content5']; ?></li>

								<li <?php if ($row_cook_detail['content6'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content6']; ?></li>

								<li <?php if ($row_cook_detail['content7'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content7']; ?></li>

								<li <?php if ($row_cook_detail['content8'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content8']; ?></li>

								<li <?php if ($row_cook_detail['content9'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content9']; ?></li>

								<li <?php if ($row_cook_detail['content10'] == "") {
										echo "style='display:none;'";
									} else {
										echo "";
									} ?>><?php echo $row_cook_detail['content10']; ?></li>

							</ol>
						</div>
					</div>
				</div>
			</div>
		</section>
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
	<script src="js/category.js?v=1001"></script>

	<script src="js/lazyload.js?v=1001"></script>


	<script src="js/jquery.chocolat.js"></script>
	<script type="text/javascript">
		$(function() {
			$('.view-seventh a').Chocolat();
			$('.view-seventh2 a').Chocolat();
			$('.view-seventh3 a').Chocolat();
		});
	</script>

</body>
</body>

</html>