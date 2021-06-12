<?php include "inc/header.php"; ?>

<div class="container-fluid">
   <div class="bg-light mt-2 px-2">
      <table id="sort_product" class="bg-light table table-striped table-bordered ">
         <h1 class="h3 mb-0 text-primary bg-light text-center pt-3 pb-2 font-weight-bold">DUE LIST</h1>
         <thead>
            <tr class="bg-primary text-white text-center">
               <th scope="col">#</th>
               <th scope="col">Sold ID</th>
               <th scope="col">Customer Name</th>
               <th scope="col">Product Name</th>
               <!-- <th scope="col">Buying Price</th> -->
               <th scope="col">Selling Price</th>
               <th scope="col">Quantity</th>
               <th scope="col">Total</th>
               <th scope="col">Paid</th>
               <th scope="col">Due</th>
               <!--  <th scope="col">Profit</th> -->
               <th scope="col">Date</th>
               <th scope="col">Action</th>
            </tr>
         </thead>
         <tbody class="text-dark">
            <?php
            $query = "SELECT * FROM tbl_sales where sales_due > 0";
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
                        <?php echo $result['sales_id']; ?>
                     </td>
                     <td>
                        <?php echo $result['sales_cstmr_name']; ?>
                     </td>
                     <td>
                        <?php echo $result['sales_prdct_name']; ?>
                     </td>

                     <!-- <td>
                        <?php /* echo $result['sales_buying_price']; */ ?>
                     </td> -->
                     <td>
                        <?php echo $result['sales_selling_price']; ?>
                     </td>
                     <td>
                        <?php echo $result['sales_quantity']; ?>
                     </td>
                     <td>
                        <?php echo $result['sales_total']; ?>
                     </td>
                     <td>
                        <?php echo $result['sales_paid']; ?>
                     </td>
                     <td>
                        <?php echo $result['sales_due']; ?>
                     </td>
                     <!--  <td>
                        <?php /* echo $result['sales_profit']; */ ?>
                     </td> -->
                     <td><?php echo $fm->formatDate($result['sales_date']); ?></td>
                     <td>

                        <a data-toggle="tooltip" data-placement="top" title="Update" onclick="return confirm('Update Due List !');" href="due_list_update.php?due=<?php echo $result['sales_id']; ?>" class="font-weight-bold btn btn-sm btn-warning">
                           Update
                        </a>

                     </td>
                  </tr>

            <?php }
            } ?>
         </tbody>
      </table>
   </div>

</div>

<?php include "inc/footer.php"; ?>