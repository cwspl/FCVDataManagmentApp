<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['q'])){
$q = $_GET['q'];
if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `area` WHERE `name` LIKE '%".$q."%'";
} else {
	$qury = "SELECT * FROM `area` t1 INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' AND t1.name LIKE '%".$q."%'";
}
$row = mysqli_query($conn, $qury);
$n = mysqli_num_rows($row);
if($n > 0){
	while($ad = mysqli_fetch_array($row)) { ?>
		<button class="btn btn-default btn-block btn-flat" onclick="otab('tab_a','<?php echo $c_year; ?>','<?php echo $ad['id'];?>','0','cnt')"><?php echo $ad['name'];?> <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon where aid = ".$ad['id']));?></span></button>
<?php } } else {
if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `area` WHERE `aname` LIKE '%".$q."%'";
} else {
	$qury = "SELECT t1.`id`, t1.`name`, t1.`aname` FROM `area` t1 INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' AND t1.aname LIKE '%".$q."%'";
}
$row = mysqli_query($conn, $qury);
$n = mysqli_num_rows($row);
if($n > 0){
	while($ad = mysqli_fetch_array($row)) { ?>
		<button class="btn btn-default btn-block btn-flat" onclick="otab('tab_a','<?php echo $c_year; ?>','<?php echo $ad['id'];?>','0','cnt')"><?php echo $ad['name'];?> <span class="badge"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ucon where aid = ".$ad['id']));?></span></button>
<?php } } else {?>
	<i> No Result Found !!</i>
<?php }  } }?>