<?php
session_start();

if (!isset($_SESSION['uid'])) {
	header("location:index.php?mod=Home&do=home");
}

$msg = "";
$hherb = "";
$hsname = "";
$hdetail = "";

if (isset($_GET['page'])) {
	$page = $_GET['page'];
	
	if ($page == "herb") {
		$mod = "Herbs";
		$do  = "herbs";
	} else if ($page == "disease") {
		$mod = "Diseases";
		$do = "diseases";
	}
}

if (isset($_POST['addHerb'])) {
	$hherb = trim($_POST['herb']);
	$hsname = trim($_POST['sname']);
	$hdetail = trim($_POST['detail']);
	$hstatus = "N";
	
	if (empty($hherb) || empty($hsname) || empty($hdetail)) {
		$msg = "All fields are compulsary";
	} else {
		$hn = $hherb;
		$getHerbDetail->execute();
		
		if ($getHerbDetail->fetch()) {
			$msg = "Herb already exists";
		} else {		
			if ($setHerb->execute()) {
				$msg = "Herb added successfully. It will be reviewed and, if found legitimate, will be added to the list of herbs.";
			} else {
				$msg = "Error while adding herb. Please try again after some time.";
			}
		}
	}
	
	alert($msg);
	header("Refresh:0; url=#herbs");
}

if (isset($_POST['addExp'])) {
	$duser = $_SESSION['uid'];
	$dherb = trim($_POST['herb']);
	$ddisease = trim($_POST['disease']);
	$ddis = trim($_POST['dis']);
	$ddetail = trim($_POST['detail']);
	$dtime = date("d-m-y h:m:s",time());
	
	if (empty($duser) || empty($dherb) || empty($ddisease) || empty($ddetail) || ($ddisease == "new" && empty($ddis))) {
		$msg = "All fields are compulsary";
	} else {
		if ($ddisease != "new") {
			$dname = $ddisease;
		} else {
			$dname = $ddis;
		}
		
		if ($setDisease->execute()) {
			$msg = "Data added successfully. It will be reviewed and, if found legitimate, will be added.";
		} else {
			$msg = "Error while adding data. Please try again after some time.";
		}
	}
	
	alert($msg);
	header("Refresh:0; url=#exp");
}

function alert($msg) {
	print '<script type="text/javascript">'; 
	print 'alert("' . $msg . '")'; 
	print '</script>'; 
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Herbipedia</title>

	<link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap.min.home.css" rel="stylesheet">
    <link href="css/grayscale-add.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    
    <script type="text/javascript">
	function show() {
		var value = document.getElementById("disease").value;
		if (value == "new") {
			document.getElementById("dis").style.visibility = "visible";
		} else {
			document.getElementById("dis").style.visibility = "hidden";
		}
	}
	</script>
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
                    <li>
                       <a style="color:#333;" class="page-scroll" href=""><?php echo $_SESSION['user'] ?></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#herbs">Herbs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#exp">Experience</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#gallery">Gallery</a>
                    </li>
                    <li style="border-left:solid; border-left-color:#FFF;">
                        <a style="color:yellow;" class="page-scroll" href="index.php?mod=<?php echo $mod ?>&do=<?php echo $do?>">Back</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section id="herbs" class="container content-section-add text-center">
        <div class="row">
        	<div class="login-page">
              <div class="form">
                <form class="login-form" method="post">
                  <input type="text" name="herb" placeholder="HERB" value="<?php echo $hherb ?>">
                  <input type="text" name="sname" placeholder="BIOLOGICAL NAME" value="<?php echo $hsname ?>">
                  <textarea name="detail" placeholder="SOMETHING ABOUT THE HERB..."></textarea>
                  <input type="submit" name="addHerb" value="Add">
                </form>
              </div>
            </div>
        </div>
    </section>
    
    <section id="exp" class="container content-section-add-exp text-center">
        <div class="row">
        	<div class="login-page-exp">
              <div class="form_exp">
                <form class="login-form" method="post">
                  <select name="herb">
                    <option disabled selected>HERB</option>
                    <?php while ($getHerb->fetch()) { ?>
                    <option style="font-size: 14px;background: #f2f2f2; font:arial;" value="<?php echo $hname ?>"><?php echo $hname ?></option>
                    <?php } ?>
                  </select>
                  
                  <select name="disease" id="disease" onChange="show();">
                    <option disabled selected>DISEASE</option>
                    <option value="new">NEW+</option>
                    <?php while ($getDisease->fetch()) { ?>
                    <option value="<?php echo $disease ?>"><?php echo $disease ?></option>
                    <?php } ?>
                  </select>
                  
                  <input id="dis" type="text" style="visibility:hidden;" name="dis" placeholder="DISEASE">
                  <textarea name="detail" placeholder="SHARE YOUR EXPERIENCE..."></textarea>
                  <input type="submit" name="addExp" value="Submit">
                </form>
              </div>
            </div>
        </div>
    </section>
    
    <section id="gallery" class="container content-section-add-gal text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Gallery</h2>
                <p>Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.</p>
            </div>	
        </div>
        <div>
        	<br><br><br>
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