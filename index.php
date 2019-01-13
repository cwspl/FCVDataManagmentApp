<?php 
	require("common.php");
	if(isset($_GET['lock'])){
		unset($_SESSION['fcv']);
		unset($_SESSION);
		session_destroy();
	}
	if(isset($_GET['home'])){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en" style="overflow-x:hidden;">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | FCV </title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/small-busines2.css" rel="stylesheet">
	<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="overflow-x:hidden;margin-top:-50px;">

   

    <!-- Page Content -->
    <div class="container">

        <!-- Heading Row -->
        <div class="row">
		<div id="cnt" class="col-md-12">
			<?php
				if(isset($_SESSION['fcv']) && $_SESSION['fcv'] == 'XF0')
					{ include("src/XF0/i_home.php"); }
				else if(isset($_SESSION['fcv']) && $_SESSION['fcv'] != 'XF0')
					{ include("src/inc/home.php"); }
				else {
			?>
				<div align="center"><img src="img/logos.jpg" width="75%" style="max-width:400px"/></div><br/>
				<div align="center" class="col-md-4"></div>
				<div align="center" class="col-md-4">
				<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> Lock Mode </h4>
				<i align="center" id="er_pi" style="color:red;"><?php if(isset($_GET['er'])){echo $_GET['er'];}?></i>
				<div>
					<h5>	
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<select name="uid" id="uid" class="form-control">
								<option value="0">Administor</option>
								<?php 
									$lgrow = mysqli_query($conn, "SELECT * FROM `dagt`");
									while($lgdata = mysqli_fetch_array($lgrow)) { ?>
								<option value="<?php echo $lgdata['id'];?>"><?php echo $lgdata['name'];?></option>
								<?php } ?>
								<option Disabled>----------------</option>
								<option value="XF0">Vasti Khandali</option>
							</select>
						</div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="tel" maxlength="4" onblur="pc_log('pass','uid','er_pi','cnt')" onkeyup="pc_kup('pass','uid','er_pi','cnt')" name="pass" id="pass" class="form-control" style="text-align:center;" placeholder="Enter Passcode">
						</div>
					</h5>
					<h5 align="center"><button type="button" id="adm_log" onclick="pc_log('pass','uid','er_pi','cnt')" class="btn btn-default btn-block btn-lg"> Open </button></h5>
				</div>
				</div>
				<div align="center" class="col-md-4"></div>
				<br/>
				<script>document.getElementById("pass").focus();</script>
			<?php } ?>
            <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Wel -->
        <div class="row">
            <div class="col-lg-12">
                <div class="well text-center">
					<p>Copyright &copy; Friends Cable Vision By Panchal Deep R. 2016-18</p>
				</div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
 
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/action_c.js"></script>
    <script src="js/jquery-1.12.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
	<script>
	function tjama(id){
		var yr = document.getElementById(id).value;
		odiv_a('rpt','?y='+yr+'', 'cnt');
	}
	</script>
</body>

</html>

                            