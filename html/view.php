<?php
	session_start();
	include ("functions.php");
	$connectdb = connection();
	redirect();
	date_default_timezone_set("Asia/Singapore");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Group Description</title>
    	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/view.css">
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
				<li><a class="active" href="explore.php">Explore</a></li>
				<li class="dropbtn"><a class="dropbtn" href="groups.php">Groups</a>
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
		<div id="content">
			<div id="group_list">
				<ul id="see_group">
					<?php
						$id = $_GET['org_id'];
						$pageid = $_GET['id'];
						$org_type = $_GET['org_type'];
						$query3 = mysqli_query($connectdb, "SELECT org_name, photo, description from orgs WHERE org_id = $id");

						while(list($orgName, $photo, $des)=mysqli_fetch_array($query3)){ ?>
							<h1 class="title"><?=$orgName?></h1>
							<img onerror="this.src = '../images/janina.PNG'" id="imagev" src="<?=$photo?>"><br>
							<!-- <label id="label"><?=$orgName?></label> -->
							<p><?=$des?></p>
						<?php } 
						?>
						<div class="group-btn">
						<?php
						$query = "SELECT * FROM joined WHERE user_id = '".$_SESSION['user_id']."' AND org_id = '".$id."'";
						$result = mysqli_query($connectdb,$query);
						if(mysqli_num_rows($result)==0){
						?>
							<a class="buttoncustom" href="add.php?org_id=<?=$id?>" style="margin-right: 10px;color: white;"><span class="glyphicon glyphicon-plus-sign"></span> Add Org</a>
						<?php
						}
						?>
							<button onclick="history.go(-1);" style="color: white;"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back </button>
						</div>
				</ul>
			</div>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	</div>
	</body>
</html>