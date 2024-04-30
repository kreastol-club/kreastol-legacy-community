<?php
include '../config.php';

$users = array();

$active_event_id = (int)filter_input(INPUT_POST,"event_id");

$sql = "SELECT event_age_lowest, event_age_highest FROM events where event_id='$active_event_id'";
$ageLimits = $conn->query($sql)->fetch_row();
//echo "Start: ".$ageLimits[0]."<br>"."End: ".$ageLimits[1]."<br>";

$user_sql = "SELECT id, first_name, last_name, birthday FROM users";
$user_query = $conn->query($user_sql);
while ($row = $user_query->fetch_row())
{
    $userBDay = $row[3];
    if(strtotime($ageLimits[0]) > strtotime($userBDay)  && strtotime($ageLimits[1]) < strtotime($userBDay))
    {
        //pushing fetched data in an array
        $temp = [
            'id'=>$row[0],
            'first_name'=>$row[1],
            'last_name'=>$row[2]
        ];

        //pushing the array inside the hero array
        array_push($users, $temp);
    }
}
echo json_encode(['users' => $users]);


