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
		<button type="button" onclick="odiv('aapu', 'cnt');" class="btn btn-lg btn-block btn-social btn-success">
			<i class="glyphicon glyphicon-plus"></i> Add App User
		</button><br/>
		<button type="button" onclick="odiv('eapu', 'cnt');" class="btn btn-lg btn-block btn-social btn-warning">
			<i class="glyphicon glyphicon-pencil"></i> Edit App User
		</button><br/>
		<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-lg btn-block btn-social btn-info">
			<i class="glyphicon glyphicon-home"></i> Home
		</button>
	<br/>
	<br/>
	</div>
	<div class="col-md-4">
	</div>
	<script>document.getElementById("arn").focus();</script>
</div>