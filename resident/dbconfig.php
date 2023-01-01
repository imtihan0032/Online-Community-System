<?php

$server_name = "localhost";
$db_username = "root";
$db_pw = "";
$db_name = "wia2003";

$connection = mysqli_connect($server_name, $db_username, $db_pw);
$dbconfig = mysqli_select_db($connection, $db_name);

if ($dbconfig) {
    //echo 'DB Connected';
}
else {
    echo '
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title bg-danger text-white">
                            DB Connection failed
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}




?>