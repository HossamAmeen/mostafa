<?php
require_once('connect.php');



try {
    // Create table
    $sql = "CREATE TABLE if not exists users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(225) NOT NULL
    )";
    $conn->exec($sql);

    //echo "Table users created successfully<br>";

    // Create the wrongs table
    $conn->exec("CREATE TABLE if not exists wrongs (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(255) NOT NULL,
        reason VARCHAR(255) NOT NULL,
        status VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

   // echo "Table 'wrongs' created successfully.";

} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

$conn = null;
?>
