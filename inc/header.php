<?php
include "session.php";
Session::checkSession();
?>
<?php
include "config.php";
include "db_con.php";
include "format.php";

?>
<?php
$userId = Session::get('userId');
$userrole = Session::get('userRole');
?>
<?php
$db = new Database();
$fm = new format();

?>
<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- fontawsome css -->
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <!-- Boostrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom css -->
    <link rel="stylesheet" href="css/dashboard.css" />
    <!-- datatable css file -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon">
                    <i class="fa fa-motorcycle fa-3x"></i>
                </div>
                <!-- <div class="sidebar-brand-text mx-3">Amin & Tahmid</div> -->
            </a>
            <hr class="sidebar-divider my-0" />

            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider" />
            <div class="sidebar-heading mb-1">Dashboard Features</div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Company" aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="fas fa-motorcycle" aria-hidden="true"></i>
                    <span>Products </span>
                </a>
                <div id="Company" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products</h6>

                        <a class="collapse-item" href="product_list.php">Product Lists</a>
                        <?php if (Session::get('userRole') == '0') { ?>
                            <a class="collapse-item" href="add_product.php"> Add Product</a>
                        <?php } ?>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Managers" aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Sales</span>
                </a>
                <div id="Managers" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sales</h6>
                        <a class="collapse-item" href="sold_list.php">Sold</a>


                    </div>
                </div>
            </li>
            <?php if (Session::get('userRole') == '0') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Drivers" aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>Staff</span>
                    </a>
                    <div id="Drivers" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Staff</h6>
                            <a class="collapse-item" href="staff.php">Staff</a>
                            <a class="collapse-item" href="staff_info.php"> Staff Information</a>

                        </div>
                    </div>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#list" aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="far fa-file-alt" aria-hidden="true"></i>
                    <span>Lists</span>
                </a>
                <div id="list" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Lists</h6>
                        <a class="collapse-item" href="return_list.php">Return List</a>
                        <a class="collapse-item" href="due_list.php">Due List</a>
                    </div>
                </div>
            </li>
            <?php if (Session::get('userRole') == '0') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Expences" aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="fas fa-hand-holding-usd" aria-hidden="true"></i>
                        <span>Expenses</span>
                    </a>
                    <div id="Expences" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Expenses</h6>
                            <a class="collapse-item" href="expence.php">Expenses</a>

                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Expences1" aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                        <span>Report</span>
                    </a>
                    <div id="Expences1" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Report</h6>
                            <a class="collapse-item" href="datepicker.php">Reports</a>
                            <a class="collapse-item" href="invoice_range.php">Invoices</a>

                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!--  <img class="img-profile rounded-circle" src="" style="max-width: 60px" /> -->
                                <span class="ml-2 d-none d-lg-inline text-white font-weight-bold">Hi, <?php echo Session::get('username'); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <?php if (Session::get('userRole') == '0') { ?>
                                    <a class="dropdown-item" href="setting.php">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>

                                <?php } ?>
                                <hr>

                                <a class="dropdown-item" href="?action=logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>