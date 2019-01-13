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
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Extra Account No.</h4>
	<div>
		<input type="hidden" id="fid<?php echo $cd['id'];?>" value="<?php echo $cd['id'];?>" />
		<i style="color:red;" id="errs<?php echo $cd['id'];?>"></i><br/>
		<label>Add</label><br/>
		<div class="input-group">
			<div class="input-group">
			<span class="input-group-addon">#</span>
			<input type="tel" id="ano<?php echo $cd['id'];?>" maxlength="8" class="form-control" style="text-align:left;" placeholder="Account Number" value="">
		</div><br/>
		<button type="button" onclick="addaco('<?php echo $cd['id'];?>','ano<?php echo $cd['id'];?>','cntr<?php echo $cd['id'];?>');" class="btn btn-block btn-social btn-success">
			<i class="glyphicon glyphicon-plus"></i> Add Account No
		</button><br/>
		<label>Current Account No.</label><br/>
		<b><?php $acnc=1;echo $acnc.") ";?></b><?php echo $cd['ano'];?><br/>
		<?php 
		$acrow = mysqli_query($conn,"SELECT * FROM `acno` WHERE `cid` = '".$cd['id']."'");
		while($acno = mysqli_fetch_array($acrow)) { 
			$acnc = $acnc+1;?>
			<b><?php echo $acnc.") "?></b><?php echo $acno['acno'];?>
		<button type="button" onclick="odiv_a('dltacno','?id=<?php echo $acno['id'];?>','cntr<?php echo $cd['id'];?>');" class="btn btn-social btn-danger">
			<i class="glyphicon glyphicon-trash"></i>
		</button><br/><br/>
		<?php } ?>
	</div>
</div>
<?php } ?>