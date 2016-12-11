<!-- PWNED BY AGENT P 
	________________________________________________
	|											    |
	|				AGENT PROXY 069   sux dix      	|
	|_______________________________________________|

-->
<?php
	session_start();
	include("functions.php");
	redirect();
	$connectdb = connection();
	$orgid = intval($_GET['orgID']);
	 $query1 = mysqli_query($connectdb, "select * from joined where org_id = $orgid and membership_type ='pending' ");
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
      $query = mysqli_query($connectdb, "select * from joined where org_id = $orgid and membership_type ='pending' limit $start, $lim");


       if($_POST){       
       		$date = date("Y-m-d h:i:sa");
			$admin_id = $_SESSION["user_id"];
            for($x=0;$x<=$_SESSION['count'];$x++){
                if(isset($_POST['Accept'.$x])){
                    $value = $_POST['Accept'.$x];
                    $query_accepted= "update joined set membership_type='member' where join_id='$value'";
                    $result=mysqli_query($connectdb,$query_accepted);
                    if($result){	
			  			$topic="Accepted";
			  			$user=mysqli_query($connectdb,"select * from user,joined where user.user_id=joined.user_id and joined.join_id='$value'");
			  			$name=mysqli_fetch_assoc($user);
						$userid=$name['user_id'];
			  			$user=$name['first_name'];
			  			$user=$user." ".$name['last_name'];
			  			$content="Admin "."$_SESSION[username]"." accepted the request of "."$user"." to join the org.";
			  			$add_query = "insert into announcement(`announcement_id`,`date_posted`,`topic`,`content`,`org_id`,`user_id`) values(0,'$date','$topic','$content',$orgid, $admin_id)";
			  			$add_result = mysqli_query($connectdb, $add_query);
			  			if($add_result){
			  				$ann=mysqli_query($connectdb,"SELECT * FROM announcement WHERE org_id=$orgid order by date_posted desc limit 1");
        					$ann_id= mysqli_fetch_assoc($ann);
        					$announcement_id=$ann_id['announcement_id'];
        					$query = "INSERT INTO `seen_announcement` (`seen_id`, `seen`, `user_id`, `announcement_id`) VALUES (NULL, 'not_seen', '$userid', '$announcement_id')";
        					
        					$test=mysqli_query($connectdb,$query);
        					if($test)
			  				header("Location:approve_members.php?orgID=$orgid");
        						echo "$test";
        						//header("Location:home.php");
			  			}	
                   	}
                }

                 if(isset($_POST['Reject'.$x])){
                 	$value = $_POST['Reject'.$x];
                 	$user=mysqli_query($connectdb,"select * from user,joined where user.user_id=joined.user_id and joined.join_id='$value'");
			  		$name=mysqli_fetch_assoc($user);
                    $query_rejected= "delete from joined where membership_type='pending' and join_id='$value'";
                    $result=mysqli_query($connectdb,$query_rejected);
                    if($result){
			  			$topic="Rejected";
			  			$userid=$name['user_id'];
			  			$user=$name['first_name'];
			  			$user=$user." ".$name['last_name'];
			  			$content="Admin "."$_SESSION[username]"." rejected the request of "."$user"." to join the org.";
			  			$add_query = "insert into announcement(`announcement_id`,`date_posted`,`topic`,`content`,`org_id`,`user_id`) values(0,'$date','$topic','$content',$orgid, $admin_id)";
			  			$add_result = mysqli_query($connectdb, $add_query);
			  			if($add_result){
			  				 $ann=mysqli_query($connectdb,"SELECT * FROM announcement WHERE org_id=$orgid order by date_posted desc limit 1");
        					$ann_id= mysqli_fetch_assoc($ann);
        					$announcement_id=$ann_id['announcement_id'];
        					$query = "INSERT INTO `seen_announcement` (`seen_id`, `seen`, `user_id`, `announcement_id`) VALUES (NULL, 'not_seen', '$userid', '$announcement_id')";
        					mysqli_query($connectdb,$query);

			  				header("Location:approve_members.php?orgID=$orgid");
			  			}	
               		 }
            	}
        	}
        } 
        //
        
?>	
<!DOCTYPE html>
<html lang="en">
	<head> 
		<title>ORG SYSTEM A.Y. 2016-2017</title>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/navigation.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<style type="text/css">
				#pagination{
		        	margin-left: 0;
		            padding: 5px;
		            clear: both;
		            top: 55%;
		            left: 50%;
		        }
		        #pagination > li{
		        	display: inline-block;
		       	}
		        #pagination > li > a{ }
		        #pagination > li a.current{
		            background-color: red;
		            color: white;
		        }
		        #pagination > li a:hover:not(.current){
		            background-color: red;
		        }
				/*ul{
					list-style: none;
					float: left;
					margin-left: 2%;
				}*/
				#content
				{
					border: 1px transparent;
					border-radius: 0%;
					/*float: right;
					margin-top: -50%;	
					margin-right: 7%;*/
					padding: 3%;
					background: linear-gradient(-55deg, rgba(255, 0, 0, 0.0), rgba(255, 0, 0, 0.1), rgba(255, 0, 0, 0.2), rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.2), rgba(255, 0, 0, 0.1), rgba(255, 0, 0, 0.0));
				}

				#see_group{
					width: 25%;
					height: 50%;
					
				}
				#see_group > ul > li {
					text-decoration: none;
					color: #a10115;
					padding: 2%;
					transition: 0.2s ease-in-out;
					margin-left: -20%;
					margin-right: 1%;
				}

				#see_group > li > label {
					text-align:center;
					text-shadow: none;
					color: #a10115;
					font-size: 25px;
				}


				#see_group > li > #image{
					padding: 3% 3% 3% 3%;
					height: 171.91px;
					width: 171.91px;
				}

				#grppage{
					float: left;
				}

		</style>

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
			<div id="announcements">
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
			<h2>PENDING MEMBERS</h2>	
			<a href="group_page.php?orgID=<?= $orgid ?>" id="grppage" class="btn btn-1 btn-1a">Group Page</a><br>
			<?php
				$query_penders = "select * from user,joined where user.user_id=joined.user_id and joined.org_id=$orgid and joined.membership_type='pending' limit $start,$lim";
				$penders = mysqli_query($connectdb,$query_penders);
				$count=0;
				while($pendering=mysqli_fetch_assoc($penders)){ ?>
					<div id="group_list">
						<ul id="see_group">
							<li>
								<label><?=elipse($pendering['username'])?></label>
								<img onerror="this.src = '../images/janina.PNG'" id="image" src="<?=$pendering['prof_pic']?>" >
								<form method="post">
								<button name="<?='Accept'."$count"?>" value="<?=$pendering['join_id']?>"> Accept </button>
								<button name="<?='Reject'."$count"?>" value="<?=$pendering['join_id']?>"> Reject </button>
								</form>
								 <?php $_SESSION['count']=$count; ?>
							</li>
						</ul>
					</div>
				
		<?php 	$count++; 
				}
			?>


			<?php 
	        if($rows <= 0){ ?>
	            <p> No pending members. </p> <?php
	        }
	        else { ?>

	        	<?php
					pagination($id,$total_items,$lim,1,"approve_members.php?orgID=$orgid&id=%d"); 
				}  
				?>
	          
			</div>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	 <!-- </div>  -->
	</body>
</html>
