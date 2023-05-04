<?php
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
        require_once "db_connect.php"; // Include database configuration file
        $stmt = $conn->prepare("INSERT INTO wrongs (code, reason) VALUES (:code, :reason)");
        
        $highest_row = $worksheet->getHighestRow();
        for($row = 2; $row <= $highest_row; $row++) {
            $code = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
            $reason = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            
            $stmt->bindParam(":code", $code);
            $stmt->bindParam(":reason", $reason);
            $stmt->execute();
        }
        
        echo "Data inserted successfully!";
    } else {
        echo "Invalid file format. Only XLS and XLSX files are allowed.";
    }
}
?>