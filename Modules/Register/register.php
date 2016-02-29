<?php
$status = "";

$fname  = "";
$lname  = "";
$cont   = "";
$email  = "";
$uname  = "";
$pword  = "";
$cpword = "";

if (isset($_POST['submit'])) {
	$fname  = trim($_POST['fname']);
	$lname  = trim($_POST['lname']);
	$cont   = trim($_POST['cont']);
	$email  = trim($_POST['email']);
	$uname  = trim($_POST['uname']);
	$pword  = trim($_POST['pword']);
	$cpword = trim($_POST['cpword']);
	
	if (empty($fname) || empty($lname) || empty($cont) || empty($email) || empty($uname) || empty($pword) || empty($cpword)) {
		$status = "All fields are compulsary";
	} else {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if (strcmp($pword, $cpword) == 0) {
				if ($setUser->execute()) {
					$status = "You have registered successfully. Please continue to login.";
				} else {
					$status = "There was error while registeration. Please try again later.";
				}
				formReset();
			} else {
				$status = "Password and Confirm password fields donot match.";
			}
		} else {
			$status = "Invalid email address"; 
		}
	}
}

function formReset() {
	$fname  = "";
	$lname  = "";
	$cont   = "";
	$email  = "";
	$uname  = "";
	$pword  = "";
	$cpword = "";
}
?>



<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Register</title>

	<link href="css/bootstrap.min.home.css" rel="stylesheet">
    <link href="css/grayscale-home.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php?mod=Home&do=home">
                    <i class="fa fa-play-circle"></i>  <span class="light">Herbipedia</span>
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="index.php?mod=Login&do=login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="container content-section-home text-center">
        <div class="row">
        	<h2>Register</h2>
            <h4 style="text-align:center;">All fields are compulsary</h4>
            <div class="col-lg-8 col-lg-offset-2">
            	<form method="post">
                 	<div style="margin-bottom:5px;">
                        <input style="width:250px" type="text" name="fname" placeholder="FIRSTNAME" value="<?php echo $fname ?>">
                    </div>
                    <div style="margin-bottom:5px;">
                        <input style="width:250px" type="text" name="lname" placeholder="LASTNAME" value="<?php echo $lname ?>">
                    </div>
                    <div style="margin-bottom:5px;">
                        <input style="width:250px" type="text" name="cont" placeholder="CONTACT" value="<?php echo $cont ?>">
                    </div>
                    <div style="margin-bottom:5px;">
                        <input style="width:250px" type="text" name="email" placeholder="EMAIL" value="<?php echo $email ?>">
                    </div>
                    <div style="margin-bottom:5px;">
                        <input style="width:250px" type="text" name="uname" placeholder="USERNAME" value="<?php echo $uname ?>">
                    </div>
                    <div style="margin-bottom:5px;">
                        <input style="width:250px" type="password" name="pword" placeholder="PASSWORD">
                    </div>
                    <div style="margin-bottom:10px;">
                        <input style="width:250px" type="password" name="cpword" placeholder="RE-ENTER PASSWORD">
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
        <div style="margin-top:20px;">
            <font style="color:#F00; font-size:14px;"><b><?php echo $status ?></b></font>
        </div>
    </section>
    
    <div align="center" style="position:fixed; bottom:0; left:0; right:0;">
    	<p>Copyright &copy; All rights reserved.</p>
    </div>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
</body>
</html>