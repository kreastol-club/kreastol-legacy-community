<?php
include "../config.php";
include "../functions.php";

$error = null;
$username = null;
$email = null;
$badData = false;

$username = filter_input(INPUT_POST, "username");
$first_name = filter_input(INPUT_POST, "first_name");
$last_name = filter_input(INPUT_POST, "last_name");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$gender = (int) filter_input(INPUT_POST, "gender");
$birthday = filter_input(INPUT_POST, "birthday");
$lang = filter_input(INPUT_POST, "lang");

$query_email = $conn->query("SELECT email FROM users WHERE email='$email';");
$query_username = $conn->query("SELECT username FROM users WHERE username='$username';");

if($query_email->fetch_row() > 0)
{
    echo "email ".$email." ";
    $badData = true;
}
if ($query_username->fetch_row() > 0)
{
    echo "username ".$username;
    $badData = true;
}

if ($badData)
    return;

$vkey = rand(100000, 999999);
$vkey_d = chunk_split($vkey, 3, ' ');



$message_en = "Your 6 digit code for verifivation: $vkey_d<br><br><br>You have to verify your email address, if you want to continue with your login.\nClick here to <a href='https://community.kreastol.club/re-verify.php'>Verify Your Account</a>!";
$message_jp = "<br><br><br>メールアドレスを確認する必要があります。\nアカウントを<a href='https://community.kreastol.club/Community_Login/re-verify.php'>確認する</a>には、ここをクリックしてください。";
$message_hu = "A 6 jegyű verifikációs kód: $vkey_d<br><br><br>Meg kell erősítened az email címed a folytatáshoz\nKattintson ide a <a href='https://community.kreastol.club/Community_Login/re-verify.php'>Verifikáláshoz</a>!";
$message_rs = "<br><br><br>Trebate da verifikujete email adresu za naspasu.\nKliknite ovde za<a href='https://community.kreastol.club/Community_Login/re-verify.php'>Verifikaciju</a>!";

//password hashing
$options = array("cost"=>4);
$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);

//creating the verification

$insert = $conn->query("INSERT INTO users(first_name,last_name,username,password,email,birthday,vkey,gender) VALUES('$first_name','$last_name','$username', '$hashPassword', '$email','$birthday', '$vkey', '$gender')");
if($insert)
{
    $to = $email;
    $subject = lang_check(array("Email verification for Kreastol Club","クレアストール・クラブのメールによる確認。","Email verifikáció a Kreastol Klub oldalra!","Email verifikacija za Kreastol Klub"));
    $message = lang_check(array($message_en, $message_jp, $message_hu, $message_rs));
    $headers = "From: noreply@mail.kreastol.club\r\n";
    $headers .= "MIME-version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($to,$subject,$message,$headers);
    $_SESSION['register'] = 1;
    echo "yes";
}
else
    echo $conn->error;