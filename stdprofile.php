<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('Location: login.php');
    exit;
}

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "alumni";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user information from the database
$email = $_SESSION['email'];
$query = "SELECT * FROM students WHERE email = '$email'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $student_id = $row['student_id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $father_name = $row['father_name'];
    $mother_name = $row['mother_name'];
    $date_of_birth = $row['date_of_birth'];
    $batch = $row['batch'];
    $department = $row['department'];
    $session_year = $row['session_year'];
    $photo = $row['photo'];
    $mobile = $row['mobile'];
    $email = $row['email'];
    $coverphoto = $row['coverphoto'];
    $livein = $row['livein'];
    $currently_worked = $row['currently_worked'];
}
else {
    // Redirect to login page if user information is not found
    header('Location: login.php');
    exit;
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Facebook</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="css/std.min.css" />

    <link rel="stylesheet" type="text/css" href="css/std.css" />
     <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=FontName&display=swap"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>

  <body>
    <div class="popop-background"></div>
    <div class="thim-div">
      <div class="hadr-thim-bar">
        <span id="thim-button" class="fas fa-caret-right"></span>

        <p>Backgroun</p>
        <div class="bg-color"></div>
        <br />
        <p>Text Color</p>
        <div class="bg-color"></div>
      </div>
    </div>

    <section class="cover-image-section">
      <header class="cover-hader-site">
        <img src="<?php echo $coverphoto; ?>" />

        <div class="cover-image-div">
          <div class="cover-image-edite-btn">
            <button>
              <i class="fas fa-camera"></i>
              Edit Covar Photo
            </button>
          </div>
        </div>
      </header>
    </section>

    <section class="profile-section">
      <div class="profile-section-in">
        <div class="profile-image-site">
          <div class="profile-image-div">
            <a href="#" id="profile-link">
              <img id="Profile_images" src="<?php echo $photo; ?>" />
            </a>
            <span class="fas fa-camera"></span>
          </div>
        </div>
        <div class="profile-name-info">
          <h1>
            <span class="pro-txt" id="profile_name"><?php echo $first_name . ' ' . $last_name; ?></span>
            <span id="nik-name"></span>
          </h1>
          <p></p>
        </div>
        <div class="profile-button-site">
          <div class="btn-site-pro">
            <span>
              <i class="fas fa-plus-circle"></i>
              <a href="edit_profile.php">Edit Profile</a>
            </span>
            
          </div>
        </div>
      </div>
    </section>
 <!-- The popup form -->

    <section class="post-section">
      <div class="post-section-in">
        <section class="info-section">
          <div class="about-info">
            <h4>Intro</h4>

            <ul>
              <li>
                <i class="fas fa-briefcase"></i> Works at
                <a href="#"><?php echo $currently_worked; ?></a>
              </li>

              <li>
                <i class="fas fa-id-badge"></i> Batch
                <a href="#"><?php echo $batch; ?></a>
              </li>
              <li>
                <i class="fas fa-graduation-cap"></i> depertment
                <a href="#"><?php echo $department; ?></a>
              </li>
              <li>
                <i class="fas fa-home"></i> Lives in
                <a href="#"><?php echo $livein; ?></a>
              </li>

              <li>
                <i class="fa fa-address-book"></i> WhatsApp
                <a href="#"><?php echo $mobile; ?> </a>
              </li>
            </ul>
          </div>
        </section>

        <section class="post-info">
          <div class="box-design">
            <div class="post-upload-T">
              <div class="profil-ing-div">
                <a href="#" id="profile-link">
                  <img id="Profile_images" src="<?php echo $photo; ?>" />
                </a>
              </div>
              <div class="text-post">
                
              </div>
               
            </div>
            <div class="photo-upload">
              <div class="post-upl">
                <p><i class="fas fa-video"></i> Live Video</p>
              </div>
              <div class="post-upl">
                <p><i class="fas fa-images"></i> Photo/Video</p>
              </div>
              <div class="post-upl">
                <p><i class="fas fa-flag"></i> Life Event</p>
              </div>
            </div>
          </div>

          <!-- ************ Post ************ -->

          <div class="box-design post-div">
            <div class="post-infarmation">
              <div>
                <div class="profil-ing-div post-profile-img">
                  <a href="#" id="profile-link">
                    <!-- post user photo -->
                    <img id="Profile_images" src="<?php echo $photo; ?>" />
                  </a>
                </div>
              </div>
              <div class="post-three-dot">
                <h2><a href="#" id="profile_name"><?php echo $first_name; ?> </a></h2>
                <p>
                  <a href="%">date </a>
                </p>

                <span class="thre-dto-btn fas fa-ellipsis-h"></span>
              </div>
            </div>

            <p class="post-text-show">
              জাভাস্ক্রিপ্ট কি?
            </p>

            <div class="comment-site">
              <div class="profil-ing-div">
                <a href="#" id="profile-link">
                  <img id="Profile_images" src="images/friends/00.jpg" />
                </a>
              </div>
              <div class="comment-input">
                <input type="text" placeholder="Write a comment…" />
                
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </section>
   
  </body>
</html>
