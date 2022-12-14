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

if (isset($_GET['lang'])) {
	$lang = $_GET['lang'];
	if ($lang == "en") {
		$data_about = $conn->prepare("SELECT * FROM aboutme_en");
		$data_about->execute();
		$row_about = $data_about->fetch();
	} else {
		$data_about = $conn->prepare("SELECT * FROM aboutme");
		$data_about->execute();
		$row_about = $data_about->fetch();
	}
} else {
	$data_about = $conn->prepare("SELECT * FROM aboutme");
	$data_about->execute();
	$row_about = $data_about->fetch();
}



if (isset($_POST['submit_contact'])) {
	$title_name = $_POST['title_name'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$tel = $_POST['tel'];
	$content = $_POST['content'];

	if (empty($title_name)) {
		echo '<script>alert("กรุณากรอกชื่อเรื่อง")</script>';
	} else if (empty($name)) {
		echo '<script>alert("กรุณากรอกชื่อ)</script>';
	} else if (empty($email)) {
		echo '<script>alert("กรุณากรอกอีเมล")</script>';
	} else if (empty($tel)) {
		echo '<script>alert("กรุณากรอกโทรศัพท์")</script>';
	} else if (empty($content)) {
		echo '<script>alert("กรุณาเขียนข้อความ")</script>';
	} else {
		try {
			$send_data = $conn->prepare("INSERT INTO message(title_name, name, email, tel, content)
										VALUES(:title_name, :name, :email, :tel, :content)");
			$send_data->bindParam(":title_name", $title_name);
			$send_data->bindParam(":name", $name);
			$send_data->bindParam(":email", $email);
			$send_data->bindParam(":tel", $tel);
			$send_data->bindParam(":content", $content);
			$send_data->execute();

			if ($send_data) {
				echo '<script>alert("ส่งข้อมูลเรียบร้อยแล้ว")</script>';
				echo "<meta http-equiv='Refresh' content='0.001; url=contact'>";
			} else {
				echo '<script>alert("มีบางอย่างผิดพลาด")</script>';
				echo "<meta http-equiv='Refresh' content='0.001; url=contact'>";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
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
						<h2><?php if($lang == 'en'){echo "Contact";}else{echo "ติดต่อเรา";} ?></h2>
					</div>
				</div>



				<div class="row">


					<div class="col-md-4">
						<div class="box-contact">
							<h4>Business Development And Design</h4>
							<ul>
								<li class="mb-4"><?= $row_about["address"] ?><br>
								</li>
								<li><?php if($lang == 'en'){echo "Phone ";}else{echo "โทร ";} ?> <?= $row_about["tel1"] ?><br>
								<?php if($lang == 'en'){echo "Fax ";}else{echo "โทรสาร ";} ?> <?= $row_about["tel2"] ?></li>
								<li><?= $row_about["email"] ?></li>
							</ul>



							<img class="img-fluid" src="webpanelcw/assets/about_me/<?= $row_about['line_qr'] ?>" alt="ยกับเราทาง Line">

							<h4 class="mt-4 mt-lg-0"><?php if($lang == 'en'){echo "Talk to us via";}else{echo "คุยกับเราทาง";} ?> Line<br>Line ID : <?= $row_about["line_id"] ?></h4>




						</div>
					</div>

					<div class="col-md-8">



						<form method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="inputName"><?php if($lang == 'en'){echo "Topic";}else{echo "ชื่อเรื่อง";} ?></label>
										<input type="text" name="title_name" class="form-control rounded-0" id="inputName" placeholder="<?php if($lang == 'en'){echo "Inform Topic";}else{echo "กรอกชื่อเรื่อง";} ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="inputName"><?php if($lang == 'en'){echo "Name";}else{echo "ชื่อ";} ?></label>
										<input type="text" name="name" class="form-control rounded-0" id="inputName" placeholder="<?php if($lang == 'en'){echo "Inform Name";}else{echo "กรอกชื่อ";} ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="inputEmail"><?php if($lang == 'en'){echo "Email";}else{echo "อีเมล";} ?></label>
										<input type="email" name="email" class="form-control rounded-0" id="inputEmail" placeholder="<?php if($lang == 'en'){echo "Inform Email";}else{echo "กรอกอีเมล";} ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group mb-3">
										<label for="inputEmail"><?php if($lang == 'en'){echo "Phone";}else{echo "โทรศัพท์";} ?></label>
										<input type="tel" name="tel" class="form-control rounded-0" id="inputEmail" placeholder="<?php if($lang == 'en'){echo "Inform Phone";}else{echo "กรอกโทรศัพท์";} ?>">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group mb-3">
										<label for="inputName"><?php if($lang == 'en'){echo "Text";}else{echo "ข้อความ";} ?></label>
										<textarea name="content" class="form-control rounded-0" rows="8" placeholder="<?php if($lang == 'en'){echo "Write your message here.";}else{echo "เขียนข้อความของคุณที่นี่";} ?>" id="textareaMessage"></textarea>
									</div>

								</div>
								<div class="col-md-12">
									<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdnZCAbAAAAAN5rxRl9h09tA2OMjzo_NZxkCh3M">
										<div style="width: 304px; height: 78px;">
											<div><iframe title="reCAPTCHA" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LdnZCAbAAAAAN5rxRl9h09tA2OMjzo_NZxkCh3M&amp;co=aHR0cHM6Ly93d3cuZmlyZW1hbi1mYi5jb206NDQz&amp;hl=en&amp;v=ovmhLiigaw4D9ujHYlHcKKhP&amp;size=normal&amp;cb=9kj3f8sw2pix" width="304" height="78" role="presentation" name="a-4rb8zrm8qpsv" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
										</div><iframe style="display: none;"></iframe>
									</div>
									<div class="clearfix mt-3"></div>

									<button type="submit" name="submit_contact" class="btn btn btn-info btn-lg rounded-pill px-lg-5"><i class="icofont-send-mail"></i><?php if($lang == 'en'){echo "Submit";}else{echo "ส่งข้อความ";} ?> </button>
									<a href="contact" class="btn btn btn-info btn-lg rounded-pill px-lg-5"><i class="icofont-refresh"></i><?php if($lang == 'en'){echo "Cleanup";}else{echo "ล้างข้อมูล";} ?> </a>
								</div>
							</div>

						</form>

					</div>
				</div>





			</div>
		</section>

		<div class="ratio ratio-21x9">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15502.40809068953!2d100.548076!3d13.7425281!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29edcf327b91b%3A0x5480f75fcf67cfdb!2sGoogle%20Thailand!5e0!3m2!1sth!2sth!4v1668162178077!5m2!1sth!2sth" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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