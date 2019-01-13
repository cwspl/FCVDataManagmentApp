<?php
require("../../../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}

if(isset($_GET['cid']) && $_GET['cid'] != 0){
	$qury = "SELECT * FROM `vklist` WHERE `id` = '".$_GET['cid']."' ORDER BY aname ASC limit 1";
	$cd = mysqli_fetch_assoc(mysqli_query($conn, $qury));
	$head = $cd['name'];
} else {
	$qury = "SELECT * FROM `vklist` ORDER BY aname ASC";
	$head = 'All';
}
$row = mysqli_query($conn, $qury);
?>
<div align="center">
	<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Connection of <?php echo $head;?></h4></br>
	<button type="button" id="obtn" onclick="mtab('tab','table','obtn');" class="btn btn-lg btn-block btn-social btn-success" style="display:block;">
		<i class="glyphicon glyphicon-open"></i> Open Table
	</button>
	<div width="100%" class="table-responsive" id="tab" style="display:none;">
        <table width="100%" id="table" class="table table-bordered table-striped table-hover" cellspceing="0">
            <thead>
                <tr>
                    <th>Name</th>
					<th>Account No.</th>
                    <th>Mobile No.</th>
                </tr>
            </thead>
            <tbody>
			<?php while($data = mysqli_fetch_array($row)) {
					$aqury = "SELECT * FROM `vkacno` WHERE `cid` = '".$data['id']."' AND `stt` != '1' ORDER BY id ASC";
					$acno = mysqli_query($conn, $aqury);
					if(mysqli_num_rows($acno) > 0) {
				?>
				<tr id="refrow<?php echo $data['id'];?>">
					<td style="white-space: nowrap;"><button class="btn btn-default" onclick="odet('ccnt<?php echo $data['id'];?>','dtbtn<?php echo $data['id'];?>')"><i id="dtbtn<?php echo $data['id'];?>" class="glyphicon glyphicon-chevron-down"></i></button>
					<?php echo $data['name'];?><i style="display:none;"><?php echo $data['aname'];?></i>
					<br/><div id="ccnt<?php echo $data['id'];?>" style="display:none;">
					<button type="button" onclick="odiv_a('XF0/aadd','?id=<?php echo $data['id'];?>','conc<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-success"><i class="glyphicon glyphicon-plus"></i> Add Account No.</button>
					<button type="button" onclick="odiv_a('XF0/cdelt','?id=<?php echo $data['id'];?>','conc<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete Connection</button>
					<button type="button" onclick="refr('<?php echo $data['id'];?>','refrow<?php echo $data['id'];?>');" class="btn btn-block btn-social btn-default"><i class="glyphicon glyphicon-refresh"></i> Refresh </button>
					<div id='conc<?php echo $data['id'];?>'></div>
					</div>
					</td>
					<td>
					<table width="100%" class="table table-bordered table-striped table-hover" cellspceing="0">
					<tbody>
					<?php while($acd = mysqli_fetch_array($acno)) { ?>
						<tr>
							<td style="white-space: nowrap;background-color:<?php if($acd['stt'] == '1'){echo '#f4fff4';} else {echo '#ffa4a4';} ?>;"><button class="btn btn-sm btn-default" onclick="odet('acnt<?php echo $acd['id'];?>','adtbtn<?php echo $acd['id'];?>')"><i id="adtbtn<?php echo $acd['id'];?>" class="glyphicon glyphicon-chevron-down"></i></button> <?php echo $acd['acno'];?>
							<br/><div id="acnt<?php echo $acd['id'];?>" style="display:none;">
							<?php echo $acd['dat'];?><br/>
							<?php if($acd['stt'] == '1'){ ?> 
							<button type="button" onclick="odiv_a('XF0/disa','?id=<?php echo $acd['id'];?>','adcon<?php echo $acd['id'];?>');" class="btn btn-block btn-social btn-warning"><i class="glyphicon glyphicon-refresh"></i> Disable </button>
							<?php } else { ?>
							<button type="button" onclick="odiv_a('XF0/acta','?id=<?php echo $acd['id'];?>','adcon<?php echo $acd['id'];?>');" class="btn btn-block btn-social btn-warning"><i class="glyphicon glyphicon-refresh"></i> Active </button>
							<?php } ?>
							<button type="button" onclick="odiv_a('XF0/adelt','?id=<?php echo $acd['id'];?>','adcon<?php echo $acd['id'];?>');" class="btn btn-block btn-social btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
							<div id='adcon<?php echo $acd['id'];?>'></div>
							</div></td>
						</tr>
					<?php } ?>
					</tbody>
					</table>
					</td>
					<td><?php echo $data['mon'];?></td>
				</tr>
			<?php } } ?>			
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
					<th>Account No.</th>
                    <th>Mobile No.</th>
                </tr>
            </tfoot>
        </table>
    </div><br/>
	<button type="button" onclick="odiv('XF0/home', 'cnt');" class="btn btn-block btn-social btn-info">
		<i class="glyphicon glyphicon-home"></i> Home 
	</button><br/>
</div>