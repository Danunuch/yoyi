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
	<link rel="stylesheet" href="css/product-detail.css?v=1001" />
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













		<section id="page-section"  class="shopping-cart">

			<img class="img-fluid" src="images/page.png">

			<div class="container-xxl">



				


				<?php include("navigator.php");?>


				


				<div class="row align-items-center" >












					<div class="col-md-6 col-lg-5 d-none d-md-block">
						<div class="product-main-image" data-scrollzoom="false">
							<div class="product-main-image-item">
								<img class="zoom-product border" src='upload/product01.jpg' data-zoom-image="upload/product01.jpg" alt="Laura Mercier Foundation Powder" />
							</div>
						</div>
						<div class="product-images-carousel">
							<ul id="smallGallery">

								<?php for($ii=1;$ii<=3;$ii++){?>
									<?php for($i=1;$i<=3;$i++){?>
										<li>
											<a href="#" class="zoomGalleryActive" data-image="upload/product0<?=$i?>.jpg"  data-zoom-image="upload/product0<?=$i?>.jpg" data-target="279763451931">
												<img class="border" src="upload/product0<?=$i?>.jpg" alt="Laura Mercier Foundation Powder">
											</a>
										</li>
									<?php } ?>
								<?php } ?>

							</ul>
						</div>
					</div>
					<div class="col-md-7 d-block d-md-none">

						<div class="clearfix"></div>
						<ul class="mobileGallery-product">
							<?php for($ii=1;$ii<=3;$ii++){?>
								<?php for($i=1;$i<=3;$i++){?>
									<li><img src="upload/product0<?=$i?>.jpg" alt="Laura Mercier Foundation Powder" /></li>
								<?php } ?>
							<?php } ?>
						</ul>

					</div>



					<div class="col-lg-1 d-none d-lg-block"></div>
					<div class="col-md-6 col-lg-6">


						<h4 >เม็ดไข่มุกสีทอง</h4>


						<p>
						  หากพูดถึงความแตกต่างกันระหว่าง ได้มุกสีดำกับสีทอง นอกจากสีที่ต่างกันนั้นคือ รสชาติ รสสัมผัส และยังมีกลิ่นหอมคาราเมลที่หอมอย่างชัดเจนโดยสูตรเฉพาะของบริษัทเรา สีเหลืองทองสวยงามน่ารับประทาน และเช่นเดียวกันวัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบที่บริษัทของเราคัดสรรอย่างดีเพื่อคุณภาพของลูกค้าโดยเฉพาะ</p>

						<p>
							ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย
						</p>

					




					</div>



					<div class="col-lg-12 mt-4">

						<div class="border border-top-0 p-0 border">



							<ul class="nav nav-tabs text-center d-block border-top" id="myTab" role="tablist">
								<li class="nav-item d-inline-block" role="presentation">
									<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">รายละเอียด</button>
								</li>
								<li class="nav-item d-inline-block" role="presentation">
									<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">วิดีโอรีวิว</button>
								</li>
								<li class="nav-item d-inline-block" role="presentation">
									<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">ดาวน์โหลดแคตตาล็อค</button>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane p-4 fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									
						<p>
						  หากพูดถึงความแตกต่างกันระหว่าง ได้มุกสีดำกับสีทอง นอกจากสีที่ต่างกันนั้นคือ รสชาติ รสสัมผัส และยังมีกลิ่นหอมคาราเมลที่หอมอย่างชัดเจนโดยสูตรเฉพาะของบริษัทเรา สีเหลืองทองสวยงามน่ารับประทาน และเช่นเดียวกันวัตถุดิบที่นำมาใช้เป็นส่วนประกอบส่วนใหญ่เป็นวัตถุดิบที่บริษัทของเราคัดสรรอย่างดีเพื่อคุณภาพของลูกค้าโดยเฉพาะ</p>

						<p>
							ทางบริษัทของเรายังสามารถคิดค้นสูตร ปรับปรุงสูตร ตามที่ลูกค้าต้องการและพึงพอใจได้อีกด้วย
						</p>



								</div>
								<div class="tab-pane p-4 fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

									<div class="ratio ratio-16x9">
										<iframe src="https://www.youtube.com/embed/Dr6JVIs6hgc?rel=0" title="YouTube video" allowfullscreen></iframe>
									</div>


								</div>
								<div class="tab-pane p-4 fade text-center" id="contact" role="tabpanel" aria-labelledby="contact-tab">

									<a href="upload/pdf.pdf" target="_blank" class="btn btn-warning btn-lg mt-4"><span class="material-icons-outlined">
										file_download
									</span> ดาวน์โหลดแคตตาล็อค</a>
								</div>
							</div>


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

        <script  src="js/lazyload.js?v=1001"></script>
        <script src="js/main.js?v=1001"></script>
        <script src="js/jquery.elevatezoom.js?v=1001"></script>

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