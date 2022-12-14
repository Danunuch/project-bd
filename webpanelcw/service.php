<link rel="stylesheet" href="assets/css/service.css?v=<?php echo time(); ?>" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<?php include('menu_l.php');
require_once('../config/bddesign_db.php');
error_reporting(0);


if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == "en") {
        $page = $_GET['page'];
        $service_count = $conn->prepare("SELECT * FROM service_en");
        $service_count->execute();
        $count_service = $service_count->fetchAll();


        $rows = 5;
        if ($page == "") {
            $page = 1;
        }
        $total_data = count($count_service);
        $total_page = ceil($total_data / $rows);
        $start = ($page - 1) * $rows;

        $service = $conn->prepare("SELECT * FROM service_en LIMIT $start,6");
        $service->execute();
        $row_service = $service->fetchAll();
    } else {
        $page = $_GET['page'];
        $service_count = $conn->prepare("SELECT * FROM service_th");
        $service_count->execute();
        $count_service = $service_count->fetchAll();


        $rows = 6;
        if ($page == "") {
            $page = 1;
        }
        $total_data = count($count_service);
        $total_page = ceil($total_data / $rows);
        $start = ($page - 1) * $rows;

        $service = $conn->prepare("SELECT * FROM service_th LIMIT $start,6");
        $service->execute();
        $row_service = $service->fetchAll();
    }
} else {

    $page = $_GET['page'];
    $service_count = $conn->prepare("SELECT * FROM service_th");
    $service_count->execute();
    $count_service = $service_count->fetchAll();


    $rows = 6;
    if ($page == "") {
        $page = 1;
    }
    $total_data = count($count_service);
    $total_page = ceil($total_data / $rows);
    $start = ($page - 1) * $rows;

    $service = $conn->prepare("SELECT * FROM service_th LIMIT $start,6");
    $service->execute();
    $row_service = $service->fetchAll();
}




//ลบบริการ
if (isset($_GET['delete_service_id']) && isset($_GET['lang'])) {
    $del = $_GET['lang'];
    $delete_service_id = $_GET['delete_service_id'];
    if ($del == 'en') {
        $delete_service_id = $_GET['delete_service_id'];
        $delete_service = $conn->prepare("DELETE FROM service_en WHERE id = :id");
        $delete_service->bindParam(":id", $delete_service_id);
        $delete_service->execute();

        if ($delete_service) {
            echo "<script>alert('ลบบริการเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=service'>";
        }
    } else {
        $delete_service_id = $_GET['delete_service_id'];
        $delete_service = $conn->prepare("DELETE FROM service_th WHERE id = :id");
        $delete_service->bindParam(":id", $delete_service_id);
        $delete_service->execute();

        if ($delete_service) {
            echo "<script>alert('ลบบริการเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=service'>";
        }
    }
} else if (isset($_GET['delete_service_id'])) {
    $delete_service_id = $_GET['delete_service_id'];
    $delete_service_id = $_GET['delete_service_id'];
    $delete_service = $conn->prepare("DELETE FROM service_th WHERE id = :id");
    $delete_service->bindParam(":id", $delete_service_id);
    $delete_service->execute();

    if ($delete_service) {
        echo "<script>alert('ลบบริการเรียบร้อยแล้ว')</script>";
        echo "<meta http-equiv='Refresh' content='0.001; url=service'>";
    }
}

?>
<!-- Layout container -->


<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <div class="box-title-add">
                <p class="add-service">บริการ</p>
            </div>
            <div class="box-add-service">
                <a href="add_service"><button class="btn-add-service">เพิ่มบริการ (ภาษาไทย)</button></a>
                <a href="add_service_en"><button class="btn-add-service">เพิ่มบริการ (ภาษาอังกฤษ)</button></a>
                <a href="?lang=th"><button class="btn-add-service">ดูบริการภาษาไทย</button></a>
                <a href="?lang=en"><button class="btn-add-service">ดูบริการภาษาอังกฤษ</button></a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr align="center">
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">รูปหน้าปก</th>
                        <th scope="col">ชื่อบริการ</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody> <?php

                            foreach ($row_service as $row_service) { ?>
                            <tr align="center">
                                <!-- <th scope="row"><?= $i  ?></th> -->
                                <td><img width="80px" src="assets/service_upload/<?= $row_service['service_img1'] ?>" alt=""></td>
                                <td><?= $row_service["title_service"] ?></td>
                                <td>
                                    <a href="<?php if ($lang == "en") {
                                                    echo "edit_service_en";
                                                } else {
                                                    echo "edit_service";
                                                } ?>?service_id=<?= $row_service['id'] ?>"><button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                    <a href="service?delete_service_id=<?= $row_service['id'] ?><?php if ($lang == "en") {
                                                                                                echo "&lang=en";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>" onclick="return confirm('คุณต้องการลบบทความนี้ใช่ไหม')"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                </td>
                            </tr>
                    <?php $i++;
                            }
                        
                    ?>
                </tbody>

            </table>
        </div>
        <ul class="pagination justify-content-center mt-5">
            <li <?php if ($page == 1) {
                    echo "class='page-item disabled'";
                } ?>>
                <a class="page-link previous-page" href="service?page=<?= $page - 1 ?><?php if ($lang == "en") {
                                                                                            echo "&lang=en";
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>" aria-disabled="true">ก่อนหน้า</a>
            </li>
            <?php
            for ($i = 1; $i <= $total_page; $i++) { ?>
                <li <?php if ($page == $i) {
                        echo "class='page-item active'";
                    } ?>><a class="page-link" href="service?page=<?= $i ?><?php if ($lang == "en") {
                                                                                echo "&lang=en";
                                                                            } else {
                                                                                echo "";
                                                                            } ?>"><?= $i ?></a></li>
            <?php }
            ?>

            <li <?php if ($page == $total_page) {
                    echo "class='page-item disabled'";
                } ?>>
                <a class="page-link nextpage" href="service?page=<?= $page + 1 ?><?php if ($lang == "en") {
                                                                                        echo "&lang=en";
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>">ถัดไป </a>
            </li>

        </ul>

    </div>
</div>