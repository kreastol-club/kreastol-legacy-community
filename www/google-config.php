<?php
require_once ('google-api/vendor/autoload.php');
$gClient = new Google_Client();
$gClient -> setClientId("565620529101-erafakpvn52m0nr40qn581dan2pnl463.apps.googleusercontent.com");
$gClient -> setClientSecret("ySQqD3V2qaAGZLgDSgKbdp8S");
$gClient -> setApplicationName("Kreastol Klub Login");
$gClient -> setRedirectUri("https://community.kreastol.club/userData.php");
$gClient -> setScopes("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
$login_url = $gClient -> createAuthUrl("");