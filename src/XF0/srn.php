<?php
require("../../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] != 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['q'])){
$q = $_GET['q'];
$qury = "SELECT * FROM `vklist` WHERE `name` LIKE '%".$q."%'";
$row = mysqli_query($conn, $qury);
$n = mysqli_num_rows($row);
if($n > 0){
	while($ad = mysqli_fetch_array($row)) {
	?>
	<button class="btn btn-default btn-sm btn-block btn-flat" onclick="odiv_a('XF0/tab/tab_a','?cid=<?php echo $ad['id'];?>','cnt')"><b><?php echo $ad['name'];?></b></button>
<?php } } else {
$q = $_GET['q'];
$qury = "SELECT * FROM `vklist` WHERE `aname` LIKE '%".$q."%'";
$row = mysqli_query($conn, $qury);
$n = mysqli_num_rows($row);
if($n > 0){
	while($ad = mysqli_fetch_array($row)) { 
	?>
	<button class="btn btn-default btn-sm btn-block btn-flat" onclick="odiv_a('XF0/tab/tab_a','?cid=<?php echo $ad['id'];?>','cnt')"><b><?php echo $ad['name'];?></b></button>
<?php } } else {
	$q = $_GET['q'];
	if(strlen($q)==10){
	$qury = "SELECT * FROM `vklist` WHERE `mon` LIKE '%".$q."%'";
	$row = mysqli_query($conn, $qury);
	$n = mysqli_num_rows($row);
	if($n > 0){
		while($ad = mysqli_fetch_array($row)) {
		?>
		<button class="btn btn-default btn-sm btn-block btn-flat" onclick="odiv_a('XF0/tab/tab_a','?cid=<?php echo $ad['id'];?>','cnt')"><b><?php echo $ad['name'];?></b></button>
	<?php }
	}
	}
}
} }?>