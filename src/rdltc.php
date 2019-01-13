<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['id']) && $_GET['id'] != ''){
	if(isset($_GET['delete']) && $_GET['delete'] != ''){
	mysqli_query($conn, "DELETE FROM `ucon` WHERE `id` = ".$_GET['id']);
	mysqli_query($conn, "DELETE FROM `jama` WHERE `cid` = '".$_GET['id']."'");
	mysqli_query($conn, "DELETE FROM `baki` WHERE `cid` = '".$_GET['id']."'");
	?>
	<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully DELETE Connection</b></i><br/><br/>
	<?php } else { 
	echo '...';
	 } ?>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>