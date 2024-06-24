<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <title>Document</title> -->
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) 
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $allowed_types = array("pdf");
        if (!in_array($file_type, $allowed_types)) 
        {
            echoAlert("error", "Invalid file type. Please upload a PDF file.", 'addcompany.php');
            exit();
        } 
        else 
        {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
            {
                $Company_name = $_REQUEST['name'];
                $Filename = $_FILES["file"]["name"];

                include "db_conn.php";

                $stmt = $conn->prepare("INSERT INTO yearpdfs (Company_name, Filename) VALUES (?, ?)");
                $stmt->bind_param("ss", $Company_name, $Filename);
                

                if ($stmt->execute()) 
                {
                    echoAlert("success", "File has been Uploaded Successfully", 'mainadmin.php');
                } else 
                {
                    echoAlert("error", "There was an Error Uploading your File", 'adminhome.php');
                }

                $stmt->close();
                $conn->close();
            } 
            else 
            {
                echoAlert("error", "There was an error uploading your file.", 'adminhome.php');
            }
        }
    } else {
        echoAlert("error", "No file was uploaded.", 'adminhome.php');
    }
}

function echoAlert($icon, $title, $location) {
    echo "<script>
        swal({
            icon: '$icon',
            title: '$title',
        }).then(function() {
            window.location.href = '$location';
        });
    </script>";
}
?>
</body>
</html>
