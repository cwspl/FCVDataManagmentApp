<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<div align="center">
	<div class="col-md-6">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Search By Name </h4>
		<div class="input-group">
			<input type="text" onkeyup="src_c('sqn','screlt','srn')" id="sqn" class="form-control" style="text-align:center;" placeholder="Name">
			<span class="input-group-btn"><button onclick="src_c('sqn','screlt','srn')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
		</div>
		<div id='screlt' align="left"></div>
		<br/>
		<button type="button" onclick="otab('tab_a','<?php echo $c_year; ?>','0','0','cnt');" class="btn btn-block btn-social btn-success">
			<i class="glyphicon glyphicon-list"></i> All Connection <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon"));?></span>
		</button>
		<br/>
	</div>
	<div class="col-md-6">
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Search By Area </h4>
		<div class="input-group">
			<input type="text" onkeyup="src_c('sqa','sarelt','sra')" id="sqa" class="form-control" style="text-align:center;" placeholder="Area">
			<span class="input-group-btn"><button onclick="src_c('sqa','sarelt','sra')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
		</div>
		<br/>
		<div id='sarelt'align="left">
			<?php	$qury = "SELECT * FROM `area` ORDER BY aname ASC";
					$row = mysqli_query($conn, $qury);
					while($ad = mysqli_fetch_array($row)) { ?>
				<button class="btn btn-default btn-block btn-flat" onclick="otab('tab_a','<?php echo $c_year; ?>','<?php echo $ad['id'];?>','0','cnt');"><?php echo $ad['name'];?> <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon where aid = ".$ad['id']));?></span></button> 
			<?php } ?>
		</div>
		<br/>
	</div>
	<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
		<i class="glyphicon glyphicon-home"></i> Home 
	</button>
	<br/>
</div>