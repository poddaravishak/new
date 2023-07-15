<!DOCTYPE html>
<html>
<head>
  <title>Student Profile View</title>
  
  <style>
    
    .container {
      margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 1vh;
  margin-top: 30px;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 2vh;
  margin-bottom: 50px;
}

.container form {
  display: flex;
  align-items: center;
  justify-content: center;
  
}

.container input[type="text"] {
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 5px 0 0 5px;
  border: 2px solid #4287f5;
}

.container input[type="submit"] {
  padding: 10px 20px;
  background-color: #4287f5;
  color: #fff;
  font-size: 16px;
  border: none;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
}

.container input[type="submit"]:hover {
  background-color: #2a5db0;
}


  

  .profile-card {
    margin-top: 50px;
    display: inline-block;
    border: 1px solid #1fc9af;
    border-radius: 5px;
    padding: 10px;
    background-color: #edac16;
    margin: 10px;
    width: 300px;
    text-align: center;
  }

  .profile-card img {
    width: 200px;
    height: 200px;
    border: 2px solid rgb(152, 36, 36);
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 10px;
    cursor: pointer;
  }

  .profile-card p {
    font-size: 14px;
    margin-bottom: 10px;
  }

  /* Full Screen Modal */
  .modal-container {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
  }

  .modal-content {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  .modal-image {
    max-width: 90%;
    max-height: 90%;
  }

  .modal-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }

  .close-button {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 24px;
    color: #fff;
    cursor: pointer;
  }
  </style>
</head>
<body>
  <div class="container">
    
  <form method="GET" action="">
    <input type="text" name="search" placeholder="Search by First Name" />
    <input type="submit" value="Search" />
  </form>
</div>
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

  // Retrieve student information from the database
  $sql = "SELECT * FROM students";
  
  // Check if a search query is provided
  if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql .= " WHERE first_name LIKE '%$search%'";
  }

  $result = mysqli_query($connection, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '
      <div class="profile-card">
        ';

      if (!empty($row['photo'])) {
        echo '
        <img src="' . $row['photo'] . '" alt="Profile Picture" onclick="showFullScreen(this)">
        ';
      }

      echo '
        <h2>' . $row['first_name'] . ' ' . $row['last_name'] . '</h2>
        <p><strong>Student ID:</strong> ' . $row['student_id'] . '</p>
        <p><strong>Date of Birth:</strong> ' . $row['date_of_birth'] . '</p>
        <p><strong>Batch:</strong> ' . $row['batch'] . '</p>
        <p><strong>Department:</strong> ' . $row['department'] . '</p>
        <p><strong>Session Year:</strong> ' . $row['session_year'] . '</p>
        <p><strong>Mobile:</strong> ' . $row['mobile'] . '</p>
        <p><strong>Email:</strong> <a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></p>
        <p><strong>Currently Worked:</strong> ' . $row['currently_worked'] . '</p>
      </div>
      ';
    }
  } else {
    echo '
    <p>No student profiles found.</p>
    ';
  }

  mysqli_close($connection);
  ?>

  <!-- Full Screen Modal -->
  <div id="modal-container" class="modal-container" onclick="hideFullScreen()">
    <div class="modal-content">
      <img id="modal-image" class="modal-image" alt="Full Screen Image">
    </div>
    <span class="close-button">&times;</span>
  </div>

  <script>
    function showFullScreen(img) {
      var modalContainer = document.getElementById("modal-container");
      var modalImage = document.getElementById("modal-image");
      modalImage.src = img.src;
      modalContainer.style.display = "flex";
    }

    function hideFullScreen() {
      var modalContainer = document.getElementById("modal-container");
      modalContainer.style.display = "none";
    }
  </script>
</body>
</html>
