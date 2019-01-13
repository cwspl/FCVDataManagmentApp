<?php 
require("../common.php");
unset($_SESSION['fcv']);
unset($_SESSION);
session_destroy();
?>
<div align="center"><img src="img/logos.jpg" width="75%" style="max-width:400px"/></div><br/>
<div align="center" class="col-md-4"></div>
<div align="center" class="col-md-4">
<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Lock Mode </h4><br/>
<i align="center" id="er_pi" style="color:red;"><?php if(isset($_GET['er'])){echo "<i class='glyphicon glyphicon-remove'></i> ".$_GET['er'];}?></i>
<div>
	<h5>	
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<select name="uid" id="uid" class="form-control">
				<option value="0">Administor</option>
				<?php 
					$lgrow = mysqli_query($conn, "SELECT * FROM `dagt`");
					while($lgdata = mysqli_fetch_array($lgrow)) { ?>
				<option value="<?php echo $lgdata['id'];?>"><?php echo $lgdata['name'];?></option>
				<?php } ?>
				<option Disabled>----------------</option>
				<option value="XF0">Vasti Khandali</option>
			</select>
		</div>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input type="tel" maxlength="4" onblur="pc_log('pass','uid','er_pi','cnt')" onkeyup="pc_kup('pass','uid','er_pi','cnt')" name="pass" id="pass" class="form-control" style="text-align:center;" placeholder="Enter Passcode">
		</div>
	</h5>
	<h5 align="center"><button type="button" id="adm_log" onclick="pc_log('pass','uid','er_pi','cnt')" class="btn btn-default btn-block btn-lg"> Open </button></h5>
</div>
</div>
<div align="center" class="col-md-4"></div>
<br/>
<script>document.getElementById("pass").focus();</script>
