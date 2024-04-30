<?php

include("../config.php");

    //date
$date = date('Y-m-d G:i:s');


$category = filter_input(INPUT_POST, "category");
$title = filter_input(INPUT_POST, "title");
$body = filter_input(INPUT_POST, "body");
$username = filter_input(INPUT_POST, "username");

$title = $conn->real_escape_string( $title);
$body = $conn->real_escape_string( $body);
$body = htmlentities($body);

    //User Things
$result = $conn->query("SELECT id, admin FROM users WHERE username = '$username'");
$row = mysqli_fetch_array($result);
$user_id = $row['id'];
$isAdmin = $row['admin'];

    //CategoryId
$sql1 = "SELECT category_id FROM categories WHERE category = '$category'";
$result = $conn->query($sql1);
$row = mysqli_fetch_array($result);
$category_id = $row['category_id'];

if($isAdmin == 'y'){
    $query = $conn->query("INSERT INTO posts (user_id, title, body, category_id, date, admin_posted) VALUES('$user_id', '$title', '$body', '$category_id', '$date', 'y')");

}else{
    $query = $conn->query("INSERT INTO posts (user_id, title, body, category_id, date, admin_posted) VALUES('$user_id', '$title', '$body', '$category_id', '$date', 'n')");
}

if($query)
    echo "yes";
else
    echo "Title: ".$title.
        ", Body: ".$body.
        ", Category Id: ".$category_id.
        ", UserId: ".$user_id.
        ", IsAdmin: ".$isAdmin.
        ", Date: ".$date.
        "Error: ".$conn->error;