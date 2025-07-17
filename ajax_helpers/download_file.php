<?php
require('../functions.php');

if (isset($_GET['file_id'])) {
    $fileId = $_GET['file_id'];
    $file = DB::queryFirstRow("SELECT * FROM task_files WHERE id = %i", $fileId);
    
    if ($file) {
        $filePath = '../uploads/tasks/' . basename($file['file_path']);
        
        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $file['file_type']);
            header('Content-Disposition: attachment; filename="' . $file['file_name'] . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        }
    }
}

header("HTTP/1.0 404 Not Found");
echo "File not found";
?>