<?php
session_start();

if (isset($_GET['herb'])) {
	$herb = $_GET['herb'];
}

if (isset($_POST['submit'])) {
	$duser = $_SESSION['uid'];
	$dname = $_POST['disease'];
	$dherb = $_POST['herb'];
	$ddetail = $_POST['comment'];
	$dtime = date("Y-m-d",time());
	
	if (!empty($ddetail)) {
		$setDisease->execute();
		header("location:index.php?mod=Herbs&do=herbs&herb=".$herb);
	}
}

if (isset($_POST['add'])) {
	$cuser = $_POST['uid'];
	$cwriter = $_SESSION['uid'];
	$cherb = $_POST['herb'];
	$cdisease = $_POST['disease'];
	$ccontent = $_POST['content'];
	$ctime = date("d-m-y h:m:s",time());
	
	if (!empty($ccontent)) {
		$setComment->execute();
		header("location:index.php?mod=Herbs&do=herbs&herb=".$herb);
	}
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Herbs</title>

	<link href="css/default.css" rel="stylesheet">
	<link href="css/bootstrap.min.herbs.css" rel="stylesheet">
    <link href="css/grayscale-herbs.css" rel="stylesheet">
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
                        <a style="background-color:#4da6a6;" class="page-scroll" href="">Herbs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php?mod=Diseases&do=diseases">Diseases</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="">Gallery</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php?mod=Add&do=add&page=herb">Add</a>
                    </li>
                    <li style="border-left:solid; border-left-color:#FFF;">
                    	<a style="color:yellow;" class="page-scroll" href="index.php?mod=Login&do=logout&page=herbs">Logout</a>
                    </li>
                    <?php
					} else {
					?>
                    <li>
                        <a style="background-color:#4da6a6;" class="page-scroll" href="">Herbs</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php?mod=Diseases&do=diseases">Diseases</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="">Gallery</a>
                    </li>
                    <li style="border-left:solid; border-left-color:#FFF;">
                        <a style="color:yellow;" class="page-scroll" href="index.php?mod=Login&do=login&page=herbs">Account</a>
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
                <table width="100%">
                    <tr style="vertical-align:top;">
                        <td width="20%">
                            <table width="100%">
                                <?php
                                while ($getHerb->fetch()) {
                                ?>
                                <tr height="40px" style="border-bottom:thick; border-bottom-color:#FFF; border-bottom-width:2px; border-bottom-style:solid;">
                                    <td align="left">
                                        <a href="index.php?mod=Herbs&do=herbs&herb=<?php echo $hname ?>"><font size="+1" face="arial"><?php echo $hname ?></font></a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </td>
                        <td>
                            <?php
                            if (isset($_GET['herb'])) {
                                $hn = $herb;
                                $getHerbDetail->execute();
                                $getHerbDetail->bindColumn("herb_sname", $sname);
								$getHerbDetail->bindColumn("herb_detail", $detail);
                                $getHerbDetail->fetch();
								
								$dherb = $herb;
								$getHerbDisease->execute();
								$getHerbDisease->bindColumn("d_name", $diseases);
                            ?>
                                <h2><?php echo $sname ?></h2>
                                <h3><?php echo $herb ?></h3>
                                
                                <div><h4>Description</h4></div>
                                <div style="margin-bottom:40px;"><font face="arial" style="font-size:20px;"><?php echo $detail ?></font></div>
                                
                                <div><h4>Diseases</h4></div><br>
								<?php 
								while ($getHerbDisease->fetch()) { 
								?>
                                <div>
                                	<table width="100%" bgcolor="#CCCCCC">
                                    	<form method="post">
                                            <tr>
                                                <td align="left">
                                                    <h4><a href="index.php?mod=Diseases&do=diseases&disease=<?php echo $diseases ?>"><?php echo $diseases ?></a></h4>
                                                </td>
                                            </tr>
                                            <?php if (isset($_SESSION['uid'])) { ?>
                                            <tr>
                                                <td>
                                                    <textarea class="form-control" name="comment" style="width:100%;" placeholder="Share your experience with us"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                	<input type="hidden" name="herb" value="<?php echo $dherb ?>">
		                                            <input type="hidden" name="disease" value="<?php echo $diseases ?>">
                                                    <input type="submit" class="btn btn-sm btn-primary margin-top" name="submit" value="Add">
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td>
                                                	<br>
                                                </tr>
                                            </tr>
                                            <?php } ?>
                                        </form>
                                    </table>
                                </div>
                                <?php
									$dhb = $herb;
									$dnm = $diseases;
									$getDetails->execute();
									$getDetails->bindColumn('d_user', $dUser);
									$getDetails->bindColumn('d_detail', $dDetail);
									
									while ($getDetails->fetch()) {
										$uid = $dUser;
										$getUser->execute();
										$getUser->bindColumn('user_fname', $fName);
										$getUser->bindColumn('user_lname', $lName);
										$getUser->fetch();	
								?>
                                <div>
                                	<font style="font-size:16px; color:#3c45ad"><b><?php echo $fName . " " . $lName ?></b></font>
                                </div>
                                <div>
                                	<font style="font-size:16px;"><?php echo $dDetail ?></font>
                                </div><br>
                                
                                
                                <div style="margin-left:50px;">
                                	<div align="left" style="margin-bottom:10px;">
                                    	<?php 
										$ch = $dhb;
										$cd = $dnm;
										$cu = $uid;
										$getComment->execute();
										$getComment->bindColumn("c_id", $cid);
										$getComment->bindColumn("c_content", $content);
										$getComment->bindColumn("c_writer", $writer);
										
										while ($getComment->fetch()) {
											$getCommentUser->execute();
											$getCommentUser->bindColumn('user_fname', $cfName);
											$getCommentUser->bindColumn('user_lname', $clName);
											$getCommentUser->fetch();
										?>
                                        <div style="background-color:#f6f7f8;">
                                        	<font style="font-size:14px; color:#4c5d98"><b><?php echo "@" . $cfName . " " . $clName ?></b></font>
                                        </div>
                                        <div style="background-color:#f6f7f8;">
                                        	<font style="font-size:14px;"><?php echo $content ?></font>
                                        </div>
                                        <div style="margin-bottom:10px; background-color:#FFF;">
                                        </div>
										<?php 
										} 
										?>
                                    </div>
                                    <?php if (isset($_SESSION['uid'])) { ?>
                                	<div align="center" style="background-color:#f6f7f8;">
                                        <table width="98%">
                                        	<form method="post">
                                                <tr>
                                                    <td>
                                                        <textarea class="form-control" name="content" style="width:100%;" placeholder="Add comment"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <input type="hidden" name="uid" value="<?php echo $uid ?>">
                                                        <input type="hidden" name="herb" value="<?php echo $dherb ?>">
                                                        <input type="hidden" name="disease" value="<?php echo $diseases ?>">
                                                        <input type="submit" class="btn btn-sm btn-primary pull-left margin-top" name="add" value="Comment">
                                                    </td>
                                                </tr>
                                            </form>
                                        </table>
                                    </div>
                                    <?php } ?>
                                    <div>
                                    	<br>
                                    </div>
                                </div>
                                
                                <?php 
									}
								} 
								?>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
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