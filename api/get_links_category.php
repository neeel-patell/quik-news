<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $limit = $_POST['limit'];
    $category = $_POST['category'];

    $query = "SELECT `image`,created_at from images WHERE category=$category ORDER BY created_at DESC limit $limit,20";
    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        array_push($data,array("images"=>$row['image'],"time"=>$row['created_at']));
    }

    echo json_encode(array("data"=>$data));
?>