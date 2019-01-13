<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['delete']) && $_GET['delete'] != ''){
	mysqli_query($conn, "DELETE FROM `dagt` WHERE `id` = ".$_GET['delete']);
	mysqli_query($conn, "DELETE FROM `arda` WHERE `daid` = ".$_GET['delete']);
	?>
	<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Delete</b></i><br/><br/>
	<?php
}
else if((isset($_GET['na']) && $_GET['na'] != '') && (isset($_GET['ps']) && $_GET['ps'] != '')){
	if($_GET['id'] == 'X'){
		mysqli_query($conn, "INSERT INTO `dagt` (`name`,`psc`) VALUES ('".$_GET['na']."','".$_GET['ps']."')");
		$di = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `dagt` WHERE `name` = '".$_GET['na']."' AND `psc` = '".$_GET['ps']."' order by `id` DESC LIMIT 1"));
		$i = 0;
		$t = 'ar'.$i;
		while(isset($_GET[$t])){
			if($_GET[$t] != 'XX'){
				mysqli_query($conn, "INSERT INTO `arda` (`daid`,`aid`) VALUES ('".$di['id']."','".$_GET[$t]."')");
			}
			$i++;
			$t = 'ar'.$i;
		}
	} else {
		mysqli_query($conn, "UPDATE `dagt` SET `name` = '".$_GET['na']."', `psc` = '".$_GET['ps']."' WHERE `id` = '".$_GET['id']."';");
		mysqli_query($conn, "DELETE FROM `arda` WHERE `daid` = ".$_GET['id']);
		$i = 0;
		$t = 'ar'.$i;
		while(isset($_GET[$t])){
			if($_GET[$t] != 'XX'){
				mysqli_query($conn, "INSERT INTO `arda` (`daid`,`aid`) VALUES ('".$_GET['id']."','".$_GET[$t]."')");
			}
			$i++;
			$t = 'ar'.$i;
		}
	}
	
	?>
	<i style="color:green;" id="err"><i class="glyphicon glyphicon-check"></i> <b>Successfully Done</b></i><br/><br/>
	<?php } else { ?>
<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Wrong Opration</b></i><br/><br/>
<?php } ?>