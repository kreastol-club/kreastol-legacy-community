<?php


if(isset($_GET['a']))
{
    $page = $_GET['a'];
    $_SESSION['content'] = $page;
}
else if(isset($_SESSION['content']))
    $page = $_SESSION['content'];
else
    $page = 'posts';


switch($page){
    case "posts":
        include('html/loading.html');
        include('html/posts.php');
        break;
    case "gallery":
        include('html/gallery.php');
        break;
    case "calendar":
        include('html/loading.html');
        include('html/calendar.php');
        break;
    case "c_post":
        include('html/loading.html');
        require('html/posts_create.php');
        break;
    case "img_upload":
        include('html/loading.html');
        require('html/img_upload.php');
        break;
    case "qna":
        include('html/loading.html');
        require('html/qna.php');
        break;
}