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
    $email = $row['email'];
    $currently_worked = $row['currently_worked'];
}
else {
    // Redirect to login page if user information is not found
    header('Location: login.php');
    exit;
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="profile.css" />
    <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />

    <style>
        .section-bg{
            background: linear-gradient(90deg, white, gray);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 80vh;
            width: 100%;
            padding: auto;
           
        }
        .card {
          
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        .card h2 {
            margin-top: 0;
            text-align: center;
        }

        .card p {
            margin: 10px 0;
        }

        .card label {
            font-weight: bold;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto;
            display: block;
        }
    </style>

    <title>Profile</title>
</head>
<body>
    <?php include 'nav.php'; ?>
<section class="section-bg">
<div class="container">
        <div class="card">
            <h2>Welcome, <?php echo $first_name . ' ' . $last_name; ?></h2>
            <img src="<?php echo $photo; ?>" alt="Profile Photo" class="profile-image">
            <p>
                <label>Student ID:</label> <?php echo $student_id; ?>
            </p>
            <p>
                <label>Father's Name:</label> <?php echo $father_name; ?>
            </p>
            <p>
                <label>Mother's Name:</label> <?php echo $mother_name; ?>
            </p>
            <p>
                <label>Date of Birth:</label> <?php echo $date_of_birth; ?>
            </p>
            <p>
                <label>Batch:</label> <?php echo $batch; ?>
            </p>
            <p>
                <label>Department:</label> <?php echo $department; ?>
            </p>
            <p>
                <label>Session Year:</label> <?php echo $session_year; ?>
            </p>
            <p>
                <label>Mobile:</label> <?php echo $mobile; ?>
            </p>
            <p>
                <label>Email:</label> <?php echo $email; ?>
            </p>
            <p>
                <label>Currently Worked:</label> <?php echo $currently_worked; ?>
            </p>
        </div>
    </div>
</section>
   

<?php
include 'footter.php';
?>
</body>
</html>