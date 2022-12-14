<link rel="stylesheet" href="assets/css/blog.css?v=<?php echo time(); ?>" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<?php include('menu_l.php');
require_once('../config/bddesign_db.php');
error_reporting(0);

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    if ($lang == "en") {
        $stmt = $conn->prepare("SELECT * FROM about_us_en");
        $stmt->execute();
        $row_about_us = $stmt->fetchAll();
    } else {
        $stmt = $conn->prepare("SELECT * FROM about_us");
        $stmt->execute();
        $row_about_us = $stmt->fetchAll();
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM about_us");
    $stmt->execute();
    $row_about_us = $stmt->fetchAll();
}





?>
<!-- Layout container -->


<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <div class="box-title-add">
                <p class="add-blog"><?php if ($_GET["lang"] == "en") {
                                        echo 'About Me';
                                    } else {
                                        echo 'เกี่ยวกับเรา';
                                    } ?></p>
                <a href="?lang=th"><button class="btn-blog-en">TH</button></a>
                <a href="?lang=en"><button class="btn-blog-en">EN</button></a><a <?php if ($_GET["lang"] == "en") {
                        echo 'href="edit_about_us_en"';
                    } else {
                        echo 'href="edit_about_us"';
                    } ?>><button class="btn-add-blog"><i class="bi bi-pencil-square"></i> <?php if ($_GET["lang"] == "en") {
                                                                                                echo 'Edit';
                                                                                            } else {
                                                                                                echo 'แก้ไข';
                                                                                            } ?> </button></a>
            </div>
            <div class="box-add-blog">
                
            </div>
        </div>
        <div class="title-box">
            <?php echo $row_about_us[0]["content"]; ?>
            <img width="100%" src="assets/about_me/<?php echo $row_about_us[0]["img"]; ?>" alt="">
        </div>
    </div>
</div>