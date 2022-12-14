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

	<link rel="stylesheet" href="css/footer.css?v=1001" />
	<link href="css/slick.min.css?v=1001" rel="stylesheet">
	<link href="css/slick-custom.css?v=1001" rel="stylesheet">

</head>
<?php
require_once('config/bddesign_db.php');
error_reporting(0);
session_start();
$_SESSION['lang'] = "";
if (isset($_GET['lang']) && $_GET['lang'] != "") {
	$_SESSION['lang'] = $_GET['lang'];

	if ($_SESSION['lang'] == "en") {

		$service_count = $conn->prepare("SELECT * FROM service_en");
		$service_count->execute();
		$count_service = $service_count->fetchAll();
	} else {

		$service_count = $conn->prepare("SELECT * FROM service_th");
		$service_count->execute();
		$count_service = $service_count->fetchAll();
	}
} else {

	$service_count = $conn->prepare("SELECT * FROM service_th");
	$service_count->execute();
	$count_service = $service_count->fetchAll();
}

$_SESSION['lang'] = "";
if (isset($_GET['lang']) && $_GET['lang'] != "") {
	$_SESSION['lang'] = $_GET['lang'];

	if ($_SESSION['lang'] == "en") {
		$page = $_GET['page'];
		$portfolio_count = $conn->prepare("SELECT * FROM portfolio_en");
		$portfolio_count->execute();
		$count_portfolio = $portfolio_count->fetchAll();

		$rows = 6;
		if ($page == "") {
			$page = 1;
		}
		$total_data = count($count_portfolio);
		$total_page = ceil($total_data / $rows);
		$start = ($page - 1) * $rows;

		$portfolio = $conn->prepare("SELECT * FROM portfolio_en LIMIT $start,6");
		$portfolio->execute();
		$row_portfolio = $portfolio->fetchAll();
	} else {
		$page = $_GET['page'];
		$portfolio_count = $conn->prepare("SELECT * FROM portfolio ");
		$portfolio_count->execute();
		$count_portfolio = $portfolio_count->fetchAll();


		$rows = 6;
		if ($page == "") {
			$page = 1;
		}
		$total_data = count($count_portfolio);
		$total_page = ceil($total_data / $rows);
		$start = ($page - 1) * $rows;

		$portfolio = $conn->prepare("SELECT * FROM portfolio LIMIT $start,6");
		$portfolio->execute();
		$row_portfolio = $portfolio->fetchAll();
	}
} else {

	$page = $_GET['page'];
	$portfolio_count = $conn->prepare("SELECT * FROM portfolio ");
	$portfolio_count->execute();
	$count_portfolio = $portfolio_count->fetchAll();


	$rows = 6;
	if ($page == "") {
		$page = 1;
	}
	$total_data = count($count_portfolio);
	$total_page = ceil($total_data / $rows);
	$start = ($page - 1) * $rows;

	$portfolio = $conn->prepare("SELECT * FROM portfolio LIMIT $start,6");
	$portfolio->execute();
	$row_portfolio = $portfolio->fetchAll();
}
if (isset($_GET['lang']) && $_GET['lang'] != "") {
	$_SESSION['lang'] = $_GET['lang'];

	if ($_SESSION['lang'] == "en") {
		$page = $_GET['page'];
		$blog_count = $conn->prepare("SELECT * FROM blog_en");
		$blog_count->execute();
		$count_blog = $blog_count->fetchAll();

		$rows = 3;
		if ($page == "") {
			$page = 1;
		}
		$total_data = count($count_blog);
		$total_page = ceil($total_data / $rows);
		$start = ($page - 1) * $rows;

		$blog = $conn->prepare("SELECT * FROM blog_en LIMIT $start,3");
		$blog->execute();
		$row_blog = $blog->fetchAll();
	} else {
		$page = $_GET['page'];
		$blog_count = $conn->prepare("SELECT * FROM blog ");
		$blog_count->execute();
		$count_blog = $blog_count->fetchAll();


		$rows = 3;
		if ($page == "") {
			$page = 1;
		}
		$total_data = count($count_blog);
		$total_page = ceil($total_data / $rows);
		$start = ($page - 1) * $rows;

		$blog = $conn->prepare("SELECT * FROM blog LIMIT $start,3");
		$blog->execute();
		$row_blog = $blog->fetchAll();
	}
} else {

	$page = $_GET['page'];
	$blog_count = $conn->prepare("SELECT * FROM blog ");
	$blog_count->execute();
	$count_blog = $blog_count->fetchAll();


	$rows = 3;
	if ($page == "") {
		$page = 1;
	}
	$total_data = count($count_blog);
	$total_page = ceil($total_data / $rows);
	$start = ($page - 1) * $rows;

	$blog = $conn->prepare("SELECT * FROM blog LIMIT $start,3");
	$blog->execute();
	$row_blog = $blog->fetchAll();
}
if (isset($_GET['lang']) && $_GET['lang'] != "") {
	$_SESSION['lang'] = $_GET['lang'];
    $lang = $_GET['lang'];
	if ($_SESSION['lang'] == "en") {
		$stmt = $conn->prepare("SELECT * FROM home_en");
		$stmt->execute();
		$row_home = $stmt->fetchAll();
	} else {
		$stmt = $conn->prepare("SELECT * FROM home");
		$stmt->execute();
		$row_home = $stmt->fetchAll();
	}
} else {
	$stmt = $conn->prepare("SELECT * FROM home_about");
	$stmt->execute();
	$row_home = $stmt->fetchAll();
}
if (isset($_GET['lang']) && $_GET['lang'] != "") {
	$_SESSION['lang'] = $_GET['lang'];
    $lang = $_GET['lang'];
	if ($_SESSION['lang'] == "en") {
		$stmt = $conn->prepare("SELECT * FROM home_about_en");
		$stmt->execute();
		$row_home_about = $stmt->fetchAll();
	} else {
		$stmt = $conn->prepare("SELECT * FROM home_about");
		$stmt->execute();
		$row_home_about = $stmt->fetchAll();
	}
} else {
	$stmt = $conn->prepare("SELECT * FROM home_about");
	$stmt->execute();
	$row_home_about = $stmt->fetchAll();
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
		<?php include("header.php"); ?>
		<?php include("slide.php"); ?>
		

		<section id="service-section">
			<div class="container-xxl">
				<div class="text-center">
					<div class="box-head mb-5">
						<img class="img-fluid" src="images/service-icon.webp">
						<h2><?php
							if ($lang == 'en') {
								echo "Service";
							} else {
								echo "บริการ";
							}
							?></h2>
					</div>
				</div>

				<div class="row justify-content-center">
					<?php for ($i = 0; $i < count($count_service); $i++) {
						$p = explode(",", $count_service[$i]["title_service"]);
					?>
						<div class="col-md-6 col-lg-4">
							<a href="service-detail?service_id=<?php echo $count_service[$i]['id'] ?>" class="item-service">
								<div class="service-img">
									<img class="lazy img-fluid" data-src="upload/service0<?= $i + 1 ?>.webp">
								</div>
								<div class="service-text">

									<h4><?= $p[0] . "<br>" . $p[1] ?></h4>

								</div>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</section>



		<section id="about-section" class="bg-parallax" style="background:url(images/about-section.webp) no-repeat top center; background-size:cover;">
			<div class="container-xxl">
				<div class="text-center">
					<div class="box-head mb-5">
						<img class="lazy img-fluid" data-src="images/about-icon.webp">
						<h2><?php
							if ($lang == 'en') {
								echo "About Me";
							} else {
								echo "เกี่ยวกับเรา";
							}
							?></h2>
					</div>
				</div>


				<div class="text-center">
					<?php
					 $result = explode(";",$row_home_about[0]["content"]);
					 $result1 = explode(";",$row_home_about[0]["topic"]);
					//  echo '<pre>';
					// print_r($result);
					//  echo '</pre>';
					?>
					<p style="margin: 0px;"><?= $row_home_about[0]["title"] ?></p>
					<p style="margin: 0px;"><?= $result1[0] ?></p>
					<p style="margin: 0px;"><?= $result1[1] ?></p>
					<br>
					<p style="margin: 0px;"><?= $result[1] ?></p>
					<p><?= $result[2] ?></p>
				</div>



			</div>
		</section>





		<section id="portfolio-section">
			<div class="container-xxl">
				<div class="text-center">
					<div class="box-head mb-5">
						<img class="img-fluid" src="images/portfolio-icon.webp">
						<h2><?php
							if ($lang == 'en') {
								echo "Portfolio";
							} else {
								echo "ผลงาน";
							}
							?></h2>
					</div>
				</div>



				<div class="row justify-content-center portfolio_slick">

					<?php foreach ($row_portfolio as $row_portfolio) { ?>
							<div class="col-md-6 col-lg-4">
							<a href="portfolio-detail?portfolio=<?php echo $row_portfolio['id']; ?><?php if (isset($_GET['lang'])) {
																												$la = $_GET['lang'];
																												if ($la == "en") {
																													echo "&lang=en";
																												}
																											} else {
																												echo "";
																											}
																											?>" class="item-portfolio">
									<div class="portfolio-img">
									<img class=" img-fluid" src="webpanelcw/assets/portfolio_upload/<?php echo $row_portfolio['img1']; ?>" alt="">
									</div>
									<div class="portfolio-text">
									<h4>
										<?php echo
										$row_portfolio['p_name'];
										?></h4>
									</div>
								</a>
							</div>
						<?php } ?>





				</div>

				<div class="text-center mt-5">

					<a href="portfolio<?php
							if ($lang == 'en') {
								echo "?lang=en";
							} else {
								echo "";
							}
							?>" class="btn btn-info btn-lg rounded-pill px-5"><?php
							if ($lang == 'en') {
								echo "See All";
							} else {
								echo "ดูทั้งหมด >>";
							}
							?></a>

				</div>


			</div>
		</section>




		<section id="blog-section" class="bg-parallax" style="background:url(images/blog-section.webp) no-repeat top center; background-size:cover;">
			<div class="container-xxl">
				<div class="text-center">
					<div class="box-head mb-5">
						<img class="img-fluid" src="images/blog-icon.webp">
						<h2><?php
							if ($lang == 'en') {
								echo "Blog";
							} else {
								echo "บทความ";
							}
							?></h2>
					</div>
				</div>


				<div class="row">


				<?php foreach ($row_blog as $row_blog) { ?>
						<div class="col-md-6 col-lg-4">
						<a href="blog-detail?blog=<?php echo $row_blog['id']; ?><?php if(isset($_GET['lang'])){$dt=$_GET['lang']; if($dt =="en"){echo "&lang=en";}
						else{echo "";}}else{echo "";} ?>" class="item-blog">
								<div class="blog-img">
								<img class="img-fluid"  height="312px" src="webpanelcw/assets/blog_upload/<?= $row_blog['blog_img1'] ?>" alt="Monarch, khao-tao">
								</div>
								<div class="blog-text" style="height: 310px;">
								<h4><?= $row_blog['title_blog'] ?></h4>
								<textarea rows="7" maxlength="7" style="border: none; width: 100%; overflow: hidden;" readonly><?= $row_blog['paragraph1'] ?></textarea>
						
									<!-- <p><?= $row_blog['paragraph1'] ?></p> -->

									<div class="row">
										<div class="col-6 text-start">
										<?php
											$dateTime = $row_blog['created_blog'];
											$splitTime = explode(" ", $dateTime);
											$date = $splitTime[0];
											echo $date;
											?>
										</div>
										<div class="col-6 text-end">
										<?php if(isset($_GET['lang'])){$ll = $_GET['lang']; if($ll == "en"){echo "Read All";}else{echo "อ่านทั้งหมด";} }else{echo "อ่านทั้งหมด";} ?> >>
										</div>
									</div>
								</div>
							</a>
						</div>
					<?php } ?>





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



	<script type="text/javascript" src="js/main.js?v=1001"></script>
	<!-- Vendors -->
	<script src="js/jarallax.min.js?v=1001"></script>
	<!-- Template Functions -->
	<script src="js/functions.js?v=1001"></script>

	<script src="js/lazyload.js?v=1001"></script>
</body>
</body>

</html>