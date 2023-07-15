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

// Retrieve data from the "notice" table
$sql = "SELECT * FROM notice";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notice Viewer</title>
    <style>
        body {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .notice {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        .notice h2 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .notice img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .notice .pdf-download {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .notice .pdf-container {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Notice Viewer</h1>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="notice">';
            echo '<h2>' . $row['title'] . '</h2>';

            // Display photo if available
            if (!empty($row['photo_path'])) {
                echo '<img src="' . $row['photo_path'] . '" alt="Photo">';
            }

            // Display PDF if available
            if (!empty($row['pdf_path'])) {
                echo '<div class="pdf-container">';
                echo '<a class="pdf-download" href="' . $row['pdf_path'] . '" target="_blank">Download PDF</a>';
                echo '</div>';
            }

            echo '<div>' . $row['full_notice'] . '</div>';
            echo '<p>Created At: ' . $row['created_at'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No notices found.</p>';
    }

    mysqli_close($connection);
    ?>
</body>
</html>
