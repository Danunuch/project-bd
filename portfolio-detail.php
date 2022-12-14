<!DOCTYPE html>
<html lang="en" class="desktop">

<head>

	<link rel="shortcut icon" href="images/favicon.ico">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=0.85">
	<meta name="description" content="รับสร้างบ้าน ออกแบบบ้าน และเขียนแบบบ้าน เรามุ่งเน้นให้บริการดูแลลูกค้าอย่างครบวงจร">
	<meta name="keyword" content="รับสร้างบ้าน ออกแบบบ้าน และเขียนแบบบ้าน เรามุ่งเน้นให้บริการดูแลลูกค้าอย่างครบวงจร">
	<meta name="author" content="รับสร้างบ้าน ออกแบบบ้าน และเขียนแบบบ้าน เรามุ่งเน้นให้บริการดูแลลูกค้าอย่างครบวงจร">

	<title>รับสร้างบ้าน ออกแบบบ้าน และเขียนแบบบ้าน เรามุ่งเน้นให้บริการดูแลลูกค้าอย่างครบวงจร</title>





	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500;600;700;800;900&display=swap">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
	<link rel="stylesheet" type="text/css" href="css/fontello.css?v=1001">
	<link href="css/spinner.css?v=1001" rel="stylesheet">
	<!-- CSS only -->
	<link href="css/bootstrap.min.css?v=1001" rel="stylesheet">

	<link rel="stylesheet" href="css/coreNavigation.css?v=1001" />
	<link rel="stylesheet" href="css/typography.css?v=1001" />
	<link rel="stylesheet" href="css/custom.css?v=1001" />
	<link rel="stylesheet" href="css/header.css?v=1001" />
	<link rel="stylesheet" href="css/slide.css?v=1001" />
	<link rel="stylesheet" href="css/service-section.css?v=1001" />
	<link rel="stylesheet" href="css/about-section.css?v=1001" />
	<link rel="stylesheet" href="css/portfolio-section.css?v=1001" />
	<link rel="stylesheet" href="css/blog-section.css?v=1001" />
	<link rel="stylesheet" href="css/page-section.css?v=1001" />
	<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/footer.css?v=1001" />
	<link href="css/slick.min.css?v=1001" rel="stylesheet">
	<link href="css/slick-custom.css?v=1001" rel="stylesheet">

</head>
<?php
require_once('config/bddesign_db.php');
session_start();
$portfolio = $_GET['portfolio'];
if (isset($_GET['portfolio']) && isset($_GET['lang'])) {
	$portfolio = $_GET['portfolio'];
	$lang = $_GET['lang'];

	if ($lang == "en") {
		$portfolio_detail = $conn->prepare("SELECT * FROM portfolio_en WHERE id = :id");
		$portfolio_detail->bindParam(":id", $portfolio);
		$portfolio_detail->execute();
		$detail_portfolio = $portfolio_detail->fetch(PDO::FETCH_ASSOC);
	} else {
		$portfolio_detail = $conn->prepare("SELECT * FROM portfolio WHERE id = :id");
		$portfolio_detail->bindParam(":id", $portfolio);
		$portfolio_detail->execute();
		$detail_portfolio = $portfolio_detail->fetch(PDO::FETCH_ASSOC);
	}
} else if (isset($_GET['portfolio'])) {
	$portfolio = $_GET['portfolio'];
	$portfolio_detail = $conn->prepare("SELECT * FROM portfolio WHERE id = :id");
	$portfolio_detail->bindParam(":id", $portfolio);
	$portfolio_detail->execute();
	$detail_portfolio = $portfolio_detail->fetch(PDO::FETCH_ASSOC);
}
?>
<body>
	<!-- ป้องกันไม่ให้ copy -->
	<script language=JavaScript>
		
		function clickIE4() {
			if (event.button == 2) {
				alert(message);
				return false;
			}
		}
		function clickNS4(e) {
			if (document.layers || document.getElementById && !document.all) {
				if (e.which == 2 || e.which == 3) {
					alert(message);
					return false;
				}
			}
		}
		if (document.layers) {
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = clickNS4;
		} else if (document.all && !document.getElementById) {
			document.onmousedown = clickIE4;
		}

		document.oncontextmenu = new Function("return false")
	</script>

	<main>
		<?php if (!isset($_SESSION)) {
			session_start();
		}   ?>
		<header>
			<!-- Start Navigation -->
			<nav hidden>
				<div class="nav-header">
					<a href="index" <?php unset($_SESSION['lang']); ?> class="brand" title="รับเหมา ระบบไฟฟ้าอาคาร ระบบสุขาภิบาล ระบบปรับอากาศ ระบบดับเพลง  ระบบไฟฟ้า"><img src="images/logo.webp" /></a>
					<button class="toggle-bar">
						<span class="material-icons-outlined">
							menu
						</span>
						เมนู
					</button>
				</div>
				<ul class="menu">
					<li><a href="index"><?php if (isset($_GET['lang'])) {
												if ($_GET['lang'] == "en") {
													echo "Home";
												} else {
													echo "หน้าแรก";
												}
											} else {

												echo "หน้าแรก";
											} ?></a></li>
					<li><a href="portfolio"><?php if (isset($_GET['lang'])) {
													if ($_GET['lang'] == "en") {
														echo "Portfolio";
													} else {
														echo "ผลงาน";
													}
												} else {

													echo "ผลงาน";
												} ?></a></li>
					<li><a href="service"><?php if (isset($_GET['lang'])) {
													if ($_GET['lang'] == "en") {
														echo "Service";
													} else {
														echo "บริการ";
													}
												} else {

													echo "บริการ";
												} ?></a></li>
					<li><a href="blog"><?php if (isset($_GET['lang'])) {
												if ($_GET['lang'] == "en") {
													echo "Blog";
												} else {
													echo "บทความ";
												}
											} else {

												echo "บทความ";
											} ?></a></li>
					<li><a href="about"><?php if (isset($_GET['lang'])) {
												if ($_GET['lang'] == "en") {
													echo "About Me";
												} else {
													echo "เกี่ยวกับเรา";
												}
											} else {
												echo "เกี่ยวกับเรา";
											} ?></a></li>
					<li><a href="contact"><?php if (isset($_GET['lang'])) {
													if ($_GET['lang'] == "en") {
														echo "Contact";
													} else {
														echo "ติดต่อเรา";
													}
												} else {
													echo "ติดต่อเรา";
												} ?></a></li>

				</ul>
				<ul class="attributes">
					<li><a href="?portfolio=<?php echo $_GET['portfolio'] ?>&lang=th" <?php
											if (!isset($_GET['lang'])) {
												echo "class='active'";
											} else if (isset($_GET['lang'])) {
												$lang = $_GET['lang'];
												if ($lang == 'th') {
													echo "class='active'";
												} else {

													echo "class='not_active'";
												}
											} ?>>
							<img class="flag" src="images/thailand.webp">
						</a></li>
					<li><a href="?portfolio=<?php echo $_GET['portfolio'] ?>&lang=en" <?php
											if (!isset($_GET['lang'])) {
												echo "class='not_active'";
											} else if (isset($_GET['lang'])) {
												$lang = $_GET['lang'];
												if ($lang == 'en') {
													echo "class='active'";
												} else {

													echo "class='not_active'";
												}
											} ?>><img class="flag" src="images/uk.webp"></a></li>

				</ul>
			</nav>
			<!-- End Navigation -->
		</header>
		<div class="slider">
			<div class="ps-0 pe-0">

				<div class="item-slide">
					<div class="slide-img">
						<img class="img-fluid w-100" src="upload/page.webp">
					</div>

				</div>

			</div>



		</div>

		<section id="page-section">
			<div class="container-xxl">

				<?php include("navigator.php"); ?>
				<div class="text-center mb-5">
					<div class="page-header ">
						<h2><?php echo $detail_portfolio['p_name']; ?></h2>
					</div>
				</div>


				<div class="row align-items-center">
					<div class="col-md-6">
						<img id="show-info" class="img-fluid mb-4" src="webpanelcw/assets/portfolio_upload/<?php echo $detail_portfolio['img1']; ?>" width="100%">
						<div class="row portfolio_slick_detail">
							<?php
							$a = $detail_portfolio['img1'];
							$stack = array($a);

							if ($detail_portfolio['img2'] == null) {
								echo "";
							}else {
								array_push($stack, $detail_portfolio['img2']);
							}
							if ($detail_portfolio['img3'] == null) {
								echo "";
							}else {
								array_push($stack, $detail_portfolio['img3']);
							}
							if ($detail_portfolio['img4'] == null) {
								echo "";
							}else {
								array_push($stack, $detail_portfolio['img4']);
							}
							if ($detail_portfolio['img5'] == null) {
								echo "";
							}else {
								array_push($stack, $detail_portfolio['img5']);
							}
							
							// echo '<pre>';
							// print_r($stack);
							// echo '<pre>';

							for ($i = 1; $i < count($stack); $i++) { ?>
								<div class="col-12">
									<a href="javascript:void(0)" id="list" src="webpanelcw/assets/portfolio_upload/<?php echo $stack[$i]; ?> " alt="">
										<img class="img-fluid" data-image="original" src="webpanelcw/assets/portfolio_upload/<?php echo $stack[$i]; ?> " alt="">
									</a>
								</div>
							<?php } ?>
						</div>
					</div>

					<div class="col-md-6">
						<h3 class="my-4">Construction</h3>
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="text-white bg-dark"><b>Project</b></td>
									<td><?php echo $detail_portfolio['p_name']; ?></td>
								</tr>
								<tr>
									<td class="text-white bg-dark"><b>Location</b></td>
									<td><?php echo $detail_portfolio['lo_name']; ?></td>
								</tr>
								<tr>
									<td class="text-white bg-dark"><b>Type</b></td>
									<td><?php echo $detail_portfolio['t_name']; ?></td>
								</tr>
								<tr>
									<td class="text-white bg-dark"><b>Value</b></td>
									<td><?php echo $detail_portfolio['price']; ?></td>
								</tr>
							</tbody>
						</table>
						<p><?php echo $detail_portfolio['p_detail1']; ?></p><br>
						<p><?php echo $detail_portfolio['p_detail2']; ?></p>
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
	</script>


	<script type="text/javascript" src="js/slick.min.js?v=1001"></script>
	<script type="text/javascript" src="js/slick-custom.js?v=1001"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			$("a#list").click(function() {
				var list_y = $(this).attr("data-test");
				$("#show-info").fadeOut(50, function() {
					$(this).attr('src', list_y);
				}).fadeIn(500);
			});


		});
	</script>

	<script type="text/javascript" src="js/main.js?v=1001"></script>
	<!-- Vendors -->
	<script src="js/jarallax.min.js?v=1001"></script>
	<!-- Template Functions -->
	<script src="js/functions.js?v=1001"></script>

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