<?php
session_start();
session_unset();

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
} else {
	$mod = "Home";
	$do = "home";
}

header("location:index.php?mod=" . $mod . "&do=" . $do);
?>