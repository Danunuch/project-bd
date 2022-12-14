<?php
require_once('config/bddesign_db.php');
error_reporting(0);
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    if ($lang == "en") {
        $footer = $conn->prepare("SELECT * FROM aboutme_en");
        $footer->execute();
        $row_foot = $footer->fetch(PDO::FETCH_ASSOC);
    }else{
        $footer = $conn->prepare("SELECT * FROM aboutme");
        $footer->execute();
        $row_foot = $footer->fetch(PDO::FETCH_ASSOC);
    }
}else{
    $footer = $conn->prepare("SELECT * FROM aboutme");
$footer->execute();
$row_foot = $footer->fetch(PDO::FETCH_ASSOC);
}



?>
<footer>
    <section id="footer-section">
        <div class="container-xxl">
            <div class="row">

                <div class="col-lg-5 box-contact01">


                    <h3><?php echo $row_foot['company_name'] ?></h3>

                    <ul class="flex-column">
                        <li class="mb-1">
                            <?php echo $row_foot['address'] ?>
                        </li>


                    </ul>


                    <a class="box-tel" href="tel:0840885678" style="min-width: 250px;">
                        <span class="material-icons-sharp d-inline-block">
                            phone_in_talk
                        </span>

                        <!-- Audimed -->
                        Call Center<br>
                        <span class="tel"><?php echo $row_foot['call_center'] ?></span><br>
                        (auto)
                    </a>

                </div>


                <div class="col-lg-4 box-contact03">

                    <h3 class="mt-4 mt-lg-0"><?php if($lang == 'en'){echo "Contact";}else{echo "ติดต่อเรา";} ?></h3>

                    <div class="box-contact">

                        <ul>

                            <li><?php if($lang == 'en'){echo "Phone ";}else{echo "โทร ";} ?><?php echo $row_foot['tel1'] ?><br>
                            <?php if($lang == 'en'){echo "Fax ";}else{echo "โทรสาร ";} ?> <?php echo $row_foot['tel2'] ?></li>
                            <li><?php echo $row_foot['email'] ?></li>

                        </ul>






                    </div>




                </div>





                <!--                    <div class="box-social">

                         <a href="" title="" target="_blank"><i class="icofont-facebook"></i> </a>
                         <a href="" title="" target="_blank"><i class="icofont-facebook-messenger"></i> </a>
                         <a href="" title="" target="_blank"><i class="icofont-line"></i> </a>
                         <a href="" title="" target="_blank"><i class="icofont-youtube"></i></a>
                         <a href="mailto:sales.center@gets.co.th" title="" target="_blank"><i class="icofont-envelope"></i></a>
                     </div>
                 -->
                <div class="col-lg-3 box-contact02 text-center">


                    <img class="img-fluid" src="webpanelcw/assets/about_me/<?php echo $row_foot['line_qr'] ?>" alt="ยกับเราทาง Line">

                    <h3 class="mt-4 mt-lg-0"><?php if($lang == 'en'){echo "Talk to us via";}else{echo "คุยกับเราทาง";} ?> Line<br>Line ID : <?php echo $row_foot['line_id'] ?></h3>




                    <!--                    <div class="box-social">

                         <a href="" title="" target="_blank"><i class="icofont-facebook"></i> </a>
                         <a href="" title="" target="_blank"><i class="icofont-facebook-messenger"></i> </a>
                         <a href="" title="" target="_blank"><i class="icofont-line"></i> </a>
                         <a href="" title="" target="_blank"><i class="icofont-youtube"></i></a>
                         <a href="mailto:sales.center@gets.co.th" title="" target="_blank"><i class="icofont-envelope"></i></a>
                     </div>
                 -->
                </div>








            </div>
        </div>
    </section>




    <section id="section-copy">
        <div class="container-xxl">

            <div class="float-none float-md-end d-inline-block">
                <div class="payment-list box-copyright">
                    <span><span class="material-icons-sharp">person</span> วันนี้ : 54</span>
                    <span><span class="material-icons-sharp">people</span> เดือนนี้ : 954</span>
                    <span><span class="material-icons-sharp">leaderboard</span> ทั้งหมด : 6972</span>

                </div>
            </div>
            <div class="float-none float-md-start d-inline-block">
                <div class="box-copyright">

                    <p class="mt-2 mt-lg-0 d-none">
                        <span>
                            <img src="https://www.gets.co.th/images/logocw.webp" alt="บริษัทรับทำเว็บไซต์" title="บริษัทรับทำเว็บไซต์">
                        </span> Engine by <a href="http://www.cw.in.th/" title="บริษัทรับทำเว็บไซต์" target="_blank" class="text-white">CW</a> Copyright 2022 www.gets.co.th
                    </p>




                    <p class="mt-2 mt-lg-0">
                        <span>
                            <img src="images/logocw.webp" alt="บริษัทรับทำเว็บไซต์" title="บริษัทรับทำเว็บไซต์">
                        </span> Engine by <a class="text-white" href="http://www.cw.in.th/" title="บริษัทรับทำเว็บไซต์" target="_blank">CW</a> | Copyright : 2022 www.bddesign.com
                    </p>
                </div>
            </div>



        </div>
    </section>










    <!-- Back to top -->
    <div class="back-top">
        <div class="scroll-line"></div>
        <span class="scoll-text text-uppercase"><?php if($lang == 'en'){echo "Back to top";}else{echo "กลับขึ้นข้างบน";} ?></span>
    </div>



</footer>