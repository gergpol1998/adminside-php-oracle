<?php
include "conn.php";
//session_start();
$id = $_SESSION['ID'];
//print_r($id);  
$sql = "SELECT * FROM EMP,TB_GROUP
WHERE (EMP.GROUP_ID = TB_GROUP.GROUP_ID) AND EMP_ID ='$id' ";
$result = oci_parse($conn,$sql);
oci_execute($result);
$row = oci_fetch_array($result);
$_SESSION["PERM"] = '';
if($row > 0){
    $_SESSION["PERM"] = $row ["GROUP_PERMISSION"];
}
$permis = explode(",",$_SESSION["PERM"]);
//echo "<pre>";
//print_r ($permis); 

?>