<?php

include '../config.php';

$event_name = filter_input(INPUT_POST, "event_name");
$event_day = filter_input(INPUT_POST, "day");
$event_start_time = filter_input(INPUT_POST, "start_time");
$event_end_time = filter_input(INPUT_POST, "end_time");

$event_highest_age = filter_input(INPUT_POST, "highest_age");
$event_lowest_age = filter_input(INPUT_POST, "lowest_age");


$sql = "INSERT INTO events(event_name,event_day,event_start,event_end,event_age_lowest,event_age_highest) 
    VALUES ('$event_name','$event_day', '$event_start_time', '$event_end_time','$event_lowest_age','$event_highest_age');";

$query = $conn->query($sql);
if($query)
    echo "yes";
else
    echo $conn->error;
