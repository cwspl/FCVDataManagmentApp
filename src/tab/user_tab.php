<?php
require("../../common.php");
if(!isset($_SESSION['fcv'])){
	header("Location: lock.php");
	die();
}
if(isset($_GET['ar']) && $_GET['ar'] != 0){
	$area = $_GET['ar'];
	$gcid = 0;
	$qury = "SELECT * FROM `ucon` WHERE `aid` = '".$area."' ORDER BY aname ASC";
	$ar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `area` where id = '".$area."'"));
	$head = $ar['name'];
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
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Area : <?php echo $head;?></h4></br>
	<div width="100%" class="table-responsive" id="tab">
		<div align="left">
		<a href="http://print.wellwork.in/de.php?a=<?php echo $area; ?>"><button type="button" class="btn btn-social btn-primary">
			<i class="glyphicon glyphicon-print"></i> Print
		</button></a><br/>
		</div>
        <table width="100%" id="table" class="table table-bordered table-striped table-hover" cellspceing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Account Number</th>
                </tr>
            </thead>
            <tbody>
			<?php while($data = mysqli_fetch_array($row)) { ?>
                <tr id="refrow<?php echo $data['id'];?>">
                    <td style="white-space: nowrap;">
						<i style="display:none;"><?php echo $data['aname'];?></i>
						<b><?php echo $data['name'];?></b>
					</td>
					<td style="white-space: nowrap;">
						<?php echo $data['mno'];?>
					</td>
					<td>
						<b><?php 
						$acrow = mysqli_query($conn,"SELECT * FROM `acno` WHERE `cid` = '".$data['id']."'");
						$acnc = 1;
						if(mysqli_num_rows($acrow) > 0){
							echo $acnc.") ";
						}
						?></b><?php echo $data['ano'];?><br/>
							<?php 
							while($acno = mysqli_fetch_array($acrow)) { 
								$acnc = $acnc+1;?>
								<b><?php echo $acnc.") "?></b><?php echo $acno['acno'];?><br/>
							<?php } ?>
					</td>
                </tr>
			<?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Account Number</th>
                </tr>
            </tfoot>
        </table>
    </div><br/>
	<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
		<i class="glyphicon glyphicon-home"></i> Home 
	</button><br/>
</div>