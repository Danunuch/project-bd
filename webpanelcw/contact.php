<link rel="stylesheet" href="assets/css/contact.css?v=<?php echo time(); ?>" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<?php include('menu_l.php');
require_once('../config/bddesign_db.php');
error_reporting(0);
$about = $conn->prepare("SELECT * FROM aboutme");
$about->execute();
$row_about = $about->fetchAll();

$about_en = $conn->prepare("SELECT * FROM aboutme_en");
$about_en->execute();
$row_about_en = $about_en->fetch(PDO::FETCH_ASSOC);


/// message
$page = $_GET['page'];
$message_count = $conn->prepare("SELECT * FROM message");
$message_count->execute();
$count_message = $message_count->fetchAll();


$rows = 6;
if ($page == "") {
    $page = 1;
}
$total_data = count($count_message);
$total_page = ceil($total_data / $rows);
$start = ($page - 1) * $rows;

$message = $conn->prepare("SELECT * FROM message LIMIT $start,6");
$message->execute();
$row_message = $message->fetchAll();


if (isset($_GET['delete_message_id'])) {
    $delete_message_id = $_GET['delete_message_id'];
    $delete_message = $conn->prepare("DELETE FROM message WHERE id = :id");
    $delete_message->bindParam(":id", $delete_message_id);
    $delete_message->execute();

    if ($delete_message) {
        echo "<script>alert('ลบข้อความของลูกค้าเรียบร้อยแล้ว')</script>";
        echo "<meta http-equiv='Refresh' content='0.001; url=contact'>";
    }
}

//แก้ไข
if (isset($_POST['edit-aboutme'])) {
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
    $email = $_POST['email'];
    $line_qr = $_FILES['line_qr'];
    $line_id = $_POST['line_id'];
    $call_center = $_POST['call_center'];
    $img_qr = $row_about[0]['line_qr'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $line_qr['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "assets/about_me/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($line_qr['size'] > 0 && $line_qr['error'] == 0) {
            if (move_uploaded_file($line_qr['tmp_name'], $filePath1)) {
                $update_me = $conn->prepare("UPDATE aboutme SET company_name = :company_name, address = :address, tel1 = :tel1, tel2 = :tel2, call_center = :call_center ,line_qr = :line_qr, line_id = :line_id,email = :email");
                $update_me->bindParam(":company_name", $company_name);
                $update_me->bindParam(":address", $address);
                $update_me->bindParam(":tel1", $tel1);
                $update_me->bindParam(":tel2", $tel2);
                $update_me->bindParam(":line_id", $line_id);
                $update_me->bindParam(":call_center", $call_center);
                $update_me->bindParam(":line_qr", $fileNew1);
                $update_me->bindParam(":email", $email);
                $update_me->execute();

                if ($update_me) {
                    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=contact'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else {
        $update_me = $conn->prepare("UPDATE aboutme SET company_name = :company_name, address = :address, tel1 = :tel1, tel2 = :tel2,call_center = :call_center ,line_qr = :line_qr, line_id = :line_id,email = :email");
        $update_me->bindParam(":company_name", $company_name);
        $update_me->bindParam(":address", $address);
        $update_me->bindParam(":tel1", $tel1);
        $update_me->bindParam(":tel2", $tel2);
        $update_me->bindParam(":line_id", $line_id);
        $update_me->bindParam(":line_qr", $img_qr);
        $update_me->bindParam(":call_center", $call_center);
        $update_me->bindParam(":email", $email);
        $update_me->execute();

        if ($update_me) {
            echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=contact'>";
        } else {
            echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
        }
    }
}
if (isset($_POST['edit-aboutme-en'])) {
    $company_name_en = $_POST['company_name_en'];
    $address_en = $_POST['address_en'];
    $tel1_en = $_POST['tel1_en'];
    $tel2_en = $_POST['tel2_en'];
    $email_en = $_POST['email_en'];
    $line_qr_en = $_FILES['line_qr_en'];
    $line_id_en = $_POST['line_id_en'];
    $call_center_en = $_POST['call_center_en'];
    $img_qr_en = $row_about_en['line_qr'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $line_qr_en['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . $fileActExt1;
    $filePath1 = "assets/about_me/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($line_qr_en['size'] > 0 && $line_qr_en['error'] == 0) {
            if (move_uploaded_file($line_qr_en['tmp_name'], $filePath1)) {
                $update_me = $conn->prepare("UPDATE aboutme_en SET company_name = :company_name, address = :address, tel1 = :tel1, tel2 = :tel2, call_center = :call_center,line_qr = :line_qr, line_id = :line_id,email = :email");
                $update_me->bindParam(":company_name", $company_name_en);
                $update_me->bindParam(":address", $address_en);
                $update_me->bindParam(":tel1", $tel1_en);
                $update_me->bindParam(":tel2", $tel2_en);
                $update_me->bindParam(":line_id", $line_id_en);
                $update_me->bindParam(":call_center", $call_center_en);
                $update_me->bindParam(":line_qr", $fileNew1);
                $update_me->bindParam(":email", $email_en);
                $update_me->execute();

                if ($update_me) {
                    echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
                    echo "<meta http-equiv='Refresh' content='0.001; url=contact'>";
                } else {
                    echo "<script>alert('มีบางอย่างผิดพลาด')</script>";
                }
            }
        }
    } else {
        $update_me = $conn->prepare("UPDATE aboutme_en SET company_name = :company_name, address = :address, tel1 = :tel1, tel2 = :tel2, call_center = :call_center,line_qr = :line_qr , line_id = :line_id, email = :email");
        $update_me->bindParam(":company_name", $company_name_en);
        $update_me->bindParam(":address", $address_en);
        $update_me->bindParam(":tel1", $tel1_en);
        $update_me->bindParam(":tel2", $tel2_en);
        $update_me->bindParam(":line_id", $line_id_en);
        $update_me->bindParam(":line_qr", $img_qr_en);
        $update_me->bindParam(":call_center", $call_center_en);
        $update_me->bindParam(":email", $email_en); 
        $update_me->execute();

        if ($update_me) {
            echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv='Refresh' content='0.001; url=contact'>";
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
        <div class="box-title">
            <p class="contact-me">ติดต่อเรา
                <!-- <button class="btn-add-blog" onclick="show()">แก้ไขข้อมูล</button> -->
            </p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr align="center">
                        <th scope="col">ชื่อ</th>
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">Line ID</th>
                        <th scope="col">โทร</th>
                        <th scope="col">โทรสาร</th>
                        <th scope="col">อีเมล</th>
                        <th scope="col">Call Center</th>
                        <th scope="col">Qr code</th>
                    </tr>
                </thead>
                <tbody> <?php
                        $i = 1;
                        if (!$row_about) {
                            echo "ยังไม่มีบทความ";
                        } else {

                            foreach ($row_about as $row_about) { ?>
                            <tr align="center">
                                <td><?= $row_about['company_name']; ?></td>
                                <td><?= $row_about['address']; ?></td>
                                <td><?= $row_about['line_id']; ?></td>
                                <td><?= $row_about['tel1'];  ?></td>
                                <td><?= $row_about['tel2'];  ?></td>
                                <td><?= $row_about['email']; ?></td>
                                <td><?= $row_about['call_center']; ?></td>
                                <td> <img width="80px" src="assets/about_me/<?= $row_about['line_qr']; ?>" alt="qr_code"></td>
                            </tr>
                            <tr align="center">
                                <td><?= $row_about_en['company_name']; ?></td>
                                <td><?= $row_about_en['address']; ?></td>
                                <td><?= $row_about_en['line_id']; ?></td>
                                <td><?= $row_about_en['tel1'];  ?></td>
                                <td><?= $row_about_en['tel2'];  ?></td>
                                <td><?= $row_about_en['email']; ?></td>
                                <td><?= $row_about_en['call_center']; ?></td>
                                <td> <img width="80px" src="assets/about_me/<?= $row_about_en['line_qr']; ?>" alt="qr_code"></td>
                            </tr>
                    <?php $i++;
                            }
                        }
                    ?>
                </tbody>

            </table>
        </div>
        
        <div class="box-form" id="box-f">
            <div class="box-title">
                <p class="contact-me">แก้ไขข้อมูล (ภาษาไทย)</p>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="box-edit-me">
                    <div class="f-1"><span class="w-txt">ชื่อ</span>
                        <input type="text" name="company_name" value="<?php echo $row_about["company_name"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">ที่อยู่</span>
                        <input type="text" name="address" value="<?php echo $row_about["address"]; ?>" id="w-f" class="form-control">

                    </div>
                    <div class="f-2">
                        <span class="w-txt">โทร</span>
                        <input type="text" name="tel1" value="<?php echo $row_about["tel1"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">โทรสาร</span>
                        <input type="text" name="tel2" value="<?php echo $row_about["tel2"]; ?>" id="w-f" class="form-control">

                    </div>
                    <div class="f-2"><span class="w-txt">อีเมล</span>
                        <input type="text" name="email" value="<?php echo $row_about["email"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">QR Code</span>
                        <input type="file" name="line_qr" id="w-f" class="form-control">
                    </div>
                    <div class="f-2"><span class="w-txt">Line ID</span>
                        <input type="text" name="line_id" value="<?php echo $row_about["line_id"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">Call Center</span>
                        <input type="tel" name="call_center" value="<?php echo $row_about["call_center"]; ?>" id="w-f" class="form-control">
                    </div>
                    <div class="box-btn">
                        <button class="btn-add-blog" type="submit" name="edit-aboutme">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-form" id="box-f">
            <div class="box-title">
                <p class="contact-me">แก้ไขข้อมูล (ภาษาอังกฤษ)</p>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="box-edit-me">
                    <div class="f-1"><span class="w-txt">ชื่อ</span>
                        <input type="text" name="company_name_en" value="<?php echo $row_about_en["company_name"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">ที่อยู่</span>
                        <input type="text" name="address_en" value="<?php echo $row_about_en["address"]; ?>" id="w-f" class="form-control">

                    </div>
                    <div class="f-2">
                        <span class="w-txt">โทร</span>
                        <input type="tel" name="tel1_en" value="<?php echo $row_about_en["tel1"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">โทรสาร</span>
                        <input type="tel" name="tel2_en" value="<?php echo $row_about_en["tel2"]; ?>" id="w-f" class="form-control">

                    </div>
                    <div class="f-2"><span class="w-txt">อีเมล</span>
                        <input type="text" name="email_en" value="<?php echo $row_about_en["email"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">QR Code</span>
                        <input type="file" name="line_qr_en" id="w-f" class="form-control">
                    </div>
                    <div class="f-2"><span class="w-txt">Line ID</span>
                        <input type="text" name="line_id_en" value="<?php echo $row_about_en["line_id"]; ?>" id="w-f" class="form-control">
                        <span class="w-txt">Call Center</span>
                        <input type="tel" name="call_center_en" value="<?php echo $row_about_en["call_center"]; ?>" id="w-f" class="form-control">
                    </div>
                    <div class="box-btn">
                        <button class="btn-add-blog" type="submit" name="edit-aboutme-en">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="line-bottom"></div>
        <div class="box-title">
            <p class="contact-me">ข้อความจากลูกค้า</p>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr align="center">

                        <th scope="col">ชื่อเรื่อง</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">อีเมล</th>
                        <!-- <th scope="col">ข้อความ</th> -->
                    </tr>
                </thead>
                <tbody> <?php
                        $i = 1;
                        if (!$row_message) {
                            echo "ยังไม่มีบทความ";
                        } else {

                            foreach (array_reverse($row_message) as $row_message) { ?>
                            <tr align="center">
                                <!-- <th scope="row"><?= $i  ?></th> -->
                                <td><?= $row_message['title_name']; ?></td>
                                <td><?= $row_message['name'];  ?></td>
                                <td><?= $row_message['email'];  ?></td>
                                <!-- <td><?= $row_message['content'];  ?></td> -->
                                <td>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-eye"></i></button>
                                    <a href="contact?delete_message_id=<?= $row_message["id"] ?>" onclick="return confirm('คุณต้องการลบข้อความนี้ใช่ไหม')"><button class="btn btn-danger"><i class="bi bi-trash"></i></button></a>
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
                <a class="page-link previous-page" href="contact?page=<?= $page - 1 ?>" aria-disabled="true">ก่อนหน้า</a>
            </li>
            <?php
            for ($i = 1; $i <= $total_page; $i++) { ?>
                <li <?php if ($page == $i) {
                        echo "class='page-item active'";
                    } ?>><a class="page-link" href="contact?page=<?= $i ?>"><?= $i ?></a></li>
            <?php }
            ?>

            <li <?php if ($page == $total_page) {
                    echo "class='page-item disabled'";
                } ?>>
                <a class="page-link nextpage" href="contact?page=<?= $page + 1 ?>">ถัดไป </a>
            </li>

        </ul>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ข้อความจากลูกค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <p>คุณ : <?php echo $row_message["name"] ?></p>
                    <p>ข้อความ : <?php echo $row_message["content"] ?></p>
                    <p>ติดต่อกลับ : <?php echo $row_message["tel"] ?></p>
            </div>

        </div>
    </div>
</div>