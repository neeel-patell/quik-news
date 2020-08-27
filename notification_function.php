<?php
    require_once 'connection.php';
    function send_notification($title,$message){
        $conn = getConn();
        $tokens = array();

        // retrieving token of devices which have installed the app on their device
        $result = $conn->query("SELECT token from android_devices");
        while($row = $result->fetch_array()){
            array_push($tokens,$row['token']);
        }

        // Simple notification that shows that post has uploaded
        $message = array("body" =>$message , "title"=>$title);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $tokens,
            'notification' => $message,
            'data' => $message
            );

        $headers = array(
            'Authorization:key = AAAADIiwSbI:APA91bHRPnaHqJfn9rYelU2-Mo8tl6w3LDymRuKq5_n_iHQJoFgSZ7qsWkxdxyF_acstBxRCZOTBlRYiTuMREmDPyWj1W5st7ObufB5E5CXJB2cNgepjiQ6vDEFPqOSFDVDgzBjXD4a9',
            'Content-Type: application/json'
            );

        $ch = curl_init();

        // setting http headers and variables to pass to send notification
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);           
        if ($result === FALSE) {
            return "Notifications not sent";
        }
        curl_close($ch);
        return "Notifications Sent";
    }
?>