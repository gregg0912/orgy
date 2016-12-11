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
	$orgid = intval($_GET['orgID']);
	$query1 = mysqli_query($connectdb, "select * from joined where org_id = $orgid and (membership_type ='member' or membership_type='admin') ");
	$total_items = mysqli_num_rows($query1);
	// echo "$result";
    $rows = mysqli_num_rows($query1);
    $start=0;
    $lim=3; 

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $start=($id-1)*$lim;
        }
        else{
            $id=1;
         } 

    $total=ceil($rows/$lim);
    $query = mysqli_query($connectdb, "select * from joined where org_id = $orgid and (membership_type ='member' or membership_type='admin') limit $start, $lim");


    if($_POST){
    	echo "$_SESSION[kick]";
    	$date = date("Y-m-d h:i:sa");
    	$admin_id = $_SESSION["user_id"];
    	for($x=0;$x<=$_SESSION['count'];$x++){
    		if(isset($_POST['View'.$x])){
    			$value = $_POST['View'.$x];
    			header("Location: viewprofile.php?user_id=$value");
    		}
    	}
    }
        
?>	
<!DOCTYPE html>
<html lang="en">
	<head> 
		<title>ORG SYSTEM A.Y. 2016-2017</title>
    	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
		<link rel="stylesheet" type="text/css" href="../css/navigation.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/members.css">

	</head>

	<body>
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
			<!-- Agent Proxy -->	
			<?php
				$current_userid = $_SESSION['user_id'];
				$checker_query = "select * from joined where org_id = $orgid and user_id = $current_userid";
				$check_result = mysqli_query($connectdb, $checker_query);
				
					while($result = mysqli_fetch_assoc($check_result)){
							$member = $result['membership_type'];
					}
			?>				
		<!-- Agent Proxy -->
			<h1 class="title">Current Members</h1>
			<a href="group_page.php?orgID=<?= $orgid ?>" class="buttoncustom return"><span class="glyphicon glyphicon-chevron-left"></span> Back Group Page</a><br>			
			<?php
				$query_penders = "select * from user,joined where user.user_id=joined.user_id and joined.org_id=$orgid and (joined.membership_type='member' or joined.membership_type='admin') order by membership_type desc limit $start,$lim";
				$penders = mysqli_query($connectdb,$query_penders);
				$count=0; ?>
				<ul class="members">
				<?php while($pendering=mysqli_fetch_assoc($penders)){ ?>
							<li class="member">
								<h2 class="name"><?=elipse($pendering['username'])?></h2>
								<img onerror="this.src = '../images/janina.PNG'" src="<?=$pendering['prof_pic']?>">
								<span class="mem-type"><?=elipse($pendering['membership_type'])?></span>
								<button name="<?='View'."$count"?>" value="<?=$pendering['user_id']?>"> View Profile </button>
								<?php if($member=='admin' && $_SESSION['user_id']!=$pendering['user_id']){?>
									<a class="buttoncustom" href="delete_member.php?ID=<?= $pendering['join_id'] ?>&ORGID=<?=$orgid?>" onClick= "uSure(); return false;"> Kick </a> 
								<?php } 
									$_SESSION['count']=$count; ?>
							</li>
				<?php 	
					$count++; 
				} ?>
				</ul>
				<?php 
		        if($rows <= 0){ ?>
		            <p> No pending members. </p> <?php
		        }
		        else { ?>
			        <?php
						pagination($id,$total_items,$lim,1,"org_members.php?orgID=$orgid&id=%d");
					}  
					?>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
		<script type="text/javascript">
			function uSure() {
			    var x = confirm("<?= "Do you really want to kick " . $pendering['username'] . "? "?>");
			    if (x == true){
			    	
			        window.location.href = 'delete_member.php?ID=<?= $pendering['join_id'] ?>&ORGID=<?=$orgid?>';
			    } 
			}
		</script>
	</body>
</html>

