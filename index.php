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
		<?php include("vdo.php");?>

		<section id="intro-section">
			<div class="container-xxl">
				<div class="row align-items-center">
					<div class="col-md-6 order-md-2 text-md-end">
						<div class="mb-5 text-center text-md-end">
							<h1><span class="text-warning">Yo Yi</span> Foods Co., Ltd.</h1>
						</div>
						<p class="text-info">Our specialized in the production of natural , healthy<br>
							and delicious tapioca pearls.<br>
							Yo Yi Foods is specialized in the production of natural<br>
						healthy and delicious tapioca pearls.</p>



						<a class="rm-btn" href="about.php">Read More</a>
						<br>

						<img class="img-fluid mb-5 drop-shadow" src="images/intro.png">

					</div>
					<div class="col-md-6 order-md-1">
						<div class="mb-5 text-center text-md-start">
							<h2><span class="text-warning">Our</span> Philosophy</h2>
						</div>




						<?php $Philosophy = array ( 
							'1'=>"Aim to develop a superior brand and<br>pursue the highest quality.", 
							'2'=>"Raise awareness about food safety<br>and hygiene for all our customers.", 
							'3'=>"Supply natural , safe , healthy and<br>delicious tapioca products."
						); ?>
						<?php for($i=1;$i<=3;$i++){ ?> 

							<div class="item-philosophy text-center text-md-start">


								<div class="row align-items-center">

									<div class="col-md-3">
										<img class="img-fluid " src="upload/philosophy0<?=$i?>.png">
									</div>
									<div class="col-md-9">
										<p><?= $Philosophy[$i] ?></p>
									</div>

								</div>

							</div>

						<?php } ?>




						<p class="text-info">We are ISO 22000, HACCP, GHP and HALAL certificated, Which
						proves the high quality and consistency of our products.</p>



					</div>
				</div>
			</div>
		</section>
		


		<section id="product-section">
			<div class="container-xxl">
				<div class="my-5 text-center">
					<h2><span class="text-warning">สินค้า</span>ของเรา</h2>
				</div>
			</div>

			<div class="bg-parallax" style="background:url(images/product-section.jpg) no-repeat top center; background-size:cover;">
				
				<div class="container-xxl py-5">
					<div class="row justify-content-center">
						<div class="col-md-6 col-lg-4 text-end">
							<a href="product.php" class="btn-product">เม็ดไข่มุก</a>
							<a class="rm-btn" href="product.php">Read More</a>
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
							<h2><span class="text-warning">ข่าว</span>สาร</h2>
						</div>


						<?php $New_name = array ( 
							'1'=>"ตามมาตรฐานสากล ISO 22000 และ HACCP FSSC 22000 ถือเป็นระบบรับรองความปลอดภัยอาหารสำหรับผู้ผลิตอาหารที่ช่วยควบคุมความเสี่ยงด้านความปลอดภัยของอาหาร ", 
							'2'=>"เนื่องจากบริษัทของเราให้ความสำคัญในเรื่องของความปลอดภัยของพนักงานเป็นอย่างยิ่ง และอีกทั้งกฎหมายด้านความปลอดภัยในประเทศไทยได้ให้ก็ยังความสำคัญที่จะให้พนักงานนั้นได้มีความรู้ความเข้าใจเกี่ยวกับวิธีการควบคุมและการดับเพลิงขั้นต้นอย่างถูกวิธี", 
							'3'=>"การเรียนรู้คือวิธีปลูกฝังการปรับปรุงอย่างต่อเนื่องซึ่งเป็นหัวใจสำคัญขององค์กร "
						); ?>


						<?php $New_detail = array ( 
							'1'=>"ตามมาตรฐานสากล ISO 22000 และ HACCP FSSC 22000 ถือเป็นระบบรับรองความปลอดภัยอาหารสำหรับผู้ผลิตอาหารที่ช่วยควบคุมความเสี่ยงด้านความปลอดภัยของอาหาร หลังจากที่บริษัทเราได้รับใบรับรองสากล HACCP, ISO22000, HALAL เป็นที่เรียบร้อยแล้วขั้นตอนต่อไปคือขั้นตอนการขอรับมาตรฐานที่ได้รับการยอมรับทั่วโลกในด้านการตรวจสอบการตรวจสอบและรับรองผลิตภัณฑ์อาหารเพื่อความปลอดภัยของอาหาร FSSC 22000", 
							'2'=>"เนื่องจากบริษัทของเราให้ความสำคัญในเรื่องของความปลอดภัยของพนักงานเป็นอย่างยิ่ง และอีกทั้งกฎหมายด้านความปลอดภัยในประเทศไทยได้ให้ก็ยังความสำคัญที่จะให้พนักงานนั้นได้มีความรู้ความเข้าใจเกี่ยวกับวิธีการควบคุมและการดับเพลิงขั้นต้นอย่างถูกวิธีเพื่อสามารถตอบโต้เหตุไฟไหม้ต่างๆ สามารถใช้อุปกรณ์ดับเพลิงเบื้องต้นได้อย่างถูกต้องและปลอดภัย ทางบริษัทของเราจึงได้มีการจัดการอบรมและฝึกซ้อมอพยพหนีไฟประจำปี2022ในวันที่ 19 ธันวาคม 2565 ที่ผ่านมา  ซึ่งการอบรมฝึกซ้อมอพยพหนีไฟก็เสร็จเรียบร้อยและเป็นไปอย่างราบรื่น", 
							'3'=>"การเรียนรู้คือวิธีปลูกฝังการปรับปรุงอย่างต่อเนื่องซึ่งเป็นหัวใจสำคัญขององค์กร ทางบริษัทของเราจึงได้มีการจัดอบรมระบบมาตรฐาน FSSC 22000 ระบบการจัดการความปลอดภัยของอาหาร (FSMS) ให้กับพนักงานในองค์กรของเรา ซึ่งถือเป็นการเพิ่มเติมความรู้ เพิ่มความสำคัญในการปรับปรุงประสิทธิภาพด้านความปลอดภัยของอาหารของเราให้เพิ่มมากขึ้น เพื่อประสิทธิภาพในการทำงาน สินค้า แล้วพนักงานของเราอีกด้วย"
						); ?>



						<?php for($i=1;$i<=2;$i++){ ?> 

							<a class="item-new" href="new-detail.php">
								<div class="row align-items-center">
									<div class="col-md-3">
										<div class="img-new">
											<img class="img-fluid " src="upload/new0<?=$i?>.jpg">
										</div>
									</div>
									<div class="col-md-9">
										<div class="text-new">
											<h4><?= $New_name[$i] ?></h4>
											<p><?= $New_detail[$i] ?></p>
											<span class="text-warning">Read More ++</span>
										</div>
									</div>
								</div>
							</a>

						<?php } ?>



					</div>
					<div class="col-lg-6">
						
						<div class="mb-5 text-center text-md-start">
							<h2><span class="text-warning">Cooking</span> Time</h2>
						</div>



						<div class="row">

							<?php for($i=1;$i<=2;$i++){ ?> 

								<div class="col-md-6">
									<a class="item-cooking" href="cooking-detail.php">

										<div class="img-cooking">
											<img class="img-fluid " src="upload/cooking0<?=$i?>.jpg">
										</div>

										<div class="text-cooking">
											<h4 class="text-warning">ชาเขียวไข่มุก</h4>
											<p>ขนมปังปิ้ง 1 ชิ้น, ซอสคัสตาร์ดในปริมาณ
												ที่เหมาะสม, ผลไม้หั่นสี่เหลี่ยมลูกเต๋า
											ที่เหมาะสม, ถ้วยทนการอบ 1 ถ้วย</p>
											<span class="text-warning">Read More ++</span>
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
  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15462.642775777771!2d100.6906684!3d14.3311312!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1bb8b9ea894b7a72!2sYo%20Yi%20Foods%20Co.%2CLtd.!5e0!3m2!1sth!2sth!4v1673338842131!5m2!1sth!2sth"   allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

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