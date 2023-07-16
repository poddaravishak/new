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
    <link rel="stylesheet" href="css/verify.css" />

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
        $student_id = $_POST['student_id'];
        $date_of_birth = $_POST['date_of_birth'];
        $session_year = $_POST['session_year'];

        // Insert data into the verify table
        $sql = "INSERT INTO verify (student_id, date_of_birth, session_year)
            VALUES ('$student_id', '$date_of_birth', '$session_year')";

        if (mysqli_query($connection, $sql)) {
            $message = "Data uploaded successfully.";
        } else {
            $message = "Error: " . mysqli_error($connection);
        }
    }

    mysqli_close($connection);
    ?>

    <div class="card">
        <h3>Verify Student</h3>
        <form action="verify.php" method="POST">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" required />

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" id="date_of_birth" required />

            <label for="session_year">Session Year:</label>
            <input type="text" name="session_year" id="session_year" required />

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
