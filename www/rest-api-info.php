<?php

# If localhost
//$LOCATION = "D:/仕事/Website/Server/Community/";

# If on Server
//$LOCATION = "";

# If for android
$LOCATION = "https://community.kreastol.club/";

$CONFIG = $LOCATION."config.php";
$links_names= array();

array_push($links_names,
    "ADD_EVENT",
    "ADD_IMAGE",
    "ADD_POST",
    "FETCH_AVAILABLE_USERS",
    "FETCH_CATEGORY",
    "FETCH_IMAGES",
    "FETCH_POSTS",
    "GET_CURRENT_EVENT",
    "LOGGED_IN_USER_DATA",
    "LOGIN",
    "MANAGE_POINTS");

$links = array();
$temp = array();

$fileList = glob('rest-api/*.php');
$i = 0;

foreach($fileList as $filename){

    if(is_file($filename)){

        $temp = array_merge($temp, array($links_names[$i]=>$LOCATION.$filename));
        $i++;
    }
}
echo str_replace("\/", "/", json_encode($temp));



