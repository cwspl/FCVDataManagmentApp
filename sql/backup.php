<?php 
require("../common.php");
$a = "CREATE TABLE IF NOT EXISTS `area`(`id` int(5) NOT NULL AUTO_INCREMENT,`name` varchar(255) NOT NULL,`aname` varchar(255) NOT NULL,PRIMARY KEY (`id`)) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `ucon`(`id` int(5) NOT NULL AUTO_INCREMENT,`name` varchar(255) NOT NULL,`aname` varchar(255) NOT NULL,`aid` varchar(255) NOT NULL,`mno` varchar(255) NOT NULL,`ano` varchar(255) NOT NULL,`timc` varchar(255) NOT NULL,PRIMARY KEY (`id`)) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `baki`(`id` int(5) NOT NULL AUTO_INCREMENT,`cid` varchar(255) NOT NULL,`amt` varchar(255) NOT NULL,`timr` varchar(255) NOT NULL,`timc` varchar(255) NOT NULL,PRIMARY KEY (`id`)) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `jama`(`id` int(5) NOT NULL AUTO_INCREMENT,`cid` varchar(255) NOT NULL,`amt` varchar(255) NOT NULL,`timc` varchar(255) NOT NULL,PRIMARY KEY (`id`)) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `prfcv`(`id` int(5) NOT NULL AUTO_INCREMENT,`pid` varchar(255) NOT NULL,`per` varchar(255) NOT NULL,`cid` varchar(255) NOT NULL,`aid` varchar(255) NOT NULL,`yr` varchar(255) NOT NULL,`dat` varchar(255) NOT NULL,`timc` varchar(255) NOT NULL,PRIMARY KEY (`id`)) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
";
$qury = "SELECT * FROM `area`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t1 = "";
	while($data = mysqli_fetch_array($row)) {
	$t1 = $t1."INSERT INTO `area`(`id`,`name`,`aname`)VALUES('".$data['id']."','".$data['name']."','".$data['aname']."')ON DUPLICATE KEY UPDATE `id`='".$data['id']."', `name`='".$data['name']."', `aname`='".$data['aname']."';
";
	}
}
$qury = "SELECT * FROM `ucon`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t2 = "";
	while($data = mysqli_fetch_array($row)) {
	$t2 = $t2."INSERT INTO `ucon`(`id`,`name`,`aname`,`aid`,`mno`,`ano`,`timc`)VALUES('".$data['id']."','".$data['name']."','".$data['aname']."','".$data['aid']."','".$data['mno']."','".$data['ano']."','".$data['timc']."')ON DUPLICATE KEY UPDATE `id`='".$data['id']."',`name`='".$data['name']."',`aname`='".$data['aname']."',`aid`='".$data['aid']."',`mno`='".$data['mno']."',`ano`='".$data['ano']."',`timc`='".$data['timc']."';
";
	}
}
$qury = "SELECT * FROM `baki`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t3 = "";
	while($data = mysqli_fetch_array($row)) {
	$t3 = $t3."INSERT INTO `baki`(`cid`,`amt`,`timr`,`timc`) SELECT * FROM (SELECT '".$data['cid']."' AS `cid`,'".$data['amt']."' AS `amt`,'".$data['timr']."' AS `timr`,'".$data['timc']."' AS `timc`) AS tmp WHERE NOT EXISTS ( SELECT * FROM `baki` WHERE `cid`='".$data['cid']."' AND `amt`= '".$data['amt']."' AND `timr`='".$data['timr']."' AND `timc`='".$data['timc']."' ) LIMIT 1;
";
	}
}
$qury = "SELECT * FROM `jama`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t4 = "";
	while($data = mysqli_fetch_array($row)) {
	$t4 = $t4."INSERT INTO `jama`(`cid`,`amt`,`timc`) SELECT * FROM (SELECT '".$data['cid']."' AS `cid`,'".$data['amt']."' AS `amt`,'".$data['timc']."' AS `timc`) AS tmp WHERE NOT EXISTS ( SELECT * FROM `jama` WHERE `cid`='".$data['cid']."' AND `amt`= '".$data['amt']."' AND `timc`='".$data['timc']."' ) LIMIT 1;
";
	}
}
$qury = "SELECT * FROM `dagt`"; 
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t5 = "";
	while($data = mysqli_fetch_array($row)) {
	$t5 = $t5."INSERT INTO `dagt`(`id`,`name`,`psc`)VALUES('".$data['id']."','".$data['name']."','".$data['psc']."')ON DUPLICATE KEY UPDATE `id`='".$data['id']."',`name`='".$data['name']."',`psc`= '".$data['psc']."';
";
	}
}
$qury = "SELECT * FROM `arda`"; 
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t6 = "";
	while($data = mysqli_fetch_array($row)) {
	$t6 = $t6."INSERT INTO `arda`(`id`,`daid`,`aid`)VALUES('".$data['id']."','".$data['daid']."','".$data['aid']."')ON DUPLICATE KEY UPDATE `id`='".$data['id']."',`daid`='".$data['daid']."',`aid`= '".$data['aid']."';
";
	}
}

$a = $a.$t1.$t2.$t3.$t4.$t5.$t6;
$bfile = fopen("backup.sql", "w") or die ("Unable to Backup !");
fclose($bfile);
file_put_contents("backup.sql", $a);
$file = 'backup.sql';
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>