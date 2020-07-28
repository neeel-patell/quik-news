<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $limit = $_POST['limit'];

    $query = "SELECT id,`image`,category,created_at from images ORDER BY created_at DESC limit $limit,20";
    $result = $conn->query($query);
    while($row = $result->fetch_array()){
        if($row['category'] == 4){
            $blog = 1;
        }
        else{
            $blog = 0;
        }
        $date = date('d/m/Y - H:i A',strtotime($row['created_at']));
        array_push($data,array("id"=>$row['id'],"images"=>$row['image'],"blog"=>$blog,"time"=>$date));
    }

    echo json_encode(array("data"=>$data));
?>