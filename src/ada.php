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
			<?php 
		if($_SESSION['fcv'] == 0){ ?>
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"><i class="glyphicon glyphicon-map-marker"></i> Add New Area <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM area"));?></span></h4>
			<i style="color:red;" id="err"></i><br/>
			<div class="input-group">
				<input type="text" id="arn" class="form-control" style="text-align:center;" placeholder="Enter Area Name">
			</div><br/>
			<button type="button" onclick="adar('arn','err','adar');" class="btn btn-lg btn-block btn-social btn-success">
				<i class="glyphicon glyphicon-plus"></i> Add to Area
			</button>
			<br/>
		<?php } ?>
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"><i class="glyphicon glyphicon-link"></i> Add Connection <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon"));?></span></h4>
			<button type="button" onclick="odiv('adc', 'cnt');" class="btn btn-lg btn-block btn-social btn-primary">
				<i class="glyphicon glyphicon-user"></i> Add Connection </span>
			</button><br/>
			<button type="button" onclick="odiv('adf', 'cnt');" class="btn btn-lg btn-block btn-social  btn-success">
				<i class="glyphicon glyphicon-credit-card"></i> Add Funds 
			</button><br/>
		</div>
		<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
			<i class="glyphicon glyphicon-home"></i> Home 
		</button>
	<br/>
	</div>
	<div class="col-md-4">
	</div>
	<script>document.getElementById("arn").focus();</script>
</div>