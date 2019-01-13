<?php
if(isset($_GET['np'])){
	$hosted = $_GET['h'];
	$usered = $_GET['u'];
	$passed = $_GET['p'];
	$conn = new mysqli($hosted, $usered, $passed);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `".$_GET['d']."`");
	$sql = "CREATE USER '".$_GET['nu']."'@'localhost' IDENTIFIED BY '".$_GET['np']."'";
	mysqli_query($conn, $sql);
	$sql = "GRANT ALL PRIVILEGES ON *.* TO '".$_GET['nu']."'@'localhost' IDENTIFIED BY '".$_GET['np']."' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0";
	mysqli_query($conn, $sql);
	$sql = "GRANT ALL PRIVILEGES ON `".$_GET['d']."`.* TO '".$_GET['nu']."'@'localhost'";
	mysqli_query($conn, $sql);
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en" style="overflow-x:hidden;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<body>
	<form action="setdb.php" method="GET">
		<label> Host </label><br/>
		<input type="text" name="h" width="100%" value="localhost" /><br/>
		<label> Username </label><br/>
		<input type="text" name="u" width="100%" value="root" /><br/>
		<label> Password </label><br/>
		<input type="text" name="p" width="100%" value="" /><br/>
		<label> New DB </label><br/>
		<input type="text" name="d" width="100%" value="<?php if(isset($_GET['wd'])){ echo $_GET['wd']; } ?>" /><br/>
		<label> New Username </label><br/>
		<input type="text" name="nu" width="100%" value="<?php if(isset($_GET['wu'])){ echo $_GET['wu']; } ?>" /><br/>
		<label> New Password </label><br/>
		<input type="text" name="np" width="100%" value="<?php if(isset($_GET['wp'])){ echo $_GET['wp']; } ?>" /><br/>
		<input type="submit" name="Submit" />
	</form>
</body>
</html>