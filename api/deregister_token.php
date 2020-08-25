<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $token = $_POST['token'];
    $query = "DELETE FROM android_devices where token='$token'";
    if($conn->query($query)){
        $data[] = array("message"=>"Token Deregistered successfully");
    }
    else{
        $data[] = array("message"=>"Device is not deregistered");
    }

    echo json_encode(array("data"=>$data));
?>