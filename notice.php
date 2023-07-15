<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="notice.css">
    <title>Document</title>
</head>
<body>
    
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "alumni";

    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $title = $_POST['title'];
        $fullNotice = $_POST['full_notice'];

        // Upload PDF file
        $targetPdfDir = "pdf_uploads/";
        $targetPdfFile = $targetPdfDir . basename($_FILES["pdf_upload"]["name"]);
        move_uploaded_file($_FILES["pdf_upload"]["tmp_name"], $targetPdfFile);

        // Upload photo file
        $targetPhotoDir = "photo_uploads/";
        $targetPhotoFile = $targetPhotoDir . basename($_FILES["photo_upload"]["name"]);
        move_uploaded_file($_FILES["photo_upload"]["tmp_name"], $targetPhotoFile);

        // Insert data into the database
        $sql = "INSERT INTO notice (title, full_notice, pdf_path, photo_path) 
                VALUES ('$title', '$fullNotice', '$targetPdfFile', '$targetPhotoFile')";

        if (mysqli_query($connection, $sql)) {
            echo "<p>Notice submitted successfully.</p>";
        } else {
            echo "<p>Error: " . mysqli_error($connection) . "</p>";
        }
    }

    mysqli_close($connection);
    ?>

    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="full_notice">Full Notice:</label><br>
        <textarea name="full_notice" id="full_notice" rows="5" cols="50" required></textarea><br><br>

        <label for="pdf_upload">PDF File Upload:</label>
        <input type="file" name="pdf_upload" id="pdf_upload" accept=".pdf"><br><br>

        <label for="photo_upload">Photo Upload:</label>
        <input type="file" name="photo_upload" id="photo_upload" accept="image/*"><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>