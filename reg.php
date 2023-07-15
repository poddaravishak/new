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
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $batch = $_POST['batch'];
    $department = $_POST['department'];
    $session_year = $_POST['session_year'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $currently_worked = $_POST['currently_worked'];

    // Check verification table for matching data
    $verifyQuery = "SELECT * FROM verify WHERE student_id = '$student_id' AND date_of_birth = '$date_of_birth' AND session_year = '$session_year'";
    $verifyResult = mysqli_query($connection, $verifyQuery);

    if (mysqli_num_rows($verifyResult) > 0) {
        // Upload photo file
        $targetPhotoDir = "photo_uploads/";
        $targetPhotoFile = $targetPhotoDir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetPhotoFile);

        // Insert data into the database
        $sql = "INSERT INTO students (student_id, first_name, last_name, father_name, mother_name, date_of_birth, batch, department, session_year, photo, mobile, email, pass, currently_worked)
                VALUES ('$student_id', '$first_name', '$last_name', '$father_name', '$mother_name', '$date_of_birth', '$batch', '$department', '$session_year', '$targetPhotoFile', '$mobile', '$email', '$pass', '$currently_worked')";

        if (mysqli_query($connection, $sql)) {
            echo "Student information uploaded successfully.";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        echo "Error: Verification failed. Please contact the admin.";
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Information Upload</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <label for="student_id">Student ID:</label>
        <input type="number" name="student_id" id="student_id" required>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>

        <label for="father_name">Father's Name:</label>
        <input type="text" name="father_name" id="father_name" required>

        <label for="mother_name">Mother's Name:</label>
        <input type="text" name="mother_name" id="mother_name" required>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" id="date_of_birth" required>

        <label for="batch">Batch:</label>
        <select name="batch" id="batch" required>
            <option value="">Select Batch</option>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>

        <label for="department">Department:</label>
        <select name="department" id="department" required>
            <option value="">Select Department</option>
            <option value="CSE">CSE</option>
            <option value="EEE">EEE</option>
            <option value="ICE">ICE</option>
            <option value="CVIL">CVIL</option>
        </select>

        <label for="session_year">Session Year:</label>
        <input type="text" name="session_year" id="session_year" required>

        <label for="photo">Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*">

        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" id="mobile">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">

        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" required>

        <label for="currently_worked">Currently Worked:</label>
        <input type="text" name="currently_worked" id="currently_worked">

        <input type="submit" value="Submit">
    </form>
</body>
</html>
