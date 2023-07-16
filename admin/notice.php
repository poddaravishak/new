<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header("Location: adminlogin.php");
    exit(); // Exit the current script
}

// User is logged in, continue with the rest of the code

// Access the email from the session variable
$email = $_SESSION['email'];

// ... Rest of your code ...
?>


<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Responsive Sidebar Menu | CodingLab</title>
    <link rel="stylesheet" href="css/notice.css" />

    <!-- Boxicons CDN Link -->
    <link
        href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
        rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<?php
include 'sidebar.php';
?>

<section class="home-section">
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

    $message = ""; // Initialize an empty variable for the message

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $title = $_POST['title'];
        $date = $_POST['date'];

        // File upload logic
        $targetDir = "uploadspdf/"; // Specify the directory where you want to store uploaded files
        $pdfFilename = $_FILES["pdf_filename"]["name"];
        $targetPath = $targetDir . basename($pdfFilename);
        if (move_uploaded_file($_FILES["pdf_filename"]["tmp_name"], $targetPath)) {
            // File uploaded successfully
            // Insert data into the notice table
            $sql = "INSERT INTO notice (title, date, pdf_filename) VALUES ('$title', '$date', '$pdfFilename')";
            if (mysqli_query($connection, $sql)) {
                $message = "Data uploaded successfully.";
            } else {
                $message = "Error: " . mysqli_error($connection);
            }
        } else {
            // File upload failed
            $message = "Error uploading the file.";
        }
    }

    mysqli_close($connection);
    ?>

    <div class="card">
        <h3>Upload Notice</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required />

            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required />

            <label for="pdf_filename">PDF File:</label>
            <input type="file" name="pdf_filename" id="pdf_filename" required />

            <input type="submit" value="Submit" />
        </form>

        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</section>





<script src="sidebar.js"></script>
</body>
</html>
