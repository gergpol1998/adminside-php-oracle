<?php
include "conn.php";


    $user = $_POST['uid'];
    $uname = $_POST['uname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $bdate = date('d-m-Y', strtotime($_POST['bdate']));
    $exp = $_POST['exp'];
    $salary = $_POST['salary'];
    $role = $_POST['role'];

//เพิ่มข้อมูลลงในตาราง user


$sql = "INSERT INTO EMP (EMP_ID,EMP_NAME,EMP_LNAME,EMP_USERNAME,EMP_PASSWORD,EMP_SEX,EMP_EMAIL,EMP_TEL,EMP_BDATE
,EMP_EXP,EMP_SALARY,GROUP_ID) VALUES ('$user','$uname','$lname','$username','$password','$sex','$email','$tel',TO_DATE('" . $bdate . "','dd-mm-yy'),$exp,$salary,$role)";
$result = oci_parse($conn, $sql);
oci_execute($result);


if($result){
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
    echo "<script> window.location = 'user.php'; </script>";

}
 
oci_close($conn);
?>
