<!DOCTYPE HTML>
<link rel="stylesheet" href="assets/css/add_blog.css?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.tiny.cloud/1/2c646ifr40hywrvj32dwwml8e5qmxxr52qvzmjjq7ixbrjby/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<?php include('menu_l.php');
require_once('../config/bddesign_db.php');

$stmt = $conn->prepare("SELECT * FROM about_us");
$stmt->execute();
$row_about_us = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['edit-about-submit'])) {
    $img1 = $_FILES['img1'];
    $content = $_POST['content'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "assets/about_me/" . $fileNew1;
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก

    if (in_array($fileActExt1, $allow)) {
        if ($img1['size'] > 0 && $img1['error'] == 0) {
            if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                $edit = $conn->prepare("UPDATE about_us SET content = :content, img = :img");
                $edit->bindParam(":content", $content);
                $edit->bindParam(":img", $fileNew1);
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
        $edit = $conn->prepare("UPDATE about_us SET content = :content");
        $edit->bindParam(":content", $content);
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
                <!-- <label for="title_blog" class="mt-3 title_blog">เกริ่นนำ</label>
                <textarea name="title" class="form-control" id="title"></textarea> -->
                <div class="pt">
                    <div class="box-txt-content2">
                        <label for="paragraph3" class="mt-3 paragraph3">เนื้อหา</label>
                        <textarea type="text" name="content" class="form-control "><?= $row_about_us["content"]; ?></textarea>
                        <script>
                            tinymce.init({
                                selector: 'textarea',
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect ',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                tinycomments_mode: 'embedded',
                                tinycomments_author: 'Author name',
                            });
                        </script>
                    </div>
                </div>

                <div class="txt-img mt-4"><span style="color: red;">รองรับไฟล์ (.jpg .jpeg .png .webp)</span></div>


                <div class="pos none" id="pos">
                    <div class="filewrap">
                        <input name="img1" id="imgInput1" class="form-control" type="file" />
                        <img width="100%" src="assets/about_me/<?php echo $row_about_us["img"]; ?>"  id="previewImg1" alt="">
                    </div>
                    <button type="submit" name="del_img1" class=" cancle_img" id="cancel_img1"><i class="bi bi-x-square-fill"></i></button>
                </div>

                <div class="box-btn "> <button type="submit" name="edit-about-submit" class="btn-blog-submit">บันทึกข้อมูล</button></div>
            </form>
        </div>
    </div>
</div>
<script language="javascript" src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
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
<script>
    $(document).ready(function() {
        $('#cancel_img1').click(function() {
            $('#previewImg1').attr("src", "");
            $('#imgInput1').val(null);
        });
    });
</script>