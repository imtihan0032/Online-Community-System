<!DOCTYPE html>

<html lang="en">

    <?php session_start();
    if(isset($_SESSION['Username'])){
        //continue
    }
    else{
        header('location:../../index.php');
    }
     ?>
    
    <head>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../assets/css/admin/bootstrap.min.css">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="../../assets/css/admin/fontawesome.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../../assets/css/admin/admin.css">
        <link rel="stylesheet" href="../../assets/css/admin/quicksand.css">

        <!-- Webpage Name -->
        <title>Covid Statistics</title>
    </head>

    <body>
        <!-- Page Loader -->
        <div class="loader-wrapper">
            <div class="loader-circle">
                <div class="loader-wave"></div>
            </div>
        </div>
        <!-- Page Loader -->

        <!-- Page Wrapper -->
        <div class="container-fluid">

            <!-- Header -->
            <div class="row header shadow-sm fixed-top">

                <!-- Logo -->
                <div class="col-sm-3 text-center pl-0 header-logo">
                    <div class="bg-theme mr-3 pt-3 pb-2">
                        <h3 class="logo"><img src="../../assets/img/logo.png" class="mb-2" height="20"> Admin<span class="small"> Board</span></h3>
                    </div>
                </div>
                <!-- Logo -->

                <!-- Header Menu -->
                <div class="col-sm-9 pt-2 pb-0 header-menu">
                    <div class="row mt-1">

                        <!-- Sidebar Toggle -->
                        <div class="col-sm-4 col-8 pl-0" id="sidebar-toggle">
                            <span class="menu-icon">
                                <span id="sidebar-toggle-btn"></span>
                            </span>
                        </div>
                        <!-- Sidebar Toggle -->

                        <!-- Logout Button -->
                        <div class="col-sm-8 col-4 text-right justify-content-end" id="logout-button">
                            <div class="menu-icon justify-content-end">
                            <a href="../../resident/logout.php" role="button">
                                    <i class="fa fa-sign-out"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Logout Button -->

                    </div>
                </div>
                <!-- Header Menu -->

            </div>
            <!-- Header -->

            <!-- Main Content -->
            <div class="row main-content">

                <!-- Sidebar -->
                <div class="col-sm-3 col-xs-6 sidebar pl-0">
                    <div class="inner-sidebar mr-3">
                        
                        <!-- Admin Name -->
                        <div class="avatar text-center pt-5">
                            <p><strong><?php echo $_SESSION['Username']; ?></strong></p>
                            <span class="text-warning small"><strong>Admin</strong></span>
                        </div>
                        <!-- Admin Name -->

                        <!-- Sidebar Navigation Menu -->
                        <ul class="sidebar-menu mt-4 mb-4">
                            <li>
                                <a href="../mainboard/mainboard.php"><i class="fa fa-angle-right mr-2"></i>
                                    <span class="none">Main Board</span>
                                </a>
                            </li>
                            <li>
                                <a href="reportlist.php"><i class="fa fa-angle-right mr-2"></i>
                                    <span class="none">Covid Statistics</span>
                                </a>
                            </li>
                            <li>
                                <a href="../residentlist/residentlist.php"><i class="fa fa-angle-right mr-2"></i>
                                    <span class="none">Manage Residents</span>
                                </a>
                            </li>
                        </ul>
                        <!-- Sidebar Navigation Menu -->

                    </div>
                </div>
                <!-- Sidebar -->
                
                <!-- Content -->
                <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
                    
                    <h5 class="mb-3" ><strong>Covid Statistics</strong></h5>
                    
                    <!-- Retrieve Statistics -->
                    <?php
                        include("../../database/pdo.php");
                        try {
                            $pdo->beginTransaction();

                            $sql_Recovered = "select count(*) as normal from covidstatus where stat='Recovered';";
                            $res_Recovered  = $pdo->query($sql_Recovered );
                            $result_Recovered  = $res_Recovered ->fetch();

                            $sql_symptomatic = "select count(*) as symptomatic from covidstatus where stat='Symptomatic';";
                            $res_symptomatic = $pdo->query($sql_symptomatic);
                            $result_symptomatic = $res_symptomatic->fetch();

                            $pdo->commit();                                   
                        } catch (Exception $e) {
                            // Rollback the transaction because of error
                            $pdo->rollback();
                        }
                        $pdo = null;
                    ?>
                    <!-- Retrieve Statistics -->
                    
                    <!-- Counters -->
                    <div class="mt-1 mb-3 button-container">
                        <div class="row pl-0">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="bg-white border shadow-sm">
                                    <div class="media p-4">
                                        <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="media-body pl-2">
                                            <h3 class="mt-0 mb-0"><strong><?php echo $result_Recovered ['normal']; ?></strong></h3>
                                            <p><small class="text-muted bc-description">Recovered</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="bg-theme border shadow-sm">
                                    <div class="media p-4">
                                        <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                                            <i class="fa fa-user text-theme"></i>
                                        </div>
                                        <div class="media-body pl-2">
                                            <h3 class="mt-0 mb-0"><strong><?php echo $result_symptomatic['symptomatic']; ?></strong></h3>
                                            <p><small class="bc-description text-white">Symptomatic</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Counters -->

                    <!-- Chart -->
                    <div id="chart-container">
                        <h3 class="text-center">Covid Status vs Report ID</h3>
                        <h6 class="text-center">Status Hint: 0 for Normal, 1 for Symptomatic</h6>
                        <canvas id="mycanvas"></canvas>
                    </div>

                    <?php
                        include("../../database/pdo.php");
                        try {
                            $connectionString = "mysql:host=localhost;dbname=wia2003";
                            $user = "root";
                            $pass = "";

                            $pdo = new PDO($connectionString, $user, $pass);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $pdo->beginTransaction();
                            $sql = "SELECT * FROM report JOIN covidstatus ON (covidstatus.ReportID = report.ReportID) JOIN 
                                    quarantinedate ON (quarantinedate.ReportID = report.ReportID) ORDER BY report.ReportID";
                            $result = $pdo->query($sql);
                            $pdo->commit();
                        } catch (Exception $e) {
                            // Rollback because of error
                            $pdo->rollback();
                        }
                        $pdo = null;
                    ?>
                    <!-- Chart -->

                    <!-- Report List -->
                    <div class="mt-4 mb-4 p-3 bg-white border shadow-sm">
                        
                        <h6>Report List</h6><hr>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-0" id="report-list">
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Resident ID</th>
                                        <th>Submitted Date</th>
                                        <th>Status</th>
                                        <th>Quarantine Start Date</th>
                                        <th>Quarantine End Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <?php
                                    if ($result) {
                                        while($res = $result->fetch()){
                                            $ReportID = $res['ReportID']; ?>
                                            <tbody id="myTableBody">
                                                <tr>
                                                    <td><?php echo $res['ReportID']; ?></td>
                                                    <td><?php echo $res['ResidentID']; ?></td>
                                                    <td><?php echo $res['SubmittedDate']; ?></td>
                                                    <td><?php echo $res['stat']; ?></td>
                                                    <td><?php echo $res['StartDate']; ?></td>
                                                    <td><?php echo $res['EndDate']; ?></td>
                                                    <td><button id="<?php echo $res['ReportID']; ?>" class="btn btn-warning reportInfo"><i class="fa fa-pencil"></i></button></td>
                                                    <td><button id="<?php echo $res['ReportID']; ?>" class="btn btn-danger icon-round reportDelete"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                            </tbody>
                                        <?php }
                                    } else {
                                        echo "No record found.";
                                    }
                                ?>
                            </table>                            
                        </div>

                    </div>
                    <!-- Report List -->

                    <!-- Update Modal -->
                    <div class="modal" id="report_update">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Report</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div id="report_detail" class="modal-body">
                                    <!-- Details -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Update Modal-->

                    <!-- Delete Modal -->
                    <div class="modal" id="report_delete">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Report</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div id="delete_detail" class="modal-body">
                                    <!-- Details -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal -->
                    
                    <!-- Contact Modal -->
                    <div id="contact-modal" class="modal fade" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Contact <b>Us</b></h2>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Phone No:</strong></p>
                                    <p>(+03) 5693-2456</p><br>
                                    <p><strong>Email:</strong></p>
                                    <p>admin@lagrandemaison.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Modal -->

                    <!-- Footer -->
                    <div class="row mt-5 mb-4 footer">
                        <div class="col-sm-8">
                            <span>&copy; All rights reserved 2022 by <strong>La Grande Maison</strong></span>
                        </div>
                        <div class="col-sm-4 text-right">
                            <a href="#contact-modal" class="ml-2" data-toggle="modal">Contact Us</a>
                        </div>
                    </div>
                    <!-- Footer -->

                </div>
                <!-- Content -->

            </div>
            <!--Main Content-->

        </div>
        <!--Page Wrapper-->

        <!-- JQuery JS -->
        <script src="../../assets/js/admin/jquery.min.js"></script>
        <!--Bootstrap-->
        <script src="../../assets/js/admin/bootstrap.min.js"></script>
        <!--Popper JS-->
        <script src="../../assets/js/admin/popper.min.js"></script>
        <!-- Custom JS -->
        <script src="../../assets/js/admin/reportlist.js"></script>
        <!-- Chart JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    </body>

</html>