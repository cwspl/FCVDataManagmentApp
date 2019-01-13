<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<div align="left">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<?php if(isset($_GET['id'])) { 
		$di = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `dagt` WHERE `id` = '".$_GET['id']."' LIMIT 1"));
		?>
		<div id="nconn">
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Edit App User </h4>
			<i style="color:red;" id="err"></i></br>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" id="name" class="form-control" style="text-align:left;" placeholder="User Name" value="<?php echo $di['name'];?>">
			</div><br/>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="tel" id="pass" maxlength="4" class="form-control" style="text-align:left;" placeholder="New Passcode" value="<?php echo $di['psc'];?>">
			</div><br/>
			<label style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;">Select for Area</label><br/>
			<?php 
			$qury = "SELECT * FROM `area` Order by aname ASC";
			$row = mysqli_query($conn, $qury);
				while($ad = mysqli_fetch_array($row)) { 
				if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `arda` WHERE aid = '".$ad['id']."' AND daid = '".$di['id']."'")) != 0){
				?>
			<input type="hidden" id="auarea<?php echo $ad['id'];?>" value="1"/>
			<button type="button" id="btnauarea<?php echo $ad['id'];?>" onclick="aatu('auarea<?php echo $ad['id'];?>','btnauarea<?php echo $ad['id'];?>','<?php echo $ad['name'];?>');" class="btn btn-block btn-social btn-danger">
				<i class="glyphicon glyphicon-remove"></i> <?php echo $ad['name'];?>
			</button>
			<?php } else {?>
			<input type="hidden" id="auarea<?php echo $ad['id'];?>" value="0"/>
			<button type="button" id="btnauarea<?php echo $ad['id'];?>" onclick="aatu('auarea<?php echo $ad['id'];?>','btnauarea<?php echo $ad['id'];?>','<?php echo $ad['name'];?>');" 
			<?php if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `arda` WHERE aid = '".$ad['id']."'")) != 0){ ?>
			class="btn btn-block btn-social btn-warning" disabled
			<?php } else { ?>
			class="btn btn-block btn-social btn-default"
			<?php }?>
			>
				<i class="glyphicon glyphicon-plus"></i> <?php echo $ad['name'];?>
			</button>
		<?php } }?>
			<input value='<?php $row = mysqli_query($conn, "SELECT * FROM `area` Order by aname ASC"); while($ad = mysqli_fetch_array($row)) { echo ", \"auarea".$ad['id']."\""; }?>' id="araarry" type="hidden" />
			<br/><button type="button" onclick="aaapusr('err','nconn','<?php echo $di['id'];?>')" class="btn btn-block btn-lg btn-social btn-primary">
				<i class="glyphicon glyphicon-floppy-disk"></i> Save App User
			</button><br/>
			<button type="button" onclick="document.getElementById('duhs').style.display = 'block'" class="btn btn-block btn-lg btn-social btn-danger">
				<i class="glyphicon glyphicon-remove"></i> Delete This User
			</button><br/>
			<div align="center" id="duhs" style="display:none;">
			<i> Do you want to Delete <?php echo $di['name'];?> User ?</i><br/>
			<button type="button" onclick="odiv_a('raapu', '?delete=<?php echo $di['id'];?>', 'nconn')" class="btn btn-social btn-success">
				<i class="glyphicon glyphicon-ok"></i> Yes
			</button>
			<button type="button" onclick="document.getElementById('duhs').style.display = 'none'" class="btn btn-social btn-danger">
				<i class="glyphicon glyphicon-remove"></i> No
			</button>
			<br/><br/>
			</div>
		</div>
		<?php } else { ?>
		<div id="nconn">
			<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Add New App User </h4>
			<i style="color:red;" id="err"></i></br>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" id="name" class="form-control" style="text-align:left;" placeholder="User Name">
			</div><br/>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="tel" id="pass" maxlength="4" class="form-control" style="text-align:left;" placeholder="New Passcode">
			</div><br/>
			<label style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;">Select for Area</label><br/>
			<?php 
			$qury = "SELECT * FROM `area` Order by aname ASC";
			$row = mysqli_query($conn, $qury);
				while($ad = mysqli_fetch_array($row)) { ?>
			<input type="hidden" id="auarea<?php echo $ad['id'];?>" value="0"/>
			<button type="button" id="btnauarea<?php echo $ad['id'];?>" onclick="aatu('auarea<?php echo $ad['id'];?>','btnauarea<?php echo $ad['id'];?>','<?php echo $ad['name'];?>');" 
			<?php if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `arda` WHERE aid = '".$ad['id']."'")) != 0){ ?>
			class="btn btn-block btn-social btn-warning" disabled
			<?php } else { ?>
			class="btn btn-block btn-social btn-default"
			<?php }?>
			>
				<i class="glyphicon glyphicon-plus"></i> <?php echo $ad['name'];?>
			</button>
			<?php } ?>
			<input value='<?php $row = mysqli_query($conn, "SELECT * FROM `area` Order by aname ASC"); while($ad = mysqli_fetch_array($row)) { echo ", \"auarea".$ad['id']."\""; }?>' id="araarry" type="hidden" />
			<br/><button type="button" onclick="aaapusr('err','nconn','X')" class="btn btn-block btn-lg btn-social btn-primary">
				<i class="glyphicon glyphicon-plus"></i> Add App User
			</button><br/>
		</div>
		<?php } ?>
	</div>
	<div class="col-md-4"></div>
	<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
		<i class="glyphicon glyphicon-home"></i> Home 
	</button>
	<br/>
</div>