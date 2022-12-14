<link rel="stylesheet" href="assets/css/add_blog.css?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<?php include('menu_l.php');
require_once('../config/bddesign_db.php');

if (isset($_GET['topic_id'])) {
    $topic_id = $_GET['topic_id'];

    $stmt = $conn->prepare("SELECT * FROM home_about WHERE id = :id");
    $stmt->bindParam(":id", $topic_id);
    $stmt->execute();
    $row_home_about = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['edit-about-submit'])) {
    $title = $_POST['title'];

    $edit = $conn->prepare("UPDATE home_about SET title = :title WHERE id = :id");
    $edit->bindParam(":title", $title);
    $edit->bindParam(":id", $topic_id);
    $edit->execute();

    if ($edit) {
        echo '<script>alert("แก้ไขข้อมูลสำเร็จ")</script>';
        echo "<meta http-equiv='Refresh' content='0.001; url=index'>";
    } else {
        echo '<script>alert("มีบางอย่างผิดพลาด")</script>';
    }
} 

?>
<style>
    #title {
        height: 80px;
    }

    .pos {
        display: flex;
    }
</style>
<!-- Layout container -->
<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <p class="add-blog">แก้ไขหน้าหลัก (ภาษาไทย)</p>
        </div>
        <?php
        if (isset($errorMsg)) { ?>
            <div class="alert alert-danger " id="alert-blog" role="alert">
                <?php echo $errorMsg ?>
            </div>
        <?php  }
        ?>
        <div class="box-form">
            <form method="post" class="form-lo" enctype="multipart/form-data">
                <label for="title_blog" class="mt-3 title_blog">เกริ่นนำ</label>
                <textarea name="title" class="form-control" id="title"><?= $row_home_about["title"] ?></textarea>
               

                <div class="box-btn "> <button type="submit" name="edit-about-submit" class="btn-blog-submit">บันทึกข้อมูล</button></div>
            </form>
        </div>
    </div>
</div>
