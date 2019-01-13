<?php
require("../common.php");
if(isset($_GET['p'])){
	if($_GET['p'] == (date('i').date('h'))){
		$_SESSION['fcv'] = true;
	} else {
		header("Location: lock.php?er=Wrong Passcode");
		die();
	}
}
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<div align="center" id="cn2">
	<div class="col-md-6">
		<button type="button" onclick="odiv('cmf', 'cn2');" class="btn btn-lg btn-block btn-social  btn-primary">
			<i class="glyphicon glyphicon-calendar"></i> Change Monthly Fund
		</button>
		<button type="button" onclick="odiv('ejm', 'cn2');" class="btn btn-lg btn-block btn-social  btn-danger">
			<i class="glyphicon glyphicon-floppy-remove"></i> Erase Jama Fund
		</button><br/>
		<button type="button" onclick="odiv('edc', 'cn2');" class="btn btn-lg btn-block btn-social  btn-warning">
			<i class="glyphicon glyphicon-pencil"></i> Edit Information
		</button>
		<button type="button" onclick="odiv('dltc','cn2');" class="btn btn-lg btn-block btn-social btn-danger">
			<i class="glyphicon glyphicon-trash"></i> Delete Connection
		</button><br/>
	</div>
	<div class="col-md-6">
		<button type="button" onclick="odiv('bco', 'cn2');" class="btn btn-lg btn-block btn-social  btn-warning">
			<i class="glyphicon glyphicon-ban-circle"></i> Block Connection
		</button>
		<button type="button" onclick="odiv('rco', 'cn2');" class="btn btn-lg btn-block btn-social  btn-success">
			<i class="glyphicon glyphicon-repeat"></i> Restart Connection 
		</button>
		<br/>
	</div>
</div>
<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
	<i class="glyphicon glyphicon-home"></i> Home 
</button>
<br/>