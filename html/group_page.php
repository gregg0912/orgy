<?php
	session_start();
	include("functions.php");
	redirect();
	$connectdb = connection();
	$set_timezone = mysqli_query($connectdb, "set time_zone = '+08:00'");
	$orgid = intval($_GET['orgID']);
	$query1 = mysqli_query($connectdb, "select * from announcement where org_id = $orgid and topic !='Upvote' and topic!='Downvote' and topic!='Commented' order by date_posted DESC ");
    $rows = mysqli_affected_rows($connectdb);
    $start=0;
    $lim=5;

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $start=($id-1)*$lim;
        }
        else{
            $id=1;
        }
      	if(isset($_POST['submit_edit'])){
        	$date = date("Y-m-d h:i:sa");
        	$topic = htmlspecialchars($_POST['edit_topic'],ENT_QUOTES);
        	$content = htmlspecialchars($_POST['edit_content'],ENT_QUOTES);
      		$edit_query="UPDATE announcement 
      		      			SET date_posted='$date', topic='".$topic."', content='".$content."'
      		      				WHERE announcement_id='$_GET[edit]'";
      		querySignUp($edit_query);
      		header('Location: group_page.php?orgID='.$_GET['orgID']);
      	}
      	if(isset($_POST['cancel_edit'])){
      		header('Location: group_page.php?id='.$_GET['id'].'&orgID='.$_GET['orgID'].'#'.$_GET['edit']);
      	}
        $total=ceil($rows/$lim);
        $query = mysqli_query($connectdb, "select * from announcement where org_id =$orgid and topic !='Upvote' and topic!='Downvote' and topic!='Commented' ORDER BY date_posted DESC LIMIT $start, $lim");
        if(isset($_GET['add_announcement'])){
        	$date = date("Y-m-d h:i:sa");
        	$admin_id = $_SESSION["user_id"];
			$topic1 = $_GET['topic'];
			$content1 = $_GET['new_announcement'];
			$topic =htmlspecialchars($topic1, ENT_QUOTES);
			$content = htmlspecialchars($content1, ENT_QUOTES);
			$add_query = "insert into announcement(`announcement_id`,`date_posted`,`topic`,`content`,`org_id`,`user_id`) values(0,'$date','$topic','$content',$orgid, $admin_id)";
  			$add_result = mysqli_query($connectdb, $add_query);
  			
  			
			//adding to seen_announcements
			$announcement_query = " select announcement_id from announcement where org_id = $orgid and user_id = $admin_id and topic !='Upvote' and topic!='Downvote' and topic!='Commented' order by date_posted DESC limit 1";
			$A_result = mysqli_query($connectdb, $announcement_query);

			while($announcement_result = mysqli_fetch_assoc($A_result)){
				$announcement_id = $announcement_result['announcement_id'];
			}
			$seen_query = "select user_id from joined where org_id = $orgid and user_id != $admin_id and membership_type != 'pending'";
			$seen_result = mysqli_query($connectdb, $seen_query);
			

			while($member_result = mysqli_fetch_assoc($seen_result)){
				$member_id = $member_result["user_id"];

				$S_query = "insert into seen_announcement(`seen_id`,`seen`,`user_id`,`announcement_id`) values(0, 'not_seen', $member_id, $announcement_id)";

				$add_seen_result = mysqli_query($connectdb, $S_query);
			}
      		header("location: group_page.php?orgID=$orgid");
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ORG SYSTEM A.Y. 2016-2017</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" type="text/css" href="../css/group_page.css">
</head>
<body>
<div id="wrapper">
	<nav>
        <ul>
            <?php 
            $current_id = $_SESSION['user_id'];
            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
            while($current_user= mysqli_fetch_array($query2)){ ?>
            <li><a href = 'viewprofile.php?user_id=<?=$current_id?>' class="username"><?php echo $current_user['username'] ?></a></li>
            <li class="image"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><img onerror="this.src = '../images/janina.PNG'" src="../images/<?php echo $current_user['prof_pic'] ?>"/></a></li><?php } ?>
            <li><a href="home.php">Home</a></li>
            <li><a href="explore.php">Explore</a></li>
            <li class="dropbtn"><a class="dropbtn active" href="groups.php">Groups</a>
                <ul class="dropdown-list">
                <?php
                $pending = "%pending%";
                $query2 = "SELECT orgs.org_id, orgs.org_name
                            FROM joined, orgs
                            WHERE joined.user_id = '".$_SESSION['user_id']."' AND joined.org_id = orgs.org_id AND joined.membership_type NOT LIKE '".$pending."'";
                $result2 = mysqli_query($connectdb, $query2);
                while(list($org_id2, $orgName2) = mysqli_fetch_row($result2)){
                ?>
                    <li><a href="group_page.php?orgID=<?=$org_id2?>"><?=$orgName2?></a></li>
                <?php
                }
                ?>
                </ul>
            </li>
            <li><a href="edit.php">Edit Profile</a></li>
            <li><a href="notif.php">Notifications
              <?php
                $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
                $total2 = mysqli_num_rows($notifnum); ?>
					<span class="notif-count"><?php echo $total2 ?></span>
            </a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
    	<?php
			$current_userid = $_SESSION['user_id'];
			$checker_query = "SELECT * FROM joined,orgs WHERE joined.org_id = $orgid AND joined.user_id = $current_userid AND orgs.org_id = $orgid";
			$check_result = mysqli_query($connectdb, $checker_query);

			$pending_query = "SELECT * FROM joined WHERE org_id = $orgid AND membership_type = 'pending' ";
			$pending_count =mysqli_num_rows(mysqli_query($connectdb, $pending_query));
			$members_query = "SELECT * FROM joined WHERE org_id = $orgid AND (membership_type = 'admin' OR membership_type='member') ";
			$members_count = mysqli_num_rows(mysqli_query($connectdb, $members_query));
			
			$result = mysqli_fetch_assoc($check_result);
			$member = $result['membership_type'];
		?>
		<!-- Agent Proxy -->
	<div id="content">
		<div class="header">
			<center>
				<img class="img-absolute" onerror="this.src = '../images/janina.PNG'" src="<?=$result['photo']?>"/>
			</center>
			<h1 class="title"><?=$result['org_name']?></h1>
			<h2 class="currpage">Announcements</h2>
		</div>
		<div id="announcements">
			<div class="page-navigation">
					<a href="org_members.php?orgID=<?= $orgid ?>" id="members" class="buttoncustom"><?php echo "Members ".$members_count;?></a>
					<?php if($member =='admin'){ ?>
					<a href="approve_members.php?orgID=<?= $orgid ?>" id="pending" class="buttoncustom"><?php echo "Pending Members ".$pending_count;?></a>
					<?php } ?>
					<a href="discussions.php?orgID=<?=$orgid?>" id="discussion" class="buttoncustom">View Discussions</a>
			</div>
		<!-- Agent Proxy -->	
			
			<?php if($member =='admin'){ ?>
				<form class="posting true" action = "group_page.php?orgID=<?=$orgid?>" method = "get">
					<input type = "text" name = "topic" placeholder = "Topic">
					<textarea rows="4" cols="30" name = "new_announcement" placeholder = "What's happening?"></textarea>
					<input type="submit" name="add_announcement" value="Post">
					<input type = 'text' name ='orgID' value = "<?php echo $orgid ?>" hidden>
				</form>
			<?php } ?>
			<ul class="posted">
			<?php
			if($total>=1){
				while($GrpAnnouncement = mysqli_fetch_array($query)){
					$date_c = $GrpAnnouncement["date_posted"];
					$phpdate = strtotime( $date_c );
					$datec = date( 'F d, Y h:i:s a', $phpdate );
		       	   	$user_id = $GrpAnnouncement['user_id'];
		            $username = mysqli_query($connectdb, "select first_name, last_name from user where user_id = $user_id");
		            $name = mysqli_fetch_assoc($username);
		            if(!isset($_GET['edit'])){?>
						<li class="posted-content">
		            		<h2 class="type" id="<?=$GrpAnnouncement['announcement_id']?>"><?php echo $GrpAnnouncement['topic'] ?></h2>
			                <span class="date"><span class="glyphicon glyphicon-time"></span> <?= $datec ?></span>
			                <div class="relative-box">
				                <?php
		                    	if($user_id==$_SESSION['user_id'] && !(($GrpAnnouncement['topic']=="Rejected")||($GrpAnnouncement['topic']=="Accepted")||($GrpAnnouncement['topic']=="Kicked"))){ ?>
		                    		<a href='group_page.php?orgID=<?=$_GET['orgID']?>&id=<?=$id?>&edit=<?=$GrpAnnouncement['announcement_id']?>#<?=$GrpAnnouncement['announcement_id']?>' class="buttoncustom edit absolute"><span class="glyphicon glyphicon-pencil"></span></a>
		                        <form method="post" action="">
		                        	<button type="submit" name="" value="" class="delete absolute"><span class="glyphicon glyphicon-remove"></span></button>
		                        </form>
		                        <?php } ?>
	                        </div>
		                    <a href = "viewprofile.php?user_id=<?=$GrpAnnouncement['user_id']?>"><h3 class="name"><?php echo $name["first_name"]." ".$name["last_name"];?></h3></a>
		                    <p class="caption">"<?=nl2br($GrpAnnouncement['content']) ?>"</p>
			        	</li>
			        <?php 
		    		}
		    		else{
			    		if($_GET['edit']==$GrpAnnouncement['announcement_id']){ ?>
			    			<form class="posting" id='<?=$_GET['edit']?>' method='post'>
				            	<h3 class="name"><?php echo $name["first_name"]." ".$name["last_name"];?></h3>
				            	<span class="date"><?= $datec ?></span>
				            	<input type='text' name='edit_topic' value='<?= $GrpAnnouncement['topic'] ?>' placeholder="Topic">
				            	<textarea name='edit_content' placeholder="What's happening?"><?= $GrpAnnouncement['content'] ?></textarea>
				            	<div class="group-btn">
					            	<input type='submit' name='submit_edit' value='Done' class="done">
					            	<input type='submit' name='cancel_edit' value='Cancel' class="cancel">
				            	</div>
					        </form>
						<?php }
					     else{ ?>
					     	<li class="posted-content">
			            		<h2 class="type"><?php echo $GrpAnnouncement['topic'] ?></h2>
				                <span class="date"><?= $datec ?></span>
			                    <h3 class="name"><?php echo $name["first_name"]." ".$name["last_name"];?></h3>
			                    <p class="caption">"<?=nl2br($GrpAnnouncement['content']) ?>"</p>
				        	</li>
					   <?php  }	
					}
		    	}
	        } else{ ?>
	        	<p class="none">No new announcements for this group.</p>
	        <?php } ?>
		    </ul> 
			<?php 
			if($rows!=0){
				pagination($id,$rows,$lim,1,"group_page.php?orgID=$orgid&id=%d");
			} ?>	
		</div>		
		<footer>CMSC 128 Section 1 | 2016</footer>
	</div>
</div>
</body>
</html>