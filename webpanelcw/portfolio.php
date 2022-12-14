<link rel="stylesheet" href="assets/css/portfolio.css?v=<?php echo time(); ?>" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<?php include('menu_l.php');
require_once('../config/bddesign_db.php');
error_reporting(0);

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == "en") {
        $page = $_GET['page'];
        $portfolio_count = $conn->prepare("SELECT * FROM portfolio_en");
        $portfolio_count->execute();
        $count_portfolio = $portfolio_count->fetchAll();


        $rows = 5;
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
        $portfolio_count = $conn->prepare("SELECT * FROM portfolio");
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
    $portfolio_count = $conn->prepare("SELECT * FROM portfolio");
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


//ลบบทความ
if (isset($_GET['delete_portfolio_id']) && isset($_GET['lang'])) {
    $del = $_GET['lang'];
    $delete_portfolio_id = $_GET['delete_portfolio_id'];
    if ($del == 'en') {
        $delete_portfolio_id = $_GET['delete_portfolio_id'];
        $delete_portfolio = $conn->prepare("DELETE FROM portfolio_en WHERE id = :id");
        $delete_portfolio->bindParam(":id", $delete_portfolio_id);
        $delete_portfolio->execute();

        if ($delete_portfolio) {
            echo "<script>alert('ลบบทความเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
        }
    } else {
        $delete_portfolio_id = $_GET['delete_portfolio_id'];
        $delete_portfolio = $conn->prepare("DELETE FROM portfolio WHERE id = :id");
        $delete_portfolio->bindParam(":id", $delete_portfolio_id);
        $delete_portfolio->execute();

        if ($delete_portfolio) {
            echo "<script>alert('ลบบทความเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
        }
    }
} else if (isset($_GET['delete_portfolio_id'])) {
    $delete_portfolio_id = $_GET['delete_portfolio_id'];
    $delete_portfolio_id = $_GET['delete_portfolio_id'];
    $delete_portfolio = $conn->prepare("DELETE FROM portfolio WHERE id = :id");
    $delete_portfolio->bindParam(":id", $delete_portfolio_id);
    $delete_portfolio->execute();

    if ($delete_portfolio) {
        echo "<script>alert('ลบบทความเรียบร้อยแล้ว')</script>";
        echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
    }
}

?>


<!-- Layout container -->

<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <div class="box-title-add">
                <p class="add-portfolio">ผลงานทั้งหมด</p>
            </div>
            <div class="box-add-portfolio">
                <a href="add_portfolio"><button class="btn-add-portfolio">เพิ่มผลงาน (ภาษาไทย)</button></a>
                <a href="add_portfolio_en"><button class="btn-add-portfolio">เพิ่มผลงาน (ภาษาอังกฤษ)</button></a>
                <a href="?lang=th"><button class="btn-add-portfolio">ดูผลงาน (ภาษาไทย)</button></a>
                <a href="?lang=en"><button class="btn-add-portfolio">ดูผลงาน (ภาษาอังกฤษ)</button></a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table" id="blogTable">
            <thead>
                <tr align="center">

                    <th>รูปผลงาน</th>
                    <th>ชื่อผลงาน/สถานที่</th>
                    <th>รายละเอียดผลงาน</th>
                    <th>ราคา (ล้านบาท)</th>
                </tr>
            </thead>
            <tbody> <?php
                    $i = 1;
                    if (!$row_portfolio) {
                        echo "ยังไม่มีผลงาน";
                    } else {

                        foreach ($row_portfolio as $row_portfolio) { ?>
                        <tr>
                            <td align="center"><img width="80px" src="assets/portfolio_upload/<?= $row_portfolio['img1'] ?>" alt=""></td>
                            <td >ชื่อผลงาน : <?= $row_portfolio["p_name"] ?> <br>สถานที่ : <?= $row_portfolio["lo_name"] ?></td>
                            <td width="40%"><?= $row_portfolio["p_detail1"] ?><br><br><?= $row_portfolio["p_detail2"] ?></td>
                            <td align="center"><?= $row_portfolio["price"] ?></td>
                            <td>
                                <a href="<?php if ($lang == "en") {
                                                echo "edit_portfolio_en";
                                            } else {
                                                echo "edit_portfolio";
                                            } ?>?portfolio_id=<?= $row_portfolio['id'] ?>"><button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                <a href="portfolio?delete_portfolio_id=<?= $row_portfolio['id'] ?><?php if ($lang == "en") {
                                                                                                            echo "&lang=en";
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>" onclick="return confirm('คุณต้องการลบผลงานนี้ใช่หรือไม่?')"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                            </td>
                        </tr>
                <?php $i++;
                        }
                    }
                ?>
            </tbody>
        </table>
        </div>
        <ul class="pagination justify-content-center mt-5">
            <li <?php if ($page == 1) {
                    echo "class='page-item disabled'";
                } ?>>
                <a class="page-link previous-page" href="portfolio?page=<?= $page - 1 ?><?php if ($lang == "en") {
                                                                                                echo "&lang=en";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>" aria-disabled="true">ก่อนหน้า</a>
            </li>
            <?php
            for ($i = 1; $i <= $total_page; $i++) { ?>
                <li <?php if ($page == $i) {
                        echo "class='page-item active'";
                    } ?>><a class="page-link" href="portfolio?page=<?= $i ?><?php if ($lang == "en") {
                                                                                    echo "&lang=en";
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>"><?= $i ?></a></li>
            <?php }
            ?>

            <li <?php if ($page == $total_page) {
                    echo "class='page-item disabled'";
                } ?>>
                <a class="page-link nextpage" href="portfolio?page=<?= $page + 1 ?><?php if ($lang == "en") {
                                                                                            echo "&lang=en";
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>">ถัดไป </a>
            </li>

        </ul>

    </div>
</div>