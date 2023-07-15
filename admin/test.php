<!DOCTYPE html>
<html>
<head>
    <title>Alumni Verification Data</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        display: inline;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    table {
        justify-content: center;
        align-items: center;
        width: 60%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    form {
        display: inline-block;
        margin-bottom: 10px;
    }

    input[type="text"] {
        padding: 6px 12px;
        border: 1px solid #ddd;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>

<body>
    <?php
    // Assuming you have already established a database connection
    $host = "localhost";  // Replace with your database host
    $dbname = "alumni";  // Replace with your database name
    $username = "root";  // Replace with your database username
    $password = "";  // Replace with your database password

    // Create a PDO instance
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }

    // Fetch data from the "verify" table
    $query = "SELECT student_id, date_of_birth, session FROM verify";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $verifyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle search
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        // Filter data based on search input
        $verifyData = array_filter($verifyData, function($row) use ($search) {
            return strpos($row['student_id'], $search) !== false;
        });
    }

    // Handle delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $phn = $_POST['phn'];

        // Prepare and execute the deletion query
        $query = "DELETE FROM verify WHERE student_id = :phn";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':phn', $phn);
        $stmt->execute();

        // Remove the deleted row from the data array
        $verifyData = array_filter($verifyData, function($row) use ($phn) {
            return $row['student_id'] !== $phn;
        });
    }
    ?>

    <form method="GET" action="">
        <label for="search">Search by Student ID:</label>
        <input type="text" name="search" id="search" placeholder="Enter student ID" />
        <input type="submit" value="Search" />
    </form>

    <table>
        <tr>
            <th>Student ID</th>
            <th>Date of Birth</th>
            <th>Session</th>
            <th>Action</th>
        </tr>
        <?php foreach ($verifyData as $row): ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['date_of_birth']; ?></td>
                <td><?php echo $row['session']; ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="phn" value="<?php echo $row['student_id']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
