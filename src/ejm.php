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
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center">  Erase Jama Fund of <?php echo $cd['name'];?> Connection</h4>
	<div>
		<input type="hidden" id="fid<?php echo $cd['id'];?>" value="<?php echo $cd['id'];?>" />
		<i style="color:red;" id="errs<?php echo $cd['id'];?>"></i>
		<br/>
		<label>Select for Jama</label><br/>
		<select class="form-control" id="jma<?php echo $cd['id'];?>">
			<?php	$qury = "SELECT * FROM `jama` where cid = '".$cd['id']."' order by `timc` DESC";
				$row = mysqli_query($conn, $qury);
				while($ad = mysqli_fetch_array($row)) { ?>
				<option value="<?php echo $ad['id'];?>"><?php echo $ad['amt'].' - '.date('m / Y',$ad['timc']);?></option>
			<?php } ?>
		</select><br/><br/>
		<button type="button" onclick="ejm('jma<?php echo $cd['id'];?>','rejm','cntr<?php echo $cd['id'];?>','errs<?php echo $cd['id'];?>');" class="btn btn-block btn-social btn-danger">
			<i class="glyphicon glyphicon-floppy-remove"></i> Erase Jama Fund
		</button><br/>
	</div>
</div>
<?php } else { ?>
<div align="center">
	<div class="col-md-6">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Erase Jama Fund </h4><br/>
		<div id="abot">
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Find Connection By Name </h4>
			<div class="input-group">
				<input type="text" onkeyup="src_c('sqn','screlt','srnj')" id="sqn" class="form-control" style="text-align:center;" placeholder="Name">
				<span class="input-group-btn"><button onclick="src_c('sqn','screlt','srnj')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
			</div>
			<div id='screlt' align="left"></div>
		</div>
		<br/>
	</div>
	<br/>
</div>
<?php } ?>