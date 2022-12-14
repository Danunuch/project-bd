<?php
require_once('config/bddesign_db.php');
error_reporting(0);
$page = $_GET['page'];

if($page == ""){
	$page = 1;
}
?>
<div class="bg-navigator">
	<div class="container-xxl">
		<a href="index">Home</a>
		<a href="#">Page <?= $page ?></a>
	</div>
</div>
<div class="clearfix"></div>
