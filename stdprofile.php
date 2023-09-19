<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('Location: login.php');
    exit;
}

// Establish database connection for user information retrieval
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
} else {
    // Redirect to login page if user information is not found
    header('Location: login.php');
    exit;
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" type="text/css" href="css/std.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="css/std.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=FontName&display=swap" />
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />

</head>

<body>
    
<?php
include 'nav.php';
?>
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

                    <span>
                        <i class="fas fa-plus-circle"></i>
                        <a href="cv_update.php">Cv update</a>
                    </span>
                </div>
            </div>
        </div>
    </section>
 
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
                            <i class="fas fa-graduation-cap"></i> Department
                            <a href="#"><?php echo $department; ?></a>
                        </li>
                        <li>
                            <i class="fas fa-home"></i> Lives in
                            <a href="#"><?php echo $livein; ?></a>
                        </li>
                        <li>
                            <i class="fa fa-address-book"></i> WhatsApp
                            <a href="#">https://wa.me/<?php echo $mobile; ?> </a>
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
                        <?php
                        // Check if the form is submitted
                        if ($_SERVER["REQUEST_METHOD"] === "POST") {
                            // Assuming you have a database connection established
                            $db_host = "localhost";
                            $db_user = "root";
                            $db_password = "";
                            $db_name = "alumni";

                            $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                            // Check for database connection errors
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Retrieve the form data
                            $post_content = $_POST['post_content'];
                            $first_name = $_POST['first_name'];
                            $post_date = $_POST['post_date'];

                            // Check if a photo was uploaded
                            if (isset($_FILES['post_photo']) && $_FILES['post_photo']['error'] === UPLOAD_ERR_OK) {
                                // Handle the uploaded photo (move it to the "postphoto" folder)
                                $tmp_name = $_FILES['post_photo']['tmp_name'];
                                $photo_name = $_FILES['post_photo']['name'];
                                $photo_path = "postphoto/" . $photo_name; // Save the file path in the database

                                move_uploaded_file($tmp_name, $photo_path);
                            } else {
                                // No photo was uploaded, set the path to NULL or an appropriate default value
                                $photo_path = NULL;
                            }

                            // Insert the data into the "all_post" table
                            $sql = "INSERT INTO all_post (post_content, student_id, post_date, post_photo) VALUES ('$post_content', '$first_name', '$post_date', '$photo_path')";

                            // Execute the SQL query
                            if ($conn->query($sql) === TRUE) {
                                // Post inserted successfully
                                echo "Post submitted successfully!";
                            } else {
                                // Error occurred while inserting the post
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                            // Close the database connection
                            $conn->close();
                        }
                        ?>

<div class="postdiv" style="
    margin-left: -500px;
    width: 500px;
    margin-bottom: 20px;
" >

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <!-- Textarea for the post content -->
        <textarea name="post_content" placeholder="Write your post..."></textarea>
        <?php
        // Assuming $student_id is set in your PHP code
        echo '<input type="text" id="first_name" name="first_name" value="' . $student_id . '" style="display: none;">';
        ?>

        <!-- Date input for auto-selecting today's date -->
        <input type="date" name="post_date" id="post_date" value="<?php echo date('Y-m-d'); ?>" />
        <!-- Photo upload option -->
        <input type="file" name="post_photo" accept="image/*" />

        <!-- Submit button -->
        <input type="submit" value="Post" />
    </form>
</div>
<section style="
    width: 550px;
    display: inline-block;
">

<div class="hello" style="display: inline;">
<?php
// Establish a new database connection for posts retrieval
$post_connection = mysqli_connect($servername, $username, $password, $database);

if (!$post_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve posts from the all_post table for the current user
$post_query = "SELECT * FROM all_post WHERE student_id = '$student_id' ORDER BY post_id DESC";
$post_result = mysqli_query($post_connection, $post_query);

// Check if there are any posts for the current user
if (mysqli_num_rows($post_result) > 0) {
    // Loop through each post and display its content
    while ($post_row = mysqli_fetch_assoc($post_result)) {
        $post_content = $post_row['post_content'];
        $post_date = $post_row['post_date'];
        echo <<<HTML
        <div class="box-design post-div">
            <div class="post-infarmation">
                <div>
                    <div class="profil-ing-div post-profile-img">
                        <a href="#" id="profile-link">
                            <!-- post user photo -->
                            <img id="Profile_images" src="$photo" />
                        </a>
                    </div>
                </div>
                <div class="post-three-dot">
                    <h2><a href="#" id="profile_name">$first_name</a></h2>
                    <p><a href="#">$post_date</a></p>
                    <span class="thre-dto-btn fas fa-ellipsis-h"></span>
                </div>
            </div>
            <input type="text" id="first_name" name="first_name" value="$student_id" style="display: none;">
            <p class="post-text-show">$post_content</p>
            <div class="comment-site">
                <!-- <div class="profil-ing-div">
                    <a href="#" id="profile-link">
                        <img id="Profile_images" src="images/friends/00.jpg" />
                    </a>
                </div> -->
                <!-- <div class="comment-input">
                    <input type="text" placeholder="Write a comment…" />
                </div> -->
            </div>
        </div>
HTML;
    }
} else {
    // Display a message if there are no posts for the current user
    echo '<p class="post-text-show">No posts found.</p>';
}

// Close the connection for posts retrieval
mysqli_close($post_connection);
?>
</div>
</section>


    <script>
        // JavaScript to set the date input to the current date
        document.getElementById("post_date").valueAsDate = new Date();


         // JavaScript to show the dropdown menu for the "Delete" option
    const ellipsisButtons = document.querySelectorAll(".thre-dto-btn");

ellipsisButtons.forEach(button => {
    button.addEventListener("click", event => {
        const postId = event.target.dataset.postId;
        const dropdownMenu = event.target.nextElementSibling;
        dropdownMenu.style.display = "block";
    });
});
    </script>


</body>
</html>
