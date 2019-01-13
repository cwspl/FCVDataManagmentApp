<?php
require("../../../common.php");
if(!isset($_SESSION['fcv'])){
	header("Location: lock.php");
	die();
}
if(isset($_GET['cid']) && $_GET['cid'] != 0){
	$gcid = $_GET['cid'];
	$qury = "SELECT * FROM `vklist` WHERE `id` = '".$_GET['cid']."' ORDER BY aname ASC limit 1";
	$row = mysqli_query($conn, $qury);
	$data = mysqli_fetch_assoc($row);
	$aqury = "SELECT * FROM `vkacno` WHERE `cid` = '".$data['id']."' ORDER BY id ASC";
	$acno = mysqli_query($conn, $aqury);
?>
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
		<button type="button" onclick="odiv_a('XF0/disa','?id=<?php echo $acd['id'];?>','adcon<?php echo $acd['id'];?>');" class="btn btn-block btn-social btn-warning"><i class="glyphicon glyphicon-refresh"></i> Inactive </button>
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
<?php } ?>