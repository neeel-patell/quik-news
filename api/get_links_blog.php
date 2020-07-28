<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $limit = $_POST['limit'];
    
    $query = "SELECT id,`image`,created_at from images WHERE category=4 ORDER BY created_at DESC limit $limit,20";
    // Generating the records which are only have type 4(blog).

    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        $query = "SELECT subject,description from blog where image_id=".$row['id'];
        // Generating blog description for specific image link

        $blog = $conn->query($query);
        $blog = $blog->fetch_array();
        array_push($data,array("id"=>$row['id'],"images"=>$row['image'],"subject"=>$blog['subject'],"description"=>$blog['description'],"time"=>$row['created_at']));
    }

    echo json_encode(array("data"=>$data));
?>