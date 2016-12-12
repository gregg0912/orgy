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
	$query_rejected= "DELETE FROM joined WHERE join_id='$value'";
	$result=mysqli_query($connectdb,$query_rejected);
	if($result){
		$query_delcomm="DELETE FROM comments WHERE comments.disc_id IN
						(SELECT discuss.disc_id FROM discuss WHERE discuss.user_id='".$name['user_id']."' AND discuss.org_id = '".$orgid."')";
		$result_delcomm=mysqli_query($connectdb,$query_delcomm);
		if($result_delcomm){
			$query_delup = "DELETE FROM disc_upvote WHERE disc_upvote.disc_id IN
							(SELECT discuss.disc_id FROM discuss WHERE discuss.user_id='".$name['user_id']."' AND discuss.org_id = '".$orgid."')";
			$result_delup = mysqli_query($connectdb,$query_delup);
			if($result_delup){
				$query_deldisc = "DELETE FROM discuss WHERE discuss.user_id='".$name['user_id']."' AND discuss.org_id = '".$orgid."'";
				$result_deldisc=mysqli_query($connectdb,$query_deldisc);
			}
		}
	}

	$date = date("Y-m-d H:i:s");
	$admin_id = $_SESSION["user_id"];

	echo "$value";
	if(isset($result_deldisc)){
		echo "$result_deldisc";
		if($result_deldisc){
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
	}

	?>