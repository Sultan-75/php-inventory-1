<?php

include "inc/header.php";
?>
<?php if (!Session::get('userRole') == '0') {
   echo "<script> window.location='dashboard.php';</script> ";
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['submit1'])) {
      $name = $_POST["name"];
      $phone = $_POST["phone"];
      $email = $_POST["email"];
      $salary = $_POST["salary"];

      $address = $_POST["address"];
      $nid = $_POST["nid"];

      $insert_query = "INSERT INTO tbl_staff (staff_name, staff_phone, staff_email,staff_salary,staff_address,staff_nid) 
    VALUES ('$name','$phone','$email','$salary','$address','$nid') ";




      $redirect = $db->insert($insert_query);
      if ($redirect) {
         echo "<div class='mx-auto text-light bg-success text-center py-2 px-3 w-50'> Data Insesrted Succesfuly </div>";
         echo "<meta http-equiv='refresh' content='1;url=staff_info.php'>";

?>
         <!-- <meta http-equiv='refresh' content='1;url=staff.php'> -->
<?php
      } else {
         echo "<div class='mx-auto text-light bg-danger text-center py-2 px-3 w-50'>Something Went Wrong </div>";
      }
   }
}
?>


<!-- Container Fluid-->
<div class="container-fluid">
   <div class="container">
      <h1 class="text-center my-2 text-white font-weight-bold">Staff Section</h1>
      <div class="d-flex justify-content-between">
         <a href="staff_info.php" class="btn btn-info font-weight-bold">Manage Staff Information</a>
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary font-weight-bold" data-toggle="modal" data-target="#staticBackdrop">
            Add New Staff
         </button>
         <div class="modal fade " id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header text-center">
                     <h5 class="modal-title text-primary font-weight-bold" id="staticBackdropLabel"> Add New Staff</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form action="staff.php" method="POST">
                        <div class="row">
                           <div class="col">
                              <input type="text" name="name" class="form-control" placeholder="Name" required>
                           </div>
                           <div class="col">
                              <input type="number" name="phone" class="form-control" placeholder="Phone" required>
                           </div>
                        </div>
                        <div class="row my-2">
                           <div class="col">
                              <input type="email" name="email" class="form-control" placeholder="Email" required>
                           </div>
                           <div class="col">
                              <input type="text" name="salary" class="form-control" placeholder="Salary" required>
                           </div>
                        </div>
                        <div class="row my-2">
                           <div class="col">
                              <input type="text" name="address" class="form-control" placeholder="Address" required>
                           </div>
                           <div class="col">
                              <input type="text" name="nid" class="form-control" placeholder="NID or Birth Certificate" required>
                           </div>
                        </div>
                        <div class="float-right">
                           <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                           <input type="submit" name="submit1" class="btn btn-success btn-sm" value="Add Staff">
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>


   </div>
   <div class="row mt-3">
      <div class="col-md-5">
         <table class="table table-bordered table-hover">
            <thead>
               <tr class="bg-primary text-light">
                  <th>#</th>
                  <th>Name</th>
                  <th>Salary</th>
                  <th>Action</th>
               </tr>
            </thead>
            <?php
            $query = "SELECT * FROM tbl_staff";
            $staff = $db->select($query);
            if ($staff) {
               $sn = 1;
               while ($result = $staff->fetch_assoc()) {


            ?>
                  <tbody>
                     <tr class="text-dark bg-light">
                        <td><?php echo $sn;
                              $sn++; ?></td>
                        <td><?php echo $result['staff_name']; ?> </td>
                        <td><?php echo $result['staff_salary']; ?> </td>
                        <td>
                           <!-- Button trigger modal -->
                           <a href="staff_trans.php?tran_id=<?php echo $result['staff_id']; ?>" class="btn btn-primary btn-sm">New Transaction</a>
                        </td>
                     </tr>
                  </tbody>

            <?php
               }
            } ?>

            <!-- Modal -->

         </table>

      </div>

      <div class="col-md-7">
         <div class="bg-light pt-3 px-2">
            <table id="sort_product" class="table table-bordered">
               <thead>
                  <tr class="bg-primary text-white">
                     <th>#</th>
                     <th>Name</th>
                     <th>Cause</th>
                     <th>Amount</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $Squery = "SELECT * FROM tbl_staff_trans";
                  $staffTrans = $db->select($Squery);
                  if ($staffTrans) {
                     $sn = 1;
                     while ($result = $staffTrans->fetch_assoc()) {
                  ?>
                        <tr class="bg-light text-dark">
                           <td><?php echo $sn;
                                 $sn++; ?></td>
                           <td><?php echo $result['trans_name']; ?></td>
                           <td><?php echo $result['trans_option']; ?></td>
                           <td><?php echo $result['trans_amount']; ?></td>
                           <td><?php echo $result['trans_date']; ?></td>
                        </tr>
                  <?php }
                  } ?>
               </tbody>
            </table>

         </div>
      </div>

   </div>
</div>
<!---Container Fluid-->
<?php include "inc/footer.php"; ?>