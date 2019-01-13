<?php
ob_start();
$hosted = "";
$usered = "";
$passed = "";
$dbed = "";

$conn = new mysqli($hosted, $usered, $passed, $dbed);

if(date('m') == 12){
	$c_year = date('y');
} else {
	$c_year = date('y');
}
if ($conn->connect_error) {
	$conn = new mysqli('localhost', 'root', '');
	if ($conn->connect_error) {
		?> <a href="setdb.php?wd=<?php echo $dbed;?>&wu=<?php echo $usered;?>&wp=<?php echo $passed;?>" > SET DB </a><br/> <?php
		die("Connection failed: " . $conn->connect_error); 
	}
	mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `".$dbed."`");
	$sql = "CREATE USER '".$usered."'@'localhost' IDENTIFIED BY '".$_GET['np']."'";
	mysqli_query($conn, $sql);
	$sql = "GRANT ALL PRIVILEGES ON *.* TO '".$usered."'@'localhost' IDENTIFIED BY '".$passed."' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
	mysqli_query($conn, $sql);
	$sql = "GRANT ALL PRIVILEGES ON `".$dbed."`.* TO '".$usered."'@'localhost'";
	mysqli_query($conn, $sql);
	header("Location: index.php");
}

new DateTimeZone("Asia/Kolkata");
date_default_timezone_set("Asia/Kolkata");
session_start();
ob_start();
mb_internal_encoding("UTF-8");
function tmmd($t1,$t2){
	$yr1 = date('Y',$t1);
	$yr2 = date('Y',$t2);
	$m1 = date('m',$t1);
	$m2 = date('m',$t2);
	return (($yr2-$yr1)*12)+($m2-$m1);
}
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `area` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `baki` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `jama` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `ucon` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ano` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `prfcv` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `pid`       varchar(255) NOT NULL,
  `per`       varchar(255) NOT NULL,
  `cid`       varchar(255) NOT NULL,
  `aid`       varchar(255) NOT NULL,
  `yr`        varchar(255) NOT NULL,
  `dat`       varchar(255) NOT NULL,
  `timc`      varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `dagt` (
  `id`		int(5)  NOT NULL AUTO_INCREMENT,
  `name`      varchar(255) NOT NULL,
  `psc`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `arda` (
  `id`			    int(5)  NOT NULL AUTO_INCREMENT,
  `daid`        varchar(255) NOT NULL,
  `aid`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `acno` (
  `id`		 int(5)  NOT NULL AUTO_INCREMENT,
  `cid`      varchar(255) NOT NULL,
  `acno`     varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `vklist` (
  `id`		  int(5)  NOT NULL AUTO_INCREMENT,
  `name`      varchar(255) NOT NULL,
  `aname`      varchar(255) NOT NULL,
  `mon`       varchar(255) NOT NULL,
  `timec`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `vkacno` (
  `id`		  int(5)  NOT NULL AUTO_INCREMENT,
  `cid`       varchar(255) NOT NULL,
  `acno`      varchar(255) NOT NULL,
  `dat`      varchar(255) NOT NULL,
  `stt`       varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");

?>