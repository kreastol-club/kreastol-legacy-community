
<head>
  <meta property = "og: image" content = 'https://kreastol.club/Kreastol/img/Page-Logo.png'/>
  <link rel="icon" href='img/Title-Logo.png'>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/thankyou.css" type=text/css>
    <link rel="stylesheet" href="css/colors-schemes.css" type=text/css>
    <title><?php lang_check(array("Thank You!", "ありがとうございま", "Köszönöm", "Hvala Vam"))?></title>

</head>
<body>
  <div class="container">
    <h3><?php echo lang_check(array("Verification sent!", "確認がメールで送信されました。", "Megerősítés elküldve emailben!", "Potvrda poslata sa e-poštom!"))?></h3>
    <embed id="mail" type="image/svg+xml" src="../img/verify/mail_sent.svg" />
    <h4><?php echo lang_check(array("Check your inbox for more details!", "詳細については、受信トレイを確認してください。", "Kérem ellenőrizze a beérkezett leveleket!", "Molimo proverite primljena pisma!"))?></h4>
    <div class="mailbox">
      <a href="https://outlook.live.com/" target="_blank"><img id="outlook" src="../img/verify/outlook.png" alt="outlook"></a>
      <a href="https://mail.google.com/" target="_blank"><img src="../img/verify/gmail.png" alt="gmail"></a>
      <a href="https://mail.yahoo.com/" target="_blank"><img id="yahoo" src="../img/verify/yahoo.png" alt="yahoo"></a>  
    </div>
    <button id="login" onclick="window.location.href='../login.php';"><?php echo lang_check(array("Go back to Log In", "ログインに戻る", "Vissza a bejelentkezéshez", "Povratak na prijavu"))?></button>
  </div>
</body>