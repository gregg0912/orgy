<!-- PWNED BY AGENT P 
	________________________________________________
	|											    |
	|				AGENT PROXY 069                	|
	|_______________________________________________|

-->


<?php
	session_start();
	include("functions.php");
	redirect();
	$connectdb = connection();
	date_default_timezone_set("Asia/Singapore");
	$value = $_GET['ID'];
	$orgid = $_GET['ORGID'];
    $user=mysqli_query($connectdb,"select * from user,joined where user.user_id=joined.user_id and joined.join_id='$value' ");
	$name=mysqli_fetch_assoc($user);	
	$query_rejected= "delete from joined where join_id='$value'";
	$result=mysqli_query($connectdb,$query_rejected);
	$date = date("Y-m-d h:i:sa");
	$admin_id = $_SESSION["user_id"];

	echo "$value";
	   
	if($result){
		$topic="Kicked";
		$userid=$name['user_id'];
		$user=$name['first_name'];
		$user=$user." ".$name['last_name'];
		$content="Admin "."$_SESSION[username]"." kicked "."$user"." from the org.";
		$add_query = "insert into announcement(`announcement_id`,`date_posted`,`topic`,`content`,`org_id`,`user_id`) values(0,'$date','$topic','$content',$orgid, $admin_id)";
		$add_result = mysqli_query($connectdb, $add_query);
		if($add_result){
			 $ann=mysqli_query($connectdb,"SELECT * FROM announcement WHERE org_id=$orgid order by date_posted desc limit 1");
		$ann_id= mysqli_fetch_assoc($ann);
		$announcement_id=$ann_id['announcement_id'];
		$query = "INSERT INTO `seen_announcement` (`seen_id`, `seen`, `user_id`, `announcement_id`) VALUES (NULL, 'not_seen', '$userid', '$announcement_id')";
		mysqli_query($connectdb,$query);
		 header("Location:org_members.php?orgID=$orgid");
		}
	}

	?>