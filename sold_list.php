<?php
include "inc/header.php";
?>

<?php

if (isset($_GET['delcat'])) {
    $delid = $_GET['delcat'];
    $delquery = "DELETE FROM manager WHERE manager_id ='$delid' ";
    $deldat = $db->delete($delquery);
    if ($deldat) {
        echo "<span class='success'>  deleted  succesfuly </span>";
    } else {
        echo "<span class='error'> not delete ! </span>";
    }
}

?>

<!-- Container Fluid-->
<div class="container-fluid bg-white mt-0">

    <div class="pb-3">
        <table id="sort_product" class="bg-light table table-striped table-bordered ">
            <h1 class="h3 mb-0 text-primary font-weight-bold bg-light text-center py-3">SOLD LIST</h1>
            <thead>
                <tr class="bg-primary text-white text-center">
                    <th scope="col">#</th>
                    <th scope="col">Sold ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Product Name</th>
                    <!--  <th scope="col">Buying Price</th> -->
                    <th scope="col">Selling Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Paid</th>
                    <th scope="col">Due</th>
                    <!-- <th scope="col">Profit</th> -->
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-dark">
                <?php
                $query = "SELECT * FROM tbl_sales order by sales_id desc";
                $category = $db->select($query);
                if ($category) {
                    $sn = 1;
                    while ($result = $category->fetch_assoc()) {

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

                            <!-- <td>
                                <?php /* echo $result['sales_buying_price']; */ ?>
                            </td> -->
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
                            <!--  <td>
                                <?php /* echo $result['sales_profit']; */ ?>
                            </td> -->
                            <td><?php echo $fm->formatDate($result['sales_date']); ?></td>
                            <td>
                                <div class="d-flex">
                                    <a data-toggle="tooltip" data-placement="top" title="Return" onclick="return confirm('Are you sure to Return !');" href="return.php?sales_return=<?php echo $result['sales_id']; ?>" class="mr-2 font-weight-bold btn btn-sm btn-warning">
                                        <i class="fa fa-undo"></i>
                                    </a>
                                    <a href="invoice.php?invoice=<?php echo $result['sales_id']; ?>" data-toggle="tooltip" data-placement="top" title="Invoice" class="font-weight-bold btn btn-sm btn-primary">
                                        <i class="fa fa-print"></i></a>

                                </div>
                            </td>
                        </tr>

                <?php }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<!---Container Fluid-->
<?php include "inc/footer.php";
