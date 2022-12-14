<?php
require_once('config/bddesign_db.php');
session_start();

$_SESSION['lang'] = "";
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
    $stmt = $conn->prepare("SELECT * FROM home");
    $stmt->execute();
    $row_home = $stmt->fetchAll();
}

$row_split = explode(";",$row_home[0]["content"]);
?>


<div class="slider banner_index">
    <?php for ($i = 1; $i <= 3; $i++) { ?>
        <div class="ps-0 pe-0">
    
            <div class="item-slide">
                <div class="slide-img">
                    <img class="img-fluid w-100" src="upload/s0<?= $i ?>.webp">
                </div>
                <div class="slide-text">
                    <h1><?= $row_home[0]["title"] ?></h1>
                    <p><?= $row_home[0]["topic"] ?>
                    </p>
                    <p><?= $row_split[0]?><?= $row_split[1]?> </p>
                   
            


                </div>
            </div>

        </div>
    <?php } ?>
</div>