<?php 
require("../common.php");
$a = "DROP TABLE area;
DROP TABLE ucon;
DROP TABLE baki;
DROP TABLE jama;
DROP TABLE prfcv;
CREATE TABLE IF NOT EXISTS `area` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `name`        varchar(255) NOT NULL,
  `aname`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `ucon` (
  `id`		       int(5)  NOT NULL AUTO_INCREMENT,
  `name`       varchar(255) NOT NULL,
  `aname`      varchar(255) NOT NULL,
  `aid`        varchar(255) NOT NULL,
  `mno`        varchar(255) NOT NULL,
  `ano`        varchar(255) NOT NULL,
  `timc`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `baki` (
  `id`		      int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `amt`       varchar(255) NOT NULL,
  `timr`      varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `jama` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `amt`       varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
CREATE TABLE IF NOT EXISTS `prfcv` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `pid`       varchar(255) NOT NULL,
  `per`       varchar(255) NOT NULL,
  `cid`       varchar(255) NOT NULL,
  `aid`       varchar(255) NOT NULL,
  `yr`        varchar(255) NOT NULL,
  `dat`       varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
";
$qury = "SELECT * FROM `area`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t1 = "";
	while($data = mysqli_fetch_array($row)) {
	$t1 = $t1."INSERT INTO `area` (`id`, `name`, `aname`) VALUES ('".$data['id']."', '".$data['name']."', '".$data['aname']."');
";
	}
}
$qury = "SELECT * FROM `ucon`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t2 = "";
	while($data = mysqli_fetch_array($row)) {
	$t2 = $t2."INSERT INTO `ucon` (`id`, `name`, `aname`, `aid`, `mno`, `ano`, `timc`) VALUES ('".$data['id']."', '".$data['name']."', '".$data['aname']."', '".$data['aid']."', '".$data['mno']."', '".$data['ano']."', '".$data['timc']."');
";
	}
}
$qury = "SELECT * FROM `baki`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t3 = "";
	while($data = mysqli_fetch_array($row)) {
	$t3 = $t3."INSERT INTO `baki` (`id`, `cid`, `amt`, `timr`, `timc`) VALUES ('".$data['id']."', '".$data['cid']."', '".$data['amt']."', '".$data['timr']."', '".$data['timc']."');
";
	}
}
$qury = "SELECT * FROM `jama`";
$row = mysqli_query($conn, $qury);
if(mysqli_num_rows($row) != 0) {
	$t4 = "";
	while($data = mysqli_fetch_array($row)) {
	$t4 = $t4."INSERT INTO `jama` (`id`, `cid`, `amt`, `timc`) VALUES ('".$data['id']."', '".$data['cid']."', '".$data['amt']."', '".$data['timc']."');
";
	}
}
$a = $a.$t1.$t2.$t3.$t4;
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