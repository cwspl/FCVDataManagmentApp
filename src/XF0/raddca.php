<?php
require("../../common.php");
require("../../src/fun/gtoe.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['cid']) && $_GET['cid'] != ''){
mysqli_query($conn, "INSERT INTO `vkacno` (`cid`,`acno`,`dat`,`stt`) VALUES ('".$_GET['cid']."','".$_GET['ano']."','".$_GET['dat']."','1')");
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Added <?php echo $_GET['ano']; ?> Account.</b></i><br/><br/>
<?php } ?>