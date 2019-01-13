<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
} 
mysqli_query($conn, "INSERT INTO `prfcv` (`pid`, `per`, `cid`, `aid`, `yr`, `dat`, `timc`) VALUES ('0', '0', '".$_GET['cid']."', '".$_GET['a']."', '".$_GET['y']."', '0', '".time()."');");
?>