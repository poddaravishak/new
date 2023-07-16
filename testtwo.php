<!DOCTYPE html>
<html>
<head>
    <title>Count Rows</title>
</head>
<body>
   
    <?php
      include 'config.php';
    // Query to count rows in the "students" table
    $sql = "SELECT COUNT(*) as count FROM students";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row["count"];
        echo " " . $count;
    } else {
        echo "No rows found in the 'students' table.";
    }

    $conn->close();
    ?>
</body>
</html>
