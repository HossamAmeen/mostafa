<?php
$response = array(
    'status' => 200,
    'Description' => "sucess"
);

// Set the response headers
header('Content-Type: application/json');

// Send the JSON response
echo json_encode($response);
?>
