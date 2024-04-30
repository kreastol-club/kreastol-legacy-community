
<head>
  <meta property = "og: image" content = 'https://kreastol.club/Kreastol/img/Page-Logo.png'/>
  <link rel="icon" href='https://kreastol.club/Kreastol/img/Title-Logo.png'> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/register.css" type=text/css>
    <link rel="stylesheet" href="css/colors-schemes.css" type=text/css>
    <title><?php echo lang_check(array("Registration", "登録","Regisztráció", "Registracija"));?> </title>
</head>

<body>
<div class="header_cont">
<div class="header">
  <div class="title">
    <h2><?php echo lang_check(array("Kreastol Club ", "クレアストール・クラブ ","Kreastol Klub ", "Kreastol Klub ")); ?><span id='break'>|</span><span id='kreastol-title'><?php echo lang_check(array(" Registration", " 登録"," Regisztráció", " Registracija"));?></span>
    </h2>
  </div>
  <div class="language">
    <form id="lang" method="POST">
      <ul>
          <li><button type="submit" name="lang" value="en"><img alt="en-flag" src="img/flag/en-flag.jpg"></button></li>
          <li><button type="submit" name="lang" value="jp"><img src="img/flag/jp-flag.jpg"></button></li>
          <li><button type="submit" name="lang" value="rs"><img src="img/flag/rs-flag.png"></button></li>
          <li><button type="submit" name="lang" value="hu"><img src="img/flag/hu-flag.jpg"></button></li>
      </ul>
    </form>
  </div>
</div>
  
</div>
 <div id="announce">
     <p><?php echo lang_check(array("Register to site is still under development!<br>Profiles may be deleted!","ごめんなさい。英語の翻訳をチェックしてください。","A bejelentkezés még mindig feljlesztés alatt!<br>A fiókok lehet időnként törlődnek!","Prijava je još u fazi izrade!<br>Nalozi se mogu povremeno brisati!"))?></p>
 </div>
 <div class="container">
    <form id="form_1" method="POST">
    <?php echo $error ?>
    <h3><?php echo lang_check(array("CREATE ACCOUNT", "アカウントを作成する","FIÓK LÉTREHOZÁSA", "REGISTRUJ SE"));?></h3>
    <input type="text" name="username"placeholder="<?php echo lang_check(array("Username", "ユーザー名","Felhasználónév", "Korisničko ime"));?>"required>
    <input type="email" name="email" placeholder="<?php echo lang_check(array("Email", "メール","Email", "Email"));?>" required>
    <input type="password" name="password" placeholder="<?php echo lang_check(array("Password", "パスワード","Jelszó", "Lozinka"));?>" required>
    <input type="password" name="password2" placeholder="<?php echo lang_check(array("Confirm Password", "パスワードを認証する","Jelszó megerősítése", "Potvrdi Lozinku"));?>" required>
    <h4><?php echo lang_check(array("PERSONAL INFORMATION", "個人情報","SZEMÉLYES INFORMÁCIÓ", "LIČNA INFORMACIJA"));?></h4>
    <input type="text" name="fn" placeholder="First Name" required>
    <input type="text" name="ln" placeholder="Last Name" required>
    <h4><?php echo lang_check(array("DATE OF BIRTH", "生年月日","SZÜLETÉS DÁTUMA", "DAN ROĐENJA"));?></h4>
    <input type="date" name="bday" min='1899-01-01' max='2000-13-13' required>
    
    <label class="rcon"><?php echo lang_check(array("MALE", "男性","FÉRFI", "MUŠKO"));?>
        <input type="radio" checked="checked" name="gender" value="0" checked>
        <span class="checkmark"></span>
    </label>
    
    <label class="rcon"><?php echo lang_check(array("FEMALE", "女性","NŐ", "ŽENSKO"));?>
        <input type="radio" checked="checked" name="gender" value="1">
        <span class="checkmark"></span>
    </label>
    
    <div class="btn-box">
        <button id="logged" onclick="window.location.href='../login.php';" type="button"><?php echo lang_check(array("Already Logged In", "ログイン済み","Már van fiókom", "Već imam profil"));?></button>
        <button type="submit" id="register" name="register"><?php echo lang_check(array(" Registration", " 登録"," Regisztráció", " Registracija"));?></button>
    </div>
    </form></div>
    
