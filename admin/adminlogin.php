<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        /* CSS styling for the login card */
        .card {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .card-logo {
            margin-bottom: 20px;
        }
        .card-logo img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <?php
    session_start(); // Start the session

    // Check if the login form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "alumni";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve the form data
        $email = $_POST['email'];
        $password = md5($_POST['password']); // Encrypt the password using MD5

        // Query the adminlogin table for the provided email and password
        $sql = "SELECT * FROM adminlogin WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            // Admin login successful
            $_SESSION['email'] = $email; // Store the email in the session variable
            header("Location: index.php"); // Redirect to the index.php page
            exit(); // Exit the current script
        } else {
            // Admin login failed
            echo "Invalid email or password.";
        }

        $conn->close();
    }
    ?>
    <div class="card">
        <div class="card-logo">
            <img src="logo.png" alt="Logo">
        </div>
        <h2 class="card-title">Admin Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
