<?php

$date = mktime(11,54,65,02,1,2004);
$date2 = new DateTime();
// Formulate the Difference between two dates
$diff = abs($date2->getTimestamp() - $date);


// To get the year divide the resultant date into
// total seconds in a year (365*60*60*24)
$years = floor($diff / (365*60*60*24));

echo $date2->getTimestamp()." - ".$date." = ".$diff."<br>";
echo $date2->format("Y-m-d"). " - ". date("Y-m-d",$date).
    " = ". date("Y-m-d",$diff)." "."($years)";