<?php
include '../config.php';

$day = date("l");
$time = date("H:i:s");
$event_found = false;
$sql = "SELECT * FROM events where event_day='$day'";
$query = $conn->query($sql);

while ($result = $query->fetch_row())
{
    $start = $result[2];
    $end = $result[3];
    if(strtotime($start) < strtotime($time) && strtotime($end) > strtotime($time))
    {
        $event_found = true;
        $lowestAgeDate = date("m/d/Y", strtotime($result[5]));
        $lowestAgeDate = explode("/", $lowestAgeDate);
        $lowestAge = (date("md", date("U", mktime(0, 0, 0, $lowestAgeDate[0], $lowestAgeDate[1], $lowestAgeDate[2]))) > date("md")
            ? ((date("Y") - $lowestAgeDate[2]) - 1)
            : (date("Y") - $lowestAgeDate[2]));

        $highestAgeDate = date("m/d/Y", strtotime($result[6]));
        $highestAgeDate = explode("/", $highestAgeDate);
        $highestAge = (date("md", date("U", mktime(0, 0, 0, $highestAgeDate[0], $highestAgeDate[1], $highestAgeDate[2]))) > date("md")
            ? ((date("Y") - $highestAgeDate[2]) - 1)
            : (date("Y") - $highestAgeDate[2]));
        $temp = [
            'id'=>$result[0],
            'event_name'=>$result[1],
            'age_from'=>$lowestAge,
            'age_to'=>$highestAge,
            'starts_at'=>$start,
            'ends_at'=>$end,
            'result'=>"yes"
        ];
        echo json_encode($temp);
    }
}
if(!$event_found){
    echo json_encode(array("result"=>"no"));
}
