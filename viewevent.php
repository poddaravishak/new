<!DOCTYPE html>
<html>
<head>
    <title>View Event</title>
    <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <style>
       body {
 
 
  height: 100vh;
}

.card {
    padding-top: 50px;
    margin-top: 220px;
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 800px;
    padding: 20px;
    margin: 20px auto; /* Center align the card */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 600px; /* Set a maximum width for the card */
  }

        .card-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .card-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .card-description {
            color: #777;
        }
    </style>
</head>
<body>
<?php
include 'nav.php';
?>

<?php
    // Database connection details
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'alumni';

    // Establishing the database connection
    $connection = mysqli_connect($hostname, $username, $password, $database);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the event ID is provided
    if (isset($_GET['id'])) {
        $eventId = $_GET['id'];

        // Fetch event data from the database
        $sql = "SELECT * FROM event WHERE id = '$eventId'";
        $result = mysqli_query($connection, $sql);

        // Display the event card
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $eventTitle = $row['event_title'];
            $eventBanner = $row['event_banner'];
            $eventDescription = $row['event_description'];
?>

            <div class="card">
                <img class="card-image" src="<?php echo $eventBanner; ?>" alt="Event Banner">
                <h2 class="card-title"><?php echo $eventTitle; ?></h2>
                <p class="card-description"><?php echo $eventDescription; ?></p>
            </div>

<?php
        } else {
            echo '<p>No event found with the provided ID.</p>';
        }
    } else {
        echo '<p>No event ID provided.</p>';
    }

    // Closing the database connection
    mysqli_close($connection);
?>
<?php
include 'footter.php';
?>
</body>
</html>
