<?php
// Database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "alumni";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST["student_id"] ?? "";
    $first_name = $_POST["first_name"] ?? "";
    $last_name = $_POST["last_name"] ?? "";
    $father_name = $_POST["father_name"] ?? "";
    $mother_name = $_POST["mother_name"] ?? "";
    $date_of_birth = $_POST["date_of_birth"] ?? "";
    $batch = $_POST["batch"] ?? "";
    $department = $_POST["department"] ?? "";
    $session = $_POST["session"] ?? "";
    $photo = $_POST["photo"] ?? "";
    $mobile = $_POST["mobile"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $currently_worked = $_POST["currently_worked"] ?? "";

    // Prepare and execute the SQL query
    $sql = "INSERT INTO students (student_id, first_name, last_name, father_name, mother_name, date_of_birth, batch, department, session, photo, mobile, email, password, currently_worked) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssisssssss", $student_id, $first_name, $last_name, $father_name, $mother_name, $date_of_birth, $batch, $department, $session, $photo, $mobile, $email, $password, $currently_worked);
    if ($stmt->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting record: " . $stmt->error;
    }
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="reg.css" />
    <title>Student Information Form</title>
</head>
<body>
    <div class="container">
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Alumni Registration </h2>
            <label for="student_id">Student ID:</label>
            <input type="number" id="student_id" name="student_id" placeholder="Enter Your BAUET Student ID" required>
        
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" placeholder="Enter your First Name" required>
        
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" placeholder="Enter your Last Name" required>
        
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name"  placeholder="Enter your FiFather's Name" required>
        
            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name"  placeholder="Enter your Mother's Name" required >
        
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
        
            <label for="batch">Batch:</label>
            <select id="batch" name="batch" required >
                <option value="">Select Batch</option>
                <option value="1">Batch 1</option>
                <option value="2">Batch 2</option>
                <option value="3">Batch 3</option>
                <!-- Add more options for Batch 4 to 17 as needed -->
            </select>
        
            <label for="department">Department:</label>
            <select id="department" name="department" required>
                <option value="">Select Department</option>
                <option value="CSE">CSE</option>
                <option value="EEE">EEE</option>
                <option value="ICE">ICE</option>
                <option value="Civil">Civil</option>
            </select>
        
            <label for="session">Session:</label>
            <input type="text" id="session" name="session" placeholder="Example: 2018-2019" required>
        
            <label for="photo"> <span> Photo: use 300 x 300 pixel photo <span> </label>
            <input type="file" id="photo" name="photo" required >
           
        
            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter your Mobile Number" required>

            <label for="email">Email Id:</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <label for="currently_worked">Currently worked To:</label>
            <textarea id="currently_worked" name="currently_worked" rows="4" placeholder="Enter your recent position and company name  " required ></textarea>
        
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
