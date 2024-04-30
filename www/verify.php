<?php
$error = NULL;
session_start();
include "functions.php";


if (isset($_GET['vkey'])) {
  $vkey = $_GET['vkey'];
  // Get the variables from the environment variables
  $db_user = getenv('DB_USER');
  $db_pass = getenv('DB_PASS');
  $db_host = getenv('DB_HOST');
  $mysqli = new MySQLi($db_host, $db_user, $db_pass, 'Kreastol');

  $resultSet = $mysqli->query("SELECT verified,vkey FROM users WHERE verified = 0 AND vkey = '$vkey' LIMIT 1");
  //echo $resultSet;

  if ($resultSet->num_rows == 1) {
    $update = $mysqli->query("UPDATE users SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
    if ($update) {

      if ($_SESSION['lang'] == "en")
        $error = "<p>Your account has been verified you may now log in!</p>";
      elseif ($_SESSION['lang'] == "jp")
        $error = "<p>アカウントが確認されました。これでログインできます。</p>";
      elseif ($_SESSION['lang'] == "hu")
        $error = "<p>A fiókod meg lett erősitve, mostmár bejelentkezhetsz!</p>";
      elseif ($_SESSION['lang'] == "rs") {

      }
      $error .= "<embed id='mail' type='image/svg+xml' src='img/verify/verify.svg'/>";
    } else {
      $mysqli->error;
    }
  } else {
    if ($_SESSION['lang'] == "en")
      $error .= "<p>This account is invalid or already verified</p>";
    elseif ($_SESSION['lang'] == "jp")
      $error .= "<p>このアカウントは無効であるか、すでに確認済みです。</p>";
    elseif ($_SESSION['lang'] == "hu")
      $error .= "<p>Ez a fiók érvénytelen, vagy már meg van erősítve!</p>";
    elseif ($_SESSION['lang'] == "rs") {

    }
    $error .= "<embed id='mail' type='image/svg+xml' src='img/verify/error.svg'/>";
  }
} else {
  die("Something went wrong");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/thankyou.css">
    <link rel="stylesheet" href="css/colors-schemes.css" type=text/css>
    <meta property="og: image" content="img/Page-Logo.png"/>
    <link rel="icon" href="img/Title-Logo.png">
    <title>Verification</title>
</head>
<body>
<div class="container">
  <?php
  if ($_SESSION['lang'] == "en") {
    echo "<h3>Verifying!</h3>
            $error
            <br><button id=\"login\" onclick=\"window.location.href='/login.php';\">Log In</button>";
  } elseif ($_SESSION['lang'] == "jp") {
    echo "<h3>確認中！</h3>
            $error
            <br><button id=\"login\" onclick=\"window.location.href='/login.php';\">ログインする</button>";
  } elseif ($_SESSION['lang'] == "hu") {
    echo ">Bejelentkezés</button>";
  } elseif ($_SESSION['lang'] == "rs") {
    echo "<h3></h3>
            $error
            <br><button id=\"login\" onclick=\"window.location.href='/login.php';\"></button>";
  }

  ?>

</div>
</body>
</html>