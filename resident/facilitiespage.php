<?php 
session_start();
if(isset($_SESSION['Username'])){
    $residentID = $_SESSION['residentID'];
}
else{
    session_destroy();
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--required meta tags-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Grande Maison</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../assets/css/resident/bootstrap.css">
    </link>

    <!--Custom CSS sheets-->
    <link rel="stylesheet" href="../assets/css/resident/general.css">
    <link rel="stylesheet" href="../assets/css/resident/faci.css">
</head>

<body>
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
                        <a class="nav-link nav-link-color active" href="facilitiespage.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-color " href="visitorPass.php">Visitor's Pass</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-color" aria-current="page" href="covidStatus.php">Covid-19 Status</a>
                    </li>
                </ul>

                <div class="ms-auto">
                    <a href="logout.php" class="nav-link nav-link-color p-0" id="logout">Log Out</a>
                </div>
            </div>
        </div>
    </nav>

    <?php
    require 'dbconfig.php';
    $query = "SELECT * FROM facilities";
    ?>

    <main class="mb-3">
        <div class="rectangle-head">

            <h1 class="text-center">Facilities</h1>
            <h5 class="text-center pt-3">Locate nearby stores, facilities, etc.</h5>

        </div>

        <div class="container">

            <form action="" method="POST">
                <button id="allBtn" name="allBtn" class="btn btn-primary" >All</button>
                <button name="foodBtn" class="btn btn-primary">Food & beverage</button>
                <button name="storeBtn" class="btn btn-primary">Stores</button>
                <button name="facilitiesBtn" class="btn btn-primary">Facilities</button>
                <button name="mallBtn" class="btn btn-primary">Malls</button>
            </form>



            <div class="row mt-4">
                <?php

                $query = "SELECT * FROM facilities";
                $type = "All";

                if (isset($_POST['allBtn'])) {
                    $query = "SELECT * FROM facilities";
                }

                if (isset($_POST['foodBtn'])) {
                    $query = "SELECT * FROM facilities WHERE category='f&b'";
                    $type = "Food & Beverage";
                }

                if (isset($_POST['facilitiesBtn'])) {
                    $query = "SELECT * FROM facilities WHERE category='faci'";
                    $type = "Facilities";
                }

                if (isset($_POST['mallBtn'])) {
                    $query = "SELECT * FROM facilities WHERE category='mall'";
                    $type = "Malls";
                }

                if (isset($_POST['storeBtn'])) {
                    $query = "SELECT * FROM facilities WHERE category='store'";
                    $type = "Stores";
                }


                $query_run = mysqli_query($connection, $query);
                $check_stores = mysqli_num_rows($query_run);

                if ($check_stores > 0) {
                    echo '<p>'. $type . ' - Showing ' . $check_stores. ' result(s)</p>';
                    while ($row = mysqli_fetch_array($query_run)) {
                ?>

                        <div class="col-md-3 mb-4">
                            <div class="card ">
                                <div class="card-body ">
                                    <img src="../assets/img/<?php echo $row['image']; ?>" alt="Store image" class="card-img-top" height="200px" width="200px">
                                    <h2 class="card-title">
                                        <?php echo $row['name']; ?>
                                    </h2>
                                    <p class="card-text ">
                                        <?php echo $row['location'] . '<br>' . $row['openhours']; ?>
                                    </p>

                                </div>
                            </div>
                        </div>

                <?php
                    }
                } else {
                    echo 'Empty table';
                }
                ?>
            </div>
        </div>
    </main>

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
    <!--Bootstrap JS-->
    <script src="bootstrap.min.js"></script>


</body>

</html>