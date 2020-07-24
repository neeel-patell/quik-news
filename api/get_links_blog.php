<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $limit = $_POST['limit'];
    
    $query = "SELECT id,`image` from images WHERE category=4 ORDER BY created_at DESC limit $limit,20";
    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        $query = "SELECT subject,description from blog where image_id=".$row['id'];
        $blog = $conn->query($query);
        $blog = $blog->fetch_array();
        array_push($data,array("id"=>$row['id'],"images"=>$row['image'],"subject"=>$blog['subject'],"description"=>$blog['description']));
    }

    echo json_encode(array("data"=>$data));
?>