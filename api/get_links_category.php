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
        $date = date('dS F Y - H:i A',strtotime($row['created_at']));
        array_push($data,array("images"=>$row['image'],"time"=>$date));
    }

    echo json_encode(array("data"=>$data));
?>