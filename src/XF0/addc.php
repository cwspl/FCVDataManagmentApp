<?php
require("../../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<div align="left">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Add Connection </h4>
		<div id="nconn">
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
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				<input type="tel" id="dat" maxlength="10" class="form-control" style="text-align:left;" placeholder="Date">
			</div><br/>
			<button type="button" onclick="addc('err','nconn');" class="btn btn-block btn-lg btn-social btn-success">
				<i class="glyphicon glyphicon-plus"></i> Add to Connection 
			</button><br/>
			<button type="button" onclick="odiv('XF0/home', 'cnt');" class="btn btn-block btn-social btn-info">
				<i class="glyphicon glyphicon-home"></i> Home 
			</button>
		</div>
	</div>
</div>