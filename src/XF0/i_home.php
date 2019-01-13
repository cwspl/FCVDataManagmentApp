<?php
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<div align="center">
	<div class="col-md-6">
		<button type="button" onclick="odiv('XF0/tab/tab_a', 'cnt');" class="btn btn-lg btn-block btn-social btn-info">
			<i class="glyphicon glyphicon-map-marker"></i> All Connection <span class="badge"><?php  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM vklist"));?></span>
		</button>
		<br/>
	</div>
	<div class="col-md-6">
		<button type="button" onclick="odiv('XF0/tab/tab_b', 'cnt');" class="btn btn-lg btn-block btn-warning btn-info">
			Inactive Connection <span class="badge"><?php  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM vkacno WHERE `stt` != '1'"));?></span>
		</button>
		<br/>
	</div>
	<div class="col-md-6">
		<button type="button" onclick="odiv('XF0/addc', 'cnt');" class="btn btn-lg btn-block btn-social btn-success">
			<i class="glyphicon glyphicon-plus"></i> Add 
		</button>
		<br/>
		<h5 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="left"> Search By Name </h5>
		<div class="input-group">
			<input type="text" onkeyup="src_c('sqn','screlt','srn')" id="sqn" class="form-control" style="text-align:center;" placeholder="Name">
			<span class="input-group-btn"><button onclick="src_c('sqn','screlt','srn')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
		</div>
		<div id='screlt' align="left"></div><br/>
	</div>
	<a href="http://webapp.gtpl.net:84/login.aspx"><button type="button" class="btn btn-lg btn-block btn-social btn-default">
		<img src="img/gtpl.png" width="24px" height="24px" /> GTPL Activation
	</button></a>
	<br/>
	<br/>
</div>