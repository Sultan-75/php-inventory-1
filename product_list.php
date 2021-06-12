<?php include "inc/header.php"; ?>

<?php
if (isset($_GET['del_product'])) {
    $delproduct = $_GET['del_product'];
    $delquery = "DELETE FROM tbl_product WHERE product_id ='$delproduct' ";
    $delprdct = $db->delete($delquery);
    if ($delprdct) {
        echo "<script> window.location='product_list.php';</script> ";
    }
}
?>

<!-- Topbar -->

<!-- Container Fluid-->
<div class="container-fluid bg-white mt-0">

    <div class="pb-3">
        <table id="sort_product" class="bg-light table table-striped table-bordered table-hover">
            <h1 class="h3 mb-0 text-primary bg-light text-center py-3 font-weight-bold">PRODUCT LISTS</h1>
            <thead>
                <tr class="bg-primary text-white text-center">
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <!--  <th scope="col">Product Price</th> -->
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-dark">
                <?php
                $query = "SELECT * FROM tbl_product order by product_id desc";
                $category = $db->select($query);
                if ($category) {
                    $sn = 1;
                    while ($result = $category->fetch_assoc()) {

                ?>
                        <tr class="text-center">
                            <td><?php echo $sn;
                                $sn++;   ?></td>
                            <td><?php echo $result['product_name']; ?></td>
                            <!-- <td><?php /* echo $result['product_price']; */ ?></td> -->
                            <td><?php echo $result['product_quantity']; ?></td>
                            <td><?php echo $result['product_total']; ?></td>


                            <td>
                                <a onclick="return confirm('READY TO SALE !');" href="new_sale.php?sale_id=<?php echo $result['product_id']; ?>" class="btn btn-primary btn-sm">SALE
                                </a>
                                <?php if (Session::get('userRole') == '0') { ?>
                                    <a href="product_list_update.php?prdct_id=<?php echo $result['product_id']; ?>" class="btn btn-secondary btn-sm">EDIT</a>
                                    <a onclick="return confirm('Are you sure to DELETE !');" href="?del_product=<?php echo $result['product_id']; ?>" class="btn btn-danger btn-sm">DELETE
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                <?php
                    }
                } ?>
            </tbody>
        </table>
    </div>
</div>
<!---Container Fluid-->
<?php include "inc/footer.php"; ?>