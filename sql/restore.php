<?php 
require("../common.php");
if(isset($_FILES["bfile"]) && !empty($_FILES["bfile"]["tmp_name"])){
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
	<div align="center">
	<form action="restore.php" method="post" id="form" style="display:block" onsubmit="dothi()" enctype="multipart/form-data">
	<input name="bfile" type="file"><br/><br/>
	<button type="submit" >Upload Backup </button>
	<div id="upst" style="display:none">Uploading ...</div>
	</form>
	</div>
	<script>
	function dothi(){
		document.getElementById('upst').style.display = 'block';
		document.getElementById('form').style.display = 'none';
	}
	</script>
	<?PHP
}
?>