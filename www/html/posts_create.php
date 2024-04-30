
<?php
    if(!isset($_SESSION["username"]))
    {
        $_SESSION['content'] = "posts";
        header("Location: main-page.php" );
        exit();
    }
    include('config.php');
    
if(isset($_POST['create_post']))
{
    $title = $_POST['title'];
    $tags = $_POST['tags'];
    $body = $_POST['body'];
    $category = $_POST['category'];

    $title = $conn->real_escape_string( $title);
    $tags = $conn->real_escape_string( $tags);
    $body = $conn->real_escape_string( $body);
    $body = htmlentities($body);
//    $title = addslashes($title);
//    $body = addslashes($body);
    //User id
    $username = $_SESSION['username'];
    $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
    $row = mysqli_fetch_array($result);
    $user_id = $row['id'];

    //date
    $date = date('Y-m-d G:i:s');
    require('db_upload.php');
    
}
   

?>
<head>
    <link rel="stylesheet" href="../css/post_create.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Lato|Quicksand'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>
</head>  
<div id="post_create">
            <form  method="post">
                <div id="title">
                    <label><?php echo lang_check(array("Title: ", "題名: ", "Cím: ", "Naslov: "))?></label><input type="text" name="title"/>
                </div>
                <div id="body">
                    <label for="body"><?php echo lang_check(array("Body: ", "本文: ", "Tartalom: ", "Tekst: "))?></label>
                    <textarea name="body" cols="50" rows="10"></textarea>
                </div>
                <div class="category">
                    <label><?php echo lang_check(array("Category:", "カテゴリー: ", "Kategória: ", "Kategorija: "))?></label>
                    <div class="sel sel--black-panther">
                    
                        <select name="category" id="select-profession">
                            <?php 
                                $query = $conn->query("SELECT * FROM categories");

                                while($row =$query->fetch_object()){
                                    echo "<option value='". $row->category_id. "'>".$row->category."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="tags">
                    <label><?php echo lang_check(array("Tags:", "タグ: ", "Tag-ek: ", "Oznake: "))?></label>
                    <input type="text" name="tags"/>
                </div>
                <button id="post_submit" type="submit" name="create_post"><?php echo lang_check(array("Post", "ポストする","Poszt", "Postovati"));?></button>
            </form>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src="../js/select.js"></script>