<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if((isset($_GET['op']) && $_GET['op'] != '') && (isset($_GET['np']) && $_GET['np'] != '')){
	$chk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `dagt` WHERE `id` = '".$_SESSION['fcv']."'"));
	if($chk['psc'] == $_GET['op']){
		mysqli_query($conn, "UPDATE `dagt` SET `psc` = '".$_GET['np']."' WHERE `id` = '".$chk['id']."'");
		?>
		<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Passcode Change</b></i><br/>
		<?php
	} else {
		?>
		<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Old Passcode </b></i><br/><br/>
		<button type="button" onclick="odiv('edp', 'cnt');" class="btn btn-lg btn-block btn-social btn-warning">
			<i class="glyphicon glyphicon-lock"></i> Change again Passcode
		</button>
		<br/>
		<?php
	}
} else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>