<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $image = $_POST['image'];
    $result = $conn->query("SELECT `image` from images where id=$image");
    $row = $result->fetch_array();
    $blog = $conn->query("select subject,description from blog where image_id=$image");
    $blog = $blog->fetch_array();
    array_push($data,array("image"=>$row['image'],"subject"=>$blog['subject'],"description"=>$blog['description']));

    echo json_encode(array("data"=>$data));
?>