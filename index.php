<?php

include "inc/session.php";
Session::init();
?>
<?php
include "inc/config.php";
include "inc/db_con.php";
include "inc/format.php";
?>
<?php

$db = new Database();
$fm = new format();
?>

<!-- login page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log IN</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/dashboard.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="bg_image">
        <img class="img-fluid position-absolute" src="images/background1.jpg" alt="">


        <div class="card index_card">
            <div class="card-head">
                <h3 class="text-center">Login</h3>

            </div>

            <div class="card-body">

                <?php
                if (isset($_POST['submit'])) {
                    $username = $fm->validation($_POST['username']);
                    $admin_pass = $_POST['password'];
                    $query = "SELECT * FROM admin WHERE username ='$username' AND admin_pass='$admin_pass' ";
                    $result = $db->select($query);
                    if ($result != false) {
                        $value = $result->fetch_assoc();
                        /*  $row = mysqli_num_rows($result);
                        if ($row > 0) { */
                        Session::set("login", true);
                        Session::set("username", $value['username']);
                        Session::set("userId", $value['admin_id']);
                        Session::set("userRole", $value['role']);
                        header("Location:dashboard.php");
                        /* } else {
                            echo "Not found";
                        } */
                    } else {
                        echo "<span class='text-danger font-weight-bold text-center'>Username or Password Incorrect!</span>";
                    }
                }
                ?>
                <form action="index.php" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                    <div class="">
                        <span>Admin access:(Username :<strong class="text-danger"> admin</strong> Pass: <strong class="text-danger">admin123</strong>)</span>
                        <br>
                        <span>User access:(Username :<strong class="text-danger"> admin</strong> Pass: <strong class="text-danger">author123</strong>)</span>
                    </div>

                </form>
            </div>

        </div>


    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>