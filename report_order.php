<?php
session_start();
if (!isset($_SESSION["USERNAME"])) {
    header("location:./login/login.php");
}

include "conn.php";
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

    <title>report</title>

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

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="reports.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>report</span></a>
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

                <?php include "menu.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Report</h1>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->



                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h3 class="m-0 font-weight-bold text-primary">แสดงข้อมูลการสั่งซื้อสินค้าที่ยังไม่ได้ชำระเงิน</h3><br>
                                <div>
                                    <a href="report_order_yes.php"><button type="button" class="btn btn-outline-success">ชำระเงินแล้ว</button></a>
                                    <a href="report_order.php"><button type="button" class="btn btn-outline-success">ยังไม่ชำระเงิน</button></a>
                                    <a href="report_order_no.php"><button type="button" class="btn btn-outline-success">ยกเลิกใบสั่งซื้อ</button></a>
                                </div>
                                <br>
                                <div>
                                    <form name="form2" method="POST" action="report_order.php">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <input type="date" name="date1" class="form-control">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="date" name="date2" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>เลขที่ใบสั่งซื้อ</th>
                                                <th>ลูกค้า</th>
                                                <th>ที่อยู่จัดส่ง</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>ราคารวมสุทธิ</th>
                                                <th>วันที่สั่งซื้อ</th>
                                                <th>สถานะการสั่งซื้อ</th>
                                                <th>รายละเอียดการสั่งซื้อ</th>
                                                <th>ปรับสถานะการชำระเงิน</th>
                                                <th>ยกเลิกการสั่งซื้อ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $dt1 =@$_POST['date1'];
                                            $dt2 =@$_POST['date2'];
                                            $add_date1 = date('d-m-Y', strtotime($dt1));
                                            $add_date2 = date('d-m-Y', strtotime($dt2 . "+1 days"));

                                            if(($dt1 != "") && ($dt2 != "")){
                                                echo "ค้นหาจากวันที่ $dt1 ถึง $dt2 ";
                                                $sql = "SELECT * 
                                                FROM TB_ORDER,ORDER_LIST,CUSTOMER,CM_ADDRESS,PRODUCTDETAIL,PRODUCT
                                                WHERE (TB_ORDER.ORDER_NO = ORDER_LIST.ORDER_NO AND CUS_ID = CUSTOMER_ID AND CM_ID = CUSTOMER_ID
                                                AND ORDER_PRODUCT = PROID AND ORDER_PRO_NO = PRODUCTDETAIL.NO AND PRODUCT_ID = PRODUCTDETAIL.PROID)
                                                AND ORDER_STATUS = 1 AND ORDER_DATE BETWEEN TO_DATE('" . $add_date1 . "','dd-mm-yy') AND  TO_DATE('" . $add_date2 . "','dd-mm-yy')
                                                ORDER BY ORDER_DATE DESC";
                                            }
                                            else{
                                                $sql = "SELECT * 
                                                FROM TB_ORDER,ORDER_LIST,CUSTOMER,CM_ADDRESS,PRODUCTDETAIL,PRODUCT
                                                WHERE (TB_ORDER.ORDER_NO = ORDER_LIST.ORDER_NO AND CUS_ID = CUSTOMER_ID AND CM_ID = CUSTOMER_ID
                                                AND ORDER_PRODUCT = PROID AND ORDER_PRO_NO = PRODUCTDETAIL.NO AND PRODUCT_ID = PRODUCTDETAIL.PROID)
                                                AND ORDER_STATUS = 1
                                                ORDER BY ORDER_DATE DESC";
                                            }

                                            $result = oci_parse($conn, $sql);
                                            oci_execute($result);
                                            while ($row = oci_fetch_array($result)) {
                                                $status = $row['ORDER_STATUS'];

                                            ?>

                                                <tr>
                                                    <td><?= $row['ORDER_NO'] ?></td>
                                                    <td><?= $row['CUSTOMER_NAME'] ?></td>
                                                    <td><?= $row['NO_ADDRESS'] . ' ' . $row['CM_DISTRICT'] . ' ' . $row['CM_SUB_DISTICT'] . ' ' . $row['CM_PROVINCE'] . ' ' . $row['CM_POSTCODE'] ?></td>
                                                    <td><?= $row['CUSTOMER_TEL'] ?></td>
                                                    <td><?= $row['ORDER_SUM'] ?></td>
                                                    <td><?= $row['ORDER_DATE'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($status == 1) {
                                                            echo "ยังไม่ชำระเงิน";
                                                        } elseif ($status == 2) {
                                                            echo "<b style = 'color:blue'>ชำระเงินแล้ว </b>";
                                                        } elseif ($status == 0) {
                                                            echo "<b style = 'color:red'> ยกเลิกการสั่งซื้อ </b>";
                                                        }

                                                        ?>

                                                    </td>
                                                    <td><a href="report_order_detail.php?id=<?= $row['ORDER_NO'] ?>" class="btn btn-success" >รายละเอียด</a></td>

                                                    <td><a href="pay_order.php?id=<?= $row['ORDER_NO'] ?>" class="btn btn-warning" onclick="del1(this.href); return false;">ปรับสถานะ</a></td>

                                                    <td><a href="cancel_order.php?id=<?= $row['ORDER_NO'] ?>" class="btn btn-danger" onclick="del(this.href); return false;">ยกเลิก</a></td>
                                                </tr>

                                            <?php
                                            }
                                            oci_close($conn);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                    <?php include "footer.php"; ?>

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
            <script>
                function del(mypage) {
                    let agree = confirm('คุณต้องการยกเลิกใบสั่งซื้อสินค้าหรือไม่');
                    if (agree) {
                        window.location = mypage;
                    }
                }

                function del1(mypage) {
                    let agree = confirm('คุณต้องการปรับสถานะการชำระเงินหรือไม่');
                    if (agree) {
                        window.location = mypage;
                    }
                }
            </script>

</body>

</html>