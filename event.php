<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header("Location: admin/adminlogin.php");
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
    <link rel="stylesheet" href="event.css" />
  
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <?php
  include 'admin/sidebar.php';
  ?>

    <section class="home-section">

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alumni";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $eventTitle = $_POST["event_title"];
    $eventDescription = $_POST["event_description"];

    // File upload handling
    $targetDir = "uploadsevent/";
    $targetFile = $targetDir . basename($_FILES["event_banner"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["event_banner"]["tmp_name"]);
    if ($check === false) {
        $message = "Error: Invalid image file.";
        $uploadOk = 0;
    }

    // Check file size (optional)
    if ($_FILES["event_banner"]["size"] > 500000) {
        $message = "Error: File size is too large.";
        $uploadOk = 0;
    }

    // Allow only specific file formats (modify this list as per your requirements)
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        $message = "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If file upload is valid, move the uploaded file to the target directory
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["event_banner"]["tmp_name"], $targetFile)) {
            // Insert event details into the database
            $sql = "INSERT INTO event (event_title, event_banner, event_description) VALUES ('$eventTitle', '$targetFile', '$eventDescription')";

            if ($conn->query($sql) === true) {
                $message = "Event details uploaded successfully.";
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $message = "Error: Failed to move the uploaded file.";
        }
    }
}
$conn->close();
?>


<div class="card">
  <form action="event.php" method="POST" enctype="multipart/form-data">
    <label for="event-title">Event Title:</label>
    <input type="text" id="event-title" name="event_title" required />

    <label for="event-banner">Event Banner:</label>
    <input type="file" id="event-banner" name="event_banner" accept="image/*" required />

    <label for="event-description">Event Description:</label>
    <textarea id="event-description" name="event_description" required></textarea>

    <button type="submit">Submit</button>
  </form>
  <?php if (!empty($message)): ?>
  <p><?php echo $message; ?></p>
  <?php endif; ?>
</div>
</section>


    <script src="admin/sidebar.js"></script>
  </body>
</html>
