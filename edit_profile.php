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

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user information from the database
$email = $_SESSION['email'];
$query = "SELECT * FROM students WHERE email = '$email'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $student_id = $row['student_id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $father_name = $row['father_name'];
    $mother_name = $row['mother_name'];
    $date_of_birth = $row['date_of_birth'];
    $batch = $row['batch'];
    $department = $row['department'];
    $session_year = $row['session_year'];
    $photo = $row['photo'];
    $mobile = $row['mobile'];
    $currently_worked = $row['currently_worked'];
    $livein = $row['livein'];
    $coverphoto = $row['coverphoto'];
}

// Handle profile photo update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
    $target_dir = "photo_uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is a valid image
    if (isset($_POST["submit"]) && !empty($_FILES["photo"]["tmp_name"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }
    }

    // Move the uploaded file to the photo_uploads folder with the original filename
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $photo = $target_file;
    }
}

// Handle cover photo update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["coverphoto"])) {
    $target_dir = "coverphoto/";
    $target_file = $target_dir . basename($_FILES["coverphoto"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is a valid image
    if (isset($_POST["submit"]) && !empty($_FILES["coverphoto"]["tmp_name"])) {
        $check = getimagesize($_FILES["coverphoto"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }
    }

    // Move the uploaded file to the coverphoto folder with the original filename
    if (move_uploaded_file($_FILES["coverphoto"]["tmp_name"], $target_file)) {
        $coverphoto = $target_file;
    }
}

// Update user profile information in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $father_name = $_POST["father_name"];
    $mother_name = $_POST["mother_name"];
    $date_of_birth = $_POST["date_of_birth"];
    $batch = $_POST["batch"];
    $department = $_POST["department"];
    $session_year = $_POST["session_year"];
    $mobile = $_POST["mobile"];
    $currently_worked = $_POST["currently_worked"];
    $livein = $_POST["livein"];

    // Update the user's profile information in the database
    $update_query = "UPDATE students SET first_name='$first_name', last_name='$last_name', father_name='$father_name', mother_name='$mother_name', date_of_birth='$date_of_birth', batch='$batch', department='$department', session_year='$session_year', mobile='$mobile', currently_worked='$currently_worked', livein='$livein', photo='$photo', coverphoto='$coverphoto' WHERE student_id='$student_id'";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        // Redirect to the profile page after successful update
        header('Location: profile.php');
        exit;
    } else {
        echo "Error updating profile: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="css/std.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/std.css"/>
    <style>
        body {
            /* Add your custom styles here */
        }
    </style>
</head>
<body>
    <div class="edit-profile-form">
        <h2>Edit Profile</h2>
        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>"><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>"><br>

            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name" value="<?php echo $father_name; ?>"><br>

            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name" value="<?php echo $mother_name; ?>"><br>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>"><br>

            <label for="batch">Batch:</label>
            <input type="text" id="batch" name="batch" value="<?php echo $batch; ?>"><br>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" value="<?php echo $department; ?>"><br>

            <label for="session_year">Session Year:</label>
            <input type="text" id="session_year" name="session_year" value="<?php echo $session_year; ?>"><br>

            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" name="mobile" value="<?php echo $mobile; ?>"><br>

            <label for="currently_worked">Currently Worked:</label>
            <input type="text" id="currently_worked" name="currently_worked" value="<?php echo $currently_worked; ?>"><br>

            <label for="livein">Live In:</label>
            <input type="text" id="livein" name="livein" value="<?php echo $livein; ?>"><br>

            <!-- Profile Photo -->
            <label for="photo">Profile Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*"><br>

            <!-- Current Profile Photo -->
            <?php if ($photo): ?>
                <img src="<?php echo $photo; ?>" width="100" height="100">
            <?php endif; ?>

            <!-- Cover Photo -->
            <label for="coverphoto">Cover Photo:</label>
            <input type="file" id="coverphoto" name="coverphoto" accept="image/*"><br>

            <!-- Current Cover Photo -->
            <?php if ($coverphoto): ?>
                <img src="<?php echo $coverphoto; ?>" width="100" height="100">
            <?php endif; ?>

            <input type="submit" name="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>
