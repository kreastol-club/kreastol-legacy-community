<?php
session_start();
if (!isset($_SESSION["username"]) || $_SESSION['admin'] != true) {
    header("Location: main-page.php");
    exit();
}

include('config.php');
include 'functions.php';

$post_count = $conn->query("SELECT * FROM posts");
$comment_count = $conn->query("SELECT * FROM comments");

if (isset($_POST['category'])) {
    $newCat = $_POST['newCategory'];
    if (!empty($newCat)) {
        $sql = "INSERT INTO categories (category) VALUES('$newCat')";
        $query = $conn->query($sql);
        if ($query)
            echo 'New category added!';
        else
            echo 'Error';
    } else
        echo ' Missing Category';
}

if (isset($_POST['add_event'])) {
    $newEvent = $_POST['newEvent'];
    if (!empty($newEvent)) {
        $sql1 = "INSERT INTO events (event) VALUES('$newEvent');";
        $query1 = $conn->query($sql1);
        if ($query1)
            echo 'New Event added!';
        else
            echo 'Error';
    } else
        echo ' Missing Event';
}


$query2 = $conn->prepare("SELECT id, email, LEFT(body, 400) AS body,answer, date FROM qna");
$query2->execute();
$query2->bind_result($id, $email, $body, $answer, $date);

if (isset($_POST['resend'])) {
    $answer = $_POST['answer'];
    $id_select = $_POST['id_select'];
    $answer = $conn->real_escape_string($answer);


    $update = $conn->query("UPDATE qna SET answer = '$answer' WHERE id = '$id_select' LIMIT 1");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width='device-width', initial-scale=1.0">
    <title>Post TEST</title>
</head>
<body>
<div id="menu">
    <ul>
        <li><a href="#">Create a new post</a></li>
        <li><a href="#">Delete post</a></li>
        <li><a href="file:///C|/xampp/htdocs/public_html/logout.php">Log Out</a></li>
        <li><a href="#">Blog Homepage</a></li>
        <li><a href="https://community.kreastol.club/main-page.php">Home</a></li>
    </ul>
</div>
<div id="mainContent">
    <table>
        <tr>
            <td>Total Post</td>
            <td><?php echo $post_count->num_rows ?></td>
        </tr>
        <tr>
            <td>Total Comment</td>
            <td><?php echo $comment_count->num_rows ?></td>
        </tr>
    </table>
    <div id="categoryForm">
        <form action="" method="post">
            <label for="category">Add new category</label><input type="text" name="newCategory"><input type="submit"
                                                                                                       value="category"
                                                                                                       name="category">
        </form>
    </div>
    <div id="eventForm">
        <form action="" method="post">
            <label for="event">Add new event</label><input type="text" name="newEvent"><input type="submit"
                                                                                              value="add_event"
                                                                                              name="add_event">
        </form>
    </div>
    <a href="exportCamp.php?ext=csv">Export Signed in people for Camp - CSV</a><br>
    <a href="exportCamp.php?ext=xlsx">Export Signed in people for Camp - Excel</a>
    <div class="questions">
        <?php
        $q_count = 0;
        while ($query2->fetch()):
            ///$lastspace = strrpos($body, ' ');
            if ($answer == '') {
                $q_count++;
                ?>
                <article>
                    <h2><?php echo $id ?></h2>
                    <h3><?php echo $email ?></h3>
                    <p><?php echo $body ?></p>
                    <h5><?php echo $date ?></h5>
                    <hr>
                </article>
            <?php } endwhile ?> <?php if ($q_count != 0) { ?>
            <form action="admin.php" method="post">
                <label for="id-select"/>
                <input type="text" name="id_select">
                <label for="answer"/>
                <input type="text" name="answer">
                <input name="resend" type="submit">
            </form>
        <?php } ?>

    </div>

</div>


</body>
</html>