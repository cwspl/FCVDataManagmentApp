<?php
require("../common.php");
require("../src/fun/gtoe.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['q']) && $_GET['q'] != ''){
$q = $_GET['q'];
$q2 = gtoe($q);
mysqli_query($conn, "INSERT INTO `area` (`name`,`aname`) VALUES ('".$q."','".$q2."')");
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Added <?php echo $q; ?> in Area.</b></i><br/><br/>
<button type="button" onclick="odiv('adc', 'cnt');" class="btn btn-block btn-social btn-primary">
	<i class="glyphicon glyphicon-user"></i> Add Connection
</button><br/>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>