<!DOCTYPE html>
<html lang="en">

<?php
session_start();
// Set connection variables
$server = "localhost";
$username = "root";
$password = "";

// Create a database connection
$con = mysqli_connect($server, $username, $password);

if (isset($_POST['submit'])) {

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_type = test_input($_POST['user_type']);
    mysqli_select_db($con, 'wia2003');

    if ($user_type == 'Resident') {

        $Username = test_input($_POST['user']);
        $pass = test_input($_POST['password']);

        $s = "select * from resident where username = '$Username' && password = '$pass'";
        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);


        if ($num == 1) {

            $_SESSION['Username'] = $row['Username'];
            $_SESSION['residentID'] = $row['ResidentID'];

            header('location:resident/profile.php');
        } else {
            $error[] = 'Incorrect username or password!';
        }
    } elseif ($user_type == 'Admin') {

        $Username = test_input($_POST['user']);
        $pass = test_input($_POST['password']);

        $s = "select * from admin where username = '$Username' && password = '$pass'";
        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);

        if ($num == 1) {

            $_SESSION['Username'] = $row['Username'];
            $_SESSION['AdminID'] = $row['AdminID'];
            header('location:admin/mainboard/mainboard.php');
        } else {
            $error[] = 'Incorrect username or password!';
        }
    } else {
        $error[] = 'Please select a status';
    }
};
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/loginStyle.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>
    <section>
        <div class="imgBx">
            <img src="assets/img/community.jpeg">
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2>Login</h2>

                <form id="form" method="POST">
                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<span style = " margin: 10px 0;
                            display: block;
                            background: crimson;
                            color: #fff;
                            border-radius: 5px;
                            font-size: 20px;
                            text-align: center;
                            padding: 10px;">' . $error . '</span>';
                        };
                    };
                    ?>
                    <div class="inputBx">
                        <span>Username</span>
                        <input id="username" type="text" name="user" placeholder="Enter username">

                    </div>

                    <div class="inputBx">
                        <span>Password</span>
                        <input id="password" type="password" name="password" placeholder="Password">

                    </div>

                    <div class="inpuBx dropdown">
                        <select name="user_type">
                            <option value="">--Status--</option>
                            <option value="Resident">Resident</option>
                            <option value="Admin">Admin</option>
                        </select>
                        <label class="remember"><input type="checkbox"> Remember me</label>
                    </div>

                    <br>
                    <div class="inputBx">
                        <input type="submit" value="Sign in" name="submit">
                    </div>

                </form>
                <h3 style="color: #fca311;">Welcome to La Grande Maison</h3>
                <img style="height: 160px; width: 160px; margin-left:100px;" src="assets/img/apartment.png" alt="Apartment">
            </div>
        </div>
        <div id="arrow">
        <a href="index.php"><i class="uil uil-times"></i></a>
        </div>
    </section>
</body>

</html>