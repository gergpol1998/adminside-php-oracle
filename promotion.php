<?php
session_start();
include "conn.php";
if (!isset($_SESSION["USERNAME"])) {
    header("location:./login/login.php");
}

//query MAX ID
$sql = "SELECT MAX(RANK_ID) AS LAST_ID FROM RANK";
$result = oci_parse($conn, $sql);
oci_execute($result);
$row = oci_fetch_assoc($result);
$maxId = substr($row['LAST_ID'], -3); //ดึงค่าไอดีล่าสุดจากตารางข้อมูลที่จะบันทึก

$maxId = ($maxId + 1);  //บวกค่าเพิ่มอีก 1

$maxId = substr("00000".$maxId, -3);
$nextId = $maxId; //นำข้อมูลทั้งหมดมารวมกัน
oci_close($conn);

include "permission.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>addpromotion</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>

            

            

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Manage:</h6>
                        <a class="collapse-item" href="show_user.php">Users</a>
                        <a class="collapse-item" href="show_product.php">Product</a>

                        <?php if(in_array(1,$permis)){?>
                        <a class="collapse-item" href="show_promotion.php">promotion</a>
                        <?php }?>

                        <?php if(in_array(3,$permis)){?>
                        <a class="collapse-item" href="report_order.php">Report</a>
                        <?php }?>
                        
                        <?php if(in_array(5,$permis)){?>
                        <a class="collapse-item" href="addpermis.php">Permission</a>
                        <?php }?>
                    </div>
                </div>
            </li>
            
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="reports.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>report</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="./login/login.php">Login</a>
                    </div>
                </div>
            </li>

            


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include "menu.php";?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Manage <sub>Promotion</sub></h1>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="alert alert-primary h4 text-center mb-4 mt-4" role="alert">
                                เพิ่มข้อมูลโปรโมชั่น
                            </div>
                            <form class="form" action="insert_promotion.php" method="post"> <br>
                                <label>รหัสแรงค์:</label>
                                <input type="text" name="rankid" class="form-control" value="<?php echo $nextId; ?>" readonly  require> <br>

                                <label>ชื่อแรงค์:</label>
                                <input type="text" name="rankname" class="form-control" placeholder="ชื่อแรงค์..." require> <br>

                                <label>ส่วนลด:</label>
                                <input type="number" name="discount" class="form-control" placeholder="ส่วนลด..." require> <br>

                                <label>ยอดแรงค์ขึ้น:</label>
                                <input type="number" name="rankup" class="form-control" placeholder="ยอดแรงค์ขึ้น..." require> <br>
                                 <br>
                                
                                <input type="submit" class="btn btn-primary" name="submit" value="submit">
                                <a class="btn btn-danger" href="show_user.php" role="button">cancel</a>
                            </form><br>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

                <?php include "footer.php";?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="./login/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

</body>

</html>