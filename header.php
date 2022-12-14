<?php if (!isset($_SESSION)) {
  session_start();
}   ?>
<header>
  <!-- Start Navigation -->
  <nav hidden>
    <div class="nav-header">
      <a href="index" <?php unset($_SESSION['lang']); ?> class="brand" title="รับเหมา ระบบไฟฟ้าอาคาร ระบบสุขาภิบาล ระบบปรับอากาศ ระบบดับเพลง  ระบบไฟฟ้า"><img src="images/logo.webp" /></a>
      <button class="toggle-bar">
        <span class="material-icons-outlined">
          menu
        </span>
        เมนู
      </button>
    </div>
    <ul class="menu">
      <li><a href="index<?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "?lang=en";
                                } else {
                                  echo "";
                                }
                              } else {
                                echo "";
                              } ?>"><?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "Home";
                                } else {
                                  echo "หน้าแรก";
                                }
                              } else {
                                
                                echo "หน้าแรก";
                              } ?></a></li>
      <li><a href="portfolio<?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "?lang=en";
                                } else {
                                  echo "";
                                }
                              } else {
                                echo "";
                              } ?>"><?php if (isset($_GET['lang'])) {
                                    if ($_GET['lang'] == "en") {
                                      echo "Portfolio";
                                    } else {
                                      echo "ผลงาน";
                                    }
                                  } else {
                                 
                                    echo "ผลงาน";
                                  } ?></a></li>
      <li><a href="service<?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "?lang=en";
                                } else {
                                  echo "";
                                }
                              } else {
                                echo "";
                              } ?>"><?php if (isset($_GET['lang'])) {
                                  if ($_GET['lang'] == "en") {
                                    echo "Service";
                                  } else {
                                    echo "บริการ";
                                  }
                                } else {
                             
                                  echo "บริการ";
                                } ?></a></li>
      <li><a href="blog<?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "?lang=en";
                                } else {
                                  echo "";
                                }
                              } else {
                                echo "";
                              } ?>"><?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "Blog";
                                } else {
                                  echo "บทความ";
                                }
                              } else {
                            
                                echo "บทความ";
                              } ?></a></li>
      <li><a href="about<?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "?lang=en";
                                } else {
                                  echo "";
                                }
                              } else {
                                echo "";
                              } ?>"><?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "About Me";
                                } else {
                                  echo "เกี่ยวกับเรา";
                                }
                              } else {
                                echo "เกี่ยวกับเรา";
                              } ?></a></li>
      <li><a href="contact<?php if (isset($_GET['lang'])) {
                                if ($_GET['lang'] == "en") {
                                  echo "?lang=en";
                                } else {
                                  echo "";
                                }
                              } else {
                                echo "";
                              } ?>"><?php if (isset($_GET['lang'])) {
                                  if ($_GET['lang'] == "en") {
                                    echo "Contact";
                                  } else {
                                    echo "ติดต่อเรา";
                                  }
                                } else {
                                  echo "ติดต่อเรา";
                                } ?></a></li>

    </ul>
    <ul class="attributes">
      <li><a href="?lang=th" <?php
                              if (!isset($_GET['lang'])) {
                                echo "class='active'";
                              } else if (isset($_GET['lang'])) {
                                $lang = $_GET['lang'];
                                if ($lang == 'th') {
                                  echo "class='active'";
                                } else {

                                  echo "class='not_active'";
                                }
                              } ?>>
          <img class="flag" src="images/thailand.webp">
        </a></li>
      <li><a href="?lang=en" <?php
                              if (!isset($_GET['lang'])) {
                                echo "class='not_active'";
                              } else if (isset($_GET['lang'])) {
                                $lang = $_GET['lang'];
                                if ($lang == 'en') {
                                  echo "class='active'";
                                } else {

                                  echo "class='not_active'";
                                }
                              } ?>><img class="flag" src="images/uk.webp"></a></li>

    </ul>
  </nav>
  <!-- End Navigation -->
</header>