<?php

session_start();



if(!isset($_SESSION['lang'])){
    $_SESSION['lang'] = "en";
}
if(isset($_POST['lang'])){
    $lang = $_POST['lang'];
    $_SESSION['lang'] = $lang;
}

function lang_check($text_arr){
    $lang_arr = array('en','jp','hu','rs');
    $lang_value = $_SESSION['lang'];
    
    for($i = 0; $i < count($lang_arr); $i++){
        if($lang_value == $lang_arr[$i])
            return $text_arr[$i];
    }
}


function function_alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function reArrayFiles($file_post): array
{

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
