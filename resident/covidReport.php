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
            <a class="nav-link nav-linkSelected-color anchor-background-color m-0" href="CovidStatus.php">&#60;&#60; COVID-19 Status</a>
            <div class="page-header">
                <h1 class="text-center">Report COVID-19</h1>
            </div>
            <div class="mother-section">
                <section class="Covid-form">
                    <h5 class="">Please fill in this form to update your Covid-19 Status.</h5>
                    <form action="covidReport.php" method="POST">
                    <label for="quarantineStatus" class="mt-4 d-block">Status</label>

                    <select id="quarantineStatus" name="quarantineStatus" class="form-control">
                        <option value="">Select</option>
                        <option value="Recovered">Recovered</option>
                        <option value="Symptomatic">Symptomatic</option>
                        </select>

                        <label class="mt-5"><b>If you are symptomatic please provide the following details:</b></label>
                        <br>
                        <br>
                        <label for="quarantineStart" class="mt-2">Start date:</label>
                        <input type="date" id="quarantineStart" name="quarantineStart" class="form-control" value="">

                        <label for="quarantineEnd" class="mt-2">End date:</label>
                        <input type="date" id="quarantineEnd" name="quarantineEnd" class="form-control" value="">

                        
                        <button type="submit" class="btn btn-report btn-lg btn-block mt-5" name="submit" value="submit">Submit</button>
                    </form>
                </section>
                <section class="info">
                    <div class="text-center mt-5 ">
                        <img src="../assets/img/faceMask.png " alt="Face mask " width="120 " height="120 " class="image-fluid ">
                    </div>
                    <h3 class="text-center pt-3 ">Wear a mask! Save Lives</h3>
                    <p class="text-center mt-4 ">Wear a mask</p>
                    <p class="text-center mt-2 ">Clean your hands</p>
                    <p class="text-center mt-2 ">Keep a safe distance</p>

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
    include('../database/pdo.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        
            $submittedDate = date('Y-m-d');
            $quarantineStatus = $_POST['quarantineStatus'];  
            $quarantineStart = $_POST['quarantineStart'] ?? "NA";
            $quarantineEnd = $_POST['quarantineEnd'] ?? "NA";
            

            try {
                // begin a transaction
                $pdo->beginTransaction();
                // a set of queries: if one fails, an exception will be thrown
                $query = "INSERT INTO report (ResidentID, SubmittedDate) VALUES ('$residentID', '$submittedDate')";
                $stmt = $pdo->prepare($query);
                $stmt->execute();

                $query3 = $pdo->query("SELECT MAX(ReportID) AS ID FROM report WHERE ResidentID = '$residentID' AND SubmittedDate = '$submittedDate'");
                $reportID = $query3->fetch(PDO::FETCH_ASSOC)['ID'] ?? "NA";
                echo "<script>console.log('$reportID')</script>";
                $query1 = "INSERT INTO covidstatus (ReportID ,stat) VALUES ('$reportID', '$quarantineStatus')";
                $query2 = "INSERT INTO quarantinedate (ReportID, StartDate, EndDate) VALUES ('$reportID', '$quarantineStart', '$quarantineEnd')";

                $stmt = $pdo->prepare($query1);
                $stmt->execute();
                $stmt = $pdo->prepare($query2);
                $stmt->execute();
                // if we arrive here, it means that no exception was thrown
                // which means no query has failed, so we can commit the
                // transaction
                if($pdo->commit()){
                    echo "<script>console.log('success')</script>";
                    echo "<script>window.location.href='covidStatus.php'</script>";
                    ##
                }
              } catch (PDOException $e) {
                // we must rollback the transaction since an error occurred
                // with insert
                $pdo->rollback();
              }
            
            
        }
    
         
?>