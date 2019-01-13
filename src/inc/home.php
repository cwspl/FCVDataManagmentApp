<?php
if(isset($_GET['p'])){
	if($_GET['u'] == '0'){
		if($_GET['p'] == (date('i').date('h'))){
			$_SESSION['fcv'] = 0;
		} else {
			header("Location: lock.php?er=Wrong Passcode");
			die();
		}
	} else {
		$ur = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `dagt` where id = '".$_GET['u']."'"));
		if($_GET['p'] == $ur['psc']){
			$_SESSION['fcv'] = $ur['id'];
		} else {
			header("Location: lock.php?er=Wrong Passcode");
			die();
		}
	}
}
if(!isset($_SESSION['fcv'])){
	header("Location: lock.php");
	die();
}
?>
<div align="center">
	<div class="col-md-6">
		<h5 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="left">Total Connection - <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon")); ?></span></h5>
		<h5 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="left">Total SetTopBox - <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon where `ano` != ''"))+mysqli_num_rows(mysqli_query($conn, "SELECT * FROM acno")); ?></span> ( <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM acno")); ?></span> - Multiple)</h5>
		<button type="button" onclick="odiv('area', 'cnt');" class="btn btn-lg btn-block btn-social btn-info">
			<i class="glyphicon glyphicon-map-marker"></i> All Area <span class="badge"><?php if($_SESSION['fcv'] == 0){
					echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM area"));
				} else {
					echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `area` t1 INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."'"));
				} ?></span>
		</button>
		<br/>
	</div>
	<div class="col-md-6">
		<button type="button" onclick="odiv('ada', 'cnt');" class="btn btn-lg btn-block btn-social btn-success">
			<i class="glyphicon glyphicon-plus"></i> Add 
		</button>
		<br/>
		<button type="button" onclick="odiv('qedit', 'cnt');" class="btn btn-lg btn-block btn-social btn-warning">
			<i class="glyphicon glyphicon-pencil"></i> Quick Edit
		</button>
		<br/>
		<h5 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="left"> Search By Name </h5>
		<div class="input-group">
			<input type="text" onkeyup="src_c('sqn','screlt','srn')" id="sqn" class="form-control" style="text-align:center;" placeholder="Name">
			<span class="input-group-btn"><button onclick="src_c('sqn','screlt','srn')" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button></span>
		</div>
		<div id='screlt' align="left"></div><br/>
		<?php if($_SESSION['fcv'] == 0){ ?>
		<button type="button" onclick="odiv('apusr', 'cnt');" class="btn btn-lg btn-block btn-social btn-primary">
			<i class="glyphicon glyphicon-user"></i> App User <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dagt")); ?></span>
		</button>
		<br/>
		<?php } else { ?>
		<button type="button" onclick="odiv('edp', 'cnt');" class="btn btn-lg btn-block btn-social btn-primary">
			<i class="glyphicon glyphicon-lock"></i> Change Passcode
		</button>
		<br/>
		<?php } ?>
		<button type="button" onclick="odiv('rpt', 'cnt');" class="btn btn-block btn-social btn-danger">
			<i class="glyphicon glyphicon-certificate"></i> <h4> Total Report</h4>
		</button>
		<br/>
	</div>
	<a href="http://webapp.gtpl.net:84/login.aspx"><button type="button" class="btn btn-lg btn-block btn-social btn-default">
		<img src="img/gtpl.png" width="24px" height="24px" /> GTPL Activation
	</button></a>
	<br/>
	<button type="button" onclick="odiv('mtns', 'cnt');" class="btn btn-lg btn-block btn-social btn-default">
		<i class="glyphicon glyphicon-wrench"></i> Data Maintenance
	</button>
	<br/>
</div>