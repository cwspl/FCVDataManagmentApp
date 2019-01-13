<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['cid']) && $_GET['cid'] != 0){
	$gcid = $_GET['cid'];
	$qury = "SELECT * FROM `ucon` WHERE `id` = '".$gcid."'";
	$cd = mysqli_fetch_assoc(mysqli_query($conn, $qury));
	$head = 'done';
}
if(isset($head)){
?>
<div align="center" id="cntr<?php echo $cd['id'];?>">
	<i style="color:red;" id="err"><i class="glyphicon glyphicon-remove"></i> <b>Do you Want To Delete <?php echo $cd['name']; ?> Connection ? </b></i><br/><br/>
	<button type="button" onclick="odiv_a('rdltc','?id=<?php echo $cd['id']; ?>&delete=yes','cntr<?php echo $cd['id'];?>');" class="btn btn-social btn-danger">
		<i class="glyphicon glyphicon-ok"></i> Yes
	</button>
	<button type="button" onclick="odiv('end','cntr<?php echo $cd['id'];?>');" class="btn btn-social btn-success">
		<i class="glyphicon glyphicon-remove"></i> No
	</button>
	<br/>
</div>
<?php } else { ?>
<div align="center">
	<div class="col-md-6">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Delete Connection </h4><br/>
		<div id="abot">
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Search Connection By Name </h4>
			<div class="input-group">
				<input type="text" onkeyup="src_c('sqn','screlt','srnd')" id="sqn" class="form-control" style="text-align:center;" placeholder="Name">
				<span class="input-group-btn"><button onclick="src_c('sqn','screlt','srnd')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
			</div>
			<div id='screlt' align="left"></div>
		</div>
		<br/>
	</div>
	<br/>
</div>
<?php } ?>