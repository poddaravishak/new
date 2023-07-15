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
  <style>
  .card {
    margin-top: 200px;
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
</body>
</html>
