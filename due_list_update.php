<?php include "inc/header.php"; ?>
<?php if (!Session::get('userRole') == '0') {
   echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php

$due = $_GET['due'];

$query = "SELECT * FROM tbl_sales WHERE sales_id=$due";
$getProduct = $db->select($query)->fetch_assoc();



if (isset($_POST['submit'])) {
   $new_pay = $_POST['new_pay'];
   $sales_due = $_POST['sales_due'];
   $sales_paid = $_POST['sales_paid'];
   $last_pay = $sales_due - $new_pay;
   $last_paid = $sales_paid + $last_pay;


   if ($due > 0) {


      $query = "UPDATE tbl_sales SET  
         sales_paid='$last_paid',
        sales_due = '$last_pay'
        WHERE sales_id='$due'";

      $updateMethod = $db->update($query);
      if ($updateMethod) {
         echo "<meta http-equiv='refresh' content='0.5;url=due_list.php' </meta>";
      }
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
               <h4 class="text-center pt-2 font-weight-bold text-primary">Due UPDATE</h4>
            </div>
            <div class="card-body">
               <form action="due_list_update.php?due=<?php echo $due; ?>" method="post">

                  <div class="form-row mb-0">
                     <div class="form-group col-md-6">
                        <label for="inputEmail4" class="text-primary">NAME </label>
                        <input type="text" readonly name="customer_name" value="<?php echo $getProduct['sales_cstmr_name']; ?>" class="form-control" id="inputEmail4">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="inputPassword4" class="text-primary">DUE </label>
                        <input type="text" readonly name="sales_due" value="<?php echo $getProduct['sales_due']; ?>" class="form-control" id="inputPassword4">
                     </div>
                  </div>

                  <div class="form-group">
                     <!--  <label for="id1" class="ml-1 text-primary"> SALES PAID </label> -->
                     <input type="hidden" name="sales_paid" value="<?php echo $getProduct['sales_paid']; ?>" class="form-control" id="id1" aria-describedby="" required />
                  </div>
                  <div class="form-group mt-0">
                     <label for="id1" class="ml-1 text-primary"> NEW PAYMENT </label>
                     <input type="text" name="new_pay" class="form-control" id="id1" aria-describedby="" required />
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary mt-1 float-right">UPDATE DUE</button>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-3"></div>
   </div>
</div>
<!---Container Fluid-->
<?php include "inc/footer.php"; ?>