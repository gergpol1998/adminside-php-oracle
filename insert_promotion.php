<?php
include "conn.php";


if($_POST['submit']){
    $rankid = $_POST['rankid'];
    $rankname = $_POST['rankname'];
    $discount = $_POST['discount'];
    $rankup = $_POST['rankup'];
}

//เพิ่มข้อมูลลงในตาราง
$sql = "INSERT INTO RANK (RANK_ID,RANK_NAME,RANK_DISCOUNTID,TOTAL_RANKUP) VALUES ('$rankid','$rankname','$discount','$rankup')";
$result = oci_parse($conn, $sql);
oci_execute($result);


if ($result) {
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
    echo "<script> window.location = 'promotion.php'; </script>";
} else {
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
}


oci_close($conn);
?>