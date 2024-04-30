<?php
include('../config.php');

$username = filter_input(INPUT_POST, "username");

$user = array();

$sql = "SELECT first_name, last_name, email, birthday, gender, point_sum FROM users 
    LEFT JOIN points p on users.id = p.user_id WHERE username='$username'";

//creating an statment with the query
$stmt = $conn->query($sql);

while($row = $stmt->fetch_row()){

    //pushing fetched data in an array
    $user = array("first_name"=>$row[0], "last_name"=>$row[1], "email"=>$row[2], "birthday"=>$row[3], "gender"=>$row[4], "points"=>$row[5]);
}
echo json_encode($user);
