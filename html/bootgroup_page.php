<?php
	session_start();
	include("functions.php");
	redirect();
	$connectdb = connection();
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
      $total=ceil($rows/$lim);
      $query = mysqli_query($connectdb, "select * from announcement where org_id =$orgid order by date_posted DESC limit $start, $lim");
      if(isset($_GET['add_announcement'])){
  		  $date = date("Y-m-d h:i:sa");
  			$admin_id = $_SESSION["user_id"];
  			//$topic = $_GET['topic'];
  			//$content = $_GET['new_announcement'];



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
			$seen_query = "select user_id from joined where org_id = $orgid and user_id != $admin_id";
			$seen_result = mysqli_query($connectdb, $seen_query);
			

			while($member_result = mysqli_fetch_assoc($seen_result)){
				$member_id = $member_result["user_id"];

				$S_query = "insert into seen_announcement(`seen_id`,`seen`,`user_id`,`announcement_id`) values(0, 'not_seen', $member_id, $announcement_id)";

				$add_seen_result = mysqli_query($connectdb, $S_query);
			}
      	header("location: bootgroup_page.php?orgID=$orgid");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>ORG SYSTEM A.Y. 2016-2017</title>
	
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">

	<style type="text/css">

	.jumbotron{
		width: 50%;
	}

	.jumbotron.announcementContent{
		margin-left: -10%;
		
	}

	.container.announForm{
		position: fixed;
		background: yellow;
		padding: 20px;
		display: inline;
		margin-top: -55%;
		margin-left: 45%;
		width: 20%;
		height: 35%;
		
	}
	.btn-primary{
		margin: 10px;
	}

	#butts{
		display: block;
	}
	#post{
		margin-bottom:10%;
		margin-left: 70%;

	}
	#inner{
		margin-bottom: 4%;
		background: #c7a4a6;
		padding: 3%;
	}
	footer{
		position: relative;
		text-align: center;
		margin-top: 30%;
		background: #eaeaea;
		width: 100%;
		padding: 1%;
		
	}

     </style>
</head>
<body>
	<div class = "container">	

		<?php	$start=0;
				$lim=3;

				if(isset($_GET['id'])){
					$id=$_GET['id'];
					$start=($id-1)*$lim;
				}
				else{
					$id=1;
				} ?>
		<div id="wrapper">
		    <nav id="general">
		        <ul class="nav nav-pills nav-stacked" id="navigation" >
		            <?php 
		            $current_id = $_SESSION['user_id'];
		            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
		            while($current_user= mysqli_fetch_array($query2)){ ?>
		            <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
		            <li><img id = "prof_pic" onerror="this.src = '../images/janina.PNG'" src="../images/<?php echo $current_user['prof_pic'] ?>"/></li><?php } ?>
		            <li><a href="home.php">Home</a></li>
		            <li><a href="bootexplore.php">Explore</a></li>
		            <li class="dropdown" id="dropFilter">
		                <a class="dropdown-toggle" data-toggle="dropdown" href="bootgroups.php">Groups<span class="caret caret-right "></span></a>
		                    <ul class="dropdown-menu">
		                    <?php
		                    $pending = "%pending%";
		                    $query2 = "SELECT orgs.org_id, orgs.org_name
		                                FROM joined, orgs
		                                WHERE joined.user_id = '".$_SESSION['user_id']."' AND joined.org_id = orgs.org_id AND joined.membership_type NOT LIKE '".$pending."'";
		                    $result2 = mysqli_query($connectdb, $query2);
		                    while(list($org_id2, $orgName2) = mysqli_fetch_row($result2)){
		                    ?>
		                      <li><a href="bootgroup_page.php?orgID=<?=$org_id2?>"><?=$orgName2?></a></li>
		                    <?php
		                    }
		                    ?>
		                    </ul>
		                
		            </li>
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
		</div>	    
	</div>	
<div class="jumbotron">
	<div id="content" class="container">
		<div id="announcements">
		<!-- Agent Proxy -->	
			<?php
				$current_userid = $_SESSION['user_id'];
				$checker_query = "select * from joined where org_id = $orgid and user_id = $current_userid";
				$check_result = mysqli_query($connectdb, $checker_query);

				$pending_query = "select * from joined where org_id = $orgid and membership_type = 'pending' ";
				$pending_count =mysqli_num_rows(mysqli_query($connectdb, $pending_query));
				
					while($result = mysqli_fetch_assoc($check_result)){
							$member = $result['membership_type'];
					}
			?>
		<!-- Agent Proxy -->
		<div class="page-header">
			<h2>Announcements</h2>
		</div>
				<div class="container" id="butts">
					<a style="color: black; font-family: 'Montserrat', sans-serif;" href="bootdiscussions.php?orgID=<?=$orgid?>"><button class="btn btn-primary btn-md"  id="discussion">View Discussions</button></a>
					<!--<p>No other announcements yet.</p>-->

					<?php if($member =='admin'){ ?>
					<a style="color: black; font-family: 'Montserrat', sans-serif;" href="bootapprove_members.php?orgID=<?= $orgid ?>"> <button class="btn btn-primary btn-md" id="pending"><?php echo "Pending Members (".$pending_count.")" ?></button> </a>
					<?php } ?>
				

			<ul class="jumbotron announcementContent">
			<?php while($GrpAnnouncement = mysqli_fetch_array($query)){
	        
	       	   	$user_id = $GrpAnnouncement['user_id'];
	            $username = mysqli_query($connectdb, "select first_name, last_name from user where user_id = $user_id");
	            $name = mysqli_fetch_assoc($username);

            ?>
				</div>
				<fieldset id="inner" >
            		<legend style="font-size: 200%; text-align: center; background: #c7a4a6;"><?php echo $GrpAnnouncement['topic'] ?></legend>
                	<dl>
                    	<dt style="font-size: 100%; text-align: center;"><?php echo $name["first_name"]." ".$name["last_name"];?></dt>
                    	<dt><p>"<?php echo $GrpAnnouncement['content'] ?>"</p></dt>
	                	<!-- <dt id=''>Date</dt> -->
                    	<dt style="font-size: 50%; text-align: right;"><?php echo $GrpAnnouncement['date_posted'] ?></dt>
        			</dl>
	        	</fieldset>
	        <?php } ?>
			</ul>
			<?php 
				if($member =='admin'){ ?>
					<form class="container announForm" action = "bootgroup_page.php?orgID=<?=$orgid?>" method = "get" style="border: none;">
					<fieldset>
						<legend><input style="font-size: 90%; text-align: center;" type = "text" name = "topic" placeholder = "Topic"></legend>
						<textarea rows="4" cols="30" name = "new_announcement" placeholder = "What's happening?"></textarea>

							<input id="post" class="btn btn-primary btn-md" type="submit" name="add_announcement" value="Post">
							<input type = 'text' name ='orgID' value = "<?php echo $orgid ?>" hidden>
					</fieldset>
					</form>
				<?php } ?>
			<?php 
        if($rows <= 0){ ?>
            <p> No announcement yet. </p> <?php
        }
        else { ?>
        	<ul id="pagination">
        	<?php
        	if($total!= 1){
        		if($id>1){
        	?>
        		<li><a href="?id=<?php echo ($id-1)?>&orgID=<?=$orgid?>">&laquo;</a></li>
        		<?php }
        		for($i=1; $i<=$total; $i++){
        			if($i==$id){ ?>
        			<li><a class="current" href="?id=<?php echo $i?>&orgID=<?=$orgid?>"><?=$i?></a></li>
        			<?php
        			}
        			else{
        			?><li><a href="?id=<?php echo $i?>&orgID=<?=$orgid?>"><?=$i?></a></li>
        			<?php
        			}
        		}
        		if($id!=$total){
        		?>
        		<li><a href="?id=<?php echo ($id+1)?>&orgID=<?=$orgid?>">&raquo;</a></li>
        	<?php
        		}
        	}
		?>
			</ul>
		<?php
		}
		?>
			</div>
		</div>
		<footer>CMSC 128 Section 1 | 2016</footer>
</div>
	<!-- end tag for jumbotron -->
</div>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"</script>
</body>
</html>
