<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header("Location: adminlogin.php");
    exit(); // Exit the current script
}

// User is logged in, continue with the rest of the code

// Access the email from the session variable
$email = $_SESSION['email'];

// ... Rest of your code ...
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Responsive Sidebar Menu | CodingLab</title>
    <link rel="stylesheet" href="style.css" />
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
          <a href="index.php">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
          <a href="verify.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Verify User</span>
          </a>
          <span class="tooltip">User</span>
        </li>
        <li>
          <a href="notice.php">
            <i class="bx bx-bell"></i>
            <span class="links_name">Notice Manage</span>
          </a>
          <span class="tooltip">Messages</span>
        </li>
        <li>
          <a href="story.html">
            <i class="bx bx-chat"></i>
            <span class="links_name">Alumni Story</span>
          </a>
          <span class="tooltip">Analytics</span>
        </li>
        <li>
          <a href="event.html">
            <i class="bx bx-calendar"></i>
            <span class="links_name">Event Notices Manage</span>
          </a>
          <span class="tooltip">Files</span>
        </li>
        <li>
          <a href="gallery.html">
            <i class="bx bx-image"></i>
            <span class="links_name">Image Gallery</span>
          </a>
          <span class="tooltip">Order</span>
        </li>

        <li>
          <a href="/alumni/control.php">
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
    <?php
// Include the database connection code
require_once 'config.php';

// Query to count rows in the "students" table
$sqlStudents = "SELECT COUNT(*) as count FROM students";
$resultStudents = $conn->query($sqlStudents);

$countStudents = 0;
if ($resultStudents->num_rows > 0) {
    $rowStudents = $resultStudents->fetch_assoc();
    $countStudents = $rowStudents["count"];
}

// Query to count rows in the "notices" table
$sqlNotices = "SELECT COUNT(*) as count FROM notice";
$resultNotices = $conn->query($sqlNotices);

$countNotices = 0;
if ($resultNotices->num_rows > 0) {
    $rowNotices = $resultNotices->fetch_assoc();
    $countNotices = $rowNotices["count"];
}

$sqlevent = "SELECT COUNT(*) as count FROM event";
$resultevent = $conn->query($sqlevent);

$countevent = 0;
if ($resultNotices->num_rows > 0) {
    $rowevent = $resultevent->fetch_assoc();
    $countevent = $rowevent["count"];
}

$conn->close();
?>



<section class="home-section">
    <div class="text">Dashboard</div>

    <div class="cards">
        <div class="card">
            <i class="bx bx-user"></i>
            <div class="card-info">
                <h3>Total Users</h3>
                <p><?php echo $countStudents; ?></p>
            </div>
        </div>
        <div class="card">
            <i class="bx bx-book-bookmark"></i>
            <div class="card-info">
                <h3>Total Alumni Stories</h3>
                <p>100</p>
            </div>
        </div>
        <div class="card">
            <i class="bx bx-bell"></i>
            <div class="card-info">
                <h3>Total Notices</h3>
                <p><?php echo $countNotices; ?></p>
            </div>
        </div>
        <div class="card">
            <i class="bx bx-calendar"></i>
            <div class="card-info">
                <h3>Event Notices</h3>
                <p><?php echo $countevent; ?></p>
            </div>
        </div>
    </div>
</section>
<script>
      // Logout button click event
      document.getElementById("log_out").addEventListener("click", function() {
        // Send an AJAX request to the logout PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "logout.php", true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              // Logout successful, redirect to login page
              window.location.href = "adminlogin.php";
            } else {
              // Logout failed
              console.log("Logout failed.");
            }
          }
        };
        xhr.send();
      });
    </script>
    <script src="sidebar.js"></script>
  </body>
</html>
