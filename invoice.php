<?php
include "inc/format.php";
include "inc/config.php";
include "inc/db_con.php";


$db = new Database();
$fm = new format();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice</title>
  <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <style>
    body {
      margin-top: 20px;
      background: #eee;
    }

    .invoice {
      background: #fff;
      padding: 10px;
    }

    .invoice-company {
      font-size: 20px;
    }

    .invoice-header {
      margin: 0 20px;
      background: #f0f3f4;
      padding: 10px;
    }

    .invoice-date,
    .invoice-from,
    .invoice-to {
      display: table-cell;
      width: 1%;
    }

    /* .invoice-from,
      .invoice-to {
        padding-right: 20px;
      } */

    .invoice-date .date,
    .invoice-from strong,
    .invoice-to strong {
      font-size: 16px;
      font-weight: 600;
    }

    .invoice-date {
      text-align: right;
      padding-left: 20px;
    }

    .invoice-price {
      background: #f0f3f4;
      display: table;
      width: 100%;
    }

    .invoice-price .invoice-price-left,
    .invoice-price .invoice-price-right {
      display: table-cell;
      padding: 20px;
      font-size: 20px;
      font-weight: 600;
      width: 75%;
      position: relative;
      vertical-align: middle;
    }

    .invoice-price .invoice-price-left .sub-price {
      display: table-cell;
      vertical-align: middle;
      padding: 0 20px;
    }

    .invoice-price small {
      font-size: 12px;
      font-weight: 400;
      display: block;
    }

    .invoice-price .invoice-price-row {
      display: table;
      float: left;
    }

    .invoice-price .invoice-price-right {
      width: 25%;
      background: #fff;
      border: #F0F3F4 3px solid;
      color: #2d353c;
      font-size: 25px;
      text-align: right;
      vertical-align: bottom;
      font-weight: 400;
    }

    .invoice-price .invoice-price-right small {
      display: block;
      opacity: 0.6;
      position: absolute;
      top: 10px;
      left: 10px;
      font-size: 12px;
    }

    .invoice-footer {
      border-top: 1px solid #ddd;
      padding-top: 10px;
      font-size: 10px;
    }

    .invoice-note {
      color: #999;
      margin-top: 50px;
      font-size: 85%;
    }

    .invoice>div:not(.invoice-footer) {
      margin-bottom: 20px;
    }

    .btn.btn-white,
    .btn.btn-white.disabled,
    .btn.btn-white.disabled:focus,
    .btn.btn-white.disabled:hover,
    .btn.btn-white[disabled],
    .btn.btn-white[disabled]:focus,
    .btn.btn-white[disabled]:hover {
      color: #2d353c;
      background: #fff;
      border-color: #d9dfe3;
    }
  </style>
</head>
<?php
$invoice = $_GET['invoice'];


?>

<body>
  <div class="container">
    <div class="col-md-12">
      <div class="invoice">
        <!-- begin invoice-company -->
        <div class="invoice-company text-center f-w-600"><strong>Shop</strong> Demo Inventory Management System</div>
        <!-- end invoice-company -->
        <!-- begin invoice-header -->
        <div class="invoice-header">
          <div class="container">
            <div class="invoice-from">
              <address class="m-t-5 m-b-5">
                <strong class="text-inverse text-dark font-weight-bold">Mr Carpio</strong><br />

                loreum, Ispoo<br />
                0101500000<br />
                demo@gmail.com
              </address>
            </div>
            <?php
            $query = "SELECT * FROM tbl_sales WHERE sales_id=$invoice";
            $getInvoice = $db->select($query);
            if ($getInvoice) {

              while ($result = $getInvoice->fetch_assoc()) {



            ?>
                <div class="invoice-date">
                  <div class="date text-inverse m-t-5">Date : <?php echo $fm->formatDate2($result['sales_date']); ?></div>
                  <div class="date text-inverse m-t-5">Sold ID : <?php echo $result['sales_id']; ?></div>
                </div>
          </div>
        </div>
        <!-- end invoice-header -->
        <!-- begin invoice-content -->
        <div class="invoice-content">
          <!-- begin table-responsive -->
          <div class="table-responsive">
            <table class="table table-invoice">
              <thead>
                <tr>
                  <th>#</th>
                  <th class="text-center" width="">CUSTOMER NAME</th>
                  <th class="text-center" width="">PRODUCT NAME</th>
                  <th class="text-center" width="">QUANTITY</th>
                  <th class="text-center" width="">PRODUCT PRICE</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td class="text-center"><?php echo $result['sales_cstmr_name']; ?></td>
                  <td class="text-center"><?php echo $result['sales_prdct_name']; ?></td>
                  <td class="text-center"><?php echo $result['sales_quantity']; ?></td>
                  <td class="text-center"><?php echo $result['sales_selling_price']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- end table-responsive -->
          <!-- begin invoice-price -->
          <div class="invoice-price">
            <div class="invoice-price-left text-center">
              <div class="invoice-price-row">
                <div class="sub-price">
                  <strong>PAID</strong><br />
                  <span class="text-inverse"><?php echo $result['sales_paid']; ?></span>
                </div>

                <div class="sub-price">
                  <strong>DUE</strong><br />
                  <span class="text-inverse"><?php echo $result['sales_due']; ?></span>
                </div>
              </div>
            </div>
            <div class="invoice-price-right text-center">
              <strong>TOTAL</strong> <br />
              <span class="f-w-600"><?php echo $result['sales_total']; ?></span>
            </div>
          </div>
          <!-- end invoice-price -->
        </div>
    <?php
              }
            }
    ?>
    <!-- end invoice-content -->
    <!-- begin invoice-footer -->
    <div class="invoice-footer">
      <p class="text-center m-b-5 f-w-600">THANK YOU FOR YOUR BUSINESS</p>
    </div>
    <!-- end invoice-footer -->
      </div>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script>
    onload = window.print();
  </script>
</body>

</html>