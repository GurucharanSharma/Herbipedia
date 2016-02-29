<?php
session_start();

if (!isset($_SESSION['user'])) {
	header("location:index.php?mod=Login&do=login");
}
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
                    <li>
                       <a style="color:#333;" class="page-scroll" href=""><?php echo $_SESSION['user'] ?></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="">Herbs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="">Diseases</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="">Experiences</a>
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
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="container content-section-home text-center">
        <div class="row">
                <h2>Herbs</h2>
                <div align="center">
                	<table width="80%" class="table-striped">
						<?php while($getHerbsAdmin->fetch()) { ?>
                           	<tr>
                           		<td align="center">
                                	<font face="arial" style="font-size:16px;"><?php echo $herbId ?></font>
                                </td>
                                <td align="left">
                                	<?php echo $herbName ?>
                                </td>
                                <td align="left">
                                	<?php echo $herbSname ?>
                                </td>
                                <td align="center">
                                	<a href="#">VIEW</a>
                                </td>
                                <td align="right">
                                	<a href="#">REJECT</a> | <a href="#">ACCEPT</a>
                                </td>
                           	</tr> 
                        <?php } ?>
                	</table>
                </div>
        </div>
    </section>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/grayscale.js"></script>
</body>
</html>