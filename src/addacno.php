<?php require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if((isset($_GET['id']) && $_GET['id'] != '') && (isset($_GET['ano']) && $_GET['ano'] != '')){
mysqli_query($conn, "INSERT INTO `acno` (`cid`,`acno`) VALUES ('".$_GET['id']."','".$_GET['ano']."')");
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Added Account.</b></i><br/><br/>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>