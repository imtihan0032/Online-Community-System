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
    <title>Covid-19 Status</title>
    <link rel="stylesheet" href="../assets/css/resident/bootstrap.css"></link>
    <link rel="stylesheet" href="../assets/css/resident/covidRelated.css"></link>
    <link rel="stylesheet" href="../assets/css/resident/general.css"></link>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../assets/js/resident/piechart.js"></script>
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
                <h1 class="text-center">Covid-19 Status</h1>
                <h5 class="text-center pt-3">Check and report the covid status here!</h5>
            </div>
            <div class="mother-section ">
                <section>
                    <h3 class="text-center pt-3 heading3-color">Daily</h3>
                    <input type="date" class="form-control w-75 text-center m-auto mt-3 " id="daily" name="dateSelected">
                   
                    <div id="piechartdaily" class="m-auto"></div>

                </section>

                <section>
                    <h3 class="text-center pt-3 heading3-color">Weekly</h3>
                    <input type="week" class="form-control w-75 text-center m-auto mt-3" id="weekly" name="weekSelected">
                    <div id="piechartweekly" class="m-auto"></div>
                </section>

                <section>
                    <h3 class="text-center pt-3 heading3-color">Want to report?</h3>
                    <p class="text-center mt-8 para-color-status">Do you want to fill in your new COVID-19 status? </p>
                    <button onclick="location.href = 'CovidReport.php';" type="button" class="btn btn-report btn-lg btn-block mt-8 ms-8 ">Report Now >></button>
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
        <script src="../assets/js/resident/bootstrap.min.js"></script>



</body>

</html>
<?php
    include('../database/pdo.php');
    

    try{
        $dateDaily = $_COOKIE['date'] ?? 0; 
        $sql = "SELECT ReportId As ID FROM report WHERE submittedDate = '$dateDaily'";
        $result = $pdo->query($sql);
        $counter = 0;
        $arr = [];
        $ids = "(";
        while($row = $result->fetch()){
            $counter++;
            $arr[$counter] = $row['ID'];
        }
        for($i = 1; $i <= $counter; $i++){
            if($i != $counter)
                $ids .="". $arr[$i].",";
            else
                $ids .="". $arr[$i];
        }
        $ids .=")";
        if($ids == "()"){
            echo"<script>document.cookie = 'toSend1=0;'</script>";
            echo"<script>document.cookie = 'toSend2=0;' </script>";
        }
        else{
        echo "<script>console.log('$ids');</script>";
        $sql2 = "SELECT COUNT(stat) As numberOfRecovered FROM covidStatus WHERE ReportID IN $ids AND stat = 'Recovered'";
        $result2 = $pdo->query($sql2);
        $numberOfRecoveredDaily = $result2->fetch(PDO::FETCH_ASSOC)['numberOfRecovered'] ?? 0;
        $sql3 = "SELECT COUNT(stat) As numberOfSymptomatic FROM covidStatus WHERE ReportID IN $ids AND stat = 'Symptomatic'";
        $result3 = $pdo->query($sql3);
        $numberOfSymptomaticDaily = $result3->fetch(PDO::FETCH_ASSOC)['numberOfSymptomatic'] ?? 0;
        echo "<script>console.log('$numberOfRecoveredDaily');</script>";
        echo "<script>console.log('$numberOfSymptomaticDaily');</script>";
        echo"<script>document.cookie = 'toSend1=' + $numberOfRecoveredDaily+';' </script>";
        echo"<script>document.cookie = 'toSend2=' + $numberOfSymptomaticDaily+';' </script>";
        }
        $monday = $_COOKIE['monday'] ?? 0;
        $tuesday = $_COOKIE['tuesday'] ?? 0;
        $wednesday = $_COOKIE['wednesday'] ?? 0;
        $thursday = $_COOKIE['thursday'] ?? 0;
        $friday = $_COOKIE['friday'] ?? 0;
        $saturday = $_COOKIE['saturday'] ?? 0;
        $sunday = $_COOKIE['sunday'] ?? 0;
        

        

        $mondayDate = str_replace('/', '-', $monday);
        $monday = date("Y-m-d", strtotime($mondayDate));

        $tuesdayDate = str_replace('/', '-', $tuesday);
        $tuesday = date("Y-m-d", strtotime($tuesdayDate));

        $wednesdayDate = str_replace('/', '-', $wednesday);
        $wednesday = date("Y-m-d", strtotime($wednesdayDate));

        $thursdayDate = str_replace('/', '-', $thursday);
        $thursday = date("Y-m-d", strtotime($thursdayDate));

        $fridayDate = str_replace('/', '-', $friday);
        $friday = date("Y-m-d", strtotime($fridayDate));

        $saturdayDate = str_replace('/', '-', $saturday);
        $saturday = date("Y-m-d", strtotime($saturdayDate));

        $sundayDate = str_replace('/', '-', $sunday);
        $sunday = date("Y-m-d", strtotime($sundayDate));



        
        
        $days ="('".$monday."','".$tuesday."','".$wednesday."','".$thursday."','".$friday."','".$saturday."','".$sunday."')";
        
        
        $sql4 = "SELECT ReportId As ID FROM report WHERE submittedDate IN $days";
        echo "<script>console.log('hells');</script>";
        $result4 = $pdo->query($sql4);
        
        $counter1 = 0;
        $arrWeekly = [];
        $idsWeekly = "(";
        while($row = $result4->fetch()){
            $counter1++;
            $arrWeekly[$counter1] = $row['ID'];
        }
        for($i = 1; $i <= $counter1; $i++){
            if($i != $counter1)
                $idsWeekly .="". $arrWeekly[$i].",";
            else
                $idsWeekly .="". $arrWeekly[$i];
        }
        $idsWeekly .=")";
        if($idsWeekly == "()"){
            echo"<script>document.cookie = 'toSend3=0;'</script>";
            echo"<script>document.cookie = 'toSend4=0;' </script>";
        }
        else{
        $sql5= "SELECT COUNT(stat) As numberOfRecoveredWeekly FROM covidStatus WHERE ReportID IN $idsWeekly AND stat = 'Recovered'";
        $result5 = $pdo->query($sql5);
        $numberOfRecoveredWeekly = $result5->fetch(PDO::FETCH_ASSOC)['numberOfRecoveredWeekly'] ?? 0;
        
        $sql6 = "SELECT COUNT(stat) As numberOfSymptomaticWeekly FROM covidStatus WHERE ReportID IN $idsWeekly AND stat = 'Symptomatic'";
        $result6 = $pdo->query($sql6);
        $numberOfSymptomaticWeekly = $result6->fetch(PDO::FETCH_ASSOC)['numberOfSymptomaticWeekly'] ?? 0;
        echo"<script>document.cookie = 'toSend3=' + $numberOfRecoveredWeekly+';' </script>";
        echo"<script>document.cookie = 'toSend4=' + $numberOfSymptomaticWeekly+';' </script>";

        echo "<script>console.log('$numberOfRecoveredWeekly');</script>";
        echo "<script>console.log('$numberOfSymptomaticWeekly');</script>";
    }
    }catch(Exception $e){
        echo $e->getMessage();
    }


    

    
?>