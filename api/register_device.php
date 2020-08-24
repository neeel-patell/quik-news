<?php
    include '../connection.php';
    $conn = getConn();
    header('content-type: application/json');
    $data = array();

    $token = $_POST['token'];
    $result = $conn->query("SELECT token from android_devices where token='$token'");
    if(mysqli_num_rows($result) == 0){
        $query = "INSERT INTO android_devices(token) VALUES('$token')";
        if($conn->query($query)){
            $data[] = array("message"=>"Device registered Successfully");
        }
        else{
            $data[] = array("message"=>"Please generate new token");
        }
    }
    else{
        $data[] = array("message"=>"Device already registered");
    }

    echo json_encode(array("data"=>$data));
?>