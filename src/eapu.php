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
		<?php 
			$lgrow = mysqli_query($conn, "SELECT * FROM `dagt`");
			while($lgdata = mysqli_fetch_array($lgrow)) { ?>
		<button type="button" onclick="odiv_a('aapu', '?id=<?php echo $lgdata['id'];?>', 'cnt');" class="btn btn-block btn-social btn-default">
			<?php echo $lgdata['name'];?>
		</button><br/>
		<?php } ?>
		<br/><button type="button" onclick="odiv('home', 'cnt');" class="btn btn-lg btn-block btn-social btn-info">
			<i class="glyphicon glyphicon-home"></i> Home
		</button>
	<br/>
	<br/>
	</div>
	<div class="col-md-4">
	</div>
	<script>document.getElementById("arn").focus();</script>
</div>