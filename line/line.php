<?php 
function notify_message($message,$token){
	// error_log("message=".$message." token=".$token);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . $message);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '',);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);

    if (curl_error($ch)) {
        // echo 'error:' . curl_error($ch);
    } else {
        $res = json_decode($result, true);
        // echo "status : " . $res['status'];
        // echo "message : " . $res['message'];
    }
    curl_close($ch);
    return $result;
}

function sosOfficeNotify($message,$office_id){
    global $conn;
    // error_log("sosOfficeNotify message = ".$message." office_id = ".$office_id);
    $sql="select * from office where office_id = '".$office_id."'";
    // error_log("sosOfficeNotify sql = ".$sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row_office = $stmt->fetch(PDO::FETCH_ASSOC);
    // error_log("sosOfficeNotify office_token = ".$row_office['office_token']);
    if ($row_office['office_token']){
        notify_message($message,$row_office['office_token']);
    }
}

function sosDriverNotify($message,$office_id){
    global $conn;
    // error_log("sosOfficeNotify message = ".$message." office_id = ".$office_id);
    $sql="select * from office where office_id = '".$office_id."'";
    // error_log("sosOfficeNotify sql = ".$sql);
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row_office = $stmt->fetch(PDO::FETCH_ASSOC);
    // error_log("sosOfficeNotify office_token = ".$row_office['driver_token']);
    if ($row_office['driver_token']){
        notify_message($message,$row_office['driver_token']);
    }
}

?>