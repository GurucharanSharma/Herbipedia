<?php
include("configuration.php");

if (isset($_GET['mod'])){
	$mod = $_GET['mod'];
	$do  = $_GET['do'];	
} else {
	$mod = 'Start';
	$do  = 'start';
}

include("Modules/$mod/$do.php");
?>