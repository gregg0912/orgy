<?php
session_start();
include("functions.php");
$dbconn = connection();
$user_id = $_SESSION['user_id'];
$disc_user_id = $_GET['disc_user_id']; // para sa nag post sang discussion
$upvote = $_GET['approval'];
$disc_id = $_GET['disc_id'];
$pn = $_GET['pn'];
$orgID = $_GET['orgID'];
$sort_id = $_GET['sort_id'];
$query = "SELECT * FROM disc_upvote WHERE user_id = '".$user_id."' AND disc_id = '".$disc_id."'";
//AgentProxy
$title = $_GET['title'];
$dateposted = $_GET['dateposted'];
date_default_timezone_set("Asia/Singapore");
//
$result = mysqli_query($dbconn, $query);
if(mysqli_num_rows($result)>=1){
	$query = "SELECT approval FROM disc_upvote WHERE user_id = '".$user_id."' AND disc_id = '".$disc_id."'";
	$result = mysqli_query($dbconn, $query);
	$retval = mysqli_fetch_assoc($result);
	$username = $_SESSION['username'];
	if($disc_user_id==$_SESSION['user_id']){
		$username = "You";
	}


	if($retval['approval']==$upvote){
		// echo "<script type='text/javascript'>alert('You already voted for that comment!')</script>";
		$_SESSION['voted'] = "voted";

	}
	else{
		$query = "UPDATE disc_upvote SET approval = '".$upvote."' WHERE user_id = '".$user_id."' AND disc_id = '".$disc_id."'";
		$result = mysqli_query($dbconn, $query);
		if($result){
			$_SESSION['voted'] = "updated";
			$date = date('Y-m-d H:i:s');
			if($upvote=="upvote"){
				$content = "$username upvoted your post entitled $title";
				$topic = "Upvote";
				$query = "INSERT INTO announcement(date_posted,topic,content,user_id,org_id) VALUES ('$date','$topic','$content','$disc_user_id','$orgID')";
				$result = mysqli_query($dbconn, $query);
			}
			elseif($upvote=="downvote"){
				$content = "$username downvoted your post entitled $title";
				$topic = "Downvote";
				$query = "INSERT INTO announcement(date_posted,topic,content,user_id,org_id) VALUES ('$date','$topic','$content','$disc_user_id','$orgID')";
				$result = mysqli_query($dbconn, $query);
			}
			if($result){
				$ann=mysqli_query($connectdb,"SELECT * FROM announcement WHERE org_id=$orgID order by announcement_id desc limit 1");
		       	$ann_id= mysqli_fetch_assoc($ann);
		       	$announcement_id=$ann_id['announcement_id'];
				$query = "INSERT INTO seen_announcement(seen_id,seen,user_id,announcement_id) VALUES (null,'not_seen','$disc_user_id','$announcement_id')";
				$result = mysqli_query($dbconn, $query);
			}
			
		}
		else{
			$_SESSION['voted'] = "error";
		}
	}
}else{
	$query = "INSERT INTO disc_upvote (dvID,disc_id,user_id,approval) VALUES(NULL, '$disc_id', '$user_id', '$upvote')";
	$result = mysqli_query($dbconn, $query);
	if($result){
		 $_SESSION['voted'] = "added";
		//AGENT PROXY
		$date = date('Y-m-d H:i:s');
		if($upvote=="upvote"){
			$content = "$username upvoted your post entitled $title";
			$topic = "Upvote";
			$query = "INSERT INTO announcement(date_posted,topic,content,user_id,org_id) VALUES('$date','$topic','$content','$disc_user_id','$orgID')";
			$result = mysqli_query($dbconn, $query);
		}
		elseif($upvote=="downvote"){
			$content = "$username downvoted your post entitled $title";
			$topic = "Downvote";
			$query = "INSERT INTO announcement(date_posted,topic,content,user_id,org_id) VALUES('$date','$topic','$content','$disc_user_id','$orgID')";
			$result = mysqli_query($dbconn, $query);
		}
		if($result && !($disc_user_id==$_SESSION['user_id'])){
			$ann=mysqli_query($connectdb,"SELECT * FROM announcement WHERE org_id=$orgID order by announcement_id desc limit 1");
        	$ann_id= mysqli_fetch_assoc($ann);
        	$announcement_id=$ann_id['announcement_id'];
			$query = "INSERT INTO seen_announcement(seen_id,seen,user_id,announcement_id) VALUES (null,'not_seen','$disc_user_id','$announcement_id')";
			$result = mysqli_query($dbconn, $query);	
		}
	}
	else{
		$_SESSION['voted'] = "error";
	}
}
header("Location:discussions.php?orgID=$orgID&pn=$pn&sort_id=$sort_id#$disc_id");
?>