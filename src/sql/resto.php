<?php 
$hosted = "localhost";
$usered = "wellwork_deep";
$passed = "Deep#8562369";
$dbed = "wellwork_fcv";

$conn = new mysqli($hosted, $usered, $passed, $dbed);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
ob_start();
$a = file_get_contents('backup.sql'); 
echo mb_convert_encoding($a, "WINDOWS-1252");
$a =  mb_convert_encoding(ob_get_contents(), "WINDOWS-1252");
mysqli_query($conn, $a);
?>