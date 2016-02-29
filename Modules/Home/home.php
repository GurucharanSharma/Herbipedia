<?php
session_start();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Herbipedia</title>

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
                       <a style="color:#333;" class="page-scroll" href=""><?php echo $_SESSION['user'] ?></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php?mod=Herbs&do=herbs">Herbs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php?mod=Diseases&do=diseases">Diseases</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="">Gallery</a>
                    </li>
                    <li style="border-left:solid; border-left-color:#FFF;">
                        <a style="color:yellow;" class="page-scroll" href="">profile</a>
                    </li>
                    <li>
                    	<a style="color:yellow;" class="page-scroll" href="index.php?mod=Login&do=logout&page=home">Logout</a>
                    </li>
                    <?php
					} else {
					?>
                    <li>
                        <a class="page-scroll" href="index.php?mod=Herbs&do=herbs">Herbs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php?mod=Diseases&do=diseases">Diseases</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="">Gallery</a>
                    </li>
                    <li style="border-left:solid; border-left-color:#FFF;">
                        <a style="color:yellow;" class="page-scroll" href="">profile</a>
                    </li>
                    <li>
                        <a style="color:yellow;" class="page-scroll" href="index.php?mod=Login&do=login">Account</a>
                    </li>
                    <?php
					}
					?>
                    
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="container content-section-home text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Herbs</h2>
                <p>Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.</p>
            </div>	
        </div>
    </section>
    
    <section class="container content-section-home text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Diseases</h2>
                <p>Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.</p>
            </div>	
        </div>
    </section>
    
    <section class="container content-section-home text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Experiences</h2>
                <p>Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.Medicure is a platform where you can share the home made remedies that have helped you in some way. Share it with
                   the people and enlighten them so that they know just the thing they need. Do something that actually makes a 
                   difference.</p>
            </div>	
        </div>
    </section>
    
    <section class="container content-section-home text-center">
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
    </section>
    
    <!-- Contact Section -->
    <section class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact Medipedia</h2>
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
        <div>
        	<br><br><br>
        </div>
    </section>
    
    <footer style="background-color:teal;">
        <div class="container text-center">
            <p>Copyright &copy; Your Website 2014</p>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
</body>
</html>