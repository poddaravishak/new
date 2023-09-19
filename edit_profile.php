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
    $cv = $row['cv'];
}

// Handle profile photo update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
    // ... (your existing photo upload code)
}

// Handle cover photo update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["coverphoto"])) {
    // ... (your existing cover photo upload code)
}

// Handle CV (resume) update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["cv"])) {
    $target_dir = "cv_uploads/";
    $target_file = $target_dir . basename($_FILES["cv"]["name"]);
    $cvFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is a valid document (PDF, DOC, DOCX)
    if (isset($_POST["submit"]) && !empty($_FILES["cv"]["tmp_name"])) {
        $allowedExtensions = array("pdf", "doc", "docx");
        if (!in_array($cvFileType, $allowedExtensions)) {
            echo "Invalid CV file format. Please upload a PDF, DOC, or DOCX file.";
            exit;
        }
    }

    // Move the uploaded CV file to the cv_uploads folder with the original filename
    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
        $cv = $target_file;
    }
}

// Update user profile information in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... (your existing profile update code)

    // Update the user's profile information in the database
    $update_query = "UPDATE students SET first_name='$first_name', last_name='$last_name', father_name='$father_name', mother_name='$mother_name', date_of_birth='$date_of_birth', batch='$batch', department='$department', session_year='$session_year', mobile='$mobile', currently_worked='$currently_worked', livein='$livein', photo='$photo', coverphoto='$coverphoto', cv='$cv' WHERE student_id='$student_id'";
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
c
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="css/std.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/std.css"/>
    <style>
       /* Reset default margin and padding for all elements */
* {
    margin: 0;
    padding: 0;
}

/* Style the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    padding: 20px;
}

/* Style the form container */
.edit-profile-form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Style form headings */
h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style labels and input fields */
label {
    display: block;
    font-weight: bold;
    margin-top: 10px;
}

input[type="text"],
input[type="date"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style the image previews */
img {
    margin-top: 10px;
    max-width: 100px;
    max-height: 100px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
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
 <!-- CV (Resume) -->
 <label for="cv">CV (Resume):</label>
            <input type="file" id="cv" name="cv" accept=".pdf, .doc, .docx"><br>

            <!-- Display current CV file name -->
            <?php if ($cv): ?>
                Current CV: <?php echo basename($cv); ?><br>
            <?php endif; ?>

            <input type="submit" name="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>
