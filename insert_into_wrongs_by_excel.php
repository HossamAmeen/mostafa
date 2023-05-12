<?php
session_start();
// Step 2: Process the uploaded file
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_FILES["excel_file"]["name"];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    if($file_extension == "xls" || $file_extension == "xlsx") {
        require_once "PHPExcel-1.8\Classes/PHPExcel.php"; // Include PHPExcel library
        $file_tmp_path = $_FILES["excel_file"]["tmp_name"];
        $excel_reader = PHPExcel_IOFactory::createReaderForFile($file_tmp_path);
        $excel_obj = $excel_reader->load($file_tmp_path);
        $worksheet = $excel_obj->getActiveSheet();
        
        // Step 3: Build the SQL INSERT statement and insert the data into the database
        require_once "connect.php"; // Include database configuration file
        $stmt = $conn->prepare("INSERT INTO wrongs (code, reason, status) VALUES (:code, :reason, :status)");
        
        $highest_row = $worksheet->getHighestRow();
        for($row = 2; $row <= $highest_row; $row++) {
            $code = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
            $reason = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            
            $stmt->bindParam(":code", $code);
            $stmt->bindParam(":reason", $reason);
            $stmt->bindParam(':status', $status);
            

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
           
            
           
        }
        $_SESSION['success'] = 'تم اضافة الداتا بنجاح.';
        header("location: home.php");
    } else {
        echo "Invalid file format. Only XLS and XLSX files are allowed.";
    }
}
?>