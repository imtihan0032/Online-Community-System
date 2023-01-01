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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19 Report</title>
    <link rel="stylesheet" href="../assets/css/resident/bootstrap.css"></link>
    <link rel="stylesheet" href="../assets/css/resident/covidRelated.css"></link>
    <link rel="stylesheet" href="../assets/css/resident/general.css"></link>

</head>

<body>
    <div class="container-xll">
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
                            <a class="nav-link nav-link-color" href="visitorPass.php">Visitor's Pass</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-color active" aria-current="page" href="covidStatus.php">Covid-19 Status</a>
                        </li>
                    </ul>

                    <div class="ms-auto">
                        <a href="logout.php" class="nav-link nav-link-color p-0" id="logout">Log Out</a>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            
            <div class="page-header">
                <h1 class="text-center">Visitor Pass</h1>
            </div>
            <div class="mother-section">
                <section class="Covid-form m-auto mb-4"" id="special">
                    <h5 class=""><b>Register Visitor<b></h5>
                    <form action="visitorPass.php" method="POST">
                    <label for="Vname" class="mt-5 d-block">Visitor's Name:</label>
                    <input type="Vname" name="Vname" id="Vname" class="form-control" placeholder="Enter visitor's name" required>
                    <label for="Vemail" class="mt-3 d-block">Visitor's Email</label>
                    <input type="Vemail" name="Vemail" id="Vemail" class="form-control" placeholder="Enter your email" required>
                    <label for="Voccupation" class="mt-3 d-block">Visitor's Ocupation</label>
                    <input type="text" name="Voccupation" id="Voccupation" class="form-control" placeholder="Enter your occupation" required>
                    <label for="date" class="mt-3 d-block">Visiting Date</label>
                    <input type="date" name="date" id="date" class="form-control" placeholder="Enter the date" required>
                    <label for="contact" class="mt-3 d-block">Visitor's Contact Number</label>
                    <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter your contact number" required>
                    <label for="purpose" class="mt-3 d-block">Purpose of Visit</label>
                    <input type="text" name="purpose" id="purpose" class="form-control" placeholder="Enter the purpose of visit" required>

                    <button type="submit" class="btn btn-report btn-lg btn-block mt-5" name="submit" value="submit">Submit</button>
                    </form>
                </section>
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
    </div>
    <script src="../assets/js/resident/bootstrap.min.js"></script>

</body>

</html>

<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        
        $name = $_POST['Vname'];
        $email = $_POST['Vemail'];
        $occupation = $_POST['Voccupation'];
        $date = $_POST['date'];
        $contact = $_POST['contact'];
        $purpose = $_POST['purpose'];

        
        echo "<script>console.log('$name')</script>";
        echo "<script>console.log('$email')</script>";
        echo "<script>console.log('$occupation')</script>";
        echo "<script>console.log('$date')</script>";
        echo "<script>console.log('$contact')</script>";
        echo "<script>console.log('$purpose')</script>";

        $subject = "Visitor Pass";
        $msg = "This is a generated message\nThe following person is scheduled as a visitor\n\nName: $name\nEmail: $email\nOccupation: $occupation\nDate: $date\nContact: $contact\nPurpose: $purpose";
        $sender = "From:noneemergency@gmail.com";
        if(mail($email, $subject, $msg, $sender)){
            echo "<script>alert('Your request has been sent')</script>";
        }
        else{
            echo "<script>alert('Your request has not been sent')</script>";
        }
        
    }

         
?>