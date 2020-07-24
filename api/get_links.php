<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $limit = $_POST['limit'];

    $query = "SELECT `image`,category from images ORDER BY created_at DESC limit $limit,20";
    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        if($row['category'] == 4){
            $blog = 1;
        }
        else{
            $blog = 0;
        }
        array_push($data,array("images"=>$row['image'],"blog"=>$blog));
    }

    echo json_encode(array("data"=>$data));
?>