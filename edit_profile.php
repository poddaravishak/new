<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('Location: login.php');
    exit;
}

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "alumni";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle saving changes to the database
    $email = $_SESSION['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $batch = $_POST['batch'];
    $department = $_POST['department'];
    $session_year = $_POST['session_year'];
    $mobile = $_POST['mobile'];
    $currently_worked = $_POST['currently_worked'];
    $livein = $_POST['livein'];

    // Handle photo upload logic
    $photo_path = $row['photo']; // Default to the existing photo path

    if (!empty($_FILES['photo']['name'])) {
        $photo_name = $_FILES['photo']['name'];
        $photo_path = 'uploads/' . $photo_name;
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);
    }

    // Handle cover photo upload logic
    $cover_photo_path = $row['coverphoto']; // Default to the existing cover photo path

    if (!empty($_FILES['cover_photo']['name'])) {
        $cover_photo_name = $_FILES['cover_photo']['name'];
        $cover_photo_path = 'uploads/' . $cover_photo_name;
        move_uploaded_file($_FILES['cover_photo']['tmp_name'], $cover_photo_path);
    }

    // Check if the user wants to remove the profile photo
    if (isset($_POST['remove_photo'])) {
        $photo_path = ''; // Set the photo path to an empty string to remove the photo
    }

    // Check if the user wants to remove the cover photo
    if (isset($_POST['remove_cover_photo'])) {
        $cover_photo_path = ''; // Set the cover photo path to an empty string to remove the cover photo
    }

    // Update user information in the database
    $query = "UPDATE students SET 
        first_name='$first_name', 
        last_name='$last_name', 
        father_name='$father_name', 
        mother_name='$mother_name', 
        date_of_birth='$date_of_birth', 
        batch='$batch', 
        department='$department', 
        session_year='$session_year', 
        mobile='$mobile', 
        currently_worked='$currently_worked', 
        livein='$livein',
        photo='$photo_path',
        coverphoto='$cover_photo_path'
        WHERE email='$email'";

    $conn->query($query);

    // Optionally, you can redirect the user to a different page after saving changes
    header('Location: profile.php');
    exit;
}

// Query to retrieve user information
$email = $_SESSION['email'];
$query = "SELECT * FROM students WHERE email = '$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Display user information in an editable form
    echo "<html>
            <head>
                <title>Edit Profile</title>
            </head>
            <body>
                <h2>Edit Profile</h2>
                <form action='' method='post' enctype='multipart/form-data'>
                    First Name: <input type='text' name='first_name' value='{$row['first_name']}'><br>
                    Last Name: <input type='text' name='last_name' value='{$row['last_name']}'><br>
                    Father Name: <input type='text' name='father_name' value='{$row['father_name']}'><br>
                    Mother Name: <input type='text' name='mother_name' value='{$row['mother_name']}'><br>
                    Date of Birth: <input type='text' name='date_of_birth' value='{$row['date_of_birth']}'><br>
                    Batch: <input type='text' name='batch' value='{$row['batch']}'><br>
                    Department: <input type='text' name='department' value='{$row['department']}'><br>
                    Session Year: <input type='text' name='session_year' value='{$row['session_year']}'><br>
                    Mobile: <input type='text' name='mobile' value='{$row['mobile']}'><br>
                    Currently Worked: <input type='text' name='currently_worked' value='{$row['currently_worked']}'><br>
                    Live In: <input type='text' name='livein' value='{$row['livein']}'><br>

                    <!-- Display existing photo -->
                    Existing Photo: <img src='{$row['photo']}' alt='User Photo' width='100'><br>
                    Photo: <input type='file' name='photo'><br>
                    <label>Remove Photo: <input type='checkbox' name='remove_photo'></label><br>

                    <!-- Display existing cover photo -->
                    Existing Cover Photo: <img src='{$row['coverphoto']}' alt='Cover Photo' width='100'><br>
                    Cover Photo: <input type='file' name='cover_photo'><br>
                    <label>Remove Cover Photo: <input type='checkbox' name='remove_cover_photo'></label><br>

                    <input type='submit' value='Save Changes'>
                </form>
            </body>
        </html>";
} else {
    echo "User not found";
}

// Close the database connection
$conn->close();
?>
