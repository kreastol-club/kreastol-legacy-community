<?php

$server_name = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

if ($server_name === false || $username === false || $password === false) {
    die('One or more required environment variables are not set.');
}

$database_name = "Kreastol";

$conn = new mysqli($server_name, $username, $password);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SHOW DATABASES LIKE 'Kreastol';";
$query = $conn->prepare($sql);
$query->execute();

if(!$query->fetch() > 0)
{
    $sql_create = "CREATE DATABASE IF NOT EXISTS Kreastol";
    $create_query = $conn->query($sql_create);
    if($create_query){
        $mysqli = NEW MySQLi($server_name, $username, $password, $database_name);
        $conn = new mysqli($server_name, $username, $password, $database_name);

        $filename  = "/home/joshua/Server/Kreastol.sql";

        $tempLine = '';
        $lines = file($filename);
        foreach ($lines as $line) {

            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            $tempLine .= $line;
            if (substr(trim($line), -1, 1) == ';')  {
                mysqli_query($conn, $tempLine) or print("Error in " . $tempLine .":". mysqli_error());
                $tempLine = '';
            }
        }
    }
}
else{
    $mysqli = NEW MySQLi($server_name, $username, $password, $database_name);
    $conn = new mysqli($server_name, $username, $password, $database_name);
}
