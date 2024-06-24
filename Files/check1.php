
<?php
session_start();

// Your session start and other configurations...

if (isset($_GET['sno'])) {
    $sno = $_GET['sno'];
}

$db_host = "sql112.infinityfree.com";
$db_user = "if0_35127122";
$db_pass = "Govardhani";
$db_name = "if0_35127122_rgu_p";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query1 = "SELECT name FROM yearpdfs WHERE sno=$sno";
$result1 = mysqli_query($conn, $query1);

if ($result1 && $result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $_SESSION['company'] = $row['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Company Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <style>
        /* Add your CSS styles here */
        .navbar-custom {
            background-color: maroon;
        }

        .navbar-text {
            color: white;
            margin: 0.5rem;
            text-decoration: none;
            font-size: 1rem;
        }

        .navbar-text:hover {
            color: white;
        }

        .logout {
        height: 2rem;
        border-radius: 0.2rem;
      border-color: white;
      border: 0.063rem solid;
      color: white;
      background-color: maroon;
      margin-left: 0.5rem;
    }


        .logout:hover {
            background: rgb(146, 34, 34, 0.5);
            color: white;
            text-decoration: none;
        }

        .toggle-button {
            color: white;
            border: line;
            border-color: white;
            background-color: maroon;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

        table {
            border-collapse: collapse;
            width: 60%;
            margin-top: 2rem;
        }

        @media screen and (max-width: 45rem) {
            table {
                border-collapse: collapse;
                width: 80%;
                margin-top: 2rem;
            }
        }

        th,
        td {
            border: 0.063rem solid black;
            text-align: center;
        }

        th {
            background-color: maroon;
            height: 3rem;
            color: white;
            align-items: center;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn {
            height: 2rem;
            width: 6rem;
            padding: 0.25rem;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
            margin-right: 1rem;
            border-style: none;
            font-size: 1rem;
            color: white;
            background-color: rgb(40, 115, 226);
            border-radius: 0.5rem;
        }

        .student_name {
            height: 1.5rem;
            width: 12rem;
            padding: 0.25rem;
            margin-bottom: 1rem;
            margin-right: 1rem;
            border-style: none;
            border: 0.126rem solid black;
            font-size: 1.2rem;
        }

        .student {
            color: maroon;
            text-decoration: none;
        }

        .title {
            height: 4rem;
        }

        .back {
            width: 6rem;
            height: 2rem;
            border-radius: 0.25rem;
            margin-right: 2.5rem;
            background-color: rgb(19, 185, 19);
            color: black;
            border: none;
        }

        a {
            text-decoration: none;
        }

        a:link {
            color: white;
        }

        a:hover {
            text-decoration: none;
            color: white;
        }

        a:visited {
            color: white;
        }

        .table th {
            background-color: maroon;
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar sticky-top navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="https://www.rgukt.ac.in/"><img
                src="https://res.cloudinary.com/dl1r4zjmq/image/upload/v1696778933/RGUKT-Logo_efpy9y.jpg"
                style="width:40px; height:40px; border-radius:50%;" alt="Logo"></a>
        <button class="navbar-toggler toggle-button" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto"> <!-- Changed the class to ml-auto -->
                <li class="nav-item active">
                    <a class="navbar-text" href="main.php">HOME </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-text" href="userabout.php">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-text" href="downloadpdf.php">COMPANIES</a>
                </li>
                <li class="nav-item">
                    <a class="navbar-text" href="view.php">PLACED STUDENTS</a>
                </li>
                <li class="nav-item">
          <a class="navbar-text" href="placed.php">PLACED?</a>
        </li>
                <li class="nav-item">
                    <a class="navbar-text" href="#Contact">CONTACT</a>
                </li>
                <li class="nav-item">
                    <ul class="navbar-nav">
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0">
                    <button class="logout" type="submit"><a href="index.php"
                            style="text-decoration: none; color: white;">LOGOUT</a></button>
                </form>
            </li>
        </ul>
                </li>
            </ul>
        </div>
    </nav>
    <br>

    <div>
        <center>
            <h1 class="student"><?php echo strtoupper($_SESSION['company']) ?></h1>
        </center>
        <center>
       <h5 style="color: purple;">Year Wise Question Papers of a Company</h5>

        </center>
        <center>
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Year</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
// Assuming you have a valid database connection stored in $conn
$serial = 1;

// Assuming $sno is defined somewhere before this code
$query2 = "SELECT * FROM yearpdfs WHERE sno=$sno";
$result2 = mysqli_query($conn, $query2);

if ($result2 && $result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $years = ["2021", "2022", "2023", "2024", "2025", "2026"];
        foreach ($years as $year) {
            if (!empty($row[$year])) {
                $file_path = "uploads/" . $row[$year];
                echo "<tr>";
                echo "<td>" . $serial++ . "</td>";
                echo "<td>" . $year . "</td>";
                echo "<td><a href='" . $file_path . "' class='btn' download>Download</a></td>";
                echo "</tr>";
            }
        }
    }
} else {
    echo "<tr><td colspan='3'>No records found</td></tr>";
}
?>

                </tbody>
            </table>
        </center>
        <br>
        <br>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>
