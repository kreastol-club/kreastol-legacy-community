<link rel="stylesheet" href="css/post_create.css">
<div id="post_create">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="userfile[]" value="" multiple="">
        <label for="title">Title</label>
        <input type="text" name="title" value="" multiple="">
        <label for="">Picture Group</label>
        <input type="text" name="category" value="" multiple="">
        <div class="category">
                <label>Category</label>
                        <select name="main_category" id="select-profession">
                            <?php 
                            
                                include('config.php');
                                $admin = $_SESSION['admin'];
                                $query = $conn->query("SELECT * FROM categories");

                                while($row =$query->fetch_object()){
                                    if($admin == true)
                                        echo "<option value='". $row->category_id. "'>".$row->category."</option>";
                                    elseif($row->category_id != 7)
                                    {
                                        echo "<option value='". $row->category_id. "'>".$row->category."</option>";
                                    }
                                }
                            ?>
                        </select>
        <input id="post_submit" type="submit" name="submit" value="Upload">
    </form>
</div>
<?php
$table = 'images';
$phpFileUploadErrors = array(
    0 => 'Upload success with no error',
    1 => 'Uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'Uploaded file exceeds the MAX_FILE_SIZE directive was specified in the HTML form',
    3 => 'The uploaded file was partially uploaded',
    4 => 'No file was uploaded',
    5 => 'Missing temp folder',
    6 => 'Failed to write file to disk',
    7 => 'PHP extension stopped the file upload',
);




if(isset($_FILES['userfile'])){
    $file_array = reArrayFiles($_FILES['userfile']);
    //pre_r($file_array);
    for($i=0;$i<count($file_array);$i++){
        if($file_array[$i]['error']){
            ?><div class="alert alert-danger">
            <?php echo $file_array[$i]['name']. ' - '.$phpFileUploadErrors[$file_array[$i]['error']]; ?> 
            </div> <?php
        }
        else{
            $extensions = array('jpg','png','gif','jpeg');

            $file_ext = explode('.',$file_array[$i]['name']);
            $name = $file_ext[0];
            $name = preg_replace("!-!","_",$name);
            $name = preg_replace("! !","_",$name);
            $title = $_POST['title'];
            $category = $_POST['category'];
            $file_ext = end($file_ext);
            $title = $mysqli->real_escape_string($title);
            $mainCat= $_POST['main_category'];
            //User id
            $username = $_SESSION['username'];
            $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
            $row = mysqli_fetch_array($result);
            $user_id = $row['id'];

            if(!in_array($file_ext, $extensions))
            {
                ?><div class="alert alert-danger">
                <?php echo "{$file_array[$i]['name']} - Invalid file extension!"; ?> 
                </div> <?php
            }
            else{
                $img_dir = 'gallery/'.$file_array[$i]['name'];

//                $destination_path = getcwd().DIRECTORY_SEPARATOR;
//                $target_path = $destination_path . 'gallery/'. basename( $_FILES["profpic"]["name"]);
//                move_uploaded_file($_FILES['profpic']['tmp_name'], $target_path);

                //only image testing
                $query = "SELECT * FROM images WHERE img_dir = '$img_dir'";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) < 1){
                    move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
                    $query = $mysqli->query("INSERT IGNORE INTO $table (name,img_dir,title,category,user_id,main_category_id) VALUES('$name','$img_dir','$title','$category','$user_id','$mainCat')");
                        if($query)
                        {
                            $_SESSION['content'] = "gallery";
                            header('Location: main-page.php');
                        } 
                        else
                            echo $mysqli->error;
                }
                else{
                    ?><div class="alert alert-danger">
                    <?php echo "{$file_array[$i]['name']} - This image name is taken"; ?> 
                    </div> <?php
                }

            }
        }
    }
}


?>