<?php
    require '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $image = $_POST['image'];
    $result = $conn->query("SELECT subject from blog where image_id=$image");
    // Getting Subject of blog to show under image in android

    $row = $result->fetch_array();
    array_push($data,array("subject"=>$row['subject']));

    echo json_encode(array("data"=>$data));
?>