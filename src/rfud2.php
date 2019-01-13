<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if((isset($_GET['id']) && $_GET['id'] != '') && (isset($_GET['amt']) && $_GET['amt'] != '')){
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `ucon` WHERE `id` = ".$_GET['id']));
$chk = mysqli_query($conn, "SELECT * FROM `jama` WHERE `cid` = '".$data['id']."' AND `timc` = '".mktime(0,0,0,$_GET['mo'],1,$_GET['yr']+2000)."'");
if(mysqli_num_rows($chk) != 0){
$camt = mysqli_fetch_assoc($chk);
$tamt = (int)$_GET['amt']+(int)$camt['amt'];
mysqli_query($conn, "UPDATE `jama` SET `amt` = '".$tamt."' WHERE `cid` = '".$data['id']."' AND `timc` = '".mktime(0,0,0,$_GET['mo'],1,$_GET['yr']+2000)."'");
} else {
mysqli_query($conn, "INSERT INTO `jama` (`cid`,`amt`,`timc`) VALUES ('".$data['id']."','".$_GET['amt']."','".mktime(0,0,0,$_GET['mo'],1,$_GET['yr']+2000)."')");
}
?><br/>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Fund Added in <?php echo $data['name']; ?></b></i><br/><br/>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>