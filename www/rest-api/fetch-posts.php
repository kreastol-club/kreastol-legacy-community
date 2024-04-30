<?php

include "../config.php";

$username = filter_input(INPUT_POST, "username");
//
//$username = "joshika45";
$user_id_sql = "SELECT id FROM users WHERE username='$username'";
$user_id = $conn->query($user_id_sql)->fetch_row()[0];
$havePost = false;//get the records
$posts = array();

//this is our sql query
$sql = "SELECT posts.id,title,LEFT(body, 400) AS body,category,date,username FROM posts
    INNER JOIN categories ON categories.category_id=posts.category_id
    INNER JOIN users ON users.id=posts.user_id order by posts.id desc";

$sql1 = "SELECT posts.id,title,LEFT(body, 400) AS body,category,date,username FROM posts
    INNER JOIN categories ON categories.category_id=posts.category_id
    INNER JOIN users ON users.id=posts.user_id WHERE user_id='$user_id' order by posts.id desc";

//creating an statment with the query
$stmt = $conn->prepare($sql1);
$stmt->execute();
$stmt->bind_result($post_id, $title, $body, $category, $date, $username);

while($stmt->fetch()){

    //pushing fetched data in an array
    $temp = [
        'id'=>$post_id,
        'title'=>$title,
        'body'=>$body,
        'category'=>$category,
        'date'=>$date,
        'username'=>$username
    ];
    $havePost = true;
    //pushing the array inside the hero array
    array_push($posts, $temp);
}
if ($havePost)
    echo json_encode(['items' => $posts]);
else
    echo "error";


