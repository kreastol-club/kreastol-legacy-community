<?php
//information array
$paragraph = array("The dates of the workshops are as follows:","ワークショップの日程は次のとおりです。","A foglalkozások időpontjai a következők:","Datumi radionica su sledeći:");

$workshops1 = array("From 1st to 4th Class","このテクストをまだ翻訳しができません。","1. - 4. Osztályig","1. - 4. Razredi");
$workshops2 = array("Preschooler age","このテクストをまだ翻訳しができません。","Iskolás előtti korosztály","Kreastol - Predškolski uzrast");
$workshops3 = array("From 5th to 6th Class","このテクストをまだ翻訳しができません。","5. - 6. Osztály","5. - 6. Razred");

$date1 = array("Every Saturday*<br/>9:30 – 10:30am","","Minden Szombat*<br/>9:30 – 10:30 d.e.","Svake Subote*<br/>9:30 – 10:30 pre podne");
$date2 = array("Every Saturday*<br/>10:30 – 11:45am","","Minden Szombat*<br/>10:30 – 11:45 d.e","Svake Subote*<br/>10:30 – 11:45 pre podne");
$date3 = array("Every Thursday*<br/>5:00 – 6:30pm","","Minden Csütörtök*<br/>5:00 – 6:30 d.u","Svakog Četvrtka*<br/>5:00 – 6:30pm");

$star = array("The date may vary, check out the calendar for more accurate information.","英語の翻訳をチェックしてください。","A dátum változhat, a pontosabb információkért nézze meg a naptárat.","Datum se može razlikovati. Pogledajte kalendar za tačnije informacije.");

require "config.php";

if(isset($_POST['question_submit'])){
    function_alert("Yeyy");
    $email = $_POST['email'];
    $body = $_POST['question'];

    $email = $conn->real_escape_string($email);
    $body = $conn->real_escape_string($body);
    $body = htmlentities($body);
    $date = date('Y-m-d');
    $query = $conn->query("INSERT INTO qna (id, email, body, answer, date) VALUES (NULL, '$email', '$body', '', '$date')");

}

$record_count = $conn->query("SELECT * FROM qna");
$per_page = 4;

$pages = ceil($record_count->num_rows/$per_page);

if(isset($_GET['p']) && is_numeric($_GET['p']))
    $page = $_GET['p'];
else
    $page = 1;

if($page<=0)
    $start = 0;
else
    $start = $page * $per_page - $per_page;
$prev = $page - 1;
$next = $page + 1;

$query2 = $conn->prepare("SELECT LEFT(body, 400) AS body,answer, date FROM qna order by id desc LIMIT $start, $per_page");
$query2->execute();
$query2->bind_result($body, $answer,$date);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo lang_check(array("Kreastol Klub ・ Q&A", "クレアストール・Q&A", "Kreastol Klub ・ Q&A", "Kreastol Klub ・ Q&A"))?></title>
    <link href="css/qna.css" type="text/css" rel="stylesheet">

</head>
<body>
    <div class="qna-container">
        <div class="information">
            <h3><?php echo lang_check(array("General Information", "一般情報", "Általános információ", "Opšte informacije"))?></h3>
            <h4><?php echo lang_check(array($paragraph[0], $paragraph[1], $paragraph[2], $paragraph[3]))?></h4>
            <ul>
                <li class="workshop-li">
                    <p class="work-type"><?php echo lang_check(array($workshops1[0], $workshops1[1], $workshops1[2], $workshops1[3]))?></p>
                    <ul>
                        <li><p class="date"><?php echo lang_check(array($date1[0], $date1[1], $date1[2], $date1[3]))?></p></li>
                    </ul>
                </li>
                <li class="workshop-li">
                    <p class="work-type"><?php echo lang_check(array($workshops2[0], $workshops2[1], $workshops2[2], $workshops2[3]))?></p>
                    <ul>
                        <li><p class="date"><?php echo lang_check(array($date2[0], $date2[1], $date2[2], $date2[3]))?></p></li>
                    </ul>
                </li>
                <li class="workshop-li">
                    <p class="work-type"><?php echo lang_check(array($workshops3[0], $workshops3[1], $workshops3[2], $workshops3[3]))?></p>
                    <ul>
                        <li><p class="date"><?php echo lang_check(array($date3[0], $date3[1], $date3[2], $date3[3]))?></p></li>
                    </ul>
                </li>
            </ul>
            <p><i>*<?php echo lang_check(array($star[0], $star[1], $star[2], $star[3]))?></i></p>
        </div>
        <h2><?php echo lang_check(array("Q&A", "Q&A", "Q&A", "Q&A"))?></h2>
        <div class="questions">
            <?php
            while($query2->fetch()):
                ///$lastspace = strrpos($body, ' ');
                ?>
                <article>
                    <h3><?php echo lang_check(array("Question", "質問", "Kérdés", "Pitanja"))?></h3>
                    <p id="question"><?php echo $body?></p>
                    <h4><?php echo lang_check(array("Answer", "回答", "Válasz", "Odgovor"))?></h4>
                    <p id="answer"><?php if($answer == ''){
                        echo "<i>".lang_check(array('There is no answer yet.','まだ回答がありません。','Még nincs válasz','Nema odgovor.'))."</i>";
                        }
                        else
                            echo $answer ?></p>
                    <h5><?php echo $date?></h5>
                    <hr>
                </article>
            <?php endwhile?>

        <ul>
            <?php  if($prev > 0)  { ?>

                <li><a href='main-page.php?p=<?php echo $prev?>'><?php echo lang_check(array("Previous page", "前のページ", "Előző oldal", "Prethodna strana"))?></a></li>
            <?php }?>

            <?php if($page < $pages) {  ?>

                <li><a href='main-page.php?p=<?php echo $next?>'><?php echo lang_check(array("Next page", "次のページ", "Következő oldal", "Sledeći strana"))?></a></li>
            <?php }?>
        </ul>
        </div>
        <div id="asking">
            <h2><?php echo lang_check(array("Submit a question", "質問を送信する", "Tegyen fel kérdést", "Podnijeti pitanje"))?></h2>
            <form method="post">
                <label for="email"><?php echo lang_check(array("Email", "メール", "Email", "Email"))?></label>
                <input name="email" type="email">
                <label for="question"><?php echo lang_check(array("Question", "質問", "Kérdés", "Pitanja"))?></label>
                <textarea name="question" cols="50" rows="5"></textarea>
                <input type="submit" id="post_submit" name="question_submit">
            </form>
        </div>
    </div>
</body>
</html>