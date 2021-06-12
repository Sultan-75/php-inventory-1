<?php

include "inc/header.php";
?>
<?php if (!Session::get('userRole') == '0') {
    echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];


    $product_total = $product_price * $product_quantity;

    $insert_query = "INSERT INTO tbl_product (product_name, product_price, product_quantity,product_total) 
    VALUES ('$product_name','$product_price','$product_quantity','$product_total') ";




    $redirect = $db->insert($insert_query);
    if ($redirect) {
        echo "<div class='mx-auto text-light bg-success text-center py-2 px-3 w-50'> Data Insesrted Succesfuly </div>";

?>
        <meta http-equiv='refresh' content='0.5;url=product_list.php'>
<?php
    } else {
        echo "<div class='mx-auto text-light bg-danger text-center py-2 px-3 w-50'>Something Went Wrong </div>";
    }
}

?>



<!-- Container Fluid-->
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- Form Basic -->

            <div class="card">
                <div class="card-header py-2">
                    <h3 class="text-center pt-2 font-weight-bold text-primary">ADD PRODUCT</h3>
                </div>
                <div class="card-body">
                    <form action="add_product.php" method="post">
                        <div class="form-group">
                            <label for="id1" class="ml-1 text-primary">PRODUCT NAME</label>
                            <input type="text" name="product_name" class="form-control" id="id1" aria-describedby="" placeholder="Enter product name..." required />
                        </div>

                        <div class="form-group">
                            <label for="id1" class="ml-1 text-primary">PRODUCT PRICE</label>
                            <input type="text" name="product_price" class="form-control" id="id1" aria-describedby="" placeholder="Enter product price..." required />
                        </div>
                        <div class="form-group">
                            <label for="id1" class="ml-1 text-primary"> PRODUCT QUANTITY</label>
                            <input type="number" name="product_quantity" class="form-control" id="id1" aria-describedby="" placeholder="Enter product quantity..." required />
                        </div>


                        <button type="submit" class="btn btn-primary mt-1 float-right">Add New Product</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!---Container Fluid-->
<?php include "inc/footer.php";
