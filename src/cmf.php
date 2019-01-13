﻿<?php
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
if(date('m') == 12){
	$year = date('y')+1;
} else {
	$year = date('y');
}
if(isset($head)){
?>
<div align="center">
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Change Monthly Fund </h4>
	<div>
		<input type="hidden" id="fid<?php echo $cd['id'];?>" value="<?php echo $cd['id'];?>" />
		<i style="color:red;" id="errs<?php echo $cd['id'];?>"></i><br/>
		<label>Fund Amount</label><br/>
		<div class="input-group">
			<input type="tel" id="famt<?php echo $cd['id'];?>" class="form-control" style="text-align:center;" placeholder="Fund Amount" value="220">
		</div><br/>
		<label>Change From</label><br/>
		<div class="input-group">
			<span class="input-group-addon">Month</span>
			<select class="form-control" id="cmm<?php echo $cd['id'];?>">
				<?php
					$m='1';
					while($m <= '12'){
				?>
					<option value="<?php echo $m;?>" <?php if($m==(date('m')-1)){echo 'selected';}?>><?php echo date('F', mktime(0,0,0,$m,1,2000));?></option>
				<?php 
				$m++;
				} ?>
			</select>
		</div><br/>
		<div class="input-group">
			<span class="input-group-addon">Year</span>
			<select class="form-control" id="cmy<?php echo $cd['id'];?>">
				<?php
					$y='15';
					while($y <= $year){
				?>
					<option value="<?php echo $y;?>" <?php if($y==$year){echo 'selected';}?>><?php echo $y+2000;?></option>
				<?php 
				$y++;
				} ?>
			</select>
		</div><br/><br/>
		<button type="button" onclick="cmf('fid<?php echo $cd['id'];?>','famt<?php echo $cd['id'];?>','cmm<?php echo $cd['id'];?>','cmy<?php echo $cd['id'];?>','rcmf2','tchg<?php echo $cd['id'];?>','errs<?php echo $cd['id'];?>');" class="btn btn-block btn-social btn-primary">
			<i class="glyphicon glyphicon-plus"></i> Change Monthly Fund
		</button><br/>
	</div>
</div>
<?php } else { ?>
<div align="center">
	<div class="col-md-6">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Change Monthly Fund </h4><br/>
		<div id="abot">
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Search Connection By Name </h4>
			<div class="input-group">
				<input type="text" onkeyup="src_c('sqn','screlt','srnf')" id="sqn" class="form-control" style="text-align:center;" placeholder="Name">
				<span class="input-group-btn"><button onclick="src_c('sqn','screlt','srnf')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
			</div>
			<div id='screlt' align="left"></div>
		</div>
		<br/>
	</div>
	<div class="col-md-6">
		<input type="hidden" id="fid" value="" />
		<i style="color:red;" id="errs"></i><br/>
		<label>Fund Amount</label><br/>
		<div class="input-group">
			<input type="tel" id="famt" class="form-control" style="text-align:center;" placeholder="Fund Amount" value="220">
		</div><br/>
		<label>Change From</label><br/>
		<div class="input-group">
			<span class="input-group-addon">Month</span>
			<select class="form-control" id="cmm">
				<?php
					$m='1';
					while($m <= '12'){
				?>
					<option value="<?php echo $m;?>" <?php if($m==(date('m')-1)){echo 'selected';}?>><?php echo date('F', mktime(0,0,0,$m,1,2000));?></option>
				<?php 
				$m++;
				} ?>
			</select>
		</div><br/>
		<div class="input-group">
			<span class="input-group-addon">Year</span>
			<select class="form-control" id="cmy">
				<?php
					$y='15';
					while($y <= $year){
				?>
					<option value="<?php echo $y;?>" <?php if($y==$year){echo 'selected';}?>><?php echo $y+2000;?></option>
				<?php 
				$y++;
				} ?>
			</select>
		</div><br/><br/>
		<button type="button" onclick="cmf('fid','famt','cmm','cmy','rcmf','cn2','errs');" class="btn btn-block btn-social btn-primary">
			<i class="glyphicon glyphicon-plus"></i> Change Monthly Fund
		</button><br/>
	</div>
	<br/>
</div>
<?php } ?>