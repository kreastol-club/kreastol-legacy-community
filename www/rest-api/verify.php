<?php

include "../config.php";

$vkey = filter_input(INPUT_POST, "vkey");
$username = filter_input(INPUT_POST, "username");

$sql = "SELECT vkey FROM users WHERE username='$username'";
$query = $conn->query($sql);
if($row = $query->fetch_row())
{
    $row[0] = $vkey;
    $update = $mysqli->query("UPDATE users SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
    if($update) {
        echo "yes";
    }
    else
        echo "error ";
}
else
    echo "error";

