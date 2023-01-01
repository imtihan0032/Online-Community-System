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
        <!-- Table CSS -->
        <link rel="stylesheet" href="../../assets/css/admin/resident.css">
        <link rel="stylesheet" href="../../assets/css/admin/datatables.min.css">
        <!--Font Awesome CSS-->
        <link rel="stylesheet" href="../../assets/css/admin/fontawesome.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../../assets/css/admin/admin.css">
        <link rel="stylesheet" href="../../assets/css/admin/quicksand.css">
        
        <!-- Webpage Name -->
        <title>Manage Residents</title>
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
                                <a href="../reportlist/reportlist.php"><i class="fa fa-angle-right mr-2"></i>
                                    <span class="none">Covid Statistics</span>
                                </a>
                            </li>
                            <li>
                                <a href="residentlist.php"><i class="fa fa-angle-right mr-2"></i>
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

                    <h5 class="mb-3"><strong>Manage Residents</strong></h5>

                    <!-- Table -->
                    <div class="table-wrapper">

                        <!-- Table Title -->
                        <div class="row table-title">
                            <div class="col-6">
                                <h2>Residents <b>List</b></h2>
                            </div>
                            <div class="col-6">
                                <a href="#add-modal" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i><span>Add</span></a>
                            </div>
                        </div>
                        <!-- Table Title -->

                        <!-- Alert Message -->
                        <div id="alert"></div>
                        <!-- Alert Message -->

                        <!-- Table Content -->
                        <table class="table table-striped table-hover mt-4" id="resident-list">

                            <!-- Table Header -->
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th id="phone-field">Phone Number</th>
                                    <th id="block-field">Block</th>
                                    <th id="unit-field">Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <!-- Table Header -->

                        </table>
                        <!-- Table Content -->

                    </div>
                    <!-- Table -->

                    <!-- Add Modal -->
                    <div id="add-modal" class="modal fade pl-0" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="add-resident">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Add <b>Resident</b></h2>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Block</label>
                                            <input type="text" class="form-control" name="Block" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="text" class="form-control" name="Unit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="PhoneNumber" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="text" class="form-control" name="Age" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control" name="Nationality" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Occupation</label>
                                            <input type="text" class="form-control" name="Occupation" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                        <input type="submit" class="btn btn-success" name="submit" value="Add">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Add Modal -->

                    <!-- Update Modal -->
                    <div id="edit-modal" class="modal fade pl-0" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="edit-resident">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Update <b>Resident</b></h2>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ResidentID">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Block</label>
                                            <input type="text" class="form-control" name="Block" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="text" class="form-control" name="Unit" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="PhoneNumber" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="text" class="form-control" name="Age" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" class="form-control" name="Nationality" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Occupation</label>
                                            <input type="text" class="form-control" name="Occupation" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                        <input type="submit" class="btn btn-warning" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Update Modal -->

                    <!-- Delete Modal -->
                    <div id="delete-modal" class="modal fade" data-backdrop="static">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="delete-resident">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Delete <b>Resident</b></h2>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ResidentID">
                                        <p>Are you sure you want to delete the record?</p>
                                        <p class="text-danger"><small>This action cannot be undone.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </div>
                                </form>
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
        <!-- Page Wrapper -->

        <!-- JQuery JS -->
        <script src="../../assets/js/admin/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="../../assets/js/admin/bootstrap.min.js"></script>
        <!-- Table CSS -->
        <script src="../../assets/js/admin/datatables.min.js"></script>
        <!-- Popper JS -->
        <script src="../../assets/js/admin/popper.min.js"></script>
        <!-- Custom JS -->
        <script src="../../assets/js/admin/resident.js"></script>
    </body>

</html>