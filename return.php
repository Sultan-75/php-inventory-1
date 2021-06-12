<?php include "inc/header.php"; ?>

<?php

$sales_return = $_GET['sales_return'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   /*  $product_name = $_POST["product_name"]; */
   $sales_cstmr_name = $_POST['sales_cstmr_name'];
   $sales_selling_price = $_POST['sales_selling_price'];
   $sales_quantity = $_POST['sales_quantity'];
   $sales_total = $_POST['sales_total'];
   $sales_due = $_POST['sales_due'];
   $sales_paid = $_POST['sales_paid'];

   $buying_price = $_POST["product_price"];
   $sales_prdct_name = $_POST["product_name"];
   $product_quantity = $_POST["product_quantity"];


   $product_total = $product_quantity * $buying_price;

   if ($sales_return > 0) {
      $insert_query = "INSERT INTO tbl_product (product_name,product_price,product_quantity,product_total) 
      VALUES ('$sales_prdct_name','$buying_price','$product_quantity','$product_total') ";
      $redirect = $db->insert($insert_query);

      $insert_query2 = "INSERT INTO tbl_return (cstmr_name,prdct_name,selling_price,quantity,total,paid,due) 
      VALUES ('$sales_cstmr_name','$sales_prdct_name','$sales_selling_price','$sales_quantity','$sales_total','$sales_paid','$sales_due') ";
      $redirect2 = $db->insert($insert_query2);
   }

   if (isset($_GET['sales_return'])) {
      $delproduct = $_GET['sales_return'];
      $delquery = "DELETE FROM tbl_sales WHERE sales_id ='$sales_return' ";
      $delprdct = $db->delete($delquery);
      if ($delprdct) {
         echo "<script> window.location='sold_list.php';</script> ";
         /* echo "<meta http-equiv='refresh' content='0.5;url=sold_list.php' </meta>"; */
      }
   }
   $returnCap = $sales_quantity * $buying_price;
   if ($returnCap > $sales_paid) {
      $returnCapital = $returnCap - $sales_paid;
      $abc =  -1 * $returnCapital;
      $los_query = "INSERT INTO tbl_net_capital (cap_loss) VALUES ('$abc') ";
      $los_quer = $db->insert($los_query);
   }
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
               <h5 class="h3 mb-0  mt-2 text-center">Return Product</h5>
               <hr class="bg-primary mb-0">
            </div>
            <div class="card-body">
               <?php
               $query = "SELECT * FROM tbl_sales WHERE sales_id = '$sales_return'";
               $category = $db->select($query);
               if ($category) {

                  while ($result = $category->fetch_assoc()) {
               ?>
                     <form action="return.php?sales_return=<?php echo $sales_return; ?>" method="post">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <!-- <label for="id1" class="ml-1 text-primary">CUSTOMER NAME</label> -->
                                 <input type="hidden" class="form-control" id="id1" name="sales_cstmr_name" value="<?php echo $result['sales_cstmr_name']; ?>" aria-describedby="" required />
                              </div>
                              <div class="form-group">
                                 <!-- <label for="id1" class="ml-1 text-primary">SELLING PRICE</label> -->
                                 <input type="hidden" class="form-control" id="id1" name="sales_selling_price" value="<?php echo $result['sales_selling_price']; ?>" aria-describedby="" required />
                              </div>


                              <div class="form-group">
                                 <!-- <label for="id1" class="ml-1 text-primary">QUANTITY</label> -->
                                 <input type="hidden" class="form-control" id="id1" name="sales_quantity" value="<?php echo $result['sales_quantity']; ?>" aria-describedby="" required />
                              </div>

                              <div class="form-group">
                                 <!--  <label for="id1" class="ml-1 text-primary">TOTAL</label> -->
                                 <input type="hidden" class="form-control" id="id1" name="sales_total" value="<?php echo $result['sales_total']; ?>" aria-describedby="" required />
                              </div>
                              <div class="form-group">
                                 <!-- <h6 for="id1" class=" ml-1 text-danger">DUE</h6> -->
                                 <input type="hidden" class="border border-danger" name="sales_due" value="<?php echo $result['sales_due']; ?>">
                              </div>
                              <div class="form-group">
                                 <!-- <h6 for="id1" class=" ml-1 text-danger">PAID</h6> -->

                                 <input type="hidden" class="border border-danger" name="sales_paid" value="<?php echo $result['sales_paid']; ?>">
                              </div>

                              <div class="form-group">
                                 <h6 for="id1" class="font-weight-bold ml-1">PRODUCT NAME</h6>
                                 <span class="text-danger font-weight-bold ml-2"><?php echo $result['sales_prdct_name']; ?></span>
                                 <input type="hidden" class="border border-danger" name="product_name" value="<?php echo $result['sales_prdct_name']; ?>">
                              </div>
                              <div class="form-group">
                                 <h6 for="id1" class="font-weight-bold ml-1">RETURNED QUANTITY</h6>
                                 <span class="text-danger font-weight-bold ml-2"><?php echo $result['sales_quantity']; ?></span>
                                 <input type="hidden" class="border border-danger" id="id1" name="product_quantity" aria-describedby="" value="<?php echo $result['sales_quantity']; ?>" />
                              </div>
                              <div class="form-group">
                                 <!-- <h6 for="id1" class="font-weight-bold ml-1">SELLING PRICE</h6> -->
                                 <!-- <span class="text-danger font-weight-bold ml-2"><?php /* echo $result['sales_selling_price'];  */ ?></span> -->
                                 <input type="hidden" class="border border-danger" name="product_price" value="<?php echo  $result['sales_buying_price'];  ?>">
                              </div>
                           </div>

                        </div>
                        <button type="submit" class="btn btn-primary float-right mt-1">Return</button>
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
<?php include "inc/footer.php"; ?>