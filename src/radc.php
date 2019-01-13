<?php
require("../common.php");
require("../src/fun/gtoe.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['name']) && $_GET['name'] != ''){
$aname = gtoe($_GET['name']);
$tc = time();
mysqli_query($conn, "INSERT INTO `ucon` (`name`,`aname`,`aid`,`mno`,`ano`,`timc`) VALUES ('".$_GET['name']."','".$aname."','".$_GET['aid']."','".$_GET['mno']."','".$_GET['ano']."','".$tc."')");
mysqli_query($conn, "INSERT INTO `baki` (`cid`,`amt`,`timr`,`timc`) VALUES ('0','".$_GET['amt']."','".mktime(0,0,0,$_GET['mo'],1,$_GET['yr']+2000)."','".$tc."')");
mysqli_query($conn, "INSERT INTO `jama` (`cid`,`amt`,`timc`) VALUES ('0','".$_GET['jama']."','".$tc."')");
$di = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `ucon` WHERE `timc` = '".$tc."'"));
mysqli_query($conn, "UPDATE `baki` SET `cid` = '".$di['id']."' WHERE `timc` = '".$tc."' AND `cid` = '0'");
mysqli_query($conn, "UPDATE `jama` SET `cid` = '".$di['id']."' , `timc` = '".mktime(0,0,0,$_GET['jmm'],1,$_GET['jyr']+2000)."' WHERE `timc` = '".$tc."' AND `cid` = '0'");
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Added <?php echo $_GET['name']; ?> in Connection.</b></i><br/><br/>
<button type="button" onclick="odiv('aadc', 'nconn');" class="btn btn-lg btn-block btn-social btn-primary">
	<i class="glyphicon glyphicon-user"></i> Add Another Connection
</button><br/>
<button type="button" onclick="odiv('adf', 'cnt');" class="btn btn-lg btn-block btn-social btn-success">
	<i class="glyphicon glyphicon-credit-card"></i> Add Funds 
</button><br/>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>