<?php
/**
 * FileUpload Class - A PHP class for file uploads with optional shell code detection.
 *
 * This class provides functionalities to securely upload files to a specified directory,
 * with an optional shell code detection feature to prevent potential security risks.
 * and the ability to check for specific file types/extensions.
 *
 * @copyright Copyright (c) Lennard Kuenen 2024
 * @license   MIT License (https://opensource.org/licenses/MIT)
 */

 class FileUpload {
    protected $uploadDirectory;
    protected $checkForShell;

    public function __construct($uploadDirectory, $checkForShell = true) {
        $this->uploadDirectory = $uploadDirectory;
        $this->checkForShell = $checkForShell;
    }

    public function uploadFile($file, $allowedTypes = []) {
        $targetFilePath = $this->uploadDirectory . basename($file['name']);
        $uploadOk = ['success'=>true];

        $uploadOk = $this->validateFileType($targetFilePath, $file, $allowedTypes, $uploadOk);

        if ($this->checkForShell && isset($uploadOk['success'])) {
            $uploadOk = $this->checkForShell($file["tmp_name"], $uploadOk);
        }

        if (isset($uploadOk['success'])) {
            $uploadOk = $this->moveUploadedFile($file["tmp_name"], $targetFilePath, $uploadOk);
        }

        return $uploadOk;
    }

    private function validateFileType($targetFilePath, $file, $allowedTypes, $uploadOk) {
        if (!empty($allowedTypes)) {
            $fileExtension = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            if (is_array($allowedTypes)) {
                if (!in_array($fileExtension, $allowedTypes)) {
                    $uploadOk = ["error"=>"fileTypeNotAllowed"];
                }
            } else {
                if ($fileExtension !== $allowedTypes) {
                    $uploadOk = ["error"=>"fileTypeNotAllowed"];
                }
            }
        }
        return $uploadOk;
    }

    private function checkForShell($filePath, $uploadOk) {
        $fileData = file_get_contents($filePath);

        // Check for potential shell code
        if (preg_match("/<\?php|eval\(|system\(|shell_exec\(|passthru\(|exec\(/i", $fileData)) {
            $uploadOk = ["error"=>"shellDetected"];
        }
        return $uploadOk;
    }

    private function moveUploadedFile($tempFilePath, $targetFilePath, $uploadOk) {
        if ($uploadOk) {
            if (!move_uploaded_file($tempFilePath, $targetFilePath)) {
                $uploadOk = ["error"=>"moveFileError"];
            } else {
                $uploadOk = ["success"=>true,"filePath"=>$targetFilePath];
            }
        }
        return $uploadOk;
    }

    public function toggleShellCheck($value) {
        $this->checkForShell = $value;
    }
}
