<?php 
require("../common.php");
if(isset($_GET['p'])){
	if($_GET['u'] == '0'){
		if($_GET['p'] == (date('i').date('h'))){
			$_SESSION['fcv'] = 0;
		} else {
			header("Location: ../lock.php?er=Wrong Passcode&url=".$_GET['url']);
			die();
		}
	} else {
		$ur = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `dagt` where id = '".$_GET['u']."'"));
		if($_GET['p'] == $ur['psc']){
			$_SESSION['fcv'] = $ur['id'];
		} else {
			header("Location: ../lock.php?er=Wrong Passcode&url=".$_GET['url']);
			die();
		}
	}
}
if(!isset($_SESSION['fcv'])){
	header("Location: ../lock.php?url=".$_GET['url']);
	die();
} ?>
<style>
	.badge {
	display: inline-block;
	min-width: 10px;
	padding: 3px 7px;
	font-size: 12px;
	font-weight: bold;
	line-height: 1;
	color: #fff;
	text-align: center;
	white-space: nowrap;
	vertical-align: baseline;
	background-color: #777;
	border-radius: 10px;
	}
	.badge:empty {
	display: none;
	}
	.btn .badge {
	position: relative;
	top: -1px;
	}
	html {
	font-family: sans-serif;
	-webkit-text-size-adjust: 100%;
		-ms-text-size-adjust: 100%;
	}
	.btn {
	display: inline-block;
	padding: 6px 12px;
	margin-bottom: 0;
	font-size: 14px;
	font-weight: normal;
	line-height: 1.42857143;
	text-align: center;
	white-space: nowrap;
	vertical-align: middle;
	cursor: pointer;
	-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
			user-select: none;
	background-image: none;
	border: 1px solid transparent;
	border-radius: 4px;
	}
	.btn:focus,
	.btn:active:focus,
	.btn.active:focus {
	outline: thin dotted;
	outline: 5px auto -webkit-focus-ring-color;
	outline-offset: -2px;
	}
	.btn:hover,
	.btn:focus {
	color: #333;
	text-decoration: none;
	}
	.btn:active,
	.btn.active {
	background-image: none;
	outline: 0;
	-webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
			box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
	}
	.btn.disabled,
	.btn[disabled],
	fieldset[disabled] .btn {
	pointer-events: none;
	cursor: not-allowed;
	filter: alpha(opacity=65);
	-webkit-box-shadow: none;
			box-shadow: none;
	opacity: .65;
	}
	.btn-default {
	color: #333;
	background-color: #fff;
	border-color: #ccc;
	}
	.btn-default:hover,
	.btn-default:focus,
	.btn-default:active,
	.btn-default.active,
	.open > .dropdown-toggle.btn-default {
	color: #333;
	background-color: #e6e6e6;
	border-color: #adadad;
	}
	.btn-default:active,
	.btn-default.active,
	.open > .dropdown-toggle.btn-default {
	background-image: none;
	}
	.btn-default.disabled,
	.btn-default[disabled],
	fieldset[disabled] .btn-default,
	.btn-default.disabled:hover,
	.btn-default[disabled]:hover,
	fieldset[disabled] .btn-default:hover,
	.btn-default.disabled:focus,
	.btn-default[disabled]:focus,
	fieldset[disabled] .btn-default:focus,
	.btn-default.disabled:active,
	.btn-default[disabled]:active,
	fieldset[disabled] .btn-default:active,
	.btn-default.disabled.active,
	.btn-default[disabled].active,
	fieldset[disabled] .btn-default.active {
	background-color: #fff;
	border-color: #ccc;
	}
	.btn-default .badge {
	color: #fff;
	background-color: #333;
	}
	.btn-primary {
	color: #fff;
	background-color: #428bca;
	border-color: #357ebd;
	}
	.btn-primary:hover,
	.btn-primary:focus,
	.btn-primary:active,
	.btn-primary.active,
	.open > .dropdown-toggle.btn-primary {
	color: #fff;
	background-color: #3071a9;
	border-color: #285e8e;
	}
	.btn-primary:active,
	.btn-primary.active,
	.open > .dropdown-toggle.btn-primary {
	background-image: none;
	}
	.btn-primary.disabled,
	.btn-primary[disabled],
	fieldset[disabled] .btn-primary,
	.btn-primary.disabled:hover,
	.btn-primary[disabled]:hover,
	fieldset[disabled] .btn-primary:hover,
	.btn-primary.disabled:focus,
	.btn-primary[disabled]:focus,
	fieldset[disabled] .btn-primary:focus,
	.btn-primary.disabled:active,
	.btn-primary[disabled]:active,
	fieldset[disabled] .btn-primary:active,
	.btn-primary.disabled.active,
	.btn-primary[disabled].active,
	fieldset[disabled] .btn-primary.active {
	background-color: #428bca;
	border-color: #357ebd;
	}
	.btn-primary .badge {
	color: #428bca;
	background-color: #fff;
	}
	.btn-success {
	color: #fff;
	background-color: #5cb85c;
	border-color: #4cae4c;
	}
	.btn-success:hover,
	.btn-success:focus,
	.btn-success:active,
	.btn-success.active,
	.open > .dropdown-toggle.btn-success {
	color: #fff;
	background-color: #449d44;
	border-color: #398439;
	}
	.btn-success:active,
	.btn-success.active,
	.open > .dropdown-toggle.btn-success {
	background-image: none;
	}
	.btn-success.disabled,
	.btn-success[disabled],
	fieldset[disabled] .btn-success,
	.btn-success.disabled:hover,
	.btn-success[disabled]:hover,
	fieldset[disabled] .btn-success:hover,
	.btn-success.disabled:focus,
	.btn-success[disabled]:focus,
	fieldset[disabled] .btn-success:focus,
	.btn-success.disabled:active,
	.btn-success[disabled]:active,
	fieldset[disabled] .btn-success:active,
	.btn-success.disabled.active,
	.btn-success[disabled].active,
	fieldset[disabled] .btn-success.active {
	background-color: #5cb85c;
	border-color: #4cae4c;
	}
	.btn-success .badge {
	color: #5cb85c;
	background-color: #fff;
	}
	.fileUpload {
		position: relative;
		overflow: hidden;
		margin: 10px;
	}
	.fileUpload input.upload {
		position: absolute;
		top: 0;
		right: 0;
		margin: 0;
		padding: 0;
		font-size: 20px;
		cursor: pointer;
		opacity: 0;
		filter: alpha(opacity=0);
	}

	</style>
	<html align="center">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<h3> Download File & After Restore Data </h3><br/>
	<iframe id="xyza" style="display:none"></iframe>
	<button onclick="download()" id="finalubtn" type="submit" class="btn btn-primary"> Download Backup </button></a><br/>
	<a href="<?php echo $_GET['url'];?>"><button id="finalubtn" type="submit" class="btn btn-success"> Restore Data </button></a>
	<script>
	function download() {
		var iframe = document.getElementById('xyza');
		iframe.src = "backup2.php";
	}
	</script>
	</html>