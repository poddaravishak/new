<!DOCTYPE html>
<html>
<head>
    <title>Event Card</title>
    <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        .card-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .card-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .view-details {
            margin-top: 10px;
            text-align: right;
        }
        .view-details a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        /* Full screen image modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: hidden;
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .modal-image {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
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
    
    // Fetching event data from the database
    $sql = "SELECT * FROM event";
    $result = mysqli_query($connection, $sql);
    
    // Displaying event data in cards
    echo '<div class="card-container">';
    while ($row = mysqli_fetch_assoc($result)) {
        $eventId = $row['id'];
        $eventTitle = $row['event_title'];
        $eventBanner = $row['event_banner'];
?>
        <div class="card">
            <img class="card-image" src="<?php echo $eventBanner; ?>" alt="Event Banner" onclick="openModal('<?php echo $eventBanner; ?>')">
            <h2 class="card-title"><?php echo $eventTitle; ?></h2>
            <div class="view-details">
                <a href="viewevent.php?id=<?php echo $eventId; ?>">View Details</a>
            </div>
        </div>
<?php
    }
    echo '</div>';
    
    // Closing the database connection
    mysqli_close($connection);
?>

<!-- Full screen image modal -->
<div class="modal" id="imageModal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <img class="modal-image" id="modalImage" alt="Full Screen Image">
    </div>

  
</div>

<script>
    function openModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('imageModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }
</script>

<?php
include 'footter.php';
?>
</body>
</html>
