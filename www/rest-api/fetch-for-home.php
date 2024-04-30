<?php

include "../config.php";

$sql = "SELECT * FROM all_record order by date desc";
$check = $conn->query($sql);

$content = array();

while ($row = $check->fetch_row()){
//    echo "Type: ".$row[1].", id: ".$row[0]."<br>";

    $id = $row[0];
    switch ($row[1]){
        case "post":
            $sql1 = "SELECT title,LEFT(body, 400) AS body,category,date,username FROM posts
    INNER JOIN categories ON categories.category_id=posts.category_id
    INNER JOIN users ON users.id=posts.user_id where posts.id='$id'";

            $stmt = $conn->query($sql1);
            $result = $stmt->fetch_row();
            $temp = [
                'type'=>$row[1],
                'title'=>$result[0],
                'body'=>$result[1],
                'category'=>$result[2],
                'date'=>$result[3],
                'username'=>$result[4]
            ];
            //pushing the array inside the hero array
            array_push($content, $temp);

            break;
        case "image":
            $sql1 = "SELECT id, img_dir, title FROM images WHERE images.id='$id'";

            $stmt = $conn->query($sql1);
            $result = $stmt->fetch_row();
            $result[1] = str_replace("../gallery/", "", $result[1]);
            $temp = [
                'type'=>$row[1],
                'id'=>$result[0],
                'img_dir'=>$result[1],
                'title'=>$result[2]
            ];
            //pushing the array inside the hero array
            array_push($content, $temp);
            break;
    }
}

echo str_replace("\/", "/", json_encode(['items' => $content]));