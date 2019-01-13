<?php
require("../../common.php");
if(!isset($_SESSION['fcv'])){
	header("Location: lock.php");
	die();
}
if(isset($_GET['yr'])){
	$year = $_GET['yr'];
} else {
	if(date('m') == 12){
		$year = date('y');
	} else {
		$year = date('y');
	}
}
if(isset($_GET['ar']) && $_GET['ar'] != 0){
	$area = $_GET['ar'];
	$gcid = 0;
	$qury = "SELECT * FROM `ucon` WHERE `aid` = '".$area."' ORDER BY aname ASC";
	$ar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `area` where id = '".$area."'"));
	$head = $ar['name'];
} else if(isset($_GET['cid']) && $_GET['cid'] != 0){
	$area = 0;
	$gcid = $_GET['cid'];
	$qury = "SELECT * FROM `ucon` WHERE `id` = '".$gcid."' ORDER BY aname ASC limit 1";
	$cd = mysqli_fetch_assoc(mysqli_query($conn, $qury));
	$ar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `area` where id = '".$cd['aid']."'"));
	$head = $cd['name'].' from '.$ar['name'];
} else {
	$area = 0;
	$gcid = 0;
	$qury = "SELECT * FROM `ucon` ORDER BY aname ASC";
	$head = 'All';
}
$y = $year;
$row = mysqli_query($conn, $qury);
$maxtime = mktime(23,59,59,12,31,$year+2000);
$mintime = mktime(23,59,59,12,31,$year+2000-1);
$acnc = 1;
?>
<div align="center">
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Connection Table of <?php echo $head;?></h4></br>
	<div class="input-group">
		<span class="input-group-addon">Year</span>
		<select class="form-control" id="tbyr" onchange="otab_y('tab_a','tbyr','<?php echo $area; ?>','<?php echo $gcid; ?>', 'cnt')">
			<?php
				$y='16';
				if(date('m') == 12){
					$temp_year = date('y');
				} else {
					$temp_year = date('y');
				}
				while($y <= $temp_year){
			?>
				<option value="<?php echo $y;?>" <?php if($y==$year){echo 'selected';} ?>><?php echo $y+2000; ?></option>
			<?php 
			$y++;
			} $y--;?>
		</select>
	</div><input id='yval' type="hidden" value="<?php echo $year;?>;"><br/>
	<button type="button" id="obtn" onclick="mtab('tab','table','obtn');" class="btn btn-lg btn-block btn-social btn-success" style="display:block;">
		<i class="glyphicon glyphicon-open"></i> Open Table
	</button>
	<div width="100%" class="table-responsive" id="tab" style="display:none;">
		<div align="left">
		<a href="http://print.wellwork.in/index2.php?y=<?php echo $year.'&a='.$area; ?>"><button type="button" class="btn btn-social btn-primary">
			<i class="glyphicon glyphicon-print"></i> Print
		</button></a>   
		<a href="http://print.wellwork.in/cfull.php?y=<?php echo $year.'&a='.$area; ?>"><button type="button" class="btn btn-social btn-primary">
			<i class="glyphicon glyphicon-print"></i> Print All Month
		</button></a> 
		<a href="http://print.wellwork.in/detail.php?y=<?php echo $year.'&a='.$area; ?>"><button type="button" class="btn btn-social btn-primary">
			<i class="glyphicon glyphicon-print"></i> Print Connection Details
		</button></a><br/>
		</div>
        <table width="100%" id="table" class="table table-bordered table-striped table-hover" cellspceing="0">
            <thead>
                <tr>
                    <th rowspan="2">Name</th>
                    <th colspan="2">Jan</th>
                    <th colspan="2">Feb</th>
                    <th colspan="2">March</th>
                    <th colspan="2">April</th>
                    <th colspan="2">May</th>
                    <th colspan="2">June</th>
                    <th colspan="2">July</th>
                    <th colspan="2">Aug</th>
                    <th colspan="2">Sept</th>
                    <th colspan="2">Oct</th>
                    <th colspan="2">Nov</th>
                    <th colspan="2">Dec</th>
                </tr>
				<tr>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
					<th></th><th></th>
				</tr>
            </thead>
            <tbody>
			<?php while($data = mysqli_fetch_array($row)) { ?>
                <tr id="refrow<?php echo $data['id'];?>">
                    <td style="white-space: nowrap;">
						<i style="display:none;"><?php echo $data['aname'];?></i>
						<button class="btn btn-default" onclick="odet('ccnt<?php echo $data['id'];?>','dtbtn<?php echo $data['id'];?>')"><i id="dtbtn<?php echo $data['id'];?>" class="glyphicon glyphicon-chevron-down"></i></button>
						<b style="font-size:15px;" ><?php if($data['ano'] == ""){echo "* ";} echo $data['name'];?></b><br/>
						<div id="ccnt<?php echo $data['id'];?>" style="display:none;">
							<br/>
							<b>Mobile NO.:</b> <?php echo $data['mno'];?><br/>
							<b>Account NO.</b><br/>
							<b><?php $acnc = 1; echo $acnc.") "?></b><?php echo $data['ano'];?><br/>
							<?php 
							$acrow = mysqli_query($conn,"SELECT * FROM `acno` WHERE `cid` = '".$data['id']."'");
							while($acno = mysqli_fetch_array($acrow)) { 
								$acnc = $acnc+1;?>
								<b><?php echo $acnc.") "?></b><?php echo $acno['acno'];?><br/>
							<?php } ?>
							<br/>
							<button type="button" onclick="odiv_a('adf','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-success"><i class="glyphicon glyphicon-plus"></i> Add Fund</button>
							<button type="button" onclick="odiv_a('cmf','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-primary"><i class="glyphicon glyphicon-calendar"></i> Change Monthly Fund</button>
							<button type="button" onclick="odiv_a('ejm','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-danger"><i class="glyphicon glyphicon-floppy-remove"></i> Erase Jama Fund</button>
							<button type="button" onclick="odiv_a('edc','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-warning"><i class="glyphicon glyphicon-pencil"></i> Edit Information</button>
							<button type="button" onclick="odiv_a('acno','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-warning"><i>#</i> Extra Account No.</button>
							<button type="button" onclick="odiv_a('dltc','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete Connection</button>
							<?php
								$ab2btnq = mysqli_query($conn, "SELECT * FROM `baki` WHERE `cid` = '".$data['id']."' AND `timr` <= '".mktime(0,0,0,date('y')+0,1,date('y')+2000)."' order by `timr` DESC limit 1");
								if(mysqli_num_rows($ab2btnq) == 1){
									$ab2btn = mysqli_fetch_assoc($ab2btnq);
									if($ab2btn['amt'] == 0){ ?>
							<button type="button" onclick="odiv_a('rco','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-primary"><i class="glyphicon glyphicon-repeat"></i> Restart Connection </button>
							<?php  } else { ?> 
							<button type="button" onclick="odiv_a('bco','?cid=<?php echo $data['id'];?>','tchg<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-warning"><i class="glyphicon glyphicon-ban-circle"></i> Block Connection</button>
							<?php }	} ?>
							<br/><div id="tchg<?php echo $data['id'];?>"></div><br/>
							<button type="button" onclick="refrow('<?php echo $data['id'];?>','yval','refrow<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-default"><i class="glyphicon glyphicon-refresh"></i> Refresh </button>
							<br/>
						</div>
					</td>
					<?php 
					$a = 12;
					while($a >= 1) {
						$stime = mktime(0,0,0,$a,1,$year+2000);
						$fba = mysqli_query($conn, "SELECT * FROM `baki` WHERE `cid` = '".$data['id']."' AND `timr` <= ".$stime." order by `timr` DESC");
						$afb[$a]=0;
						$tm = $stime;
						while($dfba = mysqli_fetch_array($fba)) {
							$afb[$a]=$afb[$a]+(((date('y',$tm) - date('y',$dfba['timr'])) * 12) + (date('m',$tm) - date('m',$dfba['timr']))+1)*$dfba['amt'];
							if(date('m',$dfba['timr'])!=01){
								$tm = mktime(0,0,0,(date('m',$dfba['timr'])-1),1,date('Y',$dfba['timr']));
							} else {
								$tm = mktime(0,0,0,12,1,(date('Y',$dfba['timr'])-1));
							}
						}
						$fja = mysqli_query($conn, "SELECT * FROM `jama` WHERE `cid` = '".$data['id']."' AND `timc` < ".$stime);
						while($dfja = mysqli_fetch_array($fja)) {
							$afb[$a]=$afb[$a]-$dfja['amt'];
						}
						$afj[$a]=0;
						$fja = mysqli_query($conn, "SELECT * FROM `jama` WHERE `cid` = '".$data['id']."' AND `timc` = ".$stime);
						while($dfja = mysqli_fetch_array($fja)) {
							$afj[$a]=$afj[$a]+$dfja['amt'];
						}
						$a--;
					}
					$a = 1;
					while($a <= 12) {
					   if($year == date('y')){
							$cm = date('m')-1;
							$dst = $afb[$cm]-$afj[$cm];
							if($dst > 0){
								$rbc = '#fff4f4';
							} else {
								$rbc = '#f4fff4';
							}
						} else {
							$dst = $afb[12]-$afj[12];
							if($dst > 0){
								$rbc = '#fff4f4';
							} else {
								$rbc = '#f4fff4';
							}
						}
						if($afj[$a]<=0){$afj[$a]='-';}
						if($afb[$a]<=0){$afb[$a]='-';}
						$fbaki = $afb[$a];
						$fjama = $afj[$a];
					?>                     
					<td style="color:red;white-space: nowrap;background-color:<?php echo $rbc;?>;"><?php echo $fbaki;?></td><td style="color:blue;white-space: nowrap;background-color:<?php echo $rbc;?>;"><?php echo $fjama;?></td>
					<?php $a++; } ?>
                </tr>
			<?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th colspan="2">Jan</th>
                    <th colspan="2">Feb</th>
                    <th colspan="2">March</th>
                    <th colspan="2">April</th>
                    <th colspan="2">May</th>
                    <th colspan="2">June</th>
                    <th colspan="2">July</th>
                    <th colspan="2">Aug</th>
                    <th colspan="2">Sept</th>
                    <th colspan="2">Oct</th>
                    <th colspan="2">Nov</th>
                    <th colspan="2">Dec</th>
                </tr>
            </tfoot>
        </table>
    </div><br/>
	<button type="button" style="display:none;" onclick="otab('user_tab','<?php echo date('y'); ?>','<?php echo $_GET['ar'];?>','0','cnt')" class="btn btn-lg btn-block btn-social btn-warning">
		<i class="glyphicon glyphicon-open"></i> Connection Details
	</button>
	<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
		<i class="glyphicon glyphicon-home"></i> Home 
	</button><br/>
</div>