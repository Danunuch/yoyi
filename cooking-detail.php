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



				<div class="pb-5">


					<?php include("navigator.php");?>


					




					<h4 class="text-warning">ชาเขียวไข่มุก</h4>



					<p>
					วัตถุดิบชานมไข่มุก ร้านขายวัตถุดิบชากาแฟ สิ่งสำคัญสำหรับมือใหม่อยากเปิดร้าน ซึ่งเชื่อว่าหลาย ๆ คนคงต้องอยากรู้อยู่แล้วว่าต้องมีอะไีรบ้าง วัตถุดิบที่จำเป็น สิ่งที่ขาดไม่ได้ โดยที่ไม่ต้องใช้เงินในการลงทุนเยอะมาก หรือเกินความจำเป็นในช่วงที่กำลังเปิดร้านใหม่</p>

					<p>
						ยิ่งในปัจจุบันนี้การเปิดร้านกาแฟ ร้านชาไข่มุก แบบร้านเครื่องดื่มเล็ก ๆ นั้นมีเยอะมาก เพราะไม่ต้องใช้งบเยอะ และสามารถเปิดขายได้ง่าย ๆ แค่มีพื้นที่หน้าบ้าน ในตลาด หน้าโรงเรียน หรือพื้นที่ว่างที่เหมาะสำหรับเปิดร้านขาย ที่สำคัญยังเอาใจกลุ่มลูกค้าวัยเด็กได้ดีอีกด้วย
					</p>

					<p>
						แล้วการจะเปิดร้านขายชานมไข่มุกเล็ก ๆ ต้องมีวัตถุดิบที่สำคัญอะไรบ้าง ที่จะสามารถนำมาชงขายได้หลากหลาย ช่วยเพิ่มยอดขายให้กับร้าน นำมาขายแล้วคืนทุนได้เร็ว จะมีอะไรบ้างที่เป็นวัตถุดิบหลัก วันนี้ทาง bluemocha  เรามีคำตอบมาฝากกัน รับรองว่ามีแค่นี้ก็นำมาขายได้ เรียกลูกค้าได้เยอะ แถมลูกค้าติดใจแน่นอน

					</p>










					<div class="row mt-4">


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