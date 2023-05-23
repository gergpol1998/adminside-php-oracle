<?php
include "conn.php";

$ids = $_GET['id'];

$sql = "UPDATE TB_ORDER SET ORDER_STATUS = 2 WHERE ORDER_NO = '$ids'";
$result = oci_parse($conn,$sql);
oci_execute($result);
if($result){
    echo "<script>window.location = 'report_order.php';</script>";
}
else{
    echo "<script>alert('ไม่สามารถปรับสถานะการชำระเงินได้');</script>";
}
oci_close($conn);
?>