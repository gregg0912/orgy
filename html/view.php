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
		<link rel="stylesheet" type="text/css" href="../css/navigation.css">
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
				<li class="image"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></a></li><?php } ?>
				<li><a href="home.php">Home</a></li>
				<li><a href="explore.php">Explore</a></li>
				<li class="dropbtn"><a class="dropbtn" href="groups.php">Groups</a>
					<ul class="dropdown-content">
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
				<li><a class="active" href="notif.php">Notifications   |
				<?php
					$notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
					$total2 = mysqli_num_rows($notifnum);
					echo "$total2"
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
		<footer>CMSC 128 Section 1 | 2016</footer>
	</div>
	</body>
</html>