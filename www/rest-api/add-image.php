<?php
include('../config.php');


$category = filter_input(INPUT_POST, "category");
$title = filter_input(INPUT_POST, "title");
$group = filter_input(INPUT_POST, "group");
$username = filter_input(INPUT_POST, "username");
$image = filter_input(INPUT_POST, "image");
$count = filter_input(INPUT_POST, "count");

$date = date('Y-m-d G:i:s');

//User Things
$result = $conn->query("SELECT id, admin FROM users WHERE username = '$username'");
$row = mysqli_fetch_array($result);
$user_id = $row['id'];

//CategoryId
$sql1 = "SELECT category_id FROM categories WHERE category = '$category'";
$result = $conn->query($sql1);
$row = mysqli_fetch_array($result);
$category_id = $row['category_id'];

$saved = false;


    if(!$saved){
        $target_dir = "../gallery";
        $imageStore = rand() . "_" . time() . ".jpg";
        $target_dir = $target_dir . "/" . $imageStore;
        file_put_contents($target_dir, base64_decode($image));
        $saved = true;
    }

    if($count == 1){
        $select = "INSERT INTO images (name,img_dir,title, date, category,user_id,main_category_id) VALUES ('$imageStore','$target_dir','$title','$date','$group','$user_id','$category_id')";
        $response = $conn->query($select);
        if($response) {
            echo "success ".$count;
        }else
            echo "error";
    }






