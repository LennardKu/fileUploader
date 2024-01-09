# FileUploader

This php class helps safeguarding your files by providing shell code detection.
It also includes file type verification functionality.

## Usage

Instantiate the `FileUpload` class by providing the upload directory:

```php
<?php
include 'FileUpload.php';

$uploadDirectory = "path/to/upload/directory/";
$fileUploader = new FileUpload($uploadDirectory);
// Perform file uploads using $fileUploader methods
```

## Examples
Upload an image file with allowed types:

```php
$allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
$uploadResult = $fileUploader->uploadFile($_FILES['file'], $allowedImageTypes);
```

Upload any file with specific extensions:
```php
$allowedFileTypes = ["pdf", "xlsx", "docx"];
$uploadResult = $fileUploader->uploadFile($_FILES['file'], $allowedFileTypes);
```
## Feedback

If you have any feedback, please create an issue in the issues tab


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Support us

- [Buy me a coffee](https://www.buymeacoffee.com/webwizdom)

