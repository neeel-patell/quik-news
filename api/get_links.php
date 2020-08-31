<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $limit = $_POST['limit'];

    $query = "SELECT id,`image`,category,created_at from images ORDER BY created_at DESC limit $limit,20";
    // Generating 20 records by limit given from android device (Ex. 0,20 - which means leave first 0 or 20 records; 20,20 leave first 20 records start with 21 till next 20 which means 21 - 40 records)

    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        // Checking whether type of image is blog or not (1 = blog, 0 = other) 

        if($row['category'] == 4){
            $blog = 1;
        }
        else{
            $blog = 0;
        }
        array_push($data,array("id"=>$row['id'],"images"=>$row['image'],"blog"=>$blog,"time"=>$row['created_at']));
    }

    echo json_encode(array("data"=>$data));
?>