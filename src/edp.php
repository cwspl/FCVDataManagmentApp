<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<div align="center">
	<div class="col-md-4">
	</div>
	<div class="col-md-4">
		<div id="adar">
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Change Passcode </h4><br/>
			<i align="center" id="er_pi" style="color:red;"><?php if(isset($_GET['er'])){echo "<i class='glyphicon glyphicon-remove'></i> ".$_GET['er'];}?></i>
			<h5 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Old Passcode </h5>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="tel" maxlength="4" name="opass" id="opass" class="form-control" style="text-align:center;" placeholder="Enter Old Passcode">
			</div><br/>
			<h5 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> New Passcode </h5>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="tel" maxlength="4" name="npass" id="npass" class="form-control" style="text-align:center;" placeholder="Enter New Passcode">
			</div><br/>
			<button type="button" onclick="ch_pass('opass','npass','er_pi','adar')" class="btn btn-warning btn-block btn-lg"> Change Passcode </button> <br/>
		</div>
		<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
			<i class="glyphicon glyphicon-home"></i> Home 
		</button>
	<br/>
	</div>
	<div class="col-md-4">
	</div>
</div>