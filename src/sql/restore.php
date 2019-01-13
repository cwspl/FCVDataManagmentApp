<?php 
require("../../common.php");
if(isset($_FILES["bfile"])){
$filename = $_FILES["bfile"]["tmp_name"];
$templine = '';
$lines = file($filename);
foreach ($lines as $line)
{
if (substr($line, 0, 2) == '--' || $line == '')
    continue;
$templine .= $line;
if (substr(trim($line), -1, 1) == ';')
{
    mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
    $templine = '';
}
}
echo "Data Imported successfully";
} else {
	?>
	<form action="restore.php" method="post" enctype="multipart/form-data">
	<input name="bfile" type="file"><br/>
	<button type="submit" >Upload</button>
	</form>
	<?PHP
}
?>