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

// Check if the ID is provided in the URL parameter
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Query the database to retrieve the notice data based on the provided ID
  $query = "SELECT * FROM notice WHERE id = $id";
  $result = mysqli_query($connection, $query);

  // Check if a notice with the specified ID exists
  if (mysqli_num_rows($result) > 0) {
    $notice = mysqli_fetch_assoc($result);
    $title = $notice['title'];
    $date = $notice['date'];
    $pdfFilename = "admin/uploadspdf/" . $notice['pdf_filename']; // Modify this line to include the correct directory path
  } else {
    // Redirect or display an error message if the notice doesn't exist
    header("Location: error.php");
    exit();
  }
} else {
  // Redirect or display an error message if the ID is not provided
  header("Location: error.php");
  exit();
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Notice</title>
  <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
  <style>
  .card {
    padding-top: 50px;
    margin-top: 220px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    margin: 0 auto; /* Center align the card */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 600px; /* Set a maximum width for the card */
  }

  .card h2 {
    margin-top: 0px;
  }

  .pdf-viewer {
    width: 100%;
    height: 700px;
    border: none;
  }

  .download-button {
    display: inline-block;
    padding: 5px 10px;
    background-color: #4287f5;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
  }

  .download-button:hover {
    background-color: #2a5db0;
  }
</style>

</head>
<body>
<nav>
      <input type="checkbox" id="check" />
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">BAUETAA</label>
      <ul>
        <li><a class="" href="#">Home</a></li>
        <li><a href="#">Program & Events</a></li>
        <li><a href="#">ALUMNI STORY </a></li>
        <li><a href="#">All Alumni</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </nav>
    
  <section class="sectionmid">
    <div class="blue-div">
      <div class="card">
        <h2><?php echo $title; ?></h2>
       
        <h4>Notice Issue Date :<?php echo $date; ?></h4>
        <iframe class="pdf-viewer" src="<?php echo $pdfFilename; ?>"></iframe>
        <a href="<?php echo $pdfFilename; ?>" class="download-button" download>Download PDF</a>
        
      </div>
    </div>
  </section>
  <footer class="footer">
      <div class="containerfootter">
        <div class="row">
          <div class="footer-col">
            <h4>Usefull Link</h4>
            <ul>
              <li><a href="#">University Website</a></li>
              <li><a href="#">Career Services</a></li>
              <li><a href="#">Events and Reunions</a></li>
              <li><a href="#">Mentorship Programs</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>get help</h4>
            <ul>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Report Problem</a></li>
              <li><a href="#">Contact us</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>online shop</h4>
            <ul>
              <li><a href="#">watch</a></li>
              <li><a href="#">bag</a></li>
              <li><a href="#">shoes</a></li>
              <li><a href="#">dress</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>follow us</h4>
            <div class="social-links">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
</body>
</html>
