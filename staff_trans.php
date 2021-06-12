<?php include "inc/header.php"; ?>
<?php if (!Session::get('userRole') == '0') {
   echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php
if (isset($_GET['tran_id'])) {
   $tran_id = $_GET['tran_id'];

   $query = "SELECT * FROM tbl_staff where staff_id=$tran_id";
   $staff = $db->select($query)->fetch_assoc();
}

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['submit2'])) {
      $f_key = $_POST['f_key'];
      $trans_amount = $_POST['trans_amount'];
      $trans_option = $_POST['trans_option'];
      $nam = $_POST['trans_name'];

      $query = "INSERT INTO tbl_staff_trans (f_key,trans_name, trans_option,trans_amount)
                  VALUES ('$f_key','$nam','$trans_option','$trans_amount') ";

      $redirect = $db->insert($query);
      if ($redirect) {
         echo "<script> alert('Staff Transaction Inserted !!');</script>";
         echo "<meta http-equiv='refresh' content='1;url=staff.php'>";
      }
   }
}
?>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
         <div class="card mt-5">
            <div class="card-body">
               <div class="mb-5 mt-3 card-title text-center text-success">
                  <h3 class=" text-uppercase font-weight-bold">Staff Transaction</h3>
                  <hr style="height: 1px;" class="bg-success">
               </div>
               <form action="staff_trans.php?tran_id=<?php echo $tran_id; ?>" method="POST">
                  <div class="row">
                     <div class="col">
                        <input type="hidden" name="f_key" class="form-control" value="<?php echo $staff['staff_id']; ?>">
                     </div>

                     <div class="col">
                        <input type="hidden" name="trans_name" class="form-control" value="<?php echo $staff['staff_name']; ?>">
                     </div>
                  </div>
                  <div class="row">
                     <span class="text-center w-100 pb-3 font-weight-bold h5"> Staff Name : <?php echo $staff['staff_name']; ?> </span>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <input type="text" name="trans_amount" class="form-control" placeholder="Amount.." required>
                     </div>

                     <div class="col-md-6">
                        <select name="trans_option" id="" class="form-control">
                           <option value="">Select Option</option>
                           <option value="Salary">Salary</option>
                           <option value="TA/DA">TA/DA</option>
                           <option value="Others">Others</option>
                        </select>
                     </div>
                  </div>
                  <input type="submit" name="submit2" class="float-right mt-5 btn btn-success" value="Submit Data">
               </form>
            </div>
         </div>
      </div>
      <div class="col-md-3"></div>
   </div>

</div>
<?php include "inc/footer.php"; ?>