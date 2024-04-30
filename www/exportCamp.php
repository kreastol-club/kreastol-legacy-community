<?php
// Include the database config file
require_once 'config.php';

if(isset($_GET)){
    $ext = $_GET['ext'];

    // Excel file name for download
    $fileName = "people-for-camp-" . date('Ymd') .".".$ext;

// Column names
    $fields = array('Id', 'Child_Name', 'Parent_Name', 'Email', 'Phone', 'Age', 'Type');

// Display column names as first row
    $excelData = implode(";", array_values($fields)) . "\n";

// Get records from the database
    $query = $conn->query("SELECT * FROM camps");
    if ($query->num_rows > 0) {
        // Output each row of the data
        $i = 0;
        while ($row = $query->fetch_assoc()) {
            $i++;
            $rowData = array($i, $row['child_name'], $row['parent_name'], $row['email'], $row['phone'], $row['age'], $row['type']);
            array_walk($rowData, 'filterData');
            $excelData .= implode(";", array_values($rowData)) . "\n";
        }
    } else {
        $excelData .= 'No records found...' . "\n";

    }

// Headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");

// Render excel data
    echo $excelData;

    exit;
}

// Filter the excel data
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';


}

