<?php include "inc/header.php"; ?>
<?php if (!Session::get('userRole') == '0') {
    echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php

$staff_up = $_GET['staff_up'];

$query = "SELECT * FROM tbl_staff WHERE staff_id=$staff_up";
$getStaff = $db->select($query)->fetch_assoc();

if (isset($_POST['submit'])) {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $salary = $_POST["salary"];
    $address = $_POST["address"];
    $nid = $_POST["nid"];




    $query = "UPDATE tbl_staff SET  staff_name ='$name', 
    staff_phone='$phone', staff_email = '$email',staff_salary='$salary',
    staff_address ='$address',staff_nid ='$nid'
     WHERE staff_id='$staff_up' ";

    $updateMethod = $db->update($query);
    if ($updateMethod) {
        echo "<div class='mx-auto text-light bg-success text-center py-2 px-3 w-50'>  Updated  succesfuly </div>";
?>
        <meta http-equiv='refresh' content='2;url=staff_info.php'>
<?php
        /*  echo " <script> window.location='drivers_list.php';</script> "; */
    }
}


?>
<div class="container-fluid">

    <div class="container">
        <h3 class="text-center my-4 text-white font-weight-bold">Update Information</h3>
        <form action="staff_update.php?staff_up=<?php echo $staff_up; ?>" method="POST">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $getStaff['staff_name'];  ?>">
                </div>
                <div class="col">
                    <input type="number" name="phone" class="form-control" placeholder="Phone" value="<?php echo $getStaff['staff_phone'];  ?>">
                </div>
                <div class="col"></div>
            </div>
            <div class="row my-2">
                <div class="col"></div>
                <div class="col">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $getStaff['staff_email'];  ?>">
                </div>
                <div class="col">
                    <input type="text" name="salary" class="form-control" placeholder="Salary" value="<?php echo $getStaff['staff_salary'];  ?>">
                </div>
                <div class="col"></div>
            </div>
            <div class="row my-2">
                <div class="col"></div>
                <div class="col">
                    <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $getStaff['staff_address'];  ?>">
                </div>
                <div class="col">
                    <input type="text" name="nid" class="form-control" placeholder="NID or Birth Certificate" value="<?php echo $getStaff['staff_nid'];  ?>">
                </div>
                <div class="col"></div>
            </div>
            <div class="text-center mt-3">

                <input type="submit" name="submit" class="btn btn-success px-5 font-wegiht-bold text-uppercase" value="Update">
            </div>
        </form>
    </div>
</div>

<?php include "inc/footer.php"; ?>