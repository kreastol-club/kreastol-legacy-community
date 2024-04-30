<?php

//Post Posting
if($title && $body && $category)
{
    if($_SESSION['admin'] == true)
        $query = $conn->query("INSERT INTO posts (user_id, title, body, category_id, tags, date, admin_posted) VALUES('$user_id', '$title', '$body', '$category', '$tags', '$date', 'y')");
    else
        $query = $conn->query("INSERT INTO posts (user_id, title, body, category_id, tags, date, admin_posted) VALUES('$user_id', '$title', '$body', '$category', '$tags', '$date', 'n')");
    
    if($query)
    {
        function_alert("Posted... Redirecting to Posts!");
        $_SESSION["content"] = "posts";
        header("Location: main-page.php" );

    } 
    else
        echo "Something Went Wrong!";
}
else
    echo 'missing data';



    //img upload
?>