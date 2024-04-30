<?php

include("../config.php");
$sql = "SELECT * FROM categories";

$result = $conn->query($sql);
if($result->num_rows > 0)
{
    $return_arr['categories'] = array();
    while ($row = $result->fetch_array()){
        array_push($return_arr['categories'], array(
            'category_id'=>$row['category_id'],
            'category_name'=>$row['category']));
    }
    echo json_encode($return_arr);
}

