<!DOCTYPE html>
<html>
<head>
    <title>PDF Viewer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <style>
        #pdfViewer {
            width: 100%;
            height: 800px; /* Set the height as per your preference */
        }
    </style>
</head>
<body>
    <?php
    // Check if a student ID is provided in the query string
    if (isset($_GET['student_id'])) {
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "alumni";

        $connection = mysqli_connect($servername, $username, $password, $database);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve CV file path from the database using the provided student ID
        $student_id = $_GET['student_id'];
        $sql = "SELECT cv FROM students WHERE student_id = '$student_id'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $cvFilePath = $row['cv'];

            // Check if the CV file exists
            if (file_exists($cvFilePath)) {
                echo '<iframe id="pdfViewer" src="' . $cvFilePath . '#toolbar=0"></iframe>';
            } else {
                echo 'CV file not found.';
            }
        } else {
            echo 'Student not found.';
        }

        mysqli_close($connection);
    } else {
        echo 'Student ID not provided.';
    }
    ?>
    <script>
        // Use PDF.js to control PDF viewer options
        const pdfViewer = document.getElementById('pdfViewer');
        pdfjsLib.getDocument(pdfViewer.src).promise.then(pdfDoc => {
            pdfViewer.contentWindow.PDFViewerApplication.pdfViewer.setViewerPreferences({
                showToolbar: false // Hide the toolbar
            });
        });
    </script>
</body>
</html>
