<?php
session_start();
include("functions.php");
$dbconn = connection();
$user_id = $_SESSION['user_id'];
$upvote = $_GET['approval'];
$disc_id = $_GET['disc_id'];
$pn = $_GET['pn'];
$orgID = $_GET['orgID'];
$query = "SELECT * FROM disc_upvote WHERE user_id = '".$user_id."' AND disc_id = '".$disc_id."'";
$result = mysqli_query($dbconn, $query);
if(mysqli_num_rows($result)>=1){
	$query = "SELECT approval FROM disc_upvote WHERE user_id = '".$user_id."' AND disc_id = '".$disc_id."'";
	$result = mysqli_query($dbconn, $query);
	$retval = mysqli_fetch_assoc($result);
	if($retval['approval']==$upvote){
		// echo "<script type='text/javascript'>alert('You already voted for that comment!')</script>";
		$_SESSION['voted'] = "voted";
	}
	else{
		$query = "UPDATE disc_upvote SET approval = '".$upvote."' WHERE user_id = '".$user_id."' AND disc_id = '".$disc_id."'";
		$result = mysqli_query($dbconn, $query);
		if($result){
			$_SESSION['voted'] = "updated";
		}else{
			$_SESSION['voted'] = "error";
		}
	}
}else{
	$query = "INSERT INTO disc_upvote (dvID,disc_id,user_id,approval) VALUES(NULL, '".$disc_id."', '".$user_id."', '".$upvote."')";
	$result = mysqli_query($dbconn, $query);
	if($result){
		$_SESSION['voted'] = "added";
	}else{
		$_SESSION['voted'] = "error";
	}
}
header("Location:discussions.php?orgID=$orgID&pn=$pn");
?>