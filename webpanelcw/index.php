<link rel="stylesheet" href="assets/css/home.css?v=<?php echo time(); ?>" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<?php include('menu_l.php');
require_once('../config/bddesign_db.php');
error_reporting(0);

$stmt = $conn->prepare("SELECT * FROM home");
$stmt->execute();
$row_home = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM home_about");
$stmt->execute();
$row_home_about = $stmt->fetchAll();



?>
<!-- Layout container -->


<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <div class="box-title-add">
                <p class="add-home">หน้าหลัก</p>
            </div>
            <div class="box-add-home">
                <a href="index_en"><button class="btn-home-th">เพิ่มข้อมูลฉบับภาษาอังกฤษ</button></a>
            </div>
        </div>
        <div class="title-box">
            <?php
            for ($i = 0; $i < count($row_home); $i++) {
                $content[] = explode(";", $row_home[$i]["content"]);
                $count_content = $content[$i]; ?>

                <h4><?php echo $row_home[$i]['title'] ?> <a href="edit_title_home?topic_id=<?php echo $row_home[$i]["id"] ?>"><?php if ($row_home[$i]["title"] == null) {
                                                                                                                                    echo "";
                                                                                                                                } else {
                                                                                                                                    echo "แก้ไขที่นี่";
                                                                                                                                } ?></a></h4>
                <p><?php echo $row_home[$i]['topic'] . "   " ?><a href="edit_home?topic_id=<?php echo $row_home[$i]["id"] ?>"><button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a></p>

                <?php for ($j = 1; $j < count($count_content); $j++) { ?>
                    <h6><?php echo $j . ". " . $content[$i][$j]; ?></h6>
                <?php }
                ?>
            <?php  }
            ?>
            <br>
            <?php
            for ($i = 0; $i < count($row_home_about); $i++) {
                $content_about[] = explode(";", $row_home_about[$i]["content"]);
                $count_content_about = $content_about[$i]; ?>

                <h4><?php echo $row_home_about[$i]['title'] ?> <a href="edit_title_home_about?topic_id=<?php echo $row_home_about[$i]["id"] ?>"><?php if ($row_home_about[$i]["title"] == null) {
                                                                                                                                                    echo "";
                                                                                                                                                } else {
                                                                                                                                                    echo "แก้ไขที่นี่";
                                                                                                                                                } ?></a></h4>
                <p><?php echo $row_home_about[$i]['topic'] . "   " ?><a href="edit_home_about?topic_id=<?php echo $row_home_about[$i]["id"] ?>"><button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a></p>

                <?php for ($j = 1; $j < count($count_content_about); $j++) { ?>
                    <h6><?php echo $j . ". " . $content_about[$i][$j]; ?></h6>
                <?php }
                ?>
            <?php  }
            ?>




        </div>






        <?php
        if ($row_home[0]["title"] == null) { ?>
            <p></p>
        <?php } else { ?>


        <?php  }
        ?>

        <h4><?php //echo $content[$i] 
            ?></h4>

        <?php
        echo '<pre>';
        print_r($content[$i][$i]);
        echo '<pre>';
        ?>
    </div>
</div>
