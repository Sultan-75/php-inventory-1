
<?php

// Product Total er Buying price ->----//
foreach ($db->select('SELECT SUM(product_total) 
FROM tbl_product') as $row) {

    $product_total = $row['SUM(product_total)'];
}
// Sales Total er Selling price -> ----//
foreach ($db->select('SELECT SUM(sales_total) 
FROM tbl_sales') as $row) {

    $sales_total = $row['SUM(sales_total)'];
}

// Staff er  Sate Transaction  ------->//
foreach ($db->select('SELECT SUM(trans_amount) 
FROM tbl_staff_trans') as $row) {

    $trans_amount = $row['SUM(trans_amount)'];
}
// Dukan er Extra Koroch  ------->//
foreach ($db->select('SELECT SUM(ex_amount) 
FROM tbl_expence') as $row) {

    $ex_amount = $row['SUM(ex_amount)'];
}


// Dukan Baki   ------->//
foreach ($db->select('SELECT SUM(sales_due) 
FROM tbl_sales') as $row) {

    $sales_due = $row['SUM(sales_due)'];
}
// Dukan er Lav  ------->//


foreach ($db->select('SELECT SUM(sales_profit) 
FROM tbl_sales') as $row) {

    $sales_profit = $row['SUM(sales_profit)'];
}
// lost capital 
/* foreach ($db->select('SELECT SUM(cap_loss) 
FROM tbl_net_capital') as $row) {

    $cap_loss = $row['SUM(cap_loss)'];
} */

$profit = $sales_profit - ($ex_amount + $trans_amount);
// date wise seasrch ------->//

// Muldon Hisab  ------->//
/* $sales_buying_price = $sales_total - $sales_profit;
$capital = ($product_total + $sales_buying_price) - $cap_loss; */

?>



