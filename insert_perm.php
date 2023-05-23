<?php
include "conn.php";


$perm = implode(",",$_POST['perm']); //แปลง array to string
$roleid = $_POST['roleid'];
$rolename = $_POST['rolename'];

//print_r($perm);
//เพิ่มข้อมูลลงในตาราง
$sql = "INSERT INTO TB_GROUP (GROUP_ID,GROUP_NAME,GROUP_PERMISSION) VALUES ($roleid,'$rolename','$perm')";
$result = oci_parse($conn, $sql);
oci_execute($result);


if ($result) {
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
    echo "<script> window.location = 'addpermis.php'; </script>";
} else {
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
}


oci_close($conn);
?>