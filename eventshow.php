<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            height: inherit;
            text-align: center;
            margin: 20px;
        }

        img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        h3 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 15px;
        }

        hr {
            border: 0.5px solid #ccc;
            margin: 15px 0;
        }
    </style>
    <title>Events</title>
</head>
<body>
<?php
include 'nav.php';
?>
<div class="flex-container">

<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "alumni";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch event data from the database
$query = "SELECT * FROM event";
$result = mysqli_query($connection, $query);

// Check if there are any events
if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Display event information in a card
        echo '<div class="card">';
        
        // Output the banner if available; otherwise, display a default image
        if (!empty($row["event_banner"])) {
            echo '<img src="' . $row["event_banner"] . '" alt="Event Banner">';
        } else {
            echo '<img src="default_event_image.jpg" alt="Default Event Image">';
        }

        echo '<h3>' . $row["event_title"] . '</h3>';
        echo '<p>' . $row["event_description"] . '</p>';

        echo '<hr>';
        echo '</div>';
    }
} else {
    // No events found
    echo "No events found.";
}

// Close the database connection
mysqli_close($connection);
?>

</div>
<?php
include 'footter.php';
?>
</body>
</html>
