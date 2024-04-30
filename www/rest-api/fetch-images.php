<?php


include('../config.php');

$username = filter_input(INPUT_POST, "username");
//
//$username = "joshika45";
$user_id_sql = "SELECT id FROM users WHERE username='$username'";
$user_id = $conn->query($user_id_sql)->fetch_row()[0];
$havePost = false;

$result['success'] = "0";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result = array();
    $result['data'] = array();
    $select = "SELECT * FROM images WHERE user_id='$user_id' order by id desc";
    $response = mysqli_query($conn, $select);

    while ($row = mysqli_fetch_array($response)){
        $index['id'] = $row['0'];
        $index['image_dir'] = $row['1'];
        $index['title'] = $row['5'];

        array_push($result['data'], $index);
        $result['success'] = "1";
    }

    echo json_encode($result);
    mysqli_close($conn);

}
