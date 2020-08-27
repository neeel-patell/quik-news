<?php
    include 'notification_function.php';
    
    $title = $_POST['title'];
    $message = $_POST['message'];
    
    if(send_notification($title,$message) === "Notifications not sent")
        header("location: send_message.php?msg=Message sent Failed");
    else
        header("location: send_message.php?msg=Message sent Successfully");
?>