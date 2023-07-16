<!DOCTYPE html>
<html>
<head>
    <title>Alumni Story Upload</title>
</head>
<body>
    <h1>Alumni Story Upload</h1>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database connection code
        require_once 'database.php';

        // Retrieve form data
        $title = $_POST['title'];
        $date = $_POST['date'];
        $content = $_POST['content'];

        // Prepare and execute the SQL statement to insert data into the "story" table
        $sql = "INSERT INTO story (title, date, content) VALUES ('$title', '$date', '$content')";
        if ($conn->query($sql) === TRUE) {
            echo "Story uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required><br><br>

        <label for="content">Story:</label>
        <textarea name="content" id="content" rows="5" required></textarea><br><br>

        <input type="submit" value="Upload Story">
    </form>
</body>
</html>
