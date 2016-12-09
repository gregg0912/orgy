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
				transition: background-color .3s;
			}
			#pagination > li a.current{
				background-color: #a10115;
				color: white;
			}
			#pagination > li a:hover:not(.current){
				background-color: #FF847C;
			}
			ul{
				list-style: none;
				float: left;
				margin-left: 2%;
				top: 50px;
			}
			#content
			{
				border: 1px transparent; /*#a10115;*/
				border-radius: 0%;
				/*background: transparent;*/
				float: right;
				margin-top: -50%;	
				margin-right: 7%;
				padding: 3%;
				background: linear-gradient(-55deg, rgba(255, 0, 0, 0.0), rgba(255, 0, 0, 0.1), rgba(255, 0, 0, 0.2), rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.2), rgba(255, 0, 0, 0.1), rgba(255, 0, 0, 0.0));
			}

			#see_group{
				width: 25%;
				height: 50%;
				
			}
			#see_group > ul > li {
				text-decoration: none;
				color: #a10115;/*white; #a10115;*/
				padding: 2%;
				transition: 0.2s ease-in-out;
				margin-left: -20%;
				margin-right: 1%;
			}

			#see_group > li > label {
				text-align:center;
				text-shadow: none;
				color: #a10115;
				margin:auto;
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
				
					while($result = mysqli_fetch_assoc($check_result)){
							$member = $result['membership_type'];
					}
			?>				
		<!-- Agent Proxy -->
			<h2>CURRENT MEMBERS</h2>
			<a href="group_page.php?orgID=<?= $orgid ?>" id="grppage" class="btn btn-1 btn-1a" style="color: black;">Group Page</a><br>			
			<?php
				$query_penders = "select * from user,joined where user.user_id=joined.user_id and joined.org_id=$orgid and (joined.membership_type='member' or joined.membership_type='admin') order by membership_type desc limit $start,$lim";
				$penders = mysqli_query($connectdb,$query_penders);
				$count=0;
				while($pendering=mysqli_fetch_assoc($penders)){ ?>
					<div id="group_list">
						<ul id="see_group">
							<li>
								<label style="font-size: 130%; padding: 1%; text-align: center; margin-left: 20%"><?=elipse($pendering['username'])?></label>
								<img id="image" src="<?=$pendering['prof_pic']?>" >
								<label style="font-size: 130%; padding: 1%; text-align: center; margin-left: 30%"><?=elipse($pendering['membership_type'])?></label>
								<form method="post">
								<button name="<?='View'."$count"?>" class="btn btn-1 btn-1a" value="<?=$pendering['user_id']?>"> View Profile </button>
								<?php if($member=='admin' && $_SESSION['user_id']!=$pendering['user_id']){?>
								<!-- <button name="<?='Kick'."$count"?>" class="btn btn-1 btn-1a" value="<?=$pendering['join_id']?>">
								</button> -->
								<a class="btn btn-1 btn-1a" href="delete_member.php?ID=<?= $pendering['join_id'] ?>&ORGID=<?=$orgid?>" onClick= "uSure(); return false;"> Kick </a> 
			
								<script type="text/javascript">
									function uSure() {
									    var x = confirm("<?= "Do you really want to kick " . $pendering['username'] . "? "?>");
									    if (x == true){
									    	
									        window.location.href = 'delete_member.php?ID=<?= $pendering['join_id'] ?>&ORGID=<?=$orgid?>';
									    } 
									    else{
									    	// window.location.href = "home.php"
									    }
									}
								</script>


								<?php } ?>
								</form>
								 <?php $_SESSION['count']=$count; ?>
							</li>
						</ul>
					</div>	
				<?php 	
					$count++; 
				}
				?>
				<?php 
		        if($rows <= 0){ ?>
		            <p> No pending members. </p> <?php
		        }
		        else { ?>
			        <?php
						pagination($id,$total_items,$lim,1,"org_members.php?orgID=$orgid&id=%d");
					}  
					?>
			</div>
		</div>  
		<footer>CMSC 128 Section 1 | 2016</footer>
<!-- </div> -->
	</body>
</html>

