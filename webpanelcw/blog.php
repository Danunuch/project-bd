<link rel="stylesheet" href="assets/css/blog.css?v=<?php echo time(); ?>" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<?php include('menu_l.php');
require_once('../config/bddesign_db.php');
error_reporting(0);

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == "en") {
        $page = $_GET['page'];
        $blog_count = $conn->prepare("SELECT * FROM blog_en");
        $blog_count->execute();
        $count_blog = $blog_count->fetchAll();


        $rows = 5;
        if ($page == "") {
            $page = 1;
        }
        $total_data = count($count_blog);
        $total_page = ceil($total_data / $rows);
        $start = ($page - 1) * $rows;

        $blog = $conn->prepare("SELECT * FROM blog_en  ORDER BY id DESC LIMIT $start,6");
        $blog->execute();
        $row_blog = $blog->fetchAll();
    } else {
        $page = $_GET['page'];
        $blog_count = $conn->prepare("SELECT * FROM blog");
        $blog_count->execute();
        $count_blog = $blog_count->fetchAll();


        $rows = 6;
        if ($page == "") {
            $page = 1;
        }
        $total_data = count($count_blog);
        $total_page = ceil($total_data / $rows);
        $start = ($page - 1) * $rows;

        $blog = $conn->prepare("SELECT * FROM blog   ORDER BY id DESC LIMIT $start,6");
        $blog->execute();
        $row_blog = $blog->fetchAll();
    }
} else {

    $page = $_GET['page'];
    $blog_count = $conn->prepare("SELECT * FROM blog");
    $blog_count->execute();
    $count_blog = $blog_count->fetchAll();


    $rows = 6;
    if ($page == "") {
        $page = 1;
    }
    $total_data = count($count_blog);
    $total_page = ceil($total_data / $rows);
    $start = ($page - 1) * $rows;

    $blog = $conn->prepare("SELECT * FROM blog ORDER BY id DESC LIMIT $start,6");
    $blog->execute();
    $row_blog = $blog->fetchAll();
}


//ลบบทความ
if (isset($_GET['delete_blog_id']) && isset($_GET['lang'])) {
    $del = $_GET['lang'];
    $delete_blog_id = $_GET['delete_blog_id'];
    if ($del == 'en') {
        $delete_blog_id = $_GET['delete_blog_id'];
        $delete_blog = $conn->prepare("DELETE FROM blog_en WHERE id = :id");
        $delete_blog->bindParam(":id", $delete_blog_id);
        $delete_blog->execute();

        if ($delete_blog) {
            echo "<script>alert('ลบบทความเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=blog'>";
        }
    } else {
        $delete_blog_id = $_GET['delete_blog_id'];
        $delete_blog = $conn->prepare("DELETE FROM blog WHERE id = :id");
        $delete_blog->bindParam(":id", $delete_blog_id);
        $delete_blog->execute();

        if ($delete_blog) {
            echo "<script>alert('ลบบทความเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=blog'>";
        }
    }
} else if (isset($_GET['delete_blog_id'])) {
    $delete_blog_id = $_GET['delete_blog_id'];
    $delete_blog_id = $_GET['delete_blog_id'];
    $delete_blog = $conn->prepare("DELETE FROM blog WHERE id = :id");
    $delete_blog->bindParam(":id", $delete_blog_id);
    $delete_blog->execute();

    if ($delete_blog) {
        echo "<script>alert('ลบบทความเรียบร้อยแล้ว')</script>";
        echo "<meta http-equiv='Refresh' content='0.001; url=blog'>";
    }
}

?>
<!-- Layout container -->
<style>
    .switch.ios,
    .switch-on.ios,
    .switch-off.ios {
        border-radius: 20rem;
    }

    .switch.ios .switch-handle {
        border-radius: 20rem;
    }
</style>

<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <div class="box-title-add">
                <p class="add-blog"><?php if ($_GET["lang"] == "en") {
                                        echo 'All Blog';
                                    } else {
                                        echo 'บทความทั้งหมด';
                                    } ?></p>
                <a href="?lang=th"><button class="btn-blog-en">TH</button></a>
                <a href="?lang=en"><button class="btn-blog-en">EN</button></a>
                <a <?php if ($_GET["lang"] == "en") {
                        echo 'href="add_blog_en"';
                    } else {
                        echo 'href="add_blog"';
                    } ?>><button class="btn-add-blog"><i class="bi bi-plus"></i> <?php if ($_GET["lang"] == "en") {
                                                                                        echo 'Add Blog';
                                                                                    } else {
                                                                                        echo 'เพิ่มบทความ';
                                                                                    } ?> </button></a>
            </div>
            <div class="box-add-blog">

                <!-- <a href="add_blog_en"><button class="btn-add-blog">เพิ่มบทความ (ภาษาอังกฤษ)</button></a> -->
                <!-- <a href="?lang=th"><button class="btn-blog-en">ดูบทความภาษาไทย</button></a> -->

            </div>
        </div>
        <form method="GET">
            <div class="table-responsive">
                <table class="table">

                    <thead>
                        <tr align="center">
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">รูปหน้าปก</th>
                            <th scope="col">ชื่อบทความ</th>
                            <th scope="col">วันที่สร้าง</th>
                            <th scope="col">สถานะ</th>
                            <!-- <th scope="col">จัดการ</th> -->
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        if (!$row_blog) {
                            echo "ยังไม่มีบทความ";
                        } else {

                            foreach ($row_blog as $row_blog) { ?>
                                <tr align="center">
                                    <!-- <th scope="row"><?= $i  ?></th> -->
                                    <td><img width="80px" src="assets/blog_upload/<?php if ($row_blog['blog_img1'] == null) {
                                                                                        echo 'upload_icon.png';
                                                                                    } else {
                                                                                        echo $row_blog["blog_img1"];
                                                                                    } ?>" alt=""></td>
                                    <td><?= $row_blog["title_blog"] ?></td>
                                    <td><?= $row_blog["created_blog"] ?></td>

                                    <!-- <td>
                                        <?php
                                       
                                        if ($row_blog['status'] == "1") {?>
                                            <input type="checkbox" name="status" data-toggle="switchbutton" checked data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="sm">
                                      <?php  } else { ?>
                                            <input type="checkbox" name="status" data-toggle="switchbutton"  data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="sm">
                                        <?php }
                                        ?>


                                    </td> -->

                                    <td>
                                        <a href="<?php if ($lang == "en") {
                                                        echo "edit_blog_en";
                                                    } else {
                                                        echo "edit_blog";
                                                    } ?>?blog_id=<?= $row_blog['id'] ?>"><button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button></a>
                                        <a href="blog?delete_blog_id=<?= $row_blog['id'] ?><?php if ($lang == "en") {
                                                                                                echo "&lang=en";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>" onclick="return confirm('คุณต้องการลบบทความนี้ใช่ไหม')"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
                                    </td>
                                </tr>
                        <?php $i++;
                            }
                        }
                        ?>

                    </tbody>

                </table>
            </div>
        </form>
        <ul class="pagination justify-content-center mt-5">
            <li <?php if ($page == 1) {
                    echo "class='page-item disabled'";
                } ?>>
                <a class="page-link previous-page" href="blog?page=<?= $page - 1 ?><?php if ($lang == "en") {
                                                                                        echo "&lang=en";
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>" aria-disabled="true">ก่อนหน้า</a>
            </li>
            <?php
            for ($i = 1; $i <= $total_page; $i++) { ?>
                <li <?php if ($page == $i) {
                        echo "class='page-item active'";
                    } ?>><a class="page-link" href="blog?page=<?= $i ?><?php if ($lang == "en") {
                                                                            echo "&lang=en";
                                                                        } else {
                                                                            echo "";
                                                                        } ?>"><?= $i ?></a></li>
            <?php }
            ?>

            <li <?php if ($page == $total_page) {
                    echo "class='page-item disabled'";
                } ?>>
                <a class="page-link nextpage" href="blog?page=<?= $page + 1 ?><?php if ($lang == "en") {
                                                                                    echo "&lang=en";
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>">ถัดไป </a>
            </li>

        </ul>

    </div>
</div>