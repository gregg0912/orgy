<?php
	session_start();
	include("functions.php");
	redirect();
	$connectdb = connection();
	$set_timezone = mysqli_query($connectdb, "set time_zone = '+08:00'");
	$orgid = intval($_GET['orgID']);
	$query1 = mysqli_query($connectdb, "select * from announcement where org_id = $orgid order by date_posted DESC ");
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
      		$edit_query="UPDATE announcement 
      		      			SET date_posted='$date', topic='$_POST[edit_topic]', content='$_POST[edit_content]'
      		      				WHERE announcement_id='$_GET[edit]'";
      		// $edit_query="UPDATE discuss 
    	   //  SET title='$_POST[edit_title]', content='$_POST[edit_content]', date_posted='$today'
    	   //  	WHERE announcement_id=$disc_id";
      		querySignUp($edit_query);
      		header('Location: group_page.php?orgID='.$_GET['orgID']);
      	}
      	if(isset($_POST['cancel_edit'])){
      		header('Location: group_page.php?orgID='.$_GET['orgID']);
      	}
        $total=ceil($rows/$lim);
        $query = mysqli_query($connectdb, "select * from announcement where org_id =$orgid ORDER BY date_posted DESC LIMIT $start, $lim");
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
			$announcement_query = " select announcement_id from announcement where org_id = $orgid and user_id = $admin_id order by date_posted DESC limit 1";
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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
        #pagination{
        	margin-left: 0;
            padding: 5px;
            clear: both;
            top: 55%;
            left: 50%;
        }
    	#pagination{
    		margin-left: 0;
    		padding: 5px;
    		float: left;
    		top: 55%;
    		left: 50%;
    		font-family: 'Arial', sans-serif;
    		font-size: 99%;
    	}
    	#pagination{
    		display: inline-block;
    		padding: 0;
    		margin: 0;
    	}
    	#pagination > li{
    		display: inline;
    	}
		#pagination > li > a,
		#pagination > li > span,
		#pagination > li > b{
			color: black;
			float: left;
			padding: 8px 16px;
			text-decoration: none;
			/*transition: background-color .3s;*/
		}
		#pagination > li a.current{
			background-color: #a10115;
			color: white;
		}
		#pagination > li a:hover:not(.current){
			background-color: #FF847C;
		}
        #inner{
        	background-color: rgba(213, 213, 213, 0.4);
          	color: rgb(249, 243, 243);
            list-style-type: none;
            margin: 2%;
            padding: 1%;
        }
        form{
        	float:left;
        	clear: both; 
        }
     </style>
</head>
<body>
<div id="wrapper">
	<nav id="general">
		<ul id="navigation">
			<?php 
            $current_id = $_SESSION['user_id'];
            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
            while($current_user= mysqli_fetch_array($query2)){ ?>
            <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
            <li><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></li> <?php } ?>
			<li><a href="home.php">Home</a></li>
			<li><a href="explore.php">Explore</a></li>
				<div class="dropdownnuj">
	                <li><a id="dropA" class="dropbtnnuj" href="groups.php">Groups</a>
	                    <div class="dropdown-contentnuj">
	                    <?php
	                    $pending = "%pending%";
	                    $query2 = "SELECT orgs.org_id, orgs.org_name
	                                FROM joined, orgs
	                                WHERE joined.user_id = '".$_SESSION['user_id']."' AND joined.org_id = orgs.org_id AND joined.membership_type NOT LIKE '".$pending."'";
	                    $result2 = mysqli_query($connectdb, $query2);
	                    while(list($org_id2, $orgName2) = mysqli_fetch_row($result2)){
	                    ?>
	                        <a href="group_page.php?orgID=<?=$org_id2?>"><?=$orgName2?></a>
	                    <?php
	                    }
	                    ?>
	                    </div>
	                </li>
	            </div>
			<li><a href="edit.php">Edit Profile</a></li>
			<li><a href="notif.php">Notifications   |  
				  <?php
            $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
            $total2 = mysqli_num_rows($notifnum);
            echo "$total2"
            ?>
          </a></li>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
	</nav>
	<div id="content">
		<div id="announcements">
		<!-- Agent Proxy -->	
			<?php
				$current_userid = $_SESSION['user_id'];
				$checker_query = "select * from joined where org_id = $orgid and user_id = $current_userid";
				$check_result = mysqli_query($connectdb, $checker_query);

				$pending_query = "select * from joined where org_id = $orgid and membership_type = 'pending' ";
				$pending_count =mysqli_num_rows(mysqli_query($connectdb, $pending_query));
				$members_query = "select * from joined where org_id = $orgid and (membership_type = 'admin' or membership_type='member') ";
				$members_count = mysqli_num_rows(mysqli_query($connectdb, $members_query));
				
					while($result = mysqli_fetch_assoc($check_result)){
							$member = $result['membership_type'];
					}
			?>
		<!-- Agent Proxy -->
			<h2>Announcements</h2>
			<ul>
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
						<fieldset id="inner">
		            		<legend id="<?=$GrpAnnouncement['announcement_id']?>"style="font-size: 200%; text-align: center;"><?php echo $GrpAnnouncement['topic'] ?></legend>
		                	<dl>
		                    	<dt style="font-size: 100%; text-align: center;"><?php echo $name["first_name"]." ".$name["last_name"];?></dt>
		                    	<dt><p>"<?php echo $GrpAnnouncement['content'] ?>"</p></dt>
		                    	<?php
		                    	if($user_id==$_SESSION['user_id']){?>
		                    		<a href='group_page.php?orgID=<?=$_GET['orgID']?>&edit=<?=$GrpAnnouncement['announcement_id']?>#<?=$GrpAnnouncement['announcement_id']?>'><button>Edit</button></a>
		                    	<?php } ?>
			                	<dt style="font-size: 50%; text-align: right;"><?= $datec ?></dt>
			                	<?php
			                	if($member =='admin'){ ?>
	      
		                        <form method="post" action="">
		                        	<button type="submit" name=" " value=""> Delete </button> 
		               
		                        </form>
	                        <?php } ?> 
		        			</dl>
			        	</fieldset>
			        <?php 
		    		}
		    		else{
			    		if($_GET['edit']==$GrpAnnouncement['announcement_id']){?>
			    			<form id='<?=$_GET['edit']?>' method='post'>
								<fieldset id="inner">
				            		<legend style="font-size: 200%; text-align: center;"><input type='text' name='edit_topic' value='<?= $GrpAnnouncement['topic'] ?>' /></legend>
				                	<dl>
				                    	<dt style="font-size: 100%; text-align: center;"><?php echo $name["first_name"]." ".$name["last_name"];?></dt>
				                    	<dt><textarea name='edit_content'>"<?= $GrpAnnouncement['content'] ?>"</textarea></dt>
			                    		<input type='submit' name='submit_edit' value='Done' />
			                    		<input type='submit' name='cancel_edit' value='Cancel' />
					                	<dt style="font-size: 50%; text-align: right;"><?= $datec ?></dt> 
				        			</dl>
					        	</fieldset>
					        </form>
					<?php }
					     else{ ?>
					     	<fieldset id="inner">
				            		<legend style="font-size: 200%; text-align: center;"><?php echo $GrpAnnouncement['topic'] ?></legend>
				                	<dl>
				                    	<dt style="font-size: 100%; text-align: center;"><?php echo $name["first_name"]." ".$name["last_name"];?></dt>
				                    	<dt><p>"<?php echo $GrpAnnouncement['content'] ?>"</p></dt>
					                	<dt style="font-size: 50%; text-align: right;"><?= $datec ?></dt>
				        			</dl>
					        </fieldset>

					   <?php  }	
					 }
		    	}
	        }
	        else{
	        ?>
	        	<fieldset id="inner">
	        		<legend style="font-size: 200%; text-align: center;">System</legend>
	        		<dl>
	        			<dt>No new announcements for this group.</dt>
	        		</dl>
	        	</fieldset>
	        <?php
	        }
	        ?>
			</ul>
			<?php 
			if($rows!=0){
				pagination($id,$rows,$lim,1,"group_page.php?orgID=$orgid&id=%d");
			}
			if($member =='admin'){ ?>
					<form action = "group_page.php?orgID=<?=$orgid?>" method = "get" style="border: none;">
					<fieldset>
						<legend><input style="font-size: 90%; text-align: center;" type = "text" name = "topic" placeholder = "Topic"></legend>
						<textarea rows="4" cols="30" name = "new_announcement" placeholder = "What's happening?"></textarea>
						<input class="btn btn-1 btn-1a" type="submit" name="add_announcement" value="post">
						<input type = 'text' name ='orgID' value = "<?php echo $orgid ?>" hidden>
					</fieldset>
					</form>
				<?php } ?>
			<div id="bottoma" style="margin-left: 15%">

				<button class="btn btn-1 btn-1a" id="members">
				<a style="color: black; font-family: 'Montserrat', sans-serif;" href="org_members.php?orgID=<?= $orgid ?>"> 
				 <?php echo "Members (".$members_count.")" ?> </a></button> 

				<?php if($member =='admin'){ ?>
				<button class="btn btn-1 btn-1a" id="pending">
				<a style="color: black; font-family: 'Montserrat', sans-serif;" href="approve_members.php?orgID=<?= $orgid ?>"> 
				 <?php echo "Pending Members (".$pending_count.")" ?> </a></button> 
				<?php } ?>

				<a style="color: black; font-family: 'Montserrat', sans-serif;" href="discussions.php?orgID=<?=$orgid?>"><button class="btn btn-1 btn-1a"  id="discussion">View Discussions</button></a>

				<!--<p>No other announcements yet.</p>-->
			</div>	
		</div>		
	</div>
	<footer>CMSC 128 Section 1 | 2016</footer>
</div>
</body>
</html>