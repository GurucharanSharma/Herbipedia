<?php
session_start();

$lstatus = "";
$rstatus = "";
$fname  = "";
$lname  = "";
$cont   = "";
$email  = "";
$uname  = "";
$pword  = "";
$cpword = "";

if (isset($_POST['login'])) {
	$uname = $_POST['uname'];
	$pword = $_POST['pword'];
	
	$getUserDetails->execute();
	$getUserDetails->bindColumn('user_fname', $fname);
	$getUserDetails->bindColumn('user_lname', $lname);
	
	if ($getUserDetails->fetch()) {
		$getUserId->execute();
		$getUserId->bindColumn("user_id", $uid);
		$getUserId->fetch();
		$_SESSION['uid'] = $uid;
		$_SESSION['user'] = $fname . " " . $lname;
		
		if (isset($_SESSION['mod'])) {
			unset($_SESSION['mod']);
			unset($_SESSION['do']);
			$mod = "Add";
			$do  = "add";
		} else {
			$mod = "Home";
			$do  = "home";
		}
	} else {
		$lstatus = "Username or Password might be incorrect.";
		header("Refresh:0; url=#login");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="gurucharan">

    <title>Herbipedia</title>
	
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/grayscale.css" rel="stylesheet">
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
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">Herbipedia</span>
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    
                    <?php
					if (isset($_SESSION['user'])) {
					?>
                    <li>
                       <a style="color:teal;" class="page-scroll" href=""><?php echo $_SESSION['user'] ?></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                    	<a class="page-scroll" href="index.php?mod=Login&do=logout&page=start">Logout</a>
                    </li>
                    <?php
					} else {
					?>
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#login">Login</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#register">Register</a>
                    </li>
                    <?php
					}
					?>
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">HERBIPEDIA</h1>
                        <p class="intro-text"><font face="arial" style="font-weight:100;"><b>MAKE YOUR LIFE MORE HEALTHY AND SAFE</b></font><br><h3><a href="index.php?mod=Home&do=home">Browse</a></h3></p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
            	<h2>About Herbipedia</h2>
                <p>Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact Herbipedia</h2>
                <p>Feel free to email us to provide some feedback, give us suggestions, or to just say hello!</p>
                <p><a href="mailto:guru.thecharan@gmail.com">guru.thecharan@gmail.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (isset($_SESSION['user'])) { ?>
        <div>
            <br><br><br>
        </div>
        <?php } ?>
    </section>
	
    <?php if (!isset($_SESSION['user'])) { ?>
	<!-- Login Section -->
    <section id="login" class="container content-section-login text-center">
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
	<section id="register" class="container content-section-register text-center">
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
	<?php } ?>
    
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
