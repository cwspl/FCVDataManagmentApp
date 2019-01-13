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
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Edit Connection of <?php echo $cd['name'];?></h4>
	<div>
		<input type="hidden" id="fid<?php echo $cd['id'];?>" value="<?php echo $cd['id'];?>" />
		<i style="color:red;" id="errs<?php echo $cd['id'];?>"></i>
		<br/>
		<label>Information</label>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input type="text" id="name<?php echo $cd['id'];?>" class="form-control" style="text-align:left;" placeholder="Connection Name" value="<?php echo $cd['name'];?>">
		</div><br/>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
			<input type="tel" id="mno<?php echo $cd['id'];?>" maxlength="10" class="form-control" style="text-align:left;" placeholder="Mobile Number" value="<?php echo $cd['mno'];?>">
		</div><br/>
		<div class="input-group">
			<span class="input-group-addon">#</span>
			<input type="tel" id="ano<?php echo $cd['id'];?>" maxlength="8" class="form-control" style="text-align:left;" placeholder="Account Number" value="<?php echo $cd['ano'];?>">
		</div><br/>
		<label>Change Area</label>
		<select class="form-control" id="ara<?php echo $cd['id'];?>">
			<?php
if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `area` Order by aname ASC";
} else {
	$qury = "SELECT t1.`id`, t1.`name`, t1.`aname` FROM `area` t1 INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' Order by t1.aname ASC";
}
				$row = mysqli_query($conn, $qury);
				while($ad = mysqli_fetch_array($row)) { ?>
				<option value="<?php echo $ad['id'];?>"<?php if($ad['id']==$cd['aid']){ echo 'selected'; } ?>><?php echo $ad['name'];?></option>
			<?php } ?>
		</select><br/>
		<button type="button" onclick="edc('fid<?php echo $cd['id'];?>','name<?php echo $cd['id'];?>','mno<?php echo $cd['id'];?>','ano<?php echo $cd['id'];?>','ara<?php echo $cd['id'];?>','redc','cntr<?php echo $cd['id'];?>','errs<?php echo $cd['id'];?>');" class="btn btn-block btn-lg btn-social btn-success">
			<i class="glyphicon glyphicon-floppy-save"></i> Save Change
		</button><br/>
	</div>
</div>
<?php } else { ?>
<div align="center">
	<div class="col-md-6">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Edit Connection </h4><br/>
		<div id="abot">
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Edit Connection By Name </h4>
			<div class="input-group">
				<input type="text" onkeyup="src_c('sqn','screlt','srne')" id="sqn" class="form-control" style="text-align:center;" placeholder="Name">
				<span class="input-group-btn"><button onclick="src_c('sqn','screlt','srne')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
			</div>
			<div id='screlt' align="left"></div>
		</div>
		<br/>
	</div>
	<br/>
</div>
<?php } ?>