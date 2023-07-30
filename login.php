<?php
session_start();

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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate user credentials
    $query = "SELECT * FROM students WHERE email = '$email' AND pass = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        // Start session and store user information
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        // Redirect to profile page or any other desired page
        header('Location: stdprofile.php');
        exit;
    } 
    
}

mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />

    <title>Login</title>
</head>
<body>
<?php
include 'nav.php';
?>

    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" id="email" name="email" placeholder="Email" required /><br />
            <input type="password" id="password" name="password" placeholder="Password" required /><br />
            <div class="forgot-password">
                <a href="#">Forgot password?</a>
            </div>
            <div class="already-account">
                <a href="reg.php">Already have an account?</a>
            </div>
            <input type="submit" value="Submit" class="submit-button" />
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (mysqli_num_rows($result) != 1) {
                    echo "<p class='error-message'>Invalid email or password.</p>";
                }
            }
            ?>
          </form>
    </div>
    <?php
include 'footter.php';
?>
</body>
</html>

