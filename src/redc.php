<?php
require("../common.php");
require("../src/fun/gtoe.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['id']) && $_GET['id'] != ''){
$aname = gtoe($_GET['name']);
mysqli_query($conn, "UPDATE `ucon` SET `name` = '".$_GET['name']."', `aname` = '".$aname."', `aid` = '".$_GET['aid']."', `mno` = '".$_GET['mno']."', `ano` = '".$_GET['ano']."' WHERE `id` = '".$_GET['id']."'");
?>
<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Edit Successfully in <?php echo $_GET['name']; ?> Connection.</b></i><br/><br/>
<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>