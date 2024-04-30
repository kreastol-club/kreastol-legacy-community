<head>
<meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/img-manage.css">
    <script src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script src="../js/lightbox.js"></script>
<link href="../css/lightbox.css" rel="stylesheet" />

</head>
<div class="gallery-container">
 
<?php if(isset($_SESSION['username']))
{?>
        <button type="submit" id="register-b" onclick="window.location.href='main-page.php?a=img_upload'" name="img_upload">Upload image</button>
<?php }

    require('config.php');
    $query = $conn->query("SELECT * FROM categories");

    $table = 'images';
    while($row =$query->fetch_object()){
        $result = $mysqli->query("SELECT * FROM $table WHERE main_category_id='$row->category_id'") or die($mysqli->error);
        if(mysqli_num_rows($result) < 1)
        {

        }
        else
        {
        echo "<h2>".$row->category."</h2>";
        echo "<div class='img-grid'>";
            while($data = $result->fetch_assoc())
            {
                $title = $data['title'];
                ?>

                <div class='img-container'>
                <a href="https://community.kreastol.club/<?php echo $data['img_dir']?>" rel="lightbox" data-lightbox="<?php $data['category']?>" title="<?php echo $title?>"><img src="https://community.kreastol.club/<?php echo $data['img_dir']?>"></a>
<?php       echo "</div>";
            }
        echo "</div>";
        }
    }
?>
</div>