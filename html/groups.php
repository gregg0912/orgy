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
		<title>ORG SYSTEM A.Y. 2016-2017</title>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    	<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/navigation.css">
		<link rel="stylesheet" type="text/css" href="../css/groups.css">
		
	</head>
	<body>
	<?php	$start=0;
			$lim=3;

			if(isset($_GET['id'])){
				$id=$_GET['id'];
				$start=($id-1)*$lim;
			}
			else{
				$id=1;
			}
			if(isset($_SESSION['added'])){
				if($_SESSION['added']){
					echo "<script type='text/javascript'>alert('Successfully added a request.')</script>";
				}else{
					echo "<script type='text/javascript'>alert('Group was not added. Try Again.')</script>";
				}
				unset($_SESSION['added']);
			}
			
			?>
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
		<div id="content">
			<div id="group_list">
				<h1 class="title">ORGS JOINED</h1>
				<ul id="see_group">
					<?php
						$userid = $_SESSION['user_id'];
						$query = "SELECT * FROM joined, orgs WHERE joined.user_id = $userid AND joined.org_id = orgs.org_id";
						$result = mysqli_query($connectdb,$query);
						$rows=mysqli_num_rows($result);
						$total=ceil($rows/$lim);
						$result = groupListQuery($userid,$start,$lim,$connectdb);
						if($total>=1){
							while(list($orgid,$orgName, $photo,$memType)=mysqli_fetch_row($result)){
					?>
							<li class="joinGroup">
									<label class="orgname"><?=elipse($orgName)?></label>
									<img id="image" src="<?=$photo?>" onerror="this.src = '../images/janina.PNG'" >
									<label class="status"><?=detMemType($memType)?></label>
									<?php
										if ($memType!="pending") {
										?>
										<a class="orglink" href="group_page.php?orgID=<?=$orgid?>"><?=elipse($orgName)?></a>
										<?php
										}else{
										?>
										<a class="buttoncustom" href="cancel.php?orgID=<?=$orgid?>&id=<?=$id?>">Cancel Request</a>
										<?php
										}
									?>
							</li>
								
						<?php
							}
							pagination($id,$rows,$lim,1,"groups.php?id=%d");
						}
						else{
							echo "<p>You still haven't joined an org yet! Try <a href='explore.php'>Exploring</a> a bit.</p>";
						}
					?>							
				</ul>

				
				<?php
					if(isset($_SESSION['deleted'])&&isset($_SESSION['orgName'])){
						if($_SESSION['deleted']){
						?>
							<p>Successfully deleted request sent to <?=$_SESSION['orgName']?>.</p>
						<?php
						}else{
						?>
							<p>Request for <?=$_SESSION['orgName']?> unsuccesfully deleted. Please try again.</p>
						<?php
						}
						unset($_SESSION['deleted']);
						unset($_SESSION['orgName']);
					}
				?>
			</div>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	</div>
	</body>
</html>