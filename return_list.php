<?php include "inc/header.php"; ?>
<?php
if (isset($_GET['del_return'])) {
   $del_return = $_GET['del_return'];
   $delquery = "DELETE FROM tbl_return WHERE return_id='$del_return' ";
   $del = $db->delete($delquery);
   if ($del) {
      /*  echo "<script>alert('Deleted  Succesfuly')</script></div>"; */
      echo "<meta http-equiv='refresh' content='.5;url=return_list.php'>";
   }
}
?>
<div class="container-fluid">
   <div class="bg-light mt-2 px-2">
      <table id="sort_product" class="bg-light table table-striped table-bordered ">
         <h1 class="h3 mb-0 text-primary bg-light text-center pt-3 pb-2 font-weight-bold">RETURN LIST</h1>
         <thead>
            <tr class="bg-primary text-white text-center">
               <th scope="col">#</th>

               <th scope="col">Customer Name</th>
               <th scope="col">Product Name</th>
               <th scope="col">Selling Price</th>
               <th scope="col">Quantity</th>
               <th scope="col">Total</th>
               <th scope="col">Paid</th>
               <th scope="col">Due</th>
               <th scope="col">Date</th>
               <th scope="col">Action</th>
            </tr>
         </thead>
         <tbody class="text-dark">
            <?php
            $query = "SELECT * FROM tbl_return order by return_id desc";
            $category = $db->select($query);
            if ($category) {
               $sn = 1;
               while ($result = $category->fetch_assoc()) {

            ?>
                  <tr class="text-center">
                     <td><?php echo $sn;
                           $sn++;   ?>
                     </td>

                     <td>
                        <?php echo $result['cstmr_name']; ?>
                     </td>
                     <td>
                        <?php echo $result['prdct_name']; ?>
                     </td>
                     <td>
                        <?php echo $result['selling_price']; ?>
                     </td>
                     <td>
                        <?php echo $result['quantity']; ?>
                     </td>
                     <td>
                        <?php echo $result['total']; ?>
                     </td>
                     <td>
                        <?php echo $result['paid']; ?>
                     </td>
                     <td>
                        <?php echo $result['due']; ?>
                     </td>
                     <td><?php echo $fm->formatDate($result['date']); ?></td>
                     <td>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop2">
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
                                    <button type="button" class="btn btn-secondary btn-sm font-weight-bold" data-dismiss="modal">Close</button>
                                    <a href="?del_return=<?php echo $result['return_id']; ?>" class="btn btn-danger btn-sm font-weight-bold">DELETE
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

<?php include "inc/footer.php"; ?>