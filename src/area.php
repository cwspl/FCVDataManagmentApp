<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
?>
<div align="left">
	<div class="col-md-4"></div>
	<div class="col-md-4" align="center" ><br/><span class="badge"><?php 
	if($_SESSION['fcv'] == 0){
		echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon"));
	} else {
		echo mysqli_num_rows(mysqli_query($conn, "SELECT t.`id`, t.`name`, t.`aname`, t.`aid`, t.`mno`, t.`ano`, t.`timc` FROM `ucon` t INNER JOIN `area` t1 ON t1.id = t.aid INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."'"));
	}
	?></span><br/>
		<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> All Area </h4><br/>
		<?php 
		if(date('m') == 12){
			$year = date('y')+1;
		} else {
			$year = date('y');
		}
		if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `area` Order by aname ASC";
} else {
	$qury = "SELECT t1.`id`, t1.`name`, t1.`aname` FROM `area` t1 INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' Order by t1.aname ASC";
}
$row = mysqli_query($conn, $qury);
$n = mysqli_num_rows($row);
if($n > 0){
	while($ad = mysqli_fetch_array($row)) { ?>
		<button class="btn btn-default btn-block btn-flat" onclick="otab('tab_a','<?php echo $c_year; ?>','<?php echo $ad['id'];?>','0','cnt')"><?php echo $ad['name'];?> <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon where aid = '".$ad['id']."'"));?></span></button>
<?php } } ?>
	</div>
	<div class="col-md-4"></div>
	<button type="button" onclick="odiv('home', 'cnt');" class="btn btn-block btn-social btn-info">
		<i class="glyphicon glyphicon-home"></i> Home 
	</button>
	<br/>
</div>