<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
    $comp_name = $_POST['comp_name'];
    $file = $_FILES['file'];
    $jobfile = $_FILES['jobfile'];
    $selected_year = $_POST['selected_year'];
    
   $db_host = "sql112.infinityfree.com";
$db_user = "if0_35127122";
$db_pass = "Govardhani";
$db_name = "if0_35127122_rgu_p";



$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the selected year is a valid column in the table
    $sql = "SHOW COLUMNS FROM yearpdfs LIKE '$selected_year'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Column exists, proceed to insert/update the data
        // Change this to your desired directory

        // Check if the file already exists
        $targetDirectory = "uploads/";
        $fileName = basename($file['name']);
        $targetFilePath = $targetDirectory . $fileName;

        $jobfileName = basename($jobfile['name']);
        $jobtargetFilePath = $targetDirectory . $jobfileName;

        if (file_exists($targetFilePath)) 
        {
             echo "<script>
                swal({
                    title: 'Try Again!',
                    text: 'Same File already exists',
                    icon: 'success',
                }).then(() => {
                    window.location.href = 'addcompany1.php'; // Redirect to the admin page
                });
            </script>";
            //echo "File already exists.";
        } else {
            echo ("Here");
            // Move the file to the specified directory
            move_uploaded_file($file['tmp_name'], $targetFilePath);
            move_uploaded_file($jobfile['tmp_name'], $jobtargetFilePath);

            // Update the file path in the database

            if (!empty($fileName) && !empty($jobfileName)) {
                $sql_update = "UPDATE `yearpdfs` SET `job_desc`='$jobfileName', `$selected_year` = '$fileName' WHERE `name` = '$comp_name'";
            } else {
                $sql_update = "UPDATE `yearpdfs` SET `$selected_year` = '$fileName' WHERE `name` = '$comp_name'";
            }
    
            $result1 = $conn->query($sql_update);

            if ($result1) 
            {
                 echo "<script>
                swal({
                    title: 'Thankyou',
                    text: 'Data inserted successfully..',
                    icon: 'success',
                }).then(() => {
                    window.location.href = 'mainadmin.php'; // Redirect to the admin page
                });
            </script>";
               // echo "Data inserted successfully into year $selected_year column for $comp_name";
            } else 
            {
                 echo "<script>
                swal({
                    title: 'Try Again!',
                    text: 'Error updating file path:',
                    icon: 'success',
                }).then(() => {
                    window.location.href = 'addcompany1.php'; // Redirect to the admin page
                });
            </script>";
                //echo "Error updating file path: " . $conn->error;
            }
        }
    } else {
        // Invalid year selected, handle accordingly
        echo "Invalid year selected";
    }

    $conn->close();
}
?>
<body>
