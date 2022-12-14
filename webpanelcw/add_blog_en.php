<!DOCTYPE html>
<link rel="stylesheet" href="assets/css/add_blog.css?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.tiny.cloud/1/2c646ifr40hywrvj32dwwml8e5qmxxr52qvzmjjq7ixbrjby/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


<?php include('menu_l.php');
require_once('../config/bddesign_db.php');
error_reporting(0);
if (isset($_POST['add-blog-submit'])) {
    $title_blog = $_POST['title_blog'];
    $paragraph1 = $_POST['paragraph1'];
    $intro = $_POST['intro'];
    $img1 = $_FILES['img1'];
    $img2 = $_FILES['img2'];
    $img3 = $_FILES['img3'];

    $_SESSION['title_blog'] = $title_blog;
    $_SESSION['paragraph1'] = $paragraph1;
    $_SESSION['intro'] = $intro;


    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention2 = explode(".", $img2['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention3 = explode(".", $img3['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt2 = strtolower(end($extention2)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt3 = strtolower(end($extention3)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $fileNew2 = rand() . "." . "webp";
    $fileNew3 = rand() . "." . "webp";

    $filePath1 = "assets/blog_upload/" . $fileNew1;
    $filePath2 = "assets/blog_upload/" . $fileNew2;
    $filePath3 = "assets/blog_upload/" . $fileNew3;


    if (empty($title_blog)) {
        $errorMsg = "กรุณากรอกชื่อเรื่อง";
    }else if(empty($intro)){
        $errorMsg = "กรุณากรอกข้อมูลในส่วนเกริ่นนำ";
    } 
    else if (empty($paragraph1)) {
        $errorMsg = "กรุณากรอกเนื้อหาที่ 1";
    } else {
        try {
            if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3)) {
                        $insert_blog = $conn->prepare("INSERT INTO blog_en(title_blog,intro ,paragraph1,blog_img1, blog_img2, blog_img3)
                                                    VALUES (:title_blog,:intro ,:paragraph1, :blog_img1, :blog_img2, :blog_img3)");
                        $insert_blog->bindParam(":title_blog", $title_blog);
                        $insert_blog->bindParam(":intro", $intro);
                        $insert_blog->bindParam(":paragraph1", $paragraph1);
                        $insert_blog->bindParam(":blog_img1", $fileNew1);
                        $insert_blog->bindParam(":blog_img2", $fileNew2);
                        $insert_blog->bindParam(":blog_img3", $fileNew3);
                        $insert_blog->execute();
                        if ($insert_blog) {
                            echo "<script>alert('เพิ่มบทความเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=blog?lang=en'>";
                            unset($_SESSION['title_blog']);
                            unset($_SESSION['paragraph1']);
                            unset($_SESSION['intro']);
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2)) {
                        $insert_blog = $conn->prepare("INSERT INTO blog_en(title_blog, intro,paragraph1, blog_img1, blog_img2)
                                                   VALUES (:title_blog, :intro,:paragraph1, :blog_img1, :blog_img2)");
                        $insert_blog->bindParam(":title_blog", $title_blog);
                        $insert_blog->bindParam(":intro", $intro);
                        $insert_blog->bindParam(":paragraph1", $paragraph1);
                        $insert_blog->bindParam(":blog_img1", $fileNew1);
                        $insert_blog->bindParam(":blog_img2", $fileNew2);
                        // $insert_blog->bindParam(":blog_img3", $fileNew3);
                        $insert_blog->execute();
                        if ($insert_blog) {
                            echo "<script>alert('เพิ่มบทความเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=blog?lang=en'>";
                            unset($_SESSION['title_blog']);
                            unset($_SESSION['paragraph1']);
                            unset($_SESSION['intro']);
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else  if (in_array($fileActExt1, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                        $insert_blog = $conn->prepare("INSERT INTO blog_en(title_blog, intro,paragraph1, blog_img1)
                                                   VALUES (:title_blog, :intro,:paragraph1,:blog_img1)");
                        $insert_blog->bindParam(":title_blog", $title_blog);
                        $insert_blog->bindParam(":intro", $intro);
                        $insert_blog->bindParam(":paragraph1", $paragraph1);
                        $insert_blog->bindParam(":blog_img1", $fileNew1);
                        // $insert_blog->bindParam(":blog_img2", $fileNew2);
                        // $insert_blog->bindParam(":blog_img3", $fileNew3);
                        $insert_blog->execute();
                        if ($insert_blog) {
                            echo "<script>alert('เพิ่มบทความเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=blog?lang=en'>";
                            unset($_SESSION['title_blog']);
                            unset($_SESSION['paragraph1']);
                            unset($_SESSION['intro']);
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            }else  if (in_array($fileActExt2, $allow)) {
                if ($img2['size'] > 0 && $img2['error'] == 0) {
                    if (move_uploaded_file($img2['tmp_name'], $filePath2)) {
                        $insert_blog = $conn->prepare("INSERT INTO blog_en(title_blog, intro,paragraph1, blog_img2)
                                                   VALUES (:title_blog, :intro,:paragraph1,:blog_img2)");
                        $insert_blog->bindParam(":title_blog", $title_blog);
                        $insert_blog->bindParam(":intro", $intro);
                        $insert_blog->bindParam(":paragraph1", $paragraph1);
                        $insert_blog->bindParam(":blog_img2", $fileNew2);
                        // $insert_blog->bindParam(":blog_img2", $fileNew2);
                        // $insert_blog->bindParam(":blog_img3", $fileNew3);
                        $insert_blog->execute();
                        if ($insert_blog) {
                            echo "<script>alert('เพิ่มบทความเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=blog?lang=en'>";
                            unset($_SESSION['title_blog']);
                            unset($_SESSION['paragraph1']);
                            unset($_SESSION['intro']);
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            }else  if (in_array($fileActExt3, $allow)) {
                if ($img3['size'] > 0 && $img3['error'] == 0) {
                    if (move_uploaded_file($img3['tmp_name'], $filePath3)) {
                        $insert_blog = $conn->prepare("INSERT INTO blog_en(title_blog, intro,paragraph1, blog_img3)
                                                   VALUES (:title_blog, :intro,:paragraph1,:blog_img3)");
                        $insert_blog->bindParam(":title_blog", $title_blog);
                        $insert_blog->bindParam(":intro", $intro);
                        $insert_blog->bindParam(":paragraph1", $paragraph1);
                        $insert_blog->bindParam(":blog_img3", $fileNew3);
                        // $insert_blog->bindParam(":blog_img2", $fileNew2);
                        // $insert_blog->bindParam(":blog_img3", $fileNew3);
                        $insert_blog->execute();
                        if ($insert_blog) {
                            echo "<script>alert('เพิ่มบทความเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=blog?lang=en'>";
                            unset($_SESSION['title_blog']);
                            unset($_SESSION['paragraph1']);
                            unset($_SESSION['intro']);
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else {
                $insert_blog = $conn->prepare("INSERT INTO blog_en(title_blog, intro,paragraph1)
                VALUES (:title_blog, :intro,:paragraph1)");
                $insert_blog->bindParam(":title_blog", $title_blog);
                $insert_blog->bindParam(":intro", $intro);
                $insert_blog->bindParam(":paragraph1", $paragraph1);
                // $insert_blog->bindParam(":blog_img1", $fileNew1);
                // $insert_blog->bindParam(":blog_img2", $fileNew2);
                // $insert_blog->bindParam(":blog_img3", $fileNew3);
                $insert_blog->execute();
                if ($insert_blog) {
                    echo "<script>alert('เพิ่มบทความเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=blog?lang=en'>";
                    unset($_SESSION['title_blog']);
                            unset($_SESSION['paragraph1']);
                            unset($_SESSION['intro']);
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<style>
    .none {
        display: none;
    }
</style>
<!-- Layout container -->
<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <p class="add-blog">เพิ่มบทความ (ภาษาอังกฤษ)</p>
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
                <label for="title_blog" class="mt-3 title_blog">หัวข้อเรื่อง</label>
                <input type="text" name="title_blog" value="<?php echo $_SESSION['title_blog'] ?>" id="title_blog" class="form-control ">
                <div class="pt">
                    <div class="box-txt-content2">
                        <label for="paragraph1" class="mt-3 paragraph1">เกริ่นนำ <span style="color: red;">(ไม่ควรเกิน 360 ตัวอักษร)</span> </label>
                        <textarea name="intro" id="intro" maxlength="50"><?php echo $_SESSION['intro']; ?></textarea>
                        <!-- <span id="now_length">dd</span> -->
                        <label for="paragraph1" class="mt-3 paragraph1">เนื้อหา</label>
                        <textarea type="text" class="paragraph1" name="paragraph1" id="paragraph1" class="form-control "><?php echo $_SESSION['paragraph1']; ?></textarea>

                        <script>
                            tinymce.init({
                                selector: 'textarea',
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect ',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                tinycomments_mode: 'embedded',
                                tinycomments_author: 'Author name',
                   
                                mergetags_list: [{
                                        value: 'First.Name',
                                        title: 'First Name'
                                    },
                                    {
                                        value: 'Email',
                                        title: 'Email'
                                    },
                                ],
                            });
                        </script>
                    </div>
                </div>

                <div class="box-img">

                    <button type="button" class="btn btn-primary" id="add_img">เพิ่มรูปภาพ</button>
                    <div class="close_img none"><button type="button" class="close" id="close">ยกเลิก</button></div>

                    <div class="txt-img mt-4"><span style="color: red;">รองรับไฟล์ (.jpg .jpeg .png .webp)</span></div>


                    <div class="pos none" id="pos">
                        <div class="filewrap">
                            <input name="img1" id="imgInput1" class="form-control" type="file" />
                            <img width="100%" id="previewImg1" alt="">
                        </div>
                        <p class=" cancle_img" id="cancel_img1"><i class="bi bi-x-square-fill"></i></p>
                        <div class="filewrap">
                            <input name="img2" id="imgInput2" class="form-control" type="file" />
                            <img width="100%" id="previewImg2" alt="">
                        </div>
                        <p class=" cancle_img" id="cancel_img2"><i class="bi bi-x-square-fill"></i></p>
                        <div class="filewrap">
                            <input name="img3" id="imgInput3" class="form-control" type="file" />
                            <img width="100%" id="previewImg3" alt="">
                        </div>
                        <p class=" cancle_img" id="cancel_img3"><i class="bi bi-x-square-fill"></i></p>
                    </div>
                </div>
                <div class="box-btn "> <button type="submit" name="add-blog-submit" class="btn-blog-submit">บันทึกข้อมูล</button></div>
            </form>
        </div>
    </div>
</div>

<script language="javascript" src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function() {
        var max_length = 15; // กำหนดจำนวนตัวอักษร
        $("#intro").keyup(function() { // เมื่อ textarea id เท่ากับ data  มี event keyup
            var this_length = max_length - $(this).val().length; // หาจำนวนตัวอักษรที่เหลือ
            if (this_length < 0) {
                $(this).val($(this).val().substr(0, 15)); // แสดงตามจำนวนตัวอักษรที่กำหนด
            } else {
                $("#now_length").html(this_length + " ตัวอักษร");
                // แสดงตัวอักษรที่เหลือ           
            }
        });
    });
</script>

<script>
    let imgInput1 = document.getElementById('imgInput1');
    let previewIm = document.getElementById('previewImg1');
    let imgInput2 = document.getElementById('imgInput2');
    let previewIm2 = document.getElementById('previewImg2');
    let imgInput3 = document.getElementById('imgInput3');
    let previewImg3 = document.getElementById('previewImg3');

    imgInput1.onchange = evt => {
        const [file] = imgInput1.files;
        if (file) {
            previewImg1.src = URL.createObjectURL(file);
        }
    }
    imgInput2.onchange = evt => {
        const [file] = imgInput2.files;
        if (file) {
            previewImg2.src = URL.createObjectURL(file);
        }
    }
    imgInput3.onchange = evt => {
        const [file] = imgInput3.files;
        if (file) {
            previewImg3.src = URL.createObjectURL(file);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#add_img').click(function() {
            $('#pos').removeClass("none");
            $('#cancle_img').removeClass("none");
            $('.close_img').removeClass("none");
            $('#close').removeClass("none");
        });
        $('#cancel_img1').click(function() {
            $('#previewImg1').attr("src", "");
            $('#imgInput1').val(null);
        });
        $('#cancel_img2').click(function() {
            $('#previewImg2').attr("src", "");
            $('#imgInput2').val(null);
        });
        $('#cancel_img3').click(function() {
            $('#previewImg3').attr("src", "");
            $('#imgInput3').val(null);
        });
        $('#close').click(function() {
            $('#close').addClass("none");
            $('#pos').addClass("none");
            $('#close').addClass("none");
            $('.close_img').addClass("none");
        });


    });
</script>
<script type="text/javascript">
    var max_length = 80;
    let tt = document.getElementById("#intro");
    $(function() {
        $(tt).keyup(function() {
            var this_length = max_length - $(this).val().length; // หาจำนวนตัวอักษรที่เหลือ
            if (this_length < 0) {
                $(this).val($(this).val().substr(0, 80)); // แสดงตามจำนวนตัวอักษรที่กำหนด
            } else {
                $("#now_length").html(this_length + " ตัวอักษร");
                // แสดงตัวอักษรที่เหลือ           
            }
        });
    });
</script>