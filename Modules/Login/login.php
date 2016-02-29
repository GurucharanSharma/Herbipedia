<?php
session_start();

$mod = "Home";
$do = "home";

$lstatus = "";
$rstatus = "";
$fname  = "";
$lname  = "";
$cont   = "";
$email  = "";
$uname  = "";
$pword  = "";
$cpword = "";

if (isset($_GET['page'])) {
	$page = $_GET['page'];
	
	if ($page == "start") {
		$mod = "Start";
		$do = "start";
	} else if ($page == "herbs") {
		$mod = "Herbs";
		$do = "herbs";
	} else if ($page == "diseases") {
		$mod = "Diseases";
		$do = "diseases";
	}
}
		
if (isset($_POST['login'])) {
	$uname = $_POST['uname'];
	$pword = $_POST['pword'];
	
	if ($uname == "admin" && $pword == "12345") {
		header("location:index.php?mod=Admin&do=admin");
		$_SESSION['user'] = "Gurucharan Sharma";
	} else {		
		$getUserDetails->execute();
		$getUserDetails->bindColumn('user_fname', $fname);
		$getUserDetails->bindColumn('user_lname', $lname);
		
		if ($getUserDetails->fetch()) {
			$getUserId->execute();
			$getUserId->bindColumn("user_id", $uid);
			$getUserId->fetch();
			$_SESSION['uid'] = $uid;
			$_SESSION['user'] = $fname . " " . $lname;
			
			header("location:index.php?mod=" . $mod . "&do=" . $do);
		} else {
			$lstatus = "Username or Password might be incorrect.";
			header("Refresh:0; url=#login");
		}
	}
}

if (isset($_POST['register'])) {
	$fname  = trim($_POST['fname']);
	$lname  = trim($_POST['lname']);
	$cont   = trim($_POST['cont']);
	$email  = trim($_POST['email']);
	$uname  = trim($_POST['uname']);
	$pword  = trim($_POST['pword']);
	$cpword = trim($_POST['cpword']);
	
	if (empty($fname) || empty($lname) || empty($cont) || empty($email) || empty($uname) || empty($pword) || empty($cpword)) {
		$rstatus = "All fields are compulsary";
	} else {
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if (strcmp($pword, $cpword) == 0) {
				if ($setUser->execute()) {
					$rstatus = "You have registered successfully. Please login to continue.";
				} else {
					$rstatus = "There was error while registeration. Please try again later.";
				}
				formReset();
			} else {
				$rstatus = "Password and Confirm password fields donot match.";
			}
		} else {
			$rstatus = "Invalid email address"; 
		}
	}
	header("Refresh:0; url=#register");
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
	<title>Login</title>

	<link href="css/style.css" rel="stylesheet">
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
                        <a class="page-scroll" href="#login">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#register">Register</a>
                    </li>
                    <li style="border-left:solid; border-left-color:#FFF;">
                        <a style="color:yellow;" class="page-scroll" href="index.php?mod=<?php echo $mod ?>&do=<?php echo $do?>">Back</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section id="login" class="container content-section-login1 text-center">
        <div class="row">
            <div class="login-page">
              <div class="form">
                <form class="login-form" method="post">
                  <input type="text" name="uname" placeholder="username"/>
                  <input type="password" name="pword" placeholder="password"/>
                  <input type="submit" name="login" value="Login">
                  <font style="color:#F00; font-size:14px;"><b><?php echo $lstatus ?></b></font>
                </form>
              </div>
            </div>
        </div>
    </section>
	
    <!-- Register Section -->
	<section id="register" class="container content-section-register1 text-center">
        <div class="row">
            <div class="login-page">
              <div class="form_r">
                <form class="register-form" method="post">
                	<input type="text" name="fname" placeholder="FIRSTNAME" value="<?php echo $fname ?>">
                    <input type="text" name="lname" placeholder="LASTNAME" value="<?php echo $lname ?>">
                  	<input type="text" name="cont" placeholder="CONTACT" value="<?php echo $cont ?>">
                    <input type="text" name="email" placeholder="EMAIL" value="<?php echo $email ?>">
                    <input type="text" name="uname" placeholder="USERNAME" value="<?php echo $uname ?>">
                    <input type="password" name="pword" placeholder="PASSWORD">
                    <input type="password" name="cpword" placeholder="RE-ENTER PASSWORD">
                    <input type="submit" name="register" value="Register">
                    <font style="color:#F00; font-size:14px;"><b><?php echo $rstatus ?></b></font>
                </form>
              </div>
            </div>
        </div>
    </section>
    
     <!-- Footer -->
    <footer style="background-color:teal;">
        <div class="container text-center">
            <p>Copyright &copy; Your Website 2014</p>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="js/login.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
</body>
</html>