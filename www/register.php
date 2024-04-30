<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$error = NULL;
include('config.php');
header('Content-Type: text/html;charset=UTF-8');


if (!isset($_SESSION['register'])) {
  $_SESSION['register'] = 0;
}

if (isset($_SESSION['username'])) {
  header("location: main-page.php");
} else {
  include('functions.php');
  //Clicking the register button
  if (isset($_POST['register'])) {
    $u = $_POST['username'];
    $e = $_POST['email'];
    $p = $_POST['password'];
    $p2 = $_POST['password2'];

    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $bday = $_POST['bday'];
    $gender = $_POST['gender'];

    //$u = mb_convert_encoding($u);
    //echo $u;
    //connecting to the database

    $fn = $mysqli->real_escape_string($fn);
    $ln = $mysqli->real_escape_string($ln);
    $u = $mysqli->real_escape_string($u);
    $e = $mysqli->real_escape_string($e);
    $p = $mysqli->real_escape_string($p);
    $p2 = $mysqli->real_escape_string($p2);
    $bday = $mysqli->real_escape_string($bday);
    $gender = $mysqli->real_escape_string($gender);
    //$u = mb_convert_encoding($u);
    //echo $u;
    $query = "SELECT * FROM users WHERE email = '$e'";
    //unique email testing
    $result = mysqli_query($conn, $query);

    $dateLimit = new DateTime('now');
    //errors
    //English starts
    if (mysqli_num_rows($result) == 1) {
      $error .= "<p>" . lang_check(array("This email is already taken!", "このメールはすでに届いています！!", "Ez az email már foglalt!", "Ova email adresa već je zauzeta!")) . "</p>";
    }

    if (strlen($u) < 5) {
      $error .= "<p>" . lang_check(array("Username must be at least 5 character!", "ユーザー名は5文字以上である必要があります！", "A felhasználónév legalább 5 karakter kell, hogy legyen!", "Korisničko ime treba da sadrži najmanje 5 karaktera!")) . "</p>";
    }

    if (strlen($p) < 6) {
      $error .= "<p>" . lang_check(array("Password must be at least 6 character!", "パスワードは6文字以上である必要があります！!", "A jelszó legalább 6 karakter kell, hogy legyen!", "Lozinka treba da sadrži najmanje 6 karaktera!!")) . "</p>";
    }

    if (!preg_match("#^[a-zA-Z0-9]+$#", $p)) {
      $error .= "<p>" . lang_check(array("Please use only letters and numbers in your password!", "パスワードには文字と数字のみを使用してください", "Kérlek csak számokat és betűket használj a jelszóban!", "Samo slova i brojeve može da sadrži lozinka!")) . "</p>";
    }

    if ($p2 != $p) {
      $error .= "<p>" . lang_check(array("Your passwords do not match!", "パスワードが一致しません。", "Nem egyeznek a jelszavaid!", "Lozinke nisu isti!")) . "</p>";
    } else {
      $options = array("cost" => 4);
      $hashPassword = password_hash($p, PASSWORD_BCRYPT, $options);

      $timestamp = time();
      $vkey = password_hash('register' . $timestamp . $u, PASSWORD_DEFAULT);
      $insert = $mysqli->query("INSERT INTO users(first_name,last_name,username,password,email,birthday,vkey,gender) VALUES('$fn','$ln','$u', '$hashPassword', '$e','$bday', '$vkey', '$gender')");
      if ($insert) {
        $message_en = "You have to verify your email address, if you want to continue with your login.\nClick here to <a href='https://community.kreastol.club/verify.php?vkey=$vkey'>Verify Your Account</a>!";
        $message_jp = "メールアドレスを確認する必要があります。\nアカウントを<a href='https://community.kreastol.club/Community_Login/verify.php?vkey=$vkey'>確認する</a>には、ここをクリックしてください。";
        $message_hu = "Meg kell erősítened az email címed a folytatáshoz\nKattintson ide a <a href='https://community.kreastol.club/Community_Login/verify.php?vkey=$vkey'>Verifikáláshoz</a>!";
        $message_rs = "Trebate da verifikujete email adresu za naspasu.\nKliknite ovde za<a href='https://community.kreastol.club/Community_Login/verify.php?vkey=$vkey'>Verifikaciju</a>!";

        $mail = new PHPMailer(true);

        try {
            // Take the password the sender end the host from the environment variables
          $sender = getenv('SMTP_SENDER');
          $mail->isSMTP();
          $mail->Host = getenv('SMTP_HOST');
          $mail->SMTPAuth = true;
          $mail->Username = $sender;
          $mail->Password = getenv('SMTP_PASS');
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $subject = lang_check(array("Email verification for Kreastol Club", "クレアストール・クラブのメールによる確認。", "Email verifikáció a Kreastol Klub oldalra!", "Email verifikacija za Kreastol Klub"));
          $message = lang_check(array($message_en, $message_jp, $message_hu, $message_rs));

          $mail->setFrom($sender, 'Kreastol Club');
          $mail->addAddress($e);
          $mail->Subject = $subject;
          $mail->Body = $message;
          $mail->AltBody = strip_tags($message);
          $mail->send();

          $_SESSION['register'] = 1;
        } catch (Exception $e) {
          $error .= $e->errorMessage();
        }
      } else {
        $error .= $mysqli->error;
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
if ($_SESSION['register'] == 0) {
  include('html/register.php');
} else {
  include('html/thankyou.php');
  $_SESSION['register'] = 0;
}

?>
</body>
</html>