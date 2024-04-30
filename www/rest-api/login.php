<?php

include('../config.php');
include('functions.php');
header('Content-Type: text/html;charset=UTF-8');

$loginResult = 0;



$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

//$username = mysqli_real_escape_string($conn, $username);
//$password = mysqli_real_escape_string($conn, $password);

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        if( $row['verified'] != 1)
        {
            $loginResult = 0;
        }
        elseif(password_verify($password,$row['password'])){
            $loginType = 1;
            if($row['admin'] == 'y')
                $loginType = 2;
        }
        else
        {
            $loginResult = 0;
        }
    }
}
else
{
    $loginResult = 0;
}
echo $loginType;


