<?php include "inc/header.php"; ?>
<?php

$sale_id = $_GET['sale_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /*  $cap_loss = $_POST['cap_loss']; */

    $f_id = $_POST['f_id'];
    $buying_price = $_POST["product_price"];
    $sales_prdct_name = $_POST["product_name"];
    $product_quantity = $_POST["product_quantity"];

    $sales_cstmr_name = $_POST["sales_cstmr_name"];

    $sales_selling_price = $_POST["sales_selling_price"];
    $sales_quantity = $_POST["sales_quantity"];
    $sales_paid = $_POST["sales_paid"];
    $less = $_POST['x'];

    $qtty = $product_quantity - $sales_quantity;
    $product_total = $qtty * $buying_price;
    if ($sale_id > 0) {

        $query = "UPDATE tbl_product SET  product_quantity = '$qtty',product_total='$product_total' WHERE product_id='$sale_id' ";

        $updateMethod = $db->update($query);
    }
    $sales_total = $sales_selling_price * $sales_quantity;
    $unpaid = $sales_total - $less;
    /*  $discount = $sales_paid - $less; */
    $sales_due = $unpaid - $sales_paid;

    $sales_profit = $unpaid - ($buying_price  * $sales_quantity);


    $insert_query = "INSERT INTO tbl_sales (f_id,sales_cstmr_name,sales_prdct_name,sales_buying_price,sales_selling_price, sales_quantity,sales_total,sales_paid,sales_due,sales_profit) 
    VALUES ('$f_id','$sales_cstmr_name','$sales_prdct_name','$buying_price','$sales_selling_price','$sales_quantity','$unpaid','$sales_paid','$sales_due','$sales_profit') ";

    $redirect = $db->insert($insert_query);
    if ($redirect) {
        echo "<script> window.location='sold_list.php';</script> ";
        /* echo "<meta http-equiv='refresh' content='0;url=sold_list.php'>"; */
    }

    /* $ifloss = $sales_quantity * $buying_price;
    if ($ifloss > $sales_paid) {
        $capital = $ifloss - $sales_paid;
        $los_query = "INSERT INTO tbl_net_capital (cap_loss) VALUES ('$capital') ";
        $los_quer = $db->insert($los_query);
    } */
}

?>

<!-- Container Fluid-->
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-2">
                    <h5 class="h3 mb-0  mt-2 text-center text-primary font-weight-bold">NEW SALE</h5>
                </div>

                <div class="card-body">

                    <form oninput="topay.value=parseInt(a.value)*parseInt(b.value)" action="new_sale.php?sale_id=<?php echo $sale_id; ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id1" class="ml-1 text-primary">CUSTOMER NAME</label>
                                    <input type="text" class="form-control" id="id1" name="sales_cstmr_name" aria-describedby="" placeholder="Customer name..." required />
                                </div>
                                <div class="form-group">
                                    <label for="id1" class="ml-1 text-primary">SELLING PRICE</label>
                                    <input type="text" class="form-control" id="a" name="sales_selling_price" aria-describedby="" placeholder="Selling price..." required />
                                </div>


                                <div class="form-group">
                                    <label for="id1" class="ml-1 text-primary">QUANTITY</label>
                                    <input type="text" class="form-control" id="b" name="sales_quantity" aria-describedby="" placeholder="Quantity..." required />
                                </div>
                                <div class="form-group">
                                    <label for="id1" class="ml-1 text-primary">Discount</label>
                                    <input type="text" class="form-control" name="x" placeholder="Discount...">
                                </div>
                                <!-- <input type="hidden" class="form-control" name="cap_loss"> -->
                            </div>
                            <?php
                            $query = "SELECT * FROM tbl_product WHERE product_id = '$sale_id'";

                            $category = $db->select($query);
                            if ($category) {

                                while ($result = $category->fetch_assoc()) {



                            ?>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="id1" class="ml-1 text-primary">TOTAL AMOUNT</label>
                                                    <input type="text" readonly class="form-control" id="id1" name="topay" for="a b" aria-describedby="" placeholder="To Pay..." required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="id1" class="ml-1 text-primary">PAYMENT</label>
                                                    <input type="text" class="form-control" id="id1" name="sales_paid" aria-describedby="" placeholder="Payment..." required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 m-auto border border-danger border-top-0 border-right-0 border-bottom-0 ">

                                                <a onclick="myFunction()" class="text-decoration-none" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <span class="ml-1 text-primary font-weight-bold h5" id="hide">Show Details</span>
                                                </a>

                                                <div class="collapse" id="collapseExample1">
                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="id1" name="f_id" aria-describedby="" value="<?php echo $result['product_id']; ?>" required />
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <h6 for="id1" class=" ml-1 text-danger mb-0">PRODUCT NAME</h6>
                                                        <span class="disabled m-0 ml-1">
                                                            <?php echo $result['product_name']; ?>
                                                        </span>
                                                        <input type="hidden" class="border border-danger" name="product_name" value="<?php echo $result['product_name']; ?>">
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <h6 for="id1" class=" ml-1 text-danger">BUYING PRICE</h6>
                                                        <span class="disabled m-0 ml-1">
                                                            <?php echo $result['product_price']; ?>
                                                        </span>
                                                        <input type="hidden" class="border border-danger" name="product_price" value="<?php echo  $result['product_price'];  ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <h6 for="id1" class=" ml-1 text-danger">IN STOCK</h6>
                                                        <span class="disabled m-0 ml-1">
                                                            <?php echo $result['product_quantity']; ?>
                                                        </span>
                                                        <input type="hidden" class="border border-danger" id="id1" name="product_quantity" aria-describedby="" value="<?php echo $result['product_quantity']; ?>" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                        </div>
                        <button type="submit" class="btn btn-success float-right mt-1">Sale Now</button>
                    </form>
            <?php
                                }
                            } ?>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<!---Container Fluid-->
<!-- scrpit for onclcik funtion -->
<script>
    function myFunction() {
        var x = document.getElementById("hide");
        if (x.innerHTML === "Show Details") {
            x.innerHTML = "Hide Details";
        } else {
            x.innerHTML = "Show Details";
        }
    }
</script>
<?php include "inc/footer.php"; ?>