<?php include "inc/header.php"; ?>
<?php if (!Session::get('userRole') == '0') {
    echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php

$prdct_id = $_GET['prdct_id'];

$query = "SELECT * FROM tbl_product WHERE product_id=$prdct_id";
$getProduct = $db->select($query)->fetch_assoc();

if (isset($_POST['submit'])) {

    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];
    $add_quantity = $_POST['add_quantity'];
    $newQtty =  $product_quantity + $add_quantity;
    $product_total = $product_price * $newQtty;

    $query = "UPDATE tbl_product SET  product_name = '$product_name', 
    product_price='$product_price', product_quantity = '$newQtty',product_total='$product_total'
     WHERE product_id='$prdct_id' ";

    $updateMethod = $db->update($query);
    if ($updateMethod) {
        echo " <script> window.location='product_list.php';</script> ";
    }
}


?>

<!-- Topbar -->

<!-- Container Fluid-->
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- Form Basic -->

            <div class="card">
                <div class="card-header py-2">
                    <h3 class="text-center pt-2">UPDATE PRODUCT</h3>
                </div>
                <div class="card-body">
                    <form action="product_list_update.php?prdct_id=<?php echo $prdct_id; ?>" method="post">
                        <div class="form-group">
                            <label for="id1" class="ml-1 text-primary">PRODUCT NAME</label>
                            <input type="text" name="product_name" value="<?php echo $getProduct['product_name']; ?>" class="form-control" id="id1" aria-describedby="" placeholder="Enter product name..." required />
                        </div>

                        <div class="form-group">
                            <label for="id1" class="ml-1 text-primary">PRODUCT PRICE</label>
                            <input type="text" name="product_price" value="<?php echo $getProduct['product_price']; ?>" class="form-control" id="id1" aria-describedby="" placeholder="Enter product price..." required />
                        </div>
                        <div class="form-group">
                            <label for="id1" class="ml-1 text-primary">IN STOCK</label>
                            <input type="number" readonly name="product_quantity" value="<?php echo $getProduct['product_quantity']; ?>" class="form-control" id="id1" aria-describedby="" />
                        </div>
                        <div class="form-group">
                            <label for="id1" class="ml-1 text-primary">ADD QUANTITY</label>
                            <input type="text" name="add_quantity" class="form-control" id="id1" aria-describedby="" placeholder="Add product quantity..." />
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mt-1 float-right">Update Product</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!---Container Fluid-->
<?php include "inc/footer.php"; ?>