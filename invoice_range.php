<?php
include "inc/header.php";

?>
<?php if (!Session::get('userRole') == '0') {
    echo "<script> window.location='dashboard.php';</script> ";
}
?>
<div class="container-fluid">

    <h4 class="text-center font-weight-bold text-light mt-3 mb-4">Check Date Wise Invoice</h4>
    <hr class="bg-light">
    <form action="date_wise_invoice.php" method="GET">
        <div class="row mt-3 mb-4">
            <div class="col-md-3"></div>
            <div class="">

            </div>
            <div class="col-md-6 d-flex">
                <input type="date" name="fromdate" class="form-control" placeholder="From date..">
                <input type="date" name="todate" class="form-control ml-1" placeholder="To date..">
                <input type="submit" name="submit" class="btn btn-success py-2 font-weight-bold ml-2" value="Submit">
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
</div>
<?php include "inc/footer.php"; ?>