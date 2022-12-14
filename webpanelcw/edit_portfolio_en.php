<link rel="stylesheet" href="assets/css/add_portfolio.css?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<?php include('menu_l.php');
require_once '../config/bddesign_db.php';

$id;

if (isset($_GET['portfolio_id'])) {
    $id = $_GET['portfolio_id'];
    $data_portfolio = $conn->prepare("SELECT * FROM portfolio_en WHERE id = :id");
    $data_portfolio->bindParam(":id", $id);
    $data_portfolio->execute();
    $row_data_portfolio = $data_portfolio->fetch(PDO::FETCH_ASSOC);
}



if (isset($_POST['edit-portfolio'])) {
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

  
            if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow) && in_array($fileActExt4, $allow) && in_array($fileActExt5, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0 && $img4['size'] > 0 && $img4['error'] == 0 && $img5['size'] > 0 && $img5['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3) && move_uploaded_file($img4['tmp_name'], $filePath4) && move_uploaded_file($img5['tmp_name'], $filePath5)) {
                        $insert_portfolio = $conn->prepare("UPDATE portfolio_en SET p_name = :p_name, lo_name = :lo_name, p_detail1 = :p_detail1, p_detail2 = :p_detail2,  t_name = :t_name, price = :price, img1 = :img1, img2 = :img2 , img3 = :img3 , img4 = :img4 , img5 = :img5 WHERE id = :id");
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
                        $insert_portfolio->bindParam(":id", $id);
                        $insert_portfolio->execute();
                        if ($insert_portfolio) {
                            echo "<script>alert('แก้ไขผลงานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow) && in_array($fileActExt4, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0 && $img4['size'] > 0 && $img4['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3) && move_uploaded_file($img4['tmp_name'], $filePath4)) {
                        $insert_portfolio = $conn->prepare("UPDATE portfolio_en SET p_name = :p_name, lo_name = :lo_name, p_detail1 = :p_detail1, p_detail2 = :p_detail2,  t_name = :t_name, price = :price, img1 = :img1, img2 = :img2 , img3 = :img3 , img4 = :img4  WHERE id = :id");
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
                        $insert_portfolio->bindParam(":id", $id);
                        $insert_portfolio->execute();
                        if ($insert_portfolio) {
                            echo "<script>alert('แก้ไขผลงานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow) && in_array($fileActExt3, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0 && $img3['size'] > 0 && $img3['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2) && move_uploaded_file($img3['tmp_name'], $filePath3)) {
                        $insert_portfolio = $conn->prepare("UPDATE portfolio_en SET p_name = :p_name, lo_name = :lo_name, p_detail1 = :p_detail1, p_detail2 = :p_detail2,  t_name = :t_name, price = :price, img1 = :img1, img2 = :img2 , img3 = :img3  WHERE id = :id");
                        $insert_portfolio->bindParam(":p_name", $p_name);
                        $insert_portfolio->bindParam(":lo_name", $lo_name);
                        $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                        $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                        $insert_portfolio->bindParam(":t_name", $t_name);
                        $insert_portfolio->bindParam(":price", $price);
                        $insert_portfolio->bindParam(":img1", $fileNew1);
                        $insert_portfolio->bindParam(":img2", $fileNew2);
                        $insert_portfolio->bindParam(":img3", $fileNew3);
                        $insert_portfolio->bindParam(":id", $id);
                        $insert_portfolio->execute();
                        if ($insert_portfolio) {
                            echo "<script>alert('แก้ไขผลงานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else if (in_array($fileActExt1, $allow) && in_array($fileActExt2, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 && $img2['size'] > 0 && $img2['error'] == 0) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) && move_uploaded_file($img2['tmp_name'], $filePath2)) {
                        $insert_portfolio = $conn->prepare("UPDATE portfolio_en SET p_name = :p_name, lo_name = :lo_name, p_detail1 = :p_detail1, p_detail2 = :p_detail2,  t_name = :t_name, price = :price, img1 = :img1, img2 = :img2  WHERE id = :id");
                        $insert_portfolio->bindParam(":p_name", $p_name);
                        $insert_portfolio->bindParam(":lo_name", $lo_name);
                        $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                        $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                        $insert_portfolio->bindParam(":t_name", $t_name);
                        $insert_portfolio->bindParam(":price", $price);
                        $insert_portfolio->bindParam(":img1", $fileNew1);
                        $insert_portfolio->bindParam(":img2", $fileNew2);
                        $insert_portfolio->bindParam(":id", $id);
                        $insert_portfolio->execute();
                        if ($insert_portfolio) {
                            echo "<script>alert('แก้ไขผลงานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            } else if (in_array($fileActExt1, $allow)) {
                if ($img1['size'] > 0 && $img1['error'] == 0 ) {
                    if (move_uploaded_file($img1['tmp_name'], $filePath1) ) {
                        $insert_portfolio = $conn->prepare("UPDATE portfolio_en SET p_name = :p_name, lo_name = :lo_name, p_detail1 = :p_detail1, p_detail2 = :p_detail2,  t_name = :t_name, price = :price, img1 = :img1  WHERE id = :id");
                        $insert_portfolio->bindParam(":p_name", $p_name);
                        $insert_portfolio->bindParam(":lo_name", $lo_name);
                        $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                        $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                        $insert_portfolio->bindParam(":t_name", $t_name);
                        $insert_portfolio->bindParam(":price", $price);
                        $insert_portfolio->bindParam(":img1", $fileNew1);
                        $insert_portfolio->bindParam(":id", $id);
                        $insert_portfolio->execute();
                        if ($insert_portfolio) {
                            echo "<script>alert('แก้ไขผลงานเรียบร้อยแล้ว')</script>";
                            echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                        } else {
                            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                        }
                    }
                }
            }
        
            else {
                $insert_portfolio = $conn->prepare("UPDATE portfolio_en SET p_name = :p_name, lo_name = :lo_name, p_detail1 = :p_detail1, p_detail2 = :p_detail2,  t_name = :t_name, price = :price WHERE id = :id");
                $insert_portfolio->bindParam(":p_name", $p_name);
                $insert_portfolio->bindParam(":lo_name", $lo_name);
                $insert_portfolio->bindParam(":p_detail1", $p_detail1);
                $insert_portfolio->bindParam(":p_detail2", $p_detail2);
                $insert_portfolio->bindParam(":t_name", $t_name);
                $insert_portfolio->bindParam(":price", $price);
                // $insert_portfolio->bindParam(":img1", $row_data_portfolio['img1']);
                // $insert_portfolio->bindParam(":img2", $row_data_portfolio['img2']);
                // $insert_portfolio->bindParam(":img3", $row_data_portfolio['img3']);
                // $insert_portfolio->bindParam(":img4", $row_data_portfolio['img4']);
                // $insert_portfolio->bindParam(":img5", $row_data_portfolio['img5']);
                $insert_portfolio->bindParam(":id", $id);
                $insert_portfolio->execute();
                if ($insert_portfolio) {
                    echo "<script>alert('แก้ไขผลงานเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=portfolio'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
        
        ?>

<!-- Layout container -->
<div class="layout-container" style="position: absolute; top: 80px; z-index: 1;">
    <aside id="layout-menus" class="layout-menu menu-vertical menu bg-menu-theme"></aside>
    <div class="layout-pages">
        <h4>แก้ไขผลงาน</h4>

        <?php
        if (isset($errorMsg)) { ?>
            <div class="alert alert-danger " id="alert-portfolio" role="alert">
                <?php echo $errorMsg ?>
            </div>
        <?php  }
        ?>
        <div class="box-form">
            <form method="post" class="form-lo" enctype="multipart/form-data">

            <div class="pt">
                    <div class="box-txt-content2">
                        <label for="p_name" class="mt-3 p_name">ชื่อผลงาน</label>
                        <input type="text" name="p_name" value="<?= $row_data_portfolio["p_name"] ?>" id="p_name" class="form-control ">
                    </div>
                    <div class="box-txt-content2">
                        <label for="type" class="mt-3 type">ประเภทผลงาน</label>
                        <input type="text" name="t_name"  value="<?= $row_data_portfolio["t_name"] ?>" id="type" class="form-control ">
                    </div>
                </div>

                <div class="pt">
                    <div class="box-txt-content2">
                        <label for="location" class="mt-3 location">สถานที่</label>
                        <input type="text" name="location" value="<?= $row_data_portfolio["lo_name"] ?>" id="location" class="form-control ">
                    </div>
                    <div class="box-txt-content1">
                        <label for="price" class="mt-3 price">ราคา (ล้านบาท)</label>
                        <input type="text" name="price" value="<?= $row_data_portfolio["price"] ?>" id="price" class="form-control ">
                    </div>
                </div>

                <div class="pt">
                    <div class="box-txt-content2">
                        <label for="detail1" class="mt-3 detail1">รายละเอียดผลงานย่อหน้าที่ 1 (จำเป็น)</label>
                        <textarea type="text" name="detail1"  id="detail1" class="form-control "><?= $row_data_portfolio["p_detail1"] ?></textarea>
                    </div>
                    <div class="box-txt-content1">
                        <label for="detail2" class="mt-3 detail2">รายละเอียดผลงานย่อหน้าที่ 2 (ไม่จำเป็น)</label>
                        <textarea type="text" name="detail2" value="<?= $row_data_portfolio["p_detail2"] ?>" id="detail2" class="form-control "></textarea>
                    </div>
                </div>

            <div class="txt-img mt-4"><span>รูปภาพเดิม</span></div>
            <div class="pos">
                <?php
                $row_img1 = explode(".", $row_data_portfolio["img1"]);
                $row_img2 = explode(".", $row_data_portfolio["img2"]);
                $row_img3 = explode(".", $row_data_portfolio["img3"]);
                $row_img4 = explode(".", $row_data_portfolio["img4"]);
                $row_img5 = explode(".", $row_data_portfolio["img5"]);

              
// echo '<pre>';
// print_r($row_data_portfolio);
// print_r($row_img4);
// echo '</pre>';
?>
               
                
                <div class="filewrap">
                    <img width="100%" src="assets/portfolio_upload/<?php if ($row_data_portfolio["img1"] == null) {
                                                                        echo 'file-upload.png';
                                                                    } else {
                                                                        echo $row_data_portfolio['img1'];
                                                                    } ?>" alt="ไม่มีรูปภาพ">
                </div>
                <div class="filewrap">
                    <img width="100%" src="assets/portfolio_upload/<?php if ($row_data_portfolio["img2"] == null) {
                                                                        echo 'file-upload.png';
                                                                    } else {
                                                                        echo $row_data_portfolio['img2'];
                                                                    } ?>" alt="ไม่มีรูปภาพ">
                </div>
                <div class="filewrap">
                    <img width="100%" src="assets/portfolio_upload/<?php if ($row_data_portfolio["img3"] == null) {
                                                                        echo 'file-upload.png';
                                                                    } else {
                                                                        echo $row_data_portfolio['img3'];
                                                                    } ?>" alt="ไม่มีรูปภาพ">
                </div>
                <div class="filewrap">
                    <img width="100%" src="assets/portfolio_upload/<?php if ($row_data_portfolio["img4"] == null) {
                                                                        echo 'file-upload.png';
                                                                    } else {
                                                                        echo $row_data_portfolio['img4'];
                                                                    } ?>" alt="ไม่มีรูปภาพ">
                </div>
                <div class="filewrap">
                    <img width="100%" src="assets/portfolio_upload/<?php if ($row_data_portfolio["img5"] == null) {
                                                                        echo 'file-upload.png';
                                                                    } else {
                                                                        echo $row_data_portfolio['img5'];
                                                                    } ?>" alt="ไม่มีรูปภาพ">
                </div>
            </div>

            <div class="txt-img mt-4"><span>รูปภาพใหม่ (นามสกุล .jpg .jpeg .png .webp)</span></div>
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

                <div class="box-btn "> <button type="submit" name="edit-portfolio" class="btn-portfolio-submit">แก้ไขข้อมูล</button></div>
        </div>
    </div>
</div>


<script>
    let imgInput1 = document.getElementById('imgInput1');
    let previewIm = document.getElementById('previewImg1');
    let imgInput2 = document.getElementById('imgInput2');
    let previewIm2 = document.getElementById('previewImg2');
    let imgInput3 = document.getElementById('imgInput3');
    let previewImg3 = document.getElementById('previewImg3');
    let imgInput4 = document.getElementById('imgInput4');
    let previewImg4 = document.getElementById('previewImg4');
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