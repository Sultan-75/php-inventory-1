<?php
include "inc/header.php";

?>
<?php if (!Session::get('userRole') == '0') {
    echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['submit'])) {

        $fromdate = $_GET['fromdate'];
        $todate = $_GET['todate'];

        $query = "SELECT * FROM tbl_sales WHERE sales_date  BETWEEN '$fromdate' AND '$todate'";
        $datepic = $db->select($query);
    }
}

?>

<div class="container-fluid">

    <form action="datepicker.php" method="GET">
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


    <?php
    if (isset($datepic)) {
        foreach ($db->select("SELECT SUM(sales_total)
    FROM tbl_sales WHERE sales_date BETWEEN '$fromdate' AND '$todate' ") as $row) {

            $sales_total = $row['SUM(sales_total)'];
        }

        foreach ($db->select("SELECT SUM(sales_due) 
    FROM tbl_sales WHERE sales_date BETWEEN '$fromdate' AND '$todate' ") as $row) {

            $sales_due = $row['SUM(sales_due)'];
        }

        foreach ($db->select("SELECT SUM(sales_profit) 
    FROM tbl_sales WHERE sales_date BETWEEN '$fromdate' AND '$todate' ") as $row) {

            $sales_profit = $row['SUM(sales_profit)'];
        }
    }
    ?>

    <div class="row pb-3">
        <div class="col-md-12">
            <div class="bg-light px-2">
                <?php if (isset($datepic)) {
                    if ($datepic == true) { ?>
                        <h1 class="h3 mb-0 text-primary bg-light text-center py-3 font-weight-bold">SALES REPORT LIST</h1>
                        <hr class="bg-primary">
                        <div class="table-responsive">
                            <table id="sort_product" class="bg-light table table-striped table-bordered ">
                                <thead>
                                    <tr class="bg-primary text-white text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Sold ID</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Buying Price</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Paid</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Profit</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">
                                    <?php
                                    if (isset($datepic)) {
                                        $sn = 1;
                                        while ($result = $datepic->fetch_assoc()) {
                                    ?>
                                            <tr class="text-center">
                                                <td><?php echo $sn;
                                                    $sn++;   ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_cstmr_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_prdct_name']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $result['sales_buying_price']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_selling_price']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_quantity']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_total']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_paid']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_due']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result['sales_profit']; ?>
                                                </td>
                                                <td><?php echo $fm->formatDate($result['sales_date']); ?></td>

                                            </tr>

                                    <?php }
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-dark">

                                        <th colspan="2">Summary</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><?php echo $sales_total; ?></th>
                                        <th></th>
                                        <th><?php echo $sales_due; ?></th>
                                        <th><?php echo $sales_profit; ?></th>
                                        <th>

                                        </th>

                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                <?php } else {
                        echo "<div class='p-4 text-center w-100 text-danger bg-light h4 font-weight-bold'> No Data Found!🤪<br><span class='h5 text-info'>[Please enter a valid date]</span></div>";
                    }
                }  ?>
            </div>
        </div>

    </div>

</div>

<?php include "inc/footer.php"; ?>