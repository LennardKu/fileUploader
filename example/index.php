<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>
</head>
<body>
    <h1>Upload File</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select file to upload:</label><br>
        <input type="file" name="file" id="file"><br><br>
        <input type="submit" value="Upload" name="submit">
    </form>
</body>
</html>
