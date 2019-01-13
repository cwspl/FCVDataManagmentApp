<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<i style="color:red;" id="err"></i></br>
<label>Information</label>
<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	<input type="text" id="name" class="form-control" style="text-align:left;" placeholder="Connection Name">
</div><br/>
<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
	<input type="tel" id="mno" maxlength="10" class="form-control" style="text-align:left;" placeholder="Mobile Number">
</div><br/>
<div class="input-group">
	<span class="input-group-addon">#</span>
	<input type="tel" id="ano" maxlength="8" class="form-control" style="text-align:left;" placeholder="Account Number">
</div><br/>
<label>Connection Start Form</label>
<div class="input-group">
	<span class="input-group-addon">Month</span>
	<select class="form-control" id="scm">
		<option value="01" selected>January</option>
		<option value="02">February</option>
		<option value="03">March</option>
		<option value="04">April</option>
		<option value="05">May</option>
		<option value="06">June</option>
		<option value="07">July</option>
		<option value="08">August</option>
		<option value="09">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
	</select>
</div>
<div class="input-group">
	<span class="input-group-addon">Year</span>
	<select class="form-control" id="scy">
		<?php
			$y='16';
			while($y <= $c_year){
		?>
			<option value="<?php echo $y;?>" <?php if($y==$c_year){echo 'selected';}?>><?php echo $y+2000;?></option>
		<?php 
		$y++;
		} ?>
	</select>
</div><br/>
<label> Monthly Fund</label>
<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	<input type="tel" id="mfd" class="form-control" style="text-align:left;" value="170">
</div><br/>
<label> Total Jama </label>
<div class="input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span>
	<input type="tel" id="tjm" class="form-control" style="text-align:left;" placeholder="Total Jama" value="0">
	<span class="input-group-addon"><i class="glyphicon glyphicon-remove"></i></span>
	<select class="form-control" id="mmf">
		<?php
			$m=1;
			while($m <= 12){
		?>
			<option value="<?php echo $m;?>" <?php if($m==1){echo 'selected';}?>><?php echo $m;?></option>
		<?php 
		$m++;
		} ?>
	</select>
</div><br/>
<label>Jama In</label><br/>
<div class="input-group">
	<span class="input-group-addon">Month</span>
	<select class="form-control" id="jmm">
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
	<select class="form-control" id="jmy">
		<?php
			$y='16';
			while($y <= $c_year){
		?>
			<option value="<?php echo $y;?>" <?php if($y==$c_year){echo 'selected';}?>><?php echo $y+2000;?></option>
		<?php 
		$y++;
		} ?>
	</select>
</div><br/>
<button type="button" onclick="adc('err','nconn');" class="btn btn-block btn-lg btn-social btn-success">
	<i class="glyphicon glyphicon-plus"></i> Add to Connection 
</button><br/>