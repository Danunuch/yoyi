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
	<link rel="stylesheet" href="css/category.css?v=1001" />

	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
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
					<h2><span class="text-warning">Cooking</span> Time</h2>
				</div>









				<div class="row">
					<div class="col-lg-3">
						<h4 class="text-info">วิธีการปรุงอาหาร</h4>


						<?php $Cooking_detail = array ( 
							'1'=>"ชาเขียวไข่มุก", 
							'2'=>"บะหมี่กึ่งสำเร็จรูปแช่แข็ง 5Q", 
							'3'=>"มัทฉะลาเต้ร้อน",
							'4'=>"ซุปข้าวโพดไข่มุกหยกขาว",
							'5'=>"ชาไข่มุกอัลมอนด์นัท",
							'6'=>"รักเพิร์ลแมงโก้สมูทตี้",
							'7'=>"ครีมไข่มุกผลไม้ดอกไม้",
							'8'=>"ซาลาเปาสีขาวรูปไข่มุก",
							'9'=>"บลิส เพิร์ล ฟรุ๊ต มัฟฟิน",
							'10'=>"ไอศกรีมชาไข่มุก",
							'11'=>"สลัดมันฝรั่งเพิร์ลไลท์"
						); ?>














						<div id='cssmenu'>
							<ul>
								<li class='has-sub'><a href='#'>วิธีการปรุงอาหาร</a>
									<ul>

										<li><a href='cooking.php'>ลูกแป้งดิบ</a></li>
										<li><a href='cooking.php'>วุ้นเส้น</a></li>
									</ul>

								</li>



								
								<li class='active has-sub'><a href='#'>โซนสูตรอาหาร</a>
									<ul>
										<?php for($i=1;$i<=11;$i++){ ?>
											<li><a href='cooking.php'><?= $Cooking_detail[$i] ?></a></li>
										<?php } ?>
									</ul>

								</li>

								
							</ul>
						</div>





					</div>
					<div class="col-lg-9">
						<h4 class="text-info">ชาเขียวไข่มุก</h4>
						<div class="row mb-4">


							<?php for($i=4;$i<=6;$i++){ ?> 
								<div class="col-6 col-md-4">
									<div class="view-seventh mb-4">
										<a href="upload/cooking0<?=$i?>.jpg" class="b-link-stripe b-animate-go thickbox" title="ชาเขียวไข่มุก">
											<div class="box-gallery">
												<div class="bg-img">
													<img class="img-fluid" src="upload/cooking0<?=$i?>.jpg" alt="ชาเขียวไข่มุก">
												</div>

											</div>
										</a>
									</div>
								</div>
							<?php } ?>

						</div>







						<?php $Cooking_detail = array ( 
							'1'=>"ส่วนผสม: ครีมสดสำหรับสัตว์ 200 มล. นม 300 มล. ชาดำ 2 ซอง น้ำตาล 70 กรัม ผงปรุงแช่แข็ง 5Q", 
							'2'=>"อุ่นนมจนเดือดแล้วเปลี่ยนเป็นไฟอ่อน จากนั้นใส่น้ำตาลลงไปคนให้ละลาย", 
							'3'=>"ใส่ถุงชาลงไป คนให้เข้ากัน ปิดไฟและเคี่ยวต่ออีก 10 นาที", 
							'4'=>"หลังจากตุ๋นเสร็จ นำถุงชาออก เติมครีมสดและคนให้เข้ากัน", 
							'5'=>"เทใส่ภาชนะแล้วปล่อยให้เย็นแช่แข็งประมาณ 4-6 ชั่วโมง", 
							'6'=>"นำบะหมี่ที่ปรุงสุกแช่แข็ง 5Q กลับคืนสู่อุณหภูมิตามวิธีการปรุงก่อนหน้า", 
							'7'=>"ตักไอศกรีมแช่แข็งใส่ถ้วย โรยผงไข่มุก เป็นอันเสร็จ!"
						); ?>


						<div class="cooking-ol">

							<ol>
								<?php for($i=1;$i<=7;$i++){ ?>
									<li><?= $Cooking_detail[$i] ?></li>
								<?php } ?>
							</ol>

						</div>



					</div>
				</div>











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
    <script src="js/category.js?v=1001"></script>

    <script  src="js/lazyload.js?v=1001"></script>


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