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
    <title>User Information</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .flex-container {
            display: flex;
         
            align-items: center; 
            justify-content: center; 
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            margin: 20px;
        }

        img {
            max-width: 100%;
            border-radius: 50%;
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
</head>
<body>
    <div>
        <?php include 'nav.php'; ?>
    </div>

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

        // Fetch data from the database
        $query = "SELECT * FROM all_post";
        $result = mysqli_query($connection, $query);

        // Check if there are any posts
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row in the result set
            while ($row = mysqli_fetch_assoc($result)) {
                // Your HTML for displaying each post goes here
                echo '<div class="card">';
                
                // Output the photo if available; otherwise, display a demo image
                if (!empty($row["post_photo"])) {
                    echo '<img src="' . $row["post_photo"] . '" alt="Post Photo">';
                } else {
                    echo '<img src="demo_image.jpg" alt="Demo Image">';
                }

                echo '<h3>Post Content</h3>';
                echo '<p>' . $row["post_content"] . '</p>';
                echo '<h3>Post Date</h3>';
                echo '<p>' . $row["post_date"] . '</p>';

                echo '<hr>';
                echo '</div>';
            }
        } else {
            // No posts found
            echo "No posts found.";
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
