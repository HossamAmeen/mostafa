<?php

require_once('connect.php');
session_start();

try {
    // insert into table
    $stmt = $conn->prepare("INSERT INTO wrongs (code, reason, status) VALUES (:code, :reason, :status)");

    // Bind the parameters to the statement
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':reason', $reason);
    $stmt->bindParam(':status', $status);

    // Set the values of the parameters
    $code = $_POST['code'];
    $reason = $_POST['reason'];

    // send to api
    // Initialize curl
    $ch = curl_init();

    // Set the URL of the external API
    $url = "http://localhost/mostafa1/test_api.php";

    // Set the request method to POST
    curl_setopt($ch, CURLOPT_POST, true);

    // Set the request body
    $body = json_encode(array(
        'ViolationCode' => $code,
        'DropReason' => $reason
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    // Set the request headers
    $headers = array(
        "Content-Type: application/json",
        "CorrelationId: 0cd8bcf3-3680-44saff9-a0d3-c4cb768b9c41",
        "RequestTimeStamp: ".date('20y/m/d h:m:s'),
        "UserName: Test",
        "Password: Password"
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Set other curl options as needed
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and capture the response
    $response = curl_exec($ch);

    // Close curl
    curl_close($ch);
    $status = Null;
    // Process the response
    if ($response !== false) {
        $data = json_decode($response, true);
        if ($data !== null) {
            if (array_key_exists("Description", $data)) { 
                $status = $data['Description'];
            }
            // header("location: home.php");
        } else {
            // Handle JSON decoding error
        }
    } else {
        // Handle curl error
    }
    // Execute the statement
    $stmt->execute();
    $_SESSION['success'] = 'تم اضافة الداتا بنجاح.';
    header("location: home.php");
} catch(PDOException $e) {
    $_SESSION['error'] = 'error' . $e->getMessage();
    // echo  $e->getMessage();
    
}





$conn = null;
?>

