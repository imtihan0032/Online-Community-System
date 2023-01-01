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
            <a class="nav-link nav-linkSelected-color anchor-background-color m-0" href="profile.php">&#60;&#60; Profile</a>
            <div class="page-header">
                <h1 class="text-center">Edit Profile</h1>
            </div>
            <div class="mother-section">
                <section class="Covid-form m-auto mb-4"id="special" >
                    <h5 class=""><b>Resident Details:<b></h5>
                    <form action="editProfile.php" method="POST">
                    <label for="email" class="mt-1 d-block">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="<?php echo $_SESSION['Email'] ?>">
                    <label for="password" class="mt-1 d-block">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your new password" >
                    <label for="phonenumber" class="mt-1 d-block">Phone Number</label>
                    <input type="text" name="phonenumber" id="phonenumber" class="form-control" placeholder="Enter your phone number" value="<?php echo $_SESSION['PhoneNumber'] ?>" >
                    <label for="block" class="mt-1 d-block">Block Number</label>
                    <select id="block" name="block" class="form-control" >
                        <option value="">Select</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                    <label for="unit" class="mt-1 d-block">Unit Number</label>
                    <input type="text" name="unit" id="unit" class="form-control" placeholder="Enter your unit number"value="<?php echo $_SESSION['Unit'] ?>" >
                    <label for="occupation" class="mt-1 d-block">Ocupation</label>
                    <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Enter your occupation" value="<?php echo $_SESSION['Occupation'] ?>" >
                    <label for="description" class="mt-1 d-block">About You</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter your description" value="<?php echo $_SESSION['Description'] ?>" >
                    <label for="file" class="mt-1 d-block">Profile picture</label>
                    <input type="file" name="file" id="file" class="form-control" placeholder="Enter your file">
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
    include('../database/pdo.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        
        if(isset($_POST['email']) || isset($_POST['password']) || isset($_POST['phonenumber']) || isset($_POST['block']) || isset($_POST['unit']) || isset($_POST['occupation']) || isset($_POST['description']) || isset($_POST['file'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phonenumber = $_POST['phonenumber'];
            $block = $_POST['block'];
            $unit = $_POST['unit'];
            $occupation = $_POST['occupation'];
            $description = $_POST['description'];
            $img = $_POST['file'];
        // begin a transaction
        $pdo->beginTransaction();
        try {
            
            
            if($email != ''){
                $sql = "UPDATE resident SET Email = '$email' WHERE ResidentID = '$residentID'";
                echo "<script>console.log('hells')</script>";
                $stmt = $pdo->query($sql);

                echo "<script>console.log('hells')</script>";
            }
            
            if($password != ''){
                $sql = "UPDATE resident SET  `Password` = '$password' WHERE ResidentID = '$residentID'";
                $stmt = $pdo->query($sql);

            }


            if($phonenumber != ''){
                $sql = "UPDATE resident SET PhoneNumber = '$phonenumber' WHERE ResidentID = '$residentID'";
                $stmt = $pdo->query($sql);

            }

            if($occupation != ''){
                $sql = "UPDATE resident SET Occupation = '$occupation' WHERE ResidentID = '$residentID'";
                $stmt = $pdo->query($sql);

            }

            if($unit != ''){
                $sql = "UPDATE resident SET Unit = '$unit' WHERE ResidentID = '$residentID'";
                $stmt = $pdo->query($sql);

            }

            if($block != ''){
                $sql = "UPDATE resident SET `Block` = '$block' WHERE ResidentID = '$residentID'";
                $stmt = $pdo->query($sql);

            }
            if($description != ''){
                $sql = "UPDATE resident SET Description = '$description' WHERE ResidentID = '$residentID'";
                $stmt = $pdo->query($sql);

            }
            if($img != ''){
                $sql = "UPDATE resident SET `Image` = '$img' WHERE ResidentID = '$residentID'";
                $stmt = $pdo->query($sql);

            }
            if($pdo->commit()){
                echo "<script>alret('success')</script>";
                echo "<script>window.location.href='profile.php'</script>";
                ##
            }
            
          } catch (PDOException $e) {
            // roll back the transaction if something failed
            $pdo->rollback();
            echo "<script>console.log('chill')</script>";

          }
        
    }
}
    
       
?>