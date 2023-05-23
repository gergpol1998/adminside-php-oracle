<?php
include "../conn.php";
session_start();

$username = $_POST['USERNAME'];
$password = $_POST['PASSWORD'];


$sql = "SELECT * FROM EMP
WHERE EMP_USERNAME ='$username' AND EMP_PASSWORD ='$password'" ;
$result = oci_parse($conn,$sql);
oci_execute($result);
$row = oci_fetch_array($result);



if($row > 0){

    if(isset($username) && isset($password)){
        $_SESSION["USERNAME"] = $row ["EMP_USERNAME"];
        $_SESSION["PASSWORD"] = $row ["EMP_PASSWORD"];
        $_SESSION["ID"] = $row["EMP_ID"];
        
            echo "<script> alert('เข้าสู่ระบบสำเร็จ'); </script>";
            echo "<script> window.location = '../user_detail.php'; </script>";
    }
}else{
    $_SESSION["Error"] = "<p> username หรือ password ไม่ถูกต้อง </p>";
    echo "<script> alert('username or password ไม่ถูกต้อง'); </script>";
    echo "<script> window.location = 'login.php'; </script>";
}



oci_close($conn);
?>