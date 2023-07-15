<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Responsive Sidebar Menu | CodingLab</title>
    <link rel="stylesheet" href="css/notice.css" />

    <!-- Boxicons CDN Link -->
    <link
        href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
        rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <i class="bx bxl-admin icon"></i>
        <div class="logo_name">ADMIN</div>
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <i class="bx bx-search"></i>
            <input type="text" placeholder="Search..." />
            <span class="tooltip">Search</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-grid-alt"></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-user"></i>
                <span class="links_name">Verify User</span>
            </a>
            <span class="tooltip">User</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-bell"></i>
                <span class="links_name">Notice Manage</span>
            </a>
            <span class="tooltip">Messages</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-chat"></i>
                <span class="links_name">Alumni Story</span>
            </a>
            <span class="tooltip">Analytics</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-calendar"></i>
                <span class="links_name">Event Notices Manage</span>
            </a>
            <span class="tooltip">Files</span>
        </li>
        <li>
            <a href="#">
                <i class="bx bx-image"></i>
                <span class="links_name">Image Gallery</span>
            </a>
            <span class="tooltip">Order</span>
        </li>

        <li>
            <a href="#">
                <i class="bx bx-cog"></i>
                <span class="links_name">Setting</span>
            </a>
            <span class="tooltip">Setting</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="profile.jpg" alt="profileImg" />
                <div class="name_job">
                    <div class="name">Admin name</div>
                    <div class="job">Super Admin</div>
                </div>
            </div>
            <i class="bx bx-log-out" id="log_out"></i>
        </li>
    </ul>
</div>
<section class="home-section">
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

    $message = ""; // Initialize an empty variable for the message

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $title = $_POST['title'];
        $date = $_POST['date'];

        // File upload logic
        $targetDir = "uploadspdf/"; // Specify the directory where you want to store uploaded files
        $pdfFilename = $_FILES["pdf_filename"]["name"];
        $targetPath = $targetDir . basename($pdfFilename);
        if (move_uploaded_file($_FILES["pdf_filename"]["tmp_name"], $targetPath)) {
            // File uploaded successfully
            // Insert data into the notice table
            $sql = "INSERT INTO notice (title, date, pdf_filename) VALUES ('$title', '$date', '$pdfFilename')";
            if (mysqli_query($connection, $sql)) {
                $message = "Data uploaded successfully.";
            } else {
                $message = "Error: " . mysqli_error($connection);
            }
        } else {
            // File upload failed
            $message = "Error uploading the file.";
        }
    }

    mysqli_close($connection);
    ?>

    <div class="card">
        <h3>Upload Notice</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required />

            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required />

            <label for="pdf_filename">PDF File:</label>
            <input type="file" name="pdf_filename" id="pdf_filename" required />

            <input type="submit" value="Submit" />
        </form>

        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</section>





<script src="sidebar.js"></script>
</body>
</html>
