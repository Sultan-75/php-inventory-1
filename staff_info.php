<?php
include "inc/header.php";
?>
<?php if (!Session::get('userRole') == '0') {
    echo "<script> window.location='dashboard.php';</script> ";
}
?>
<div class="container-fluid">

    <div class="bg-white py-3 px-1 mt-2">
        <h3 class="font-weight-bold text-center text-primary">Staff Information</h3>
        <table id="sort_product" class="table table-striped table-bordered">
            <thead>
                <tr class="bg-primary text-light">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Address</th>
                    <th scope="col">NID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tbl_staff order by staff_id asc";
                $category = $db->select($query);
                if ($category) {
                    $sn = 1;
                    while ($result = $category->fetch_assoc()) {



                ?>
                        <tr class="bg-light text-dark">

                            <td><?php echo $sn;
                                $sn++;  ?> </td>
                            <td><?php echo $result['staff_name']; ?></td>
                            <td><?php echo $result['staff_phone']; ?></td>
                            <td><?php echo $result['staff_email']; ?></td>
                            <td><?php echo $result['staff_salary']; ?></td>
                            <td><?php echo $result['staff_address']; ?></td>
                            <td><?php echo $result['staff_nid']; ?></td>
                            <td>
                                <a href="staff_update.php?staff_up=<?php echo $result['staff_id']; ?>" class="btn btn-primary">EDIT</a>
                            </td>
                        </tr>
                <?php }
                } ?>

            </tbody>
        </table>
    </div>
</div>

<?php include "inc/footer.php"; ?>