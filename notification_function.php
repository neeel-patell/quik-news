<?php
    require_once 'connection.php';
    function send_notification($title,$message){
        $conn = getConn();
        $tokens = array();

        // Server has problem as it consists timezone of europe. So, It's recommended to use timezone of asia/kolkata in insertion
        $date = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $now = $date->format('Y-m-d H:i:s');
    
        // retrieving token of devices which have installed the app on their device
        $result = $conn->query("SELECT token from android_devices");
        while($row = $result->fetch_array()){
            array_push($tokens,$row['token']);
        }

        $query = "INSERT INTO notifications(title,body,created_at) VALUES('$title','$message','$now')"; // query to insert notification to table to retrieve in android devices
        if($conn->query($query)){
            // notification as per message and title defined on function call
            $message = array("body" =>$message , "title"=>$title);
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array(
                'registration_ids' => $tokens,
                'notification' => $message,
                'data' => $message
                );

            $headers = array(
                // it's key provided on firebase console
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
                // notification send failed due to connection fail.
                return "Notifications not sent";
            }
            curl_close($ch);
            return "Notifications Sent";
        }
        else{
            // insertion query failed
            return "Notifications not sent";
        }
    }        
?>