<!DOCTYPE html>
<html lang="en">

<head>
    <!--required meta tags-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>La Grande Maison</title>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="assets/css/resident/bootstrap.css"></link>

    <!--Custom CSS sheets-->
    <link rel="stylesheet" href="assets/css/resident/general.css">
    <link rel="stylesheet" href="assets/css/resident/viewFaci.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark nav-bg">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand">
                <img id="logo" src="assets/img/logo.png" alt="" class="d-inline-block align-text-top" height="50">
            </a>
            <label for="logo" class="label">La Grande Maison</label>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarMav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNav" class="collapse navbar-collapse nav-link-margin">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="viewFaci.php" class="nav-link nav-link-color active" aria-current="page">View Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a href="#footer" class="nav-link nav-link-color">About Us</a>
                    </li>
                </ul>

                <div class="ms-auto ">
                    <a href="login.php" class="nav-link nav-link-color p-0">Log In</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="top-margin">
        <div class="container main-content">
            <div class="container">
                <div class="content-head">
                    <h1 class="text-head">La Grande Maison Facilities</h1>
                    <p>La Grande Maison was designed and built with the happiness of the residents in mind. Therefore, it was designed to have a plethora of facilities available for the residents to use in their daily lives. </p>
                    <hr>
                </div>
                <div class="row align-items-center faci-div">
                    <div class="col-6 faci-img">
                        <img src="assets/img/pool.jpg" alt="" class="faci-img" width="400" styles="opacity:">
                    </div>
                    <div class="col">
                        <h1 class="text-head">The Pool</h1>
                        <p>Visit the pool, open to all residents daily.</p>
                    </div>
                </div>
                <hr>
                <div class="row align-items-center faci-div">
                    <div class="col-6 faci-img">
                        <img src="assets/img/gym.jpg" alt="" class="faci-img" width="400" styles="opacity:">
                    </div>
                    <div class="col">
                        <h1 class="text-head">The Gym</h1>
                        <p>Workout at the gym, open to all residents daily.</p>
                    </div>
                </div>
                <hr>
                <div class="row align-items-center faci-div">
                    <div class="col-6 faci-img">
                        <img src="assets/img/playground.jpg" alt="" class="faci-img" width="400" styles="opacity:">
                    </div>
                    <div class="col">
                        <h1 class="text-head">The Children's Playground</h1>
                        <p>Bring your kids out to play at our safety-guaranteed playground.</p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </main>
    <footer id="footer">
        <div class="container top-padding">
            <div class="row">
                <div class="col-5 address">
                    <p class="footing-head">Address:</p>
                    <p class="footing-normal">11 Jln PJS 11/18<br>Taman Bandar Sunway<br>Petaling Jaya<br>46150, Selangor
                        <br>Malaysia</p>
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
                        <img src="assets/img/facebook.png" alt="" class="icon" height="40px">
                    </a>
                    <a href="https://www.instagram.com/">
                        <img src="assets/img/instagram.png" alt="" class="icon" height="40px">
                    </a>
                    <a href="https://twitter.com/">
                        <img src="assets/img/twitter.png" alt="" class="icon" height="40px">
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!--Bootstrap JS-->
    <script src="assets/js/resident/bootstrap.min.js"></script>
</body>

</html>