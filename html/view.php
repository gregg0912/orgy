<?php
	session_start();
	include ("functions.php");
	$connectdb = connection();
	redirect();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Group Description</title>
		<style type="text/css">
			#image{
				margin-left: 33%;
			}
			#label{
				margin-left: -2.5%;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
	<div id="wrapper">
		<nav id="general">
			<ul id="navigation">
				<?php 
	            $current_id = $_SESSION['user_id'];
	            $query2 = mysqli_query($connectdb, "SELECT * from user where user_id = $current_id"); 
	            while($current_user= mysqli_fetch_array($query2)){ ?>
	            <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
	            <li><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></li> <?php } ?>
				<li><a href="home.php">Home</a></li>
				<li><a href="explore.php" class="active">Explore</a></li>
				<li><a href="groups.php">Groups</a></li>
				<li><a href="edit.php">Edit Profile</a></li>
				<li><a href="notif.php">Notifications   |  
				  <?php
            $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
            $total = mysqli_num_rows($notifnum);
            echo "$total"
            ?>
          </a></li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</nav>
		<div id="content" style="height: 60%;">
			<div id="group_list">
				<ul id="see_group">
					<?php
						$id = $_GET['org_id'];
						$pageid = $_GET['id'];
						$org_type = $_GET['org_type'];
						$query3 = mysqli_query($connectdb, "SELECT org_name, photo, description from orgs WHERE org_id = $id");

						while(list($orgName, $photo, $des)=mysqli_fetch_array($query3)){ ?>
							<h2 id="label"><?=$orgName?></h2>
							<img id="image" src="<?=$photo?>"><br>
							<!-- <label id="label"><?=$orgName?></label> -->
							<p><?=$des?></p>
						<?php } 
						?>
						<!-- <a href="explore.php?org_type=<?php echo $org_type?>&id=<?=$pageid?>"><button  onclick="history.go(-1);">Go Back to Exploring</button></a> -->
						<a href="add.php?org_id=<?=$id?>" class="btn btn-1 btn-1a" style="margin-left: 69%;">Add Org</a>
						<button class="btn btn-1 btn-1a" style="margin-left: 69%;" onclick="history.go(-1);">Go Back to Exploring</button>
				</ul>
			</div>
		</div>
	</div>
	</body>
</html>