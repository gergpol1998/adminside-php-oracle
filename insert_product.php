<?php
include "conn.php";


$pid = $_POST['pid'];
$pno = $_POST['pno'];
$pname = $_POST['pname'];
$type = $_POST['typeid'];
$partner = $_POST['partnerid'];
$brand = $_POST['brandid'];
$season = $_POST['seasonid'];
$size = $_POST['sizeid'];
$color = $_POST['colorid'];
$price = $_POST['price'];
$qty = $_POST['qty'];

$pdate = date('d-m-Y', strtotime($_POST['pdate']));

//อัพโหลดรูปภาพ
if (is_uploaded_file($_FILES['file1']['tmp_name'])) { // check ว่ามีการคลิกปุ่มอัพโหลดไฟล์ไหม
    $new_image_name = 'pro_' . uniqid() . "." . pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "./image/" . $new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}
//เพิ่มข้อมูลลงในตาราง product
$sql = "INSERT INTO PRODUCT(PRODUCT_ID,PRODUCT_NAME,PRODUCT_COLORID,PRODUCTBRAND_ID,PRODUCT_SEASONID
    ,PRODUCT_TYPEID,PRODUCT_DATE) 
    VALUES ('$pid','$pname','$color','$brand','$season','$type',TO_DATE('" . $pdate . "','dd-mm-yy'))";
$result = oci_parse($conn, $sql);
oci_execute($result);

$sql2 = "INSERT INTO PRODUCTDETAIL (PRODUCTDETAIL.NO,PROID,SELL,COM_ID,QUANTITY,SIZEID,IMAGE)
    VALUES ('$pno','$pid','$price','$partner','$qty','$size','$new_image_name')";

$result2 = oci_parse($conn, $sql2);
oci_execute($result2);

if ($result && $result2) {
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
    echo "<script> window.location = 'product.php'; </script>";
} else {
    echo "<script> alert('ไม่สามารถบันทึกข้อมูลได้'); </script>";
}

oci_close($conn);
