<?php

$conn = oci_connect('USER061', 'KE278V', '203.188.54.7/database');
if (!$conn) {

die('Could not connect:'. oci_error($conn));

}
 else {
	//echo "Connection : OK (เชื่อมต่อฐานข้อมูลสำเร็จ)";
}