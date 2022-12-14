<?php
session_start();
require_once '../config/bddesign_db.php';

if (!isset($_SESSION['admin_login'])) {
    header("location: login");
}
?>

<?php
if (isset($_SESSION['admin_login'])) {
    $user_id = $_SESSION['admin_login'];
    $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="adimage/logo_bd.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>

    <script src="https://cdn.tiny.cloud/1/2c646ifr40hywrvj32dwwml8e5qmxxr52qvzmjjq7ixbrjby/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body style="font-family: 'Kanit', sans-serif;">
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
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

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu Side bar  -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="adimage/logo_bd.png" width="65px" alt="">
                        </span>
                        <span class="demo menu-text fw-bolder ms-2" style="font-size: 22px; font-weight: bold;">Design</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <!-- Dashboard -->

                    <li class="menu-item " id="home">
                        <a href="index" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">หน้าหลัก</div>
                        </a>
                    </li>

                    <!-- Performance -->
                    <li class="menu-item  " id="portfolio">
                        <a href="portfolio" class="menu-link ">
                            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                            <div>ผลงาน</div>
                        </a>
                    </li>

                    <!-- Service -->
                    <li class="menu-item  " id="service">
                        <a href="service" class="menu-link ">
                            <i class="menu-icon tf-icons bi bi-tools "></i>
                            <div>บริการ</div>
                        </a>
                    </li>

                    <!-- Aticle -->
                    <li class="menu-item " id="blog">
                        <a href="blog" class="menu-link">
                            <i class="menu-icon bi bi-journals"></i>
                            <div data-i18n="blog">บทความ</div>
                        </a>
                    </li>

                    <!-- Aticle -->
                    <li class="menu-item " id="blog">
                        <a href="about_us" class="menu-link">
                            <i class="menu-icon bi bi-file-earmark-person-fill"></i>

                            <div data-i18n="blog">เกี่ยวกับเรา</div>
                        </a>
                    </li>

                    <!-- About -->
                    <li class="menu-item " id="aboutme">
                        <a href="contact" class="menu-link">
                            <i class="menu-icon bi bi-telephone"></i>

                            <div>ติดต่อเรา</div>
                        </a>
                    </li>
                    <li class="menu-item " id="aboutme">
                        <a href="logout" class="menu-link">
                            <i class="menu-icon bi bi-box-arrow-left"></i>

                            <div>ออกจากระบบ</div>
                        </a>
                    </li>
                    <li class="menu-item " id="aboutme" style="position: absolute; bottom: 10px;">
                        <div class="ml-auto" style="padding: 20px; margin: 0 auto;">Powered by <a href="https://www.cw.in.th" target="_blank" style="font-weight: bold; color: #000000;">Channel Wide Computer Co., Ltd.</a></div>
                    </li>
                </ul>
            </aside>
            <!-- / Menu Side bar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <span style="color: #000000;"><b>Business Development And Design</b></span>
                            </div>
                        </div>
                        <!-- /Search -->

                        <!-- <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <span>Powered by <a href="https://www.cw.in.th" target="_blank" style="font-weight: bold; color: #000000;">Channel Wide Computer Co., Ltd.</a></span>
                          
                        </ul> -->
                    </div>
                </nav>

                <!-- / Navbar -->


                <div class="content-backdrop fade"></div>

            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>

    </script>
</body>

</html>