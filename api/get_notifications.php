<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $limit = $_POST['limit'];

    $query = "SELECT title,body,created_at from notifications ORDER BY created_at DESC limit $limit,20";
    // Generating 20 records by limit given from android device (Ex. 0,20 - which means leave first 0 or 20 records; 20,20 leave first 20 records start with 21 till next 20 which means 21 - 40 records) 

    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        array_push($data,array("title"=>$row['title'],"body"=>$row['body'],"time"=>$row['created_at']));
    }

    echo json_encode(array("data"=>$data));
?>