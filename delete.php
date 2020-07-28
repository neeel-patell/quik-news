<?php
    require 'connection.php';
    $conn = getConn();
    $id = $_GET['id'];
    $page = $_GET['page'];
    $date = $_GET['date'];

    $conn->query("DELETE FROM blog where image_id=$id");
    // Delete record of blog if it exists

    $query = "DELETE FROM images where id=$id";
    // Delete record of image for specific id
    if($conn->query($query)){
        header("location: view.php?msg=Link / Post Deleted&date=$date&page=$page");
    }
    else{
        header("location: view.php?msg=Link / Post is not Deleted&date=$date&page=$page");
    }
?>