<?php

include "inc/header.php";
?>
<?php if (!Session::get('userRole') == '0') {
   echo "<script> window.location='dashboard.php';</script> ";
}
?>

<?php
$exup_id = $_GET['exup_id'];
$query = "SELECT * FROM tbl_expence WHERE ex_id=$exup_id";
$getexpence = $db->select($query)->fetch_assoc();

if (isset($_POST['submit'])) {

   $details = $_POST["details"];
   $amount = $_POST["amount"];




   $query = "UPDATE tbl_expence SET  ex_details = '$details', 
ex_amount='$amount' WHERE ex_id='$exup_id' ";

   $updateExpence = $db->update($query);
   if ($updateExpence) {
      echo "<meta http-equiv='refresh' content='0.5;url=expence.php'>";
   }
}


?>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
         <div class="card mt-3">
            <div class="card-title pt-2">
               <h4 class="text-center text-primary font-weight-bold">Update Expence</h4>
            </div>
            <hr class="bg-primary">
            <div class="card-body">

               <form action="expence_update.php?exup_id=<?php echo $exup_id; ?>" method="POST">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Expence Details</label>
                     <input type="text" name="details" class="form-control" value="<?php echo $getexpence['ex_details']; ?>" id="exampleInputEmail1" required>

                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">Amount</label>
                     <input type="text" name="amount" class="form-control" value="<?php echo $getexpence['ex_amount']; ?>" id="exampleInputPassword1" required>
                  </div>
                  <button type="submit" name="submit" class="btn btn-success float-right  font-weight-bold px-5 py-2">Update</button>
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-3"></div>
   </div>

</div>

<?php include "inc/footer.php";
