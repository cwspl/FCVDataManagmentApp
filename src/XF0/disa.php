<?php
require("../../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['id']) && $_GET['id'] != ''){
mysqli_query($conn, "UPDATE `vkacno` SET `stt` = '0' WHERE `id` = '".$_GET['id']."'");
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Disable</b></i><br/><br/>
<?php } ?>