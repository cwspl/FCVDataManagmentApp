<?php
require("../../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['id']) && $_GET['id'] != 0){
	$gcid = $_GET['id'];
	$qury = "SELECT * FROM `vkacno` WHERE `id` = '".$gcid."'";
	$cd = mysqli_fetch_assoc(mysqli_query($conn, $qury));
	$head = 'done';
}
if(isset($head)){
?>
<div align="center" id="cntr<?php echo $cd['id'];?>">
	<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Do you Want To Delete <?php echo $cd['acno']; ?> Account No. ? </b></i><br/><br/>
	<button type="button" onclick="odiv_a('XF0/radelt','?id=<?php echo $cd['id']; ?>&delete=yes','cntr<?php echo $cd['id'];?>');" class="btn btn-social btn-danger">
		<i class="glyphicon glyphicon-ok"></i> Yes
	</button>
	<button type="button" onclick="odiv('end','cntr<?php echo $cd['id'];?>');" class="btn btn-social btn-success">
		<i class="glyphicon glyphicon-remove"></i> No
	</button>
	<br/>
</div>
<?php } ?>