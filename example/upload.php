<?php
// Include the FileUpload class
include '../uploader.class.php'; // Make sure to replace 'FileUpload.php' with the actual filename

// Check if file is being uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $uploadDirectory = "./"; // Replace with your desired directory
    $fileUploader = new FileUpload($uploadDirectory);

    // Example usage for uploading an image with allowed types
    $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
    $uploadResult = $fileUploader->uploadFile($_FILES['file'], $allowedImageTypes);

    if (isset($uploadResult['error'])) {
        // Handle the upload failure accordingly
    }
}