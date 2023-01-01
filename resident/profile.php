<!DOCTYPE html>
<?php
session_start();
// Set connection variables
$server = "localhost";
$username = "root";
$password = "";

// Create a database connection
$con = mysqli_connect($server, $username, $password);

mysqli_select_db($con, 'wia2003');
$username = $_SESSION['Username'];

if (isset($username)) {
    $s = "select * from resident where username = '$username'";
    $result = mysqli_query($con, $s);
    $row = mysqli_fetch_array($result);

    $_SESSION['Name'] = $row['Name'];
    $_SESSION['Block'] = $row['Block'];
    $_SESSION['Unit'] = $row['Unit'];
    $_SESSION['PhoneNumber'] = $row['PhoneNumber'];
    $_SESSION['Email'] = $row['Email'];
    $_SESSION['Age'] = $row['Age'];
    $_SESSION['Nationality'] = $row['Nationality'];
    $_SESSION['Occupation'] = $row['Occupation'];
    $_SESSION['Description'] = $row['Description'];
    $_SESSION['Image'] = $row['Image'];
} else {
    session_destroy();
    header('location:../index.php');
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/1f30f6c4e8.js" crossorigin="anonymous"></script>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../assets/css/resident/bootstrap.css">
    </link>
    <link rel="stylesheet" href="../assets/css/resident/general.css">
    </link>
    <link rel="stylesheet" href="../assets/css/resident/styleup.css">
    </link>
    <link rel="stylesheet" href="../assets/css/resident/style.css">
    </link>
</head>



<nav class="navbar navbar-expand-lg navbar-dark nav-bg">
    <div class="container-fluid">
        
        <img id="logo" src="../assets/img/logo.png" alt="" class="d-inline-block align-text-top" height="50">
        
        <label for="logo" class="label">La Grande Maison</label>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarMav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNav" class="collapse navbar-collapse nav-link-margin">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link nav-link-color" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-color" href="facilitiespage.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-color active" href="visitorPass.php">Visitor's Pass</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-color" aria-current="page" href="covidStatus.php">Covid-19 Status</a>
                </li>
            </ul>

            <div class="ms-auto">
                <a href="logout.php" class="nav-link nav-link-color p-0">Log Out</a>
            </div>
        </div>
    </div>
</nav>

<body>
    <!-- home section starts  -->

    <section class="home" id="home">

        <h3>HI THERE !</h3>
        <h1>I'M <span><?php echo $_SESSION['Name']; ?></span></h1>
        <p><?php echo $_SESSION['Description']; ?></p>
        <a href="#about"><button class="btn">More info <i class="uil uil-user"></i></button></a>

    </section>

    <!-- home section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">
        <h1 class="heading"> <span>about</span> me </h1>
        <div class="row2">
            <div class="info">
                <h3> <span> name : </span><?php echo $_SESSION['Name']; ?></h3>
                <h3> <span> age : </span><?php echo $_SESSION['Age']; ?></h3>
                <h3> <span>Block No. : </span><?php echo $_SESSION['Block']; ?></h3>
                <h3> <span>Unit No. : </span><?php echo $_SESSION['Unit']; ?></h3>
                <h3> <span>Username : </span><?php echo $_SESSION['Username']; ?></h3>
                <h3> <span>Occupation : </span><?php echo $_SESSION['Occupation']; ?></h3>
                <h3> <span>Nationality : </span><?php echo $_SESSION['Nationality']; ?></h3>
                <h3> <span>Email : </span><?php echo $_SESSION['Email']; ?></h3>
                <h3> <span>Contact number : </span><?php echo $_SESSION['PhoneNumber']; ?></h3>

                <a href="editProfile.php"><button class="btn">Edit Profile <i class="uil uil-cog"></i></button></a>
            </div>

            <div class="about-pic" id="about-pic">
                <div class="box-container">
                    <div class="box">
                        <img src="../assets/img/<?php echo $_SESSION['Image']; ?>">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- about section ends -->


    <!-- jquery cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- custom js file link  -->
    <script src="../assets/js/resident/script.js"></script>

</body>

<footer id="footer">
    <div class="container top-padding">
        <div class="row">
            <div class="col-5 address">
                <p class="footing-head">Address:</p>
                <p class="footing-normal">11 Jln PJS 11/18<br>Taman Bandar Sunway<br>Petaling Jaya<br>46150, Selangor
                    <br>Malaysia
                </p>
            </div>
            <div class="col-4 contact">
                <p class="footing-head">Contact:</p>
                <p class="footing-subhead">Email:</p>
                <p class="footing-normal"><a href="mailto:admin@lagrandemaison.com">admin@lagrandemaison.com</a></p>
                <p class="footing-subhead">Phone No:</p>
                <p class="footing-normal">(+03) 5693-2456</p>
            </div>
            <div class="col-3 socmed">
                <a href="https://www.facebook.com/">
                    <img src="../assets/img/facebook.png" alt="" class="icon" height="40px">
                </a>
                <a href="https://www.instagram.com/">
                    <img src="../assets/img/instagram.png" alt="" class="icon" height="40px">
                </a>
                <a href="https://twitter.com/">
                    <img src="../assets/img/twitter.png" alt="" class="icon" height="40px">
                </a>
            </div>
        </div>
    </div>
</footer>

</html>