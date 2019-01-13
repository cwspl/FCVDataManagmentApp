<?php
require("../../common.php");
if(!isset($_SESSION['fcv'])){
	header("Location: lock.php");
	die();
}
if(isset($_GET['cid']) && $_GET['cid'] != 0){
	$gcid = $_GET['cid'];
	$year = $_GET['yr'];
	$y = $_GET['yr'];
	$qury = "SELECT * FROM `ucon` WHERE `id` = '".$gcid."' ORDER BY aname ASC limit 1";
	$row = mysqli_query($conn, $qury);
	$maxtime = mktime(23,59,59,12,31,$year+2000);
	$mintime = mktime(23,59,59,12,31,$year+2000-1);
	$data = mysqli_fetch_assoc($row);
	$acnc = 1;
?>
<td style="white-space: nowrap;">
	<i style="display:none;"><?php echo $data['aname'];?></i>
	<button class="btn btn-default" onclick="odet('ccnt<?php echo $data['id'];?>','dtbtn<?php echo $data['id'];?>')"><i id="dtbtn<?php echo $data['id'];?>" class="glyphicon glyphicon-chevron-down"></i></button>
	<b style="font-size:15px;" ><?php if($data['ano'] == ""){echo "* ";} echo $data['name'];?></b><br/>
	<div id="ccnt<?php echo $data['id'];?>" style="display:none;">
		<br/>
		<b>Mobile NO.:</b> <?php echo $data['mno'];?><br/>
		<b>Account NO.</b><br/>
		<b><?php echo $acnc.") "?></b><?php echo $data['ano'];?><br/>
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
$a = 12;$year = $_GET['yr'];
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
<?php $a++; } }?>