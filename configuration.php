<?php
$servername = "localhost";
$username   = "root";
$password   = "dmatics";
$dbname     = "medipedia";

try {
	$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$getUserId = $pdo->prepare("Select user_id from users where user_uname = :user_uname");
	$getUserId->bindParam(':user_uname', $uname);

	$getHerb = $pdo->prepare("Select herb_id, herb_name from herbs");
	$getHerb->execute();
	$getHerb->bindColumn("herb_id", $hid);
	$getHerb->bindColumn("herb_name", $hname);
	
	$getHerbDetail = $pdo->prepare("Select herb_sname, herb_detail from herbs where herb_name = :herb_name");
	$getHerbDetail->bindParam(':herb_name', $hn, PDO::PARAM_STR);
	
	$getHerbDisease = $pdo->prepare("Select distinct d_name from disease where d_herb = :d_herb");
	$getHerbDisease->bindParam(':d_herb', $dherb);
	
	$getDisease = $pdo->prepare("Select distinct d_name from disease");
	$getDisease->execute();
	$getDisease->bindColumn("d_name", $disease);
	
	$getDiseaseDetails = $pdo->prepare("Select distinct d_herb from disease where d_name = :d_name");
	$getDiseaseDetails->bindParam(':d_name', $dname);
	
	$getUser = $pdo->prepare("Select user_fname, user_lname from users where user_id = :user_id");
	$getUser->bindParam(':user_id', $uid);
	
	$getDetails = $pdo->prepare("Select d_user, d_detail from disease where d_herb = :d_herb and d_name = :d_name");
	$getDetails->bindParam(':d_herb', $dhb);
	$getDetails->bindParam(':d_name', $dnm);
	
	$getUserDetails = $pdo->prepare("Select user_fname, user_lname from users where user_uname = :user_uname and user_pass = :user_pass");
	$getUserDetails->bindParam(':user_uname', $uname);
	$getUserDetails->bindParam(':user_pass', $pword);
	
	$setUser = $pdo->prepare("Insert into users (user_uname, user_pass, user_fname, user_lname, user_contact, user_email) values (:user_uname, :user_pass, :user_fname, :user_lname, :user_contact, :user_email)");
	$setUser->bindParam(':user_uname', $uname);
	$setUser->bindParam(':user_pass', $pword);
	$setUser->bindParam(':user_fname', $fname);
	$setUser->bindParam(':user_lname', $lname);
	$setUser->bindParam(':user_contact', $cont);
	$setUser->bindParam(':user_email', $email);
	
	$setDisease = $pdo->prepare("Insert into disease (d_user, d_name, d_herb, d_detail, d_timestamp) values(:d_user, :d_name, :d_herb, :d_detail, :d_timestamp)");
	$setDisease->bindParam(':d_user', $duser);
	$setDisease->bindParam(':d_name', $dname);
	$setDisease->bindParam(':d_herb', $dherb);
	$setDisease->bindParam(':d_detail', $ddetail);
	$setDisease->bindParam(':d_timestamp', $dtime);
	
	$setComment = $pdo->prepare("Insert into comment (c_user, c_herb, c_disease, c_writer, c_content, c_time) values (:c_user, :c_herb, :c_disease, :c_writer, :c_content, :c_time)");
	$setComment->bindParam(':c_user', $cuser);
	$setComment->bindParam(':c_herb', $cherb);
	$setComment->bindParam(':c_disease', $cdisease);
	$setComment->bindParam(':c_writer', $cwriter);
	$setComment->bindParam(':c_content', $ccontent);
	$setComment->bindParam(':c_time', $ctime);
	
	$getComment = $pdo->prepare("Select c_id, c_content, c_writer from comment where c_herb = :c_herb and c_disease = :c_disease and c_user = :c_user");
	$getComment->bindParam(':c_herb', $ch);
	$getComment->bindParam(':c_disease', $cd);
	$getComment->bindParam(':c_user', $cu);
	
	$getCommentUser = $pdo->prepare("Select user_fname, user_lname from users where user_id = :user_id");
	$getCommentUser->bindParam(':user_id', $writer);
	
	$setHerb = $pdo->prepare("Insert into herbs (herb_name, herb_sname, herb_detail, herb_status) values (:herb_name, :herb_sname, :herb_detail, :herb_status)");
	$setHerb->bindParam(':herb_name', $hherb);
	$setHerb->bindParam(':herb_sname', $hsname);
	$setHerb->bindParam(':herb_detail', $hdetail);
	$setHerb->bindParam(':herb_status', $hstatus);
	
	$getHerbsAdmin = $pdo->prepare("Select herb_id, herb_name, herb_sname, herb_detail from herbs where herb_status = 'N'");
	$getHerbsAdmin->execute();
	$getHerbsAdmin->bindColumn("herb_id", $herbId);
	$getHerbsAdmin->bindColumn("herb_name", $herbName);
	$getHerbsAdmin->bindColumn("herb_sname", $herbSname);
	$getHerbsAdmin->bindColumn("herb_detail", $herbDetail);
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
?>