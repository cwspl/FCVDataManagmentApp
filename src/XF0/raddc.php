<?php
require("../../common.php");
require("../../src/fun/gtoe.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['name']) && $_GET['name'] != ''){
$aname = gtoe($_GET['name']);
$tc = time();
mysqli_query($conn, "INSERT INTO `vklist` (`name`,`aname`,`mon`,`timec`) VALUES ('".$_GET['name']."','".$aname."','".$_GET['mno']."','".$tc."')");
$di = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `vklist` WHERE `timec` = '".$tc."'"));
mysqli_query($conn, "INSERT INTO `vkacno` (`cid`,`acno`,`dat`,`stt`) VALUES ('".$di['id']."','".$_GET['ano']."','".$_GET['dat']."','1')");
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Added <?php echo $_GET['name']; ?> in Connection.</b></i><br/><br/>
<button type="button" onclick="odiv('XF0/addc', 'nconn');" class="btn btn-lg btn-block btn-social btn-primary">
	<i class="glyphicon glyphicon-user"></i> Add Another Connection
</button><br/><br/>
<button type="button" onclick="odiv('XF0/home', 'cnt');" class="btn btn-block btn-social btn-info">
	<i class="glyphicon glyphicon-home"></i> Home 
</button>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>