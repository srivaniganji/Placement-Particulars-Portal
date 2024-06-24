<?php
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include "db_conn.php";

if (isset($_POST['id'])) {
    // Function to sanitize user input
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Sanitize input ID
    $id = validate($_POST['id']);

    if (empty($id)) {
        header("Location: check.php?error=User Id is required");
        exit();
    }

    // Prepare SQL query to fetch user by ID
    $sql = "SELECT * FROM student WHERE LOWER(ids) = LOWER('$id')";

    // Execute SQL query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if a user with the provided ID exists
        if (mysqli_num_rows($result) === 1) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);
            $_SESSION['ids'] = $row['ids'];
            // Redirect to registration page
            header("Location: registration.php");
            exit();
        } else {
            // Redirect with error message if user ID is invalid
            header("Location: main.php?error=Invalid ID. Please try again.");
            exit();
        }
    } else {
        // Redirect with error message if there's an issue with the database query
        header("Location: main.php?error=Database error. Please try again later.");
        exit();
    }
} else {
    // Redirect with error message if no ID is provided
    header("Location: main.php?error=Please provide a valid ID.");
    exit();
}
?>
