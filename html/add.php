<?php
	session_start();
	include ("functions.php");
	redirect();

	$host = 'localhost';
	$username = 'root';
	$password = '';
	$db	= 'org_y';
	$dbconn = mysqli_connect($host, $username, $password, $db) or die("Cannot connect to database!");
	mysqli_select_db($dbconn, $db) or die( "Unable to select database"); 
	
	$user_id = $_SESSION["user_id"];
	$date = date("Y-m-d");
	echo "Today is $date<br>" ;
	$org_id = $_GET['org_id'];
	$query = "SELECT org_name FROM orgs WHERE org_id = '".$org_id."'";
	$result = mysqli_query($dbconn, $query);
	list($orgName) = mysqli_fetch_row($result);
	$member = "pending";
	$query = "insert into joined (user_id, org_id, membership_type, date_joined) values($user_id, $org_id, '$member', '$date')";
	$topic = "Request";
	$user = "SELECT * FROM user WHERE user_id = '".$user_id."'";
	$user = mysqli_query($dbconn, $user);
	$user = mysqli_fetch_assoc($user);
	$name = $user['first_name']." ".$user['last_name'];
	$content = $_SESSION['username'] ." wishes to join $orgName.";
	$date = date("Y-m-d h:i:sa");
	$add_query = "INSERT INTO announcement(`announcement_id`,`date_posted`,`topic`,`content`,`user_id`,`org_id`) VALUES(NULL,'$date','$topic','$content','$user_id','$org_id')";
	$add_result = mysqli_query($dbconn, $add_query);
	if($add_result){
		$ann=mysqli_query($dbconn,"SELECT * FROM announcement WHERE org_id= '".$org_id."' AND user_id = '".$user_id."' ORDER BY date_posted DESC LIMIT 1");
		$announcement=mysqli_fetch_assoc($ann);
		$ann_id = $announcement['announcement_id'];
		$admin_query = "SELECT user_id FROM `joined` WHERE org_id = '".$org_id."' AND membership_type = 'admin'";
		$admin_result = mysqli_query($dbconn, $admin_query);
		while(list($admin_id)=mysqli_fetch_row($admin_result)){
			$seen_query = "INSERT INTO `seen_announcement` (`seen_id`, `seen`, `user_id`, `announcement_id`) VALUES (NULL, 'not_seen', '$admin_id', '$ann_id')";
			mysqli_query($dbconn, $seen_query);
		}
	}
	if ($dbconn->query($query) === true ){
		$_SESSION['added'] = true;
		header('Location: groups.php');
	}
	else{
		$_SESSION['added'] = false;
	}
?>
