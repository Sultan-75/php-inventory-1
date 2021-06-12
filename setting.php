<?php

include "inc/header.php";
?>
<?php if (!Session::get('userRole') == '0') {
    echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php
$userId = Session::get('userId');
$userRole = Session::get('userRole');
?>
<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $admin_pass = $_POST['admin_pass'];

    $query = "UPDATE admin SET username='$username',admin_pass='$admin_pass' WHERE admin_id='$userId' ";
    $b = $db->update($query);
    if ($b) {
        echo "<script>alert('Profile Updated!')</script>";
    }
}

?>
<?php
if (isset($_GET['delusr'])) {
    $delusr = $_GET['delusr'];
    $delquery = "DELETE FROM admin WHERE admin_id ='$delusr' ";
    $delUser = $db->delete($delquery);
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card mx-auto mt-3" style="max-width: 18rem;">
                <div class="card-title">
                    <h3 class="text-center text-success font-weight-bold mt-4 mb-0">Admin Profile</h3>
                </div>
                <div class="card-body text-success pt-3">
                    <form action="" method="post">
                        <?php
                        $query = "SELECT * FROM admin WHERE admin_id='$userId' AND role='$userRole'";
                        $getuser = $db->select($query);
                        if ($getuser) {
                            while ($result = $getuser->fetch_assoc()) {

                        ?>
                                <div class="form-group">
                                    <label for="id1" class="ml-1 text-success">USERNAME</label>
                                    <input type="text" name="username" class="form-control" id="id1" aria-describedby="" value="<?php echo $result['username']; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="id1" class="ml-1 text-success">PASSWORD</label>
                                    <input type="password" name="admin_pass" class="form-control" id="myInput2" aria-describedby="" value="<?php echo $result['admin_pass']; ?>" required />
                                </div>

                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" onclick="myFunction2()" id="gridCheck2">
                                        <label class="form-check-label" for="gridCheck">
                                            Show Password
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-success btn-sm" name="submit">Update</button>
                                </div>
                        <?php }
                        } ?>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="bg-white mt-3 pt-1 px-1">
                <h3 class="text-center text-primary font-weight-bold my-3">User's Table</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-primary text-light">
                                <th>#</th>
                                <th>UserName</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $userquery = "SELECT * FROM admin WHERE role='1' ";
                            $userdata = $db->select($userquery);
                            if ($userdata) {
                                $sn = 0;
                                while ($result = $userdata->fetch_assoc()) {
                                    $sn++;

                            ?>
                                    <tr class="bg-light text-dark">
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $result['username']; ?></td>
                                        <td><?php echo $result['admin_pass']; ?></td>
                                        <td>
                                            <a onclick="return confirm('Are You Sure to Remove a User!');" href="?delusr=<?php echo $result['admin_id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction2() {
        var x = document.getElementById("myInput2");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php include "inc/footer.php";
