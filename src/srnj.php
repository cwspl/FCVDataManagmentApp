<?php
require("../common.php");
if(!isset($_SESSION['fcv']) || $_SESSION['fcv'] == 'XF0'){
	header("Location: lock.php");
	die();
}
if(isset($_GET['q'])){
$q = $_GET['q'];
if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `ucon` WHERE `name` LIKE '%".$q."%'";
} else {
	$qury = "SELECT t.`id`, t.`name`, t.`aname`, t.`aid`, t.`mno`, t.`ano`, t.`timc` FROM `ucon` t INNER JOIN `area` t1 ON t1.id = t.aid INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' AND t.name LIKE '%".$q."%'";
}
$row = mysqli_query($conn, $qury);
$n = mysqli_num_rows($row);
if($n > 0){
	while($ad = mysqli_fetch_array($row)) { 
	$ad2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `area` where id = '".$ad['aid']."'"));
	?>
	<button class="btn btn-default btn-sm btn-block btn-flat" onclick="odiv_a('ejm','?cid=<?php echo $ad['id'];?>','cn2')"><b><?php echo $ad['name'];?></b><br/><i><?php echo $ad2['name'];?></i></button>
<?php } } else {
$q = $_GET['q'];
if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `ucon` WHERE `aname` LIKE '%".$q."%'";
} else {
	$qury = "SELECT t.`id`, t.`name`, t.`aname`, t.`aid`, t.`mno`, t.`ano`, t.`timc` FROM `ucon` t INNER JOIN `area` t1 ON t1.id = t.aid INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' AND t.aname LIKE '%".$q."%'";
}
$row = mysqli_query($conn, $qury);
$n = mysqli_num_rows($row);
if($n > 0){
	while($ad = mysqli_fetch_array($row)) { 
	$ad2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `area` where id = '".$ad['aid']."'"));
	?>
	<button class="btn btn-default btn-sm btn-block btn-flat" onclick="odiv_a('ejm','?cid=<?php echo $ad['id'];?>','cn2')"><b><?php echo $ad['name'];?></b><br/><i><?php echo $ad2['name'];?></i></button>
<?php } } else {
	$q = $_GET['q'];
	if(strlen($q)==10){
if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `ucon` WHERE `mno` LIKE '%".$q."%'";
} else {
	$qury = "SELECT t.`id`, t.`name`, t.`aname`, t.`aid`, t.`mno`, t.`ano`, t.`timc` FROM `ucon` t INNER JOIN `area` t1 ON t1.id = t.aid INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' AND t.mno LIKE '%".$q."%'";
}
	$row = mysqli_query($conn, $qury);
	$n = mysqli_num_rows($row);
	if($n > 0){
		while($ad = mysqli_fetch_array($row)) {
		$ad2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `area` where id = '".$ad['aid']."'"));
		?>
		<button class="btn btn-default btn-sm btn-block btn-flat" onclick="odiv_a('ejm','?cid=<?php echo $ad['id'];?>','cn2')"><b><?php echo $ad['name'];?></b><br/><i><?php echo $ad2['name'];?></i></button>
	<?php }
	}
	} else {
if($_SESSION['fcv'] == 0){
	$qury = "SELECT * FROM `ucon` WHERE `ano` LIKE '%".$q."%'";
} else {
	$qury = "SELECT t.`id`, t.`name`, t.`aname`, t.`aid`, t.`mno`, t.`ano`, t.`timc` FROM `ucon` t INNER JOIN `area` t1 ON t1.id = t.aid INNER JOIN `arda` t2 ON t1.id = t2.aid WHERE t2.daid = '".$_SESSION['fcv']."' AND t.ano LIKE '%".$q."%'";
}
	$row = mysqli_query($conn, $qury);
	$n = mysqli_num_rows($row);
	if($n > 0){
		while($ad = mysqli_fetch_array($row)) {
		$ad2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `area` where id = '".$ad['aid']."'"));
		?>
		<button class="btn btn-default btn-sm btn-block btn-flat" onclick="odiv_a('ejm','?cid=<?php echo $ad['id'];?>','cn2')"><b><?php echo $ad['name'];?></b><br/><i><?php echo $ad2['name'];?></i></button>
	<?php }
	}
	}
}
} }?>