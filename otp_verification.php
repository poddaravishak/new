// otp_verification.php
<?php
  // Establish database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "alumni";
// Establish database connection and retrieve the stored OTP for the user
$connection = mysqli_connect($servername, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$student_id = $_POST['student_id']; // Retrieve the student ID from the previous form submission
$selectQuery = "SELECT otp FROM students WHERE student_id = '$student_id'";
$result = mysqli_query($connection, $selectQuery);
$row = mysqli_fetch_assoc($result);
$storedOTP = $row['otp'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otpInput = $_POST['otp'];

    if ($otpInput === $storedOTP) {
        // OTP verification successful
        // Proceed with the registration process

        // Clear the stored OTP from the database
        $updateQuery = "UPDATE students SET otp = NULL WHERE student_id = '$student_id'";
        mysqli_query($connection, $updateQuery);

        echo "Registration completed successfully.";
        // Redirect to the success page or any other desired page
        header("Location: registration_success.php");
        exit;
    } else {
        // Incorrect OTP entered
        echo "Incorrect OTP. Please try again.";
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <link rel="stylesheet" href="hf.css" />
    <link rel="stylesheet" href="reg.css">
    
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />

</head>
<body>
<?php include 'nav.php'; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" id="otp" required>

        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

        <input type="submit" value="Submit">
    </form>
<?php include 'footter.php'; ?>
</body>
</html>
