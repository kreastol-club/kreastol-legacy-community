<?php

include('config.php');

//get the records
$record_count = $conn->query("SELECT * FROM posts");
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

$query = $conn->prepare("SELECT posts.id,title,LEFT(body, 400) AS body,category,date,username FROM posts INNER JOIN categories ON categories.category_id=posts.category_id INNER JOIN users ON users.id=posts.user_id order by posts.id desc LIMIT $start, $per_page");
$query->execute();
$query->bind_result($post_id, $title, $body, $category, $date, $username);


?><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <!--[if lt IE 9]>
        <script src="/www/js/html5shiv.js"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-1.5.mi.js"></script>
    <link rel="stylesheet" href="../css/posts.css" type="text/css">
</head>
    


<div id="posts">
    <?php 
    if(isset($_SESSION['username']))
    {?>
        <li><a id="register-b" href="main-page.php?a=c_post"><?php echo lang_check(array("Make a Post", "投稿する", "Poszt Készítése","Napravi Post"))?></a></li>
    <?php }?>        
        <?php 
            while($query->fetch()):
            ///$lastspace = strrpos($body, ' ');
        ?>
        <article>
        <h2><?php echo $title?></h2>
        <p><?php echo $body?></p>
        <div class="details">
            <p id="poster"><?php echo lang_check(array("Posted by: $username",$username."による投稿", "Posztolta: $username", "Postovao/la: $username"));?></p>
            <p><?php echo posts . phplang_check(array("Category:", "カテゴリー: ", "Kategória: ", "Kategorija: ")) . $category ?></p>
        </div>
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