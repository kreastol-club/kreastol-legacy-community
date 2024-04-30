<?php

include '../config.php';

$users = filter_input(INPUT_POST,"json" );
//$users = '{"users_list":[{"id":4,"is_here":true},{"id":5,"is_here":true}]}';

$temp = json_decode($users, true);
$temp2 = json_encode($temp["users_list"]);
$arr = (array) json_decode($temp2,true);

$user_ids = array();
foreach ($arr as $key => $value) {
    if($value["is_here"] == 1){
        echo $value["id"]." Is here";
        array_push($user_ids, $value["id"]);

    }
}


for($i = 0; $i < count($user_ids); $i++){
    $query = $conn->query("SELECT point_sum FROM points where user_id='$user_ids[$i]'");
    $result = $query->fetch_row();

    if($conn->query("INSERT IGNORE INTO points(user_id, point_sum) VALUES('$user_ids[$i]', 1) ON DUPLICATE KEY UPDATE point_sum='$result[0]' + 1"))
    {
        echo $user_ids[$i].'added ';
    }
}







