<?php
    include_once 'connection.php';
    include_once 'notification_function.php';
    $conn = getConn();

    $image = $_POST['image_link'];
    $category = $_POST['category'];

    // Getting current date and time for server
    $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
    $now = $date->format('Y-m-d H:i:s');
    
    $query = "INSERT INTO images(`image`,category,created_at,updated_at) VALUES(\"$image\",$category,'$now','$now')";
    // Adding image with specific category

    switch($category){
        case 0:
            $title = "Business";
            break;
        case 1:
            $title = "Defense";
            break;
        case 2:
            $title = "Prime";
            break;
        case 3:
            $title = "Lists";
            break;
        case 4:
            $title = "Blog";
            break;
        case 5:
            $title = "India";
            break;
    }
    if($conn->query($query) == true){
        if(isset($_POST['notify'])){
            send_notification($title);
        }
        if($category == 4){ // Checking whether image is a type of blog or not
            $id = $conn->query("SELECT id from images where `image`=\"$image\" AND category=$category");
            // Retrieving ID of latest image inserted with link and category as blog

            $id = $id->fetch_array();
            $image = $id['id'];
            $description = str_replace('"','\"',$_POST['description']);
            $subject = str_replace("'","\'",$_POST['blog_subject']);
            // Replacing characters for easy insert in database
            
            $conn->query("INSERT INTO blog(`subject`,`description`,image_id,created_at,updated_at) VALUES('$subject',\"$description\",$image,'$now','$now')");
        }
        header('location: dashboard.php?msg=Image link / Blog is inserted');
    }
    else{
        header('location: dashboard.php?msg=Image link / Blog is not inserted');
    }
?>