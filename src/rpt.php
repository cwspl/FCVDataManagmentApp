<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['yr'])){
	$year = $_GET['yr'];
} else {
	$year = date('y');
}
$area = 4;
$y = $year;
$maxtime = mktime(23,59,59,12,31,$year+2000);
$mintime = mktime(23,59,59,12,31,$year+2000-1);
?>
<div align="center">
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Total Jama by Area</h4>
	<div class="input-group">
		<span class="input-group-addon">Year</span>
		<select class="form-control" id="tjs" onchange="tjama('tjs')">
			<option disabled selected>SELECT</option>
			<?php
				$ty='16';
				if(date('m') == 12){
					$temp_year = date('y');
				} else {
					$temp_year = date('y');
				}
				while($ty <= $temp_year){
			?>
				<option value="<?php echo $ty;?>"><?php echo $ty+2000; ?></option>
			<?php 
			$ty++;
			} $ty--;?>
		</select>
	</div><br/><br/>
	<?php 
	if(isset($_GET['y'])){
		$y=$_GET['y']; ?>
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"><?php echo $y+2000; ?></h4>
	<div class="table-responsive" id="tab" style="display:block;">
        <table id="table" class="table table-bordered table-striped table-hover" cellspceing="0">
            <thead>
                <tr>
                    <th>Area Name</th>
                    <?php 
					$a = 1;
					while($a <= 12) { $c = '';
					if(mktime(0,0,0,(date('m')-1),1,date('y')+2000) == mktime(0,0,0,$a,1,date('y')+2000)){ $c = ' style="background-color:#c3ffc4;"';}
					echo '<th'.$c.'>'.date('F', mktime(0,0,0,$a,1,2000)).'</th>'; 
					$ftotal[$a] = 0;
					$a++;  } ?>
                </tr>
            </thead>
            <tbody>
				<?php 
				if($_SESSION['fcv'] == 0){
					$aqury = "SELECT * FROM `area` Order by aname ASC";
				} else {
					$aqury = "SELECT * FROM `area` t1 INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' Order by t1.aname ASC";
				}
				$arow = mysqli_query($conn, $aqury);
				while($ar = mysqli_fetch_array($arow)) { ?>
				<tr>
				<?php 
				echo '<td>'.$ar['name'].'</td>';
				$a = 1;
				while($a <= 12) {
					$c = '';
					if(mktime(0,0,0,(date('m')-1),1,date('y')+2000) == mktime(0,0,0,$a,1,date('y')+2000)){ $c = ' style="background-color:#c3ffc4;"';}
					$tjama = 0;
					$tbaki = 0;
					$qury = "SELECT * FROM `ucon` where aid = '".$ar['id']."'";
					$row = mysqli_query($conn, $qury);
					while($data = mysqli_fetch_array($row)) {
						$jqury = "SELECT * FROM `jama` where cid = '".$data['id']."' and timc = '".mktime(0,0,0,$a,1,$y+2000)."'";
						$jrow = mysqli_query($conn, $jqury);
						if(mysqli_num_rows($jrow) > 0){
							while($jdata = mysqli_fetch_array($jrow)) {
								$tjama = $tjama+$jdata['amt'];
							}
						}
					}
					$ftotal[$a] = $ftotal[$a]+$tjama;
					?>
					<td <?php echo $c;?>><?php echo $tjama;?></td>
				<?php $a++; } ?>
				</tr>
				<?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <?php 
					$a = 1;
					while($a <= 12) { $c = '';
					if(mktime(0,0,0,(date('m')-1),1,date('y')+2000) == mktime(0,0,0,$a,1,date('y')+2000)){ $c = ' style="background-color:#c3ffc4;"';}
					echo '<th'.$c.'>'.$ftotal[$a].'</th>'; ?>
					<?php $a++;  } ?>
                </tr>
            </tfoot>
        </table>
    </div><br/>
	<?php } ?>
	<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
		<i class="glyphicon glyphicon-home"></i> Home 
	</button><br/>
</div>