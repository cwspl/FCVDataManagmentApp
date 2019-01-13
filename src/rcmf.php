<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if((isset($_GET['id']) && $_GET['id'] != '') && (isset($_GET['amt']) && $_GET['amt'] != '') && (isset($_GET['m']) && $_GET['m'] != '') && (isset($_GET['y']) && $_GET['y'] != '')){
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `ucon` WHERE `id` = ".$_GET['id']));
$chk = mysqli_query($conn, "SELECT * FROM `baki` WHERE `cid` = '".$_GET['id']."' AND `timr` = '".mktime(0,0,0,$_GET['m'],1,$_GET['y']+2000)."'");
if(mysqli_num_rows($chk) != 0){
mysqli_query($conn, "UPDATE `baki` SET `amt` = '".$_GET['amt']."' WHERE `cid` = '".$_GET['id']."' AND `timr` = '".mktime(0,0,0,$_GET['m'],1,$_GET['y']+2000)."'");
} else {
mysqli_query($conn, "INSERT INTO `baki` (`cid`,`amt`,`timr`,`timc`) VALUES ('".$data['id']."','".$_GET['amt']."','".mktime(0,0,0,$_GET['m'],1,$_GET['y']+2000)."','".time()."')");
}
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Change in <?php echo $data['name']; ?></b></i><br/><br/>
<button type="button" onclick="odiv('cmf', 'cn2');" class="btn btn-block btn-social btn-info">
	<i class="glyphicon glyphicon-user"></i> Change Monthly Fund
</button><br/>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>