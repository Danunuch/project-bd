<link rel="stylesheet" href="assets/css/add_blog.css?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<?php include('menu_l.php');
require_once('../config/bddesign_db.php');

if (isset($_GET['topic_id'])) {
    $topic_id = $_GET['topic_id'];

    $stmt = $conn->prepare("SELECT * FROM about_us WHERE id = :id");
    $stmt->bindParam(":id", $topic_id);
    $stmt->execute();
    $row_about_us = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['edit-about-submit'])) {
    $title = $_POST['title'];
    $img1 = $_FILES['img1'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "assets/about_me/" . $fileNew1;

    

    if (in_array($fileActExt1, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                $edit = $conn->prepare("UPDATE about_us SET title = :title, img = :img WHERE id = :id");
                $edit->bindParam(":title", $title);
                $edit->bindParam(":img", $fileNew1);
                $edit->bindParam(":id", $topic_id);
                $edit->execute();

                if ($edit) {
                    echo '<script>alert("แก้ไขข้อมูลสำเร็จ")</script>';
                    echo "<meta http-equiv='Refresh' content='0.001; url=about_us'>";
                } else {
                    echo '<script>alert("มีบางอย่างผิดพลาด")</script>';
                }
            }
        }
    }else{
        $edit = $conn->prepare("UPDATE about_us SET title = :title WHERE id = :id");
        $edit->bindParam(":title", $title);
        $edit->bindParam(":id", $topic_id);
        $edit->execute();

        if ($edit) {
            echo '<script>alert("แก้ไขข้อมูลสำเร็จ")</script>';
            echo "<meta http-equiv='Refresh' content='0.001; url=about_us'>";
        } else {
            echo '<script>alert("มีบางอย่างผิดพลาด")</script>';
        }
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
            <p class="add-blog">แก้ไขเกี่ยวกับเรา (ภาษาไทย)</p>
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
                <textarea name="title" class="form-control" id="title"><?= $row_about_us["title"] ?></textarea>
                <!-- <div class="pt">
                    <div class="box-txt-content2">
                        <label for="paragraph1" class="mt-3 paragraph1">หัวข้อ</label>
                        <input type="text" name="topic" value="" class="form-control ">

                        <label for="paragraph3" class="mt-3 paragraph3">เนื้อหา (ถ้าขึ้นบรรทัดใหม่ให้ใส่ ; ข้างหลัง)</label>
                        <textarea type="text" name="content" id="paragraph3" class="form-control "><?= $row_about_us['content'] ?></textarea>
                    </div>
                </div> -->
                <div class="txt-img mt-4"><span>รูปภาพ (นามสกุล .jpg .jpeg .png .webp)</span></div>
                <div class="pos">

                    <div class="pos">
                        <div class="filewrap">
                            <input name="img1" id="imgInput1" class="form-control" type="file" />
                            <img width="100%" id="previewImg1" alt="">
                        </div>

                        <!-- <div class="txt-img mt-4"><span>รูปภาพเดิม</span></div> -->
                        <div class="pos">
                            <div class="filewrap">
                                <img width="100%" src="assets/about_me/<?= $row_about_us["img"] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-btn "> <button type="submit" name="edit-about-submit" class="btn-blog-submit">บันทึกข้อมูล</button></div>
            </form>
        </div>
    </div>
</div>

<script>
    let imgInput1 = document.getElementById('imgInput1');
    let previewIm = document.getElementById('previewImg1');

    imgInput1.onchange = evt => {
        const [file] = imgInput1.files;
        if (file) {
            previewImg1.src = URL.createObjectURL(file);
        }
    }
</script>