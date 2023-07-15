<?php
// Assuming you have already established a database connection using the config.php file
// Replace the placeholders with your actual database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "alumni";

// Create a new database connection
$connection = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query the database to retrieve event data
$query = "SELECT * FROM event";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Cards</title>
    <link rel="stylesheet" type="text/css" href="card.css">

    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .view-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4287f5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .view-button:hover {
            background-color: #2a5db0;
        }
    </style>
</head>
<body>
    <h1>Events</h1>

    <div class="card-container">
        <?php
        // Loop through the query results and display event cards
        while ($row = mysqli_fetch_assoc($result)) {
            $eventId = $row['id'];
            $eventTitle = $row['event_title'];
            $eventBanner = "uploadsevent/" . $row['event_banner'];
        ?>

            <div class="card">
                <img src="<?php echo $eventBanner; ?>" alt="Event Banner">
                <h2><?php echo $eventTitle; ?></h2>
                <a href="event_details.php?id=<?php echo $eventId; ?>" class="view-button">View</a>
            </div>

        <?php
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
</body>
</html>
