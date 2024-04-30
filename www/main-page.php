<?php
// Initialize the session
include('functions.php');
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta property = "og: image" content = "https://kreastol.club/Kreastol/img/Page-Logo.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://kreastol.club/Kreastol/img/Title-Logo.png">  
    <title><?php echo lang_check(array("Kreastol Klub ・ Community", "クレアストール・クラブ・コミュニティ", "Kreastol Klub ・ Közösség", "Kreastol Klub ・ Zajednice"))?></title>
    <link rel="stylesheet" href="css/main-page.css">
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/colors-schemes.css" type=text/css>
    <meta name="google-signin-client_id" content="565620529101-erafakpvn52m0nr40qn581dan2pnl463.apps.googleusercontent.com">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<script src="js/loading.js"></script>
    <div class="sidebar">
    <div class="hamburger-icon"><img src="img/menu.svg" alt=""></div>
    <div class="dropdown">
          <img src="img/settings.svg" id="settings-img" alt="">
            <div class="dropdown-content">
                <form id="lang" method="POST">
                    <ul>
                        <li><button type="submit" name="lang" value="en"><img alt="en-flag" src="img/flag/en-flag.jpg"></button></li>
                        <li><button type="submit" name="lang" value="jp"><img alt="jp-flag" src="img/flag/jp-flag.jpg"></button></li>
                        <li><button type="submit" name="lang" value="rs"><img alt="rs-flag" src="img/flag/rs-flag.png"></button></li>
                        <li><button type="submit" name="lang" value="hu"><img alt="hu-flag" src="img/flag/hu-flag.jpg"></button></li>
                    </ul>
                </form>
                <ul id="colors">
                    <li class="default-color" id="default-color"></li>
                    <li class="blue" id="blue"></li>
                    <li class="purple" id="purple"></li>
                    <li class="red-color" id="red-color"></li>
                    <li class="yellow" id="yellow"></li>
                    <li class="orange" id="orange"></li>

                </ul>
            </div>
        </div>
    <div class="title">
          <h2><?php echo lang_check(array("Kreastol Club", "クレアストール・クラブ","Kreastol Klub", "Kreastol Klub"))?></h2>
      </div>
    </div>
    <div class="header">
      <div class="title">
        <h2><?php echo lang_check(array("Kreastol Club", "クレアストール・クラブ","Kreastol Klub", "Kreastol Klub"))?></h2>
      </div>

      <div class="navbar">
        <ul>
            <li><a href="main-page.php?a=gallery"><?php echo lang_check(array("Gallery", "画廊","Galéria", "Galerija"))?></a></li> 
            <li><a href='main-page.php?a=posts'><?php echo lang_check(array("Posts", "投稿","Posztok", "Postovi"))?></a></li> 
            <li><a href='main-page.php?a=calendar'><?php echo lang_check(array("Calendar", "カレンダー","Naptár", "Kalendar"))?></a></li>
            <li><a href='main-page.php?a=qna'><?php echo lang_check(array("Q&A", "Q&A","Q&A", "Q&A"))?></a></li>
            <!--<li><a href='main-page.php?a=calendar'><?php echo lang_check(array("Calendar", "カレンダー","Naptár", "Kalendar"))?></a></li>-->
        </ul>
      </div>
      <div class="dropdown desktop-dropdown">
          <img src="img/settings.svg" id="settings-img" alt="">
            <div class="dropdown-content">
                <form id="lang" method="POST">
                    <ul>
                        <li><button type="submit" name="lang" value="en"><img alt="en-flag" src="img/flag/en-flag.jpg"></button></li>
                        <li><button type="submit" name="lang" value="jp"><img alt="jp-flag" src="img/flag/jp-flag.jpg"></button></li>
                        <li><button type="submit" name="lang" value="rs"><img alt="rs-flag" src="img/flag/rs-flag.png"></button></li>
                        <li><button type="submit" name="lang" value="hu"><img alt="hu-flag" src="img/flag/hu-flag.jpg"></button></li>
                    </ul>
                </form>
                <ul id="colors">
                    <li class="default-color" id="default-color-d"></li>
                    <li class="blue" id="blue-d"></li>
                    <li class="purple" id="purple-d"></li>
                    <li class="red-color" id="red-color-d"></li>
                    <li class="yellow" id="yellow-d"></li>
                    <li class="orange" id="orange-d"></li>
                    <script src="js/color-scheme.js"></script>
                </ul>
            </div>
        </div>

        <div class="log-part">

                <?php
            
                // Check if the user is logged in
                if(!isset($_SESSION["username"]))
                {?>
                <ul>
                    <li><button id="register-b"  onclick="window.location.href='register.php';"><?php echo lang_check(array(" Register", "登録する"," Regisztrálás", " Registracija"))?></button></li>
                    <li><button onclick="window.location.href='login.php';" id="login-b"><?php echo lang_check(array("Log In", "ログインする","Bejelentkezés", "Prijavite se"))?></button></li>
                </ul>

                <?php
                }else
                {?>
                <ul>
                    <li><form method="post"><button type="submit" id="register-b" name="profile"><?php echo lang_check(array("My Profile", "マイアカウント","Én Fiókom", "Moj profil"))?></button></form></li>
                    <li><button onclick="window.location.href='logout.php';" id="login-b"><?php echo lang_check(array("Log Out", "ログアウト","Kijelentkezés", "Odjaviti se"))?></button></li>

                    <?php
                    if(isset($_SESSION['admin']) == true)
                        echo "<li><button onclick=\"window.location.href='admin.php';\" id=\"login-b\">Management</button></li>";
                    ?></ul>
                <?php }?>

        </div>
    </div>
    <div class="container">
        <?php
        include "page-select.php";
        ?>
    </div>
    <script src="js/home-js.js"></script>
    <script src="js/loading.js"></script>
</body>
</html>