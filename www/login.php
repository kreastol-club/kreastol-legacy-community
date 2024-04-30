<?php
$error = NULL;
include('config.php');
include('functions.php');

header('Content-Type: text/html;charset=UTF-8');

if(isset($_SESSION['username']))
    header("location: main-page.php");
    


if(isset($_POST['login']))
{
    if(empty($_POST['username']) || empty($_POST['password']))
    {
        echo '<script>alert("Both fields are required")</script>';
    }
    else
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                if( $row['verified'] != 1)
                {
                    $error .= "<p>".lang_check(array("Your account isn't verified!", "アカウントはまだ確認されていません。","A fiókod még nincs megerősítve!", "PRIJAVITE SE"))."</p>";
                }
                elseif(password_verify($password,$row['password'])){
                    if($row['admin'] == 'y')    
                        $_SESSION["admin"] = true;

                    $_SESSION["username"] = $username;
                    header("location: main-page.php");
                }
                else
                {
                    $error .= "<p>".lang_check(array("Wrong password!", "間違ったパスワード。","Rosst jelszó!", "Pogrešna Lozinka!"))."</p>";           
                }
            }
        }
        else
        {
            $error .= "<p>".lang_check(array("There isn't a user with<b>$username</b>username!", "<b>$username</b>ユーザー名を持つユーザーは存在しません。","Nincs <b>$username</b> nevű felhasználó!", "Ne postoji korisnik koji se zove <b>$username</b>"))."</p>";
        }
            
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta property = "og: image" content = "https://kreastol.club/Kreastol/img/Page-Logo.png"/>
    <link rel="icon" href="img/Title-Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
  <title><?php echo lang_check(array("Login", "ログインする","Bejelentkezés", "Prijavite se"));?> </title>
    <link rel="stylesheet" href="css/colors-schemes.css" type=text/css>

    <link href="css/login.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
</head>
    <body>
    
    <div class="header">
        <div class="title">
            <h2><?php echo lang_check(array("Kreastol Club ", "クレアストール・クラブ ","Kreastol Klub ", "Kreastol Klub ")); ?><span id='break'>|</span><span id='kreastol-title'><?php echo lang_check(array(" Login", " ログインする"," Bejelentkezés", " Prijavite se"));?></span></h2>
        </div>

        <div class="language">
            <form action="<?php $_SERVER['PHP_SELF']?>" id="language_f" method="POST">
                <ul>
                <li><button type="submit" name="lang" value="en"><img src="img/flag/en-flag.jpg"></button></li>
                <li><button type="submit" name="lang" value="jp"><img src="img/flag/jp-flag.jpg"></button></li>
                <li><button type="submit" name="lang" value="rs"><img src="img/flag/rs-flag.png"></button></li>
                <li><button type="submit" name="lang" value="hu"><img src="img/flag/hu-flag.jpg"></button></li>
                </ul>
            </form>
        </div>
    </div>



    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF']?>" id="form_1" method="POST">
            <?php echo $error ?>
            <h3><?php echo lang_check(array("LOGIN", "ログインする","BEJELENTKEZÉS", "PRIJAVITE SE"));?></h3>
            <input type="text" name="username"placeholder="<?php echo lang_check(array("Username", "ユーザー名","Felhasználónév", "Korisničko ime"));?>"required>
            <input type="password" name="password" placeholder="<?php echo lang_check(array("Password", "パスワード","Jelszó", "Lozinka"));?>" required>
            
            <div class="btn-box">
                <button id="logged" onclick="window.location.href='register.php';" type="button"><?php echo lang_check(array(" Registration", " 登録"," Regisztráció", " Registracija"));?></button>
                <button type="submit" id="register" name="login"><?php echo lang_check(array("LOGIN", "ログインする","BEJELENTKEZÉS", "PRIJAVITE SE"));?></button>
            </div>
        </form>
    </div>
    </body>
</html>


