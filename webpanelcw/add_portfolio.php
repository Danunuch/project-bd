<link rel="stylesheet" href="assets/css/add_portfolio.css?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<?php include('menu_l.php');
require_once '../config/bddesign_db.php';


if (isset($_POST['add-portfolio-submit'])) {
    $p_name = $_POST['p_name'];
    $lo_name = $_POST['location'];
    $p_detail1 = $_POST['detail1'];
    $p_detail2 = $_POST['detail2'];
    $price = $_POST['price'];
    $t_name = $_POST['t_name'];
    $img1 = $_FILES['img1'];
    $img2 = $_FILES['img2'];
    $img3 = $_FILES['img3'];
    $img4 = $_FILES['img4'];
    $img5 = $_FILES['img5'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img1['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention2 = explode(".", $img2['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention3 = explode(".", $img3['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention4 = explode(".", $img4['name']); //เเยกชื่อกับนามสกุลไฟล์
    $extention5 = explode(".", $img5['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt2 = strtolower(end($extention2)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt3 = strtolower(end($extention3)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt4 = strtolower(end($extention4)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileActExt5 = strtolower(end($extention5)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $fileNew2 = rand() . "." . "webp";
    $fileNew3 = rand() . "." . "webp";
    $fileNew4 = rand() . "." . "webp";
    $fileNew5 = rand() . "." . "webp";
    $filePath1 = "assets/portfolio_upload/" . $fileNew1;
    $filePath2 = "assets/portfolio_upload/" . $fileNew2;
    $filePath3 = "assets/portfolio_upload/" . $fileNew3;
    $filePath4 = "assets/portfolio_upload/" . $fileNew4;
    $filePath5 = "assets/portfolio_upload/" . $fileNew5;


    if (empty($p_name)) {
        $errorMsg = "กรุณากรอกชื่อผลงาน";
    } else if (empty($p_detail1)) {
        $errorMsg = "กรุณากรอกรายละเอียดผลงาน";
    } else if (empty($lo_name)) {
        $errorMsg = "กรุณากรอกสถานที่";
    } else if (empty($price)) {
        $errorMsg = "กรุณากรอกราคา";
    } else if (empty($t_name)) {
        $errorMsg = "กรุณากรอกประเภทผลงาน";
    } else {
        try {
            if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow) && in_array($fileActExt4, $allow) && in_array($fileActExt5, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0 && $img4['size'] > 0 && $img4['error'] == 0 && $img5['size'] > 0 && $img5['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3) && move_uploaded_file($img4['tmp_name'], $filePath4) && move_uploaded_file($img5['tmp_name'], $filePath5)) {
                        $insert_portfolio = $conn->prepare("INSERT INTO portfolio (p_name, lo_name, p_detail1, p_detail2, t_name, price, img1, img2, img3, img4, img5)
                                                    VALUES (:p_name, :lo_name, :p_detail1, :p_detail2, :t_name, :price, :img1, :img2, :img3, :img4, :img5)");
                        $insert_portfolio->bindParam(":p_name", $p_name);
                        $insert_portfolio->bindParam(":lo_name", $lo_name);
                        $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                        $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                        $insert_portfolio->bindParam(":t_name", $t_name);
                        $insert_portfolio->bindParam(":price", $price);
                        $insert_portfolio->bindParam(":img1", $fileNew1);
                        $insert_portfolio->bindParam(":img2", $fileNew2);
                        $insert_portfolio->bindParam(":img3", $fileNew3);
                        $insert_portfolio->bindParam(":img4", $fileNew4);
                        $insert_portfolio->bindParam(":img5", $fileNew5);
                        $insert_portfolio->execute();
                        if ($insert_portfolio) {
                            echo "<script>alert('เพิ่มผลงานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else 
            
            if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) || in_array($fileActExt3, $allow) || in_array($fileActExt4, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 || $img3['size'] > 0 && $img3['error'] == 0 || $img4['size'] > 0 && $img4['error'] == 0 ) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) || move_uploaded_file($img3['tmp_name'], $filePath3) || move_uploaded_file($img4['tmp_name'], $filePath4)) {
                        $insert_portfolio = $conn->prepare("INSERT INTO portfolio (p_name, lo_name, p_detail1, p_detail2, t_name, price, img1, img2, img3, img4)
                                                    VALUES (:p_name, :lo_name, :p_detail1, :p_detail2, :t_name, :price, :img1, :img2, :img3, :img4)");
                        $insert_portfolio->bindParam(":p_name", $p_name);
                        $insert_portfolio->bindParam(":lo_name", $lo_name);
                        $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                        $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                        $insert_portfolio->bindParam(":t_name", $t_name);
                        $insert_portfolio->bindParam(":price", $price);
                        $insert_portfolio->bindParam(":img1", $fileNew1);
                        $insert_portfolio->bindParam(":img2", $fileNew2);
                        $insert_portfolio->bindParam(":img3", $fileNew3);
                        $insert_portfolio->bindParam(":img4", $fileNew4);
                        // $insert_portfolio->bindParam(":img5", $fileNew5);
                        $insert_portfolio->execute();
                        if ($insert_portfolio) {
                            echo "<script>alert('เพิ่มผลงานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else  if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow) ) {
                    if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0) {
                        if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3)) {
                            $insert_portfolio = $conn->prepare("INSERT INTO portfolio (p_name, lo_name, p_detail1, p_detail2, t_name, price, img1, img2, img3)
                                                        VALUES (:p_name, :lo_name, :p_detail1, :p_detail2, :t_name, :price, :img1, :img2, :img3)");
                            $insert_portfolio->bindParam(":p_name", $p_name);
                            $insert_portfolio->bindParam(":lo_name", $lo_name);
                            $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                            $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                            $insert_portfolio->bindParam(":t_name", $t_name);
                            $insert_portfolio->bindParam(":price", $price);
                            $insert_portfolio->bindParam(":img1", $fileNew1);
                            $insert_portfolio->bindParam(":img2", $fileNew2);
                            $insert_portfolio->bindParam(":img3", $fileNew3);
                            // $insert_portfolio->bindParam(":img4", $fileNew4);
                            // $insert_portfolio->bindParam(":img5", $fileNew5);
                            $insert_portfolio->execute();
                            if ($insert_portfolio) {
                                echo "<script>alert('เพิ่มผลงานเรียบร้อยแล้ว')</script>";
                                echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                            } else {
                                echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                            }
                        }
                    }
                } else  if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) ) {
                    if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 ) {
                        if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2)) {
                            $insert_portfolio = $conn->prepare("INSERT INTO portfolio (p_name, lo_name, p_detail1, p_detail2, t_name, price, img1, img2)
                                                        VALUES (:p_name, :lo_name, :p_detail1, :p_detail2, :t_name, :price, :img1, :img2)");
                            $insert_portfolio->bindParam(":p_name", $p_name);
                            $insert_portfolio->bindParam(":lo_name", $lo_name);
                            $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                            $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                            $insert_portfolio->bindParam(":t_name", $t_name);
                            $insert_portfolio->bindParam(":price", $price);
                            $insert_portfolio->bindParam(":img1", $fileNew1);
                            $insert_portfolio->bindParam(":img2", $fileNew2);
                            // $insert_portfolio->bindParam(":img3", $fileNew3);
                            // $insert_portfolio->bindParam(":img4", $fileNew4);
                            // $insert_portfolio->bindParam(":img5", $fileNew5);
                            $insert_portfolio->execute();
                            if ($insert_portfolio) {
                                echo "<script>alert('เพิ่มผลงานเรียบร้อยแล้ว')</script>";
                                echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                            } else {
                                echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                            }
                        }
                    }
                } else  if (in_array($fileActExt1, $allow) ) {
                    if ($img1['size'] > 0 && $img1['error'] == 0 ) {
                        if (move_uploaded_file($img1['tmp_name'], $filePath1)) {
                            $insert_portfolio = $conn->prepare("INSERT INTO portfolio (p_name, lo_name, p_detail1, p_detail2, t_name, price, img1)
                                                        VALUES (:p_name, :lo_name, :p_detail1, :p_detail2, :t_name, :price, :img1)");
                            $insert_portfolio->bindParam(":p_name", $p_name);
                            $insert_portfolio->bindParam(":lo_name", $lo_name);
                            $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                            $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                            $insert_portfolio->bindParam(":t_name", $t_name);
                            $insert_portfolio->bindParam(":price", $price);
                            $insert_portfolio->bindParam(":img1", $fileNew1);
                            // $insert_portfolio->bindParam(":img2", $fileNew2);
                            // $insert_portfolio->bindParam(":img3", $fileNew3);
                            // $insert_portfolio->bindParam(":img4", $fileNew4);
                            // $insert_portfolio->bindParam(":img5", $fileNew5);
                            $insert_portfolio->execute();
                            if ($insert_portfolio) {
                                echo "<script>alert('เพิ่มผลงานเรียบร้อยแล้ว')</script>";
                                echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                            } else {
                                echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                            }
                        }
                    }
                } 
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>

<!-- Layout container -->
<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <div class="box-title">
            <p class="add-portfolio">เพิ่มผลงาน</p>
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

                <div class="pt">
                    <div class="box-txt-content2">
                        <label for="p_name" class="mt-3 p_name">ชื่อผลงาน</label>
                        <input type="text" name="p_name" id="p_name" class="form-control ">
                    </div>
                    <div class="box-txt-content2">
                        <label for="t_name" class="mt-3 t_name">ประเภทผลงาน</label>
                        <input type="text" name="t_name" id="t_name" class="form-control ">
                    </div>
                </div>

                <div class="pt">
                    <div class="box-txt-content2">
                        <label for="location" class="mt-3 location">สถานที่</label>
                        <input type="text" name="location" id="location" class="form-control ">
                    </div>
                    <div class="box-txt-content1">
                        <label for="price" class="mt-3 price">ราคา (ล้านบาท)</label>
                        <input type="text" name="price" id="price" class="form-control ">
                    </div>
                </div>

                <div class="pt">
                    <div class="box-txt-content2">
                        <label for="detail1" class="mt-3 detail1">รายละเอียดผลงานย่อหน้าที่ 1 (จำเป็น)</label>
                        <textarea type="text" name="detail1" id="detail1" class="form-control "></textarea>
                    </div>
                    <div class="box-txt-content1">
                        <label for="detail2" class="mt-3 detail2">รายละเอียดผลงานย่อหน้าที่ 2 (ไม่จำเป็น)</label>
                        <textarea type="text" name="detail2" id="detail2" class="form-control "></textarea>
                    </div>
                </div>

                <div class="txt-img mt-4"><span>รูปภาพ (นามสกุล .jpg .jpeg .png .webp)</span></div>
                <div class="pos">
                    <div class="filewrap">
                        <input name="img1" id="imgInput1" class="form-control" type="file" />
                        <img width="100%" id="previewImg1" alt="">
                    </div>
                    <div class="filewrap">
                        <input name="img2" id="imgInput2" class="form-control" type="file" />
                        <img width="100%" id="previewImg2" alt="">
                    </div>
                    <div class="filewrap">
                        <input name="img3" id="imgInput3" class="form-control" type="file" />
                        <img width="100%" id="previewImg3" alt="">
                    </div>
                    <div class="filewrap">
                        <input name="img4" id="imgInput4" class="form-control" type="file" />
                        <img width="100%" id="previewImg4" alt="">
                    </div>
                    <div class="filewrap">
                        <input name="img5" id="imgInput5" class="form-control" type="file" />
                        <img width="100%" id="previewImg5" alt="">
                    </div>
                </div>
                <div class="box-btn"> <button type="submit" name="add-portfolio-submit" class="btn-portfolio-submit">บันทึกข้อมูล</button></div>

            </form>
        </div>
    </div>
</div>

<script>
    let imgInput1 = document.getElementById('imgInput1');
    let previewIm1 = document.getElementById('previewImg1');
    let imgInput2 = document.getElementById('imgInput2');
    let previewIm2 = document.getElementById('previewImg2');
    let imgInput3 = document.getElementById('imgInput3');
    let previewImg3 = document.getElementById('previewImg3');
    let imgInput4 = document.getElementById('imgInput4');
    let previewIm4 = document.getElementById('previewImg4');
    let imgInput5 = document.getElementById('imgInput5');
    let previewImg5 = document.getElementById('previewImg5');

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
    imgInput4.onchange = evt => {
        const [file] = imgInput4.files;
        if (file) {
            previewImg4.src = URL.createObjectURL(file);
        }
    }
    imgInput5.onchange = evt => {
        const [file] = imgInput5.files;
        if (file) {
            previewImg5.src = URL.createObjectURL(file);
        }
    }
</script>