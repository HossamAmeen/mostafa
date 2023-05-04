<?php
require_once('db_connect.php');

try {
    // Create table
    $stmt = $conn->prepare("INSERT INTO wrongs (code, reason) VALUES (:code, :reason)");

    // Bind the parameters to the statement
    $stmt->bindParam(':code', $code);
    $stmt->bindParam(':reason', $reason);

    // Set the values of the parameters
    $code = $_POST['code'];
    $reason = $_POST['reason'];


    // Execute the statement
    $stmt->execute();
} catch(PDOException $e) {
    echo  $e->getMessage();
}

$conn = null;
?>

