<?php
	session_start();
	include ("functions.php");
	$connectdb = connection();
	redirect();
	date_default_timezone_set("Asia/Singapore");
	$org_id = $_GET['orgID'];
	$query = "SELECT org_name FROM orgs WHERE org_id = '".$_GET['orgID']."'";
	$result = mysqli_query($connectdb, $query);
	list($orgName) = mysqli_fetch_row($result);
	$_SESSION['orgName']=$orgName;
	$query = "DELETE FROM joined WHERE user_id = '".$_SESSION['user_id']."' AND org_id = '".$_GET['orgID']."'";
	$result = mysqli_query($connectdb,$query);
	if($result){
		$_SESSION['deleted']=true;
		$content = $_SESSION['username']." cancelled their request to join $orgName.";
		$user_id = $_SESSION['user_id'];
		$topic = "Request";
		$date = date("Y-m-d H:i:s");
		$add_query = "INSERT INTO announcement(`announcement_id`,`date_posted`,`topic`,`content`,`user_id`,`org_id`) VALUES(NULL,'$date','$topic','$content','$user_id','$org_id')";
		$add_result = mysqli_query($connectdb, $add_query);
		if($add_result){
			$ann=mysqli_query($connectdb,"SELECT * FROM announcement WHERE org_id= '".$org_id."' AND user_id = '".$user_id."' ORDER BY date_posted DESC LIMIT 1");
			$announcement=mysqli_fetch_assoc($ann);
			$ann_id = $announcement['announcement_id'];
			$admin_query = "SELECT user_id FROM `joined` WHERE org_id = '".$org_id."' AND membership_type = 'admin'";
			$admin_result = mysqli_query($connectdb, $admin_query);
			while(list($admin_id)=mysqli_fetch_row($admin_result)){
				$seen_query = "INSERT INTO `seen_announcement` (`seen_id`, `seen`, `user_id`, `announcement_id`) VALUES (NULL, 'not_seen', '$admin_id', '$ann_id')";
				mysqli_query($connectdb, $seen_query);
			}
		}
	}else{
		$_SESSION['deleted']=false;
	}
	header("Location:groups.php?id=".$_GET['id']);
?>