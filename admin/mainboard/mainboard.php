<?php require_once('../../database/mysqli.php'); ?>

<!DOCTYPE html>

<html lang="en">

    <?php 
    session_start();
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
        <!-- Table CSS -->
        <link rel="stylesheet" href="../../assets/css/admin/mainboard.css">
        <link rel="stylesheet" href="../../assets/css/admin/datatables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
        <!--Font Awesome CSS-->
        <link rel="stylesheet" href="../../assets/css/admin/fontawesome.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../../assets/css/admin/admin.css">
        <link rel="stylesheet" href="../../assets/css/admin/quicksand.css">
        
        <!-- Webpage Name -->
        <title>Mainboard</title>
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
                                <a href="mainboard.php"><i class="fa fa-angle-right mr-2"></i>
                                    <span class="none">Main Board</span>
                                </a>
                            </li>
                            <li>
                                <a href="../reportlist/reportlist.php"><i class="fa fa-angle-right mr-2"></i>
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

                    <h5 class="mb-3"><strong>Mainboard</strong></h5>

                    <!-- Counters -->
                    <div class="mt-1 mb-3 button-container">
                        <div class="row pl-0">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                                <div class="bg-white border shadow-sm">
                                    <div class="media p-4">
                                        <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="media-body pl-2">
                                            <h3 class="mt-0 mb-0"><strong><?php echo $conn->query("SELECT * FROM resident")->num_rows; ?></strong></h3>
                                            <p><small class="text-muted bc-description">Residents</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                                <div class="bg-white border shadow-sm">
                                    <div class="media p-4">
                                        <div class="align-self-center mr-3 rounded-circle notify-icon bg-danger">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="media-body pl-2">
                                            <h3 class="mt-0 mb-0"><strong><?php echo $conn->query("SELECT * FROM report")->num_rows; ?></strong></h3>
                                            <p><small class="text-muted bc-description">Reports</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                                <div class="bg-theme border shadow-sm">
                                    <div class="media p-4">
                                        <div class="align-self-center mr-3 rounded-circle notify-icon bg-white">
                                            <i class="fa fa-gavel text-theme"></i>
                                        </div>
                                        <div class="media-body pl-2">
                                            <h3 class="mt-0 mb-0"><strong><?php echo $conn->query("SELECT * FROM admin")->num_rows; ?></strong></h3>
                                            <p><small class="bc-description text-white">Admins</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Counters -->

                    <!-- FlourishMap API -->
                    <div class="mt-3 mb-3 p-3 button-container bg-white shadow-sm border">
                        
                        <h6>Covid Overview</h6><hr>
                        <div class="flourish-embed flourish-map" data-src="story/225979"><script src="https://public.flourish.studio/resources/embed.js"></script></div>

                    </div>
                    <!-- FlourishMap API -->

                    <!-- Task List -->
                    <div class="mt-3 mb-3 p-3 button-container bg-white shadow-sm border">

                        <h6>Task List</h6><hr>
                        <div id="alert"></div>

                        <table class="table table-hover table-striped" id="task-tbl">
                            <thead>
                                <tr class="bg-dark text-light bg-opacity-150">
                                    <th class=" text-center"></th>
                                    <th class=" text-center">Task</th>
                                    <th class=" text-center">Description</th>
                                    <th class=" text-center">Deadline</th>
                                    <th class=" text-center">Actions</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                    <!-- Task List -->
                    
                    <!-- Add Modal -->
                    <div id="add-modal" class="modal fade" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add <b>Task</b></h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="add-task-form">
                                        <div class="form-group">
                                            <label class="control-label">Task</label>
                                            <input type="text" class="form-control" name="Task" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="Description" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Deadline</label>
                                            <input type="date" class="form-control" name="Deadline" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" form="add-task-form">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Modal -->

                    <!-- Edit Modal -->
                    <div id="edit-modal" class="modal fade" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <b>Task</b></h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-task-form">
                                        <input type="hidden" class="form-control" name="TaskID">
                                        <div class="form-group">
                                            <label class="control-label">Task</label>
                                            <input type="text" class="form-control" name="Task" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="Description" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Deadline</label>
                                            <input type="date" class="form-control" name="Deadline" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-warning" form="edit-task-form">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->

                    <!-- Delete Modal -->
                    <div id="delete-modal" class="modal fade" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete <b>Task</b></h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="delete-task-form">
                                        <input type="hidden" name="TaskID">
                                        <p>Are you sure you want to delete the record?</p>
                                        <p class="text-danger"><small>This action cannot be undone.</small></p>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger" form="delete-task-form">Delete</button>
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
            <!-- Main Content -->

        </div>
        
        <!-- JQuery JS -->
        <script src="../../assets/js/admin/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="../../assets/js/admin/bootstrap.min.js"></script>
        <!-- Table CSS -->
        <script src="../../assets/js/admin/datatables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
        <!-- Popper JS -->
        <script src="../../assets/js/admin/popper.min.js"></script>
        <!-- Custom JS -->
        <script src="../../assets/js/admin/mainboard.js"></script>
    </body>

<html> 