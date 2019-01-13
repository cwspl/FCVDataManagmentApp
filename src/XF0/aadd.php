<?php
require("../../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['id']) && $_GET['id'] != ''){
?>
<div align="left">
	<div class="col-md-4">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Add Account Number </h4>
		<div id="nconn">
			<i style="color:red;" id="err"></i></br>
			<input type="hidden" id="cid" value="<?php echo $_GET['id'];?>"/>
			<div class="input-group">
				<span class="input-group-addon">#</span>
				<input type="tel" id="ano" maxlength="8" class="form-control" style="text-align:left;" placeholder="Account Number">
			</div><br/>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				<input type="tel" id="dat" maxlength="10" class="form-control" style="text-align:left;" placeholder="Date">
			</div><br/>
			<button type="button" onclick="addca('err','nconn');" class="btn btn-block btn-lg btn-social btn-success">
				<i class="glyphicon glyphicon-plus"></i> Add Account
			</button><br/>
		</div>
	</div>
</div>
<?php } ?>