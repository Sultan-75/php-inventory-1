<?php

include "inc/header.php";
?>

<?php if (!Session::get('userRole') == '0') {
   echo "<script> window.location='dashboard.php';</script> ";
}
?>

<?php
if (isset($_GET['del_ex'])) {
   $del_ex = $_GET['del_ex'];
   $delquery = "DELETE FROM tbl_expence WHERE ex_id ='$del_ex' ";
   $del = $db->delete($delquery);
   if ($del) {
      /*  echo "<script>alert('Deleted  Succesfuly')</script></div>"; */
      echo "<meta http-equiv='refresh' content='.5;url=expence.php'>";
   }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $details = $_POST['details'];
   $amount = $_POST['amount'];

   $insertquery = "INSERT INTO tbl_expence (ex_details,ex_amount) VALUES('$details','$amount') ";
   $insertDone = $db->insert($insertquery);
   if ($insertDone) { ?>
      <!-- <meta http-equiv='refresh' content='1;url=expence.php'>; -->
<?php }
}
?>
<!-- Container Fluid-->
<div class="container-fluid">
   <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
         <div class="card mt-3">
            <div class="card-head">
               <h4 class="text-center text-primary font-weight-bold mt-3"> Expense Details</h4>
            </div>
            <div class="card-body">

               <div class="bg-white">
                  <div class="table-responsive px-2">
                     <table id="sort_product" class="bg-light table table-striped table-bordered table-hover">
                        <thead>
                           <tr class="bg-primary text-white">
                              <th>#</th>
                              <th>Expense Details</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $query = "SELECT * FROM tbl_expence order by ex_id desc";
                           $category = $db->select($query);
                           if ($category) {
                              $sn = 1;
                              while ($result = $category->fetch_assoc()) {



                           ?>
                                 <tr class="text-dark">
                                    <td><?php echo $sn;
                                          $sn++;   ?></td>
                                    <td><?php echo $result['ex_details']; ?></td>
                                    <td><?php echo $result['ex_amount']; ?></td>
                                    <td><?php echo $fm->formatDate($result['date']); ?></td>
                                    <td>
                                       <a href="expence_update.php?exup_id=<?php echo $result['ex_id']; ?>" class="btn btn-primary">EDIT</a>


                                       <!-- Button trigger modal -->
                                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop2">
                                          Delete
                                       </button>

                                       <!-- Modal -->
                                       <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered modal-sm">
                                             <div class="modal-content">

                                                <div class="modal-body">
                                                   Are you sure to delete!.
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-danger btn-sm font-weight-bold" data-dismiss="modal">Close</button>
                                                   <a href="?del_ex=<?php echo $result['ex_id']; ?>" class="btn btn-success btn-sm font-weight-bold">DELETE
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>

                                    </td>
                                 </tr>
                           <?php }
                           } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-2">
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-primary mt-3 font-weight-bold" data-toggle="modal" data-target="#staticBackdrop">
            Add New Record
         </button>

         <!-- Modal -->
         <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">

                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <h4 class="text-center text-primary font-weight-bold">New Expense</h4>
                     <form action="" method="POST">
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="text-primary">Expense Details</label>
                           <input type="text" name="details" class="form-control" id="exampleInputEmail1" required>

                        </div>
                        <div class="form-group">
                           <label for="exampleInputPassword1" class="text-primary">Amount</label>
                           <input type="text" name="amount" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <div class="d-flex justify-content-between">
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                     </form>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!---Container Fluid-->
<?php include "inc/footer.php";
