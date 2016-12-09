<?php
	session_start();	
	include ("functions.php");
	$connectdb = connection();
	redirect();
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
		
		<style type="text/css">
			
			.jumbotron{
				background: #0000;
				width: 72%;
				margin-left: 24%;
				margin-top: -0.5%;
				padding: 5%;
				height: 90%;
			}

			.jumbotronwidth{
				max-width: 100%;
				width: 100%;
				height: 100%;
			}
			.page-header{
				color: #740000;
			    line-height: 100%;
			    background-color: rgba(249, 243, 243, 0.5);
			    font-size: 300%;
			    margin: auto;
			    text-align: center;
			    font-family: 'Arca Majora 3 Bold', sans-serif;
			    padding: 1%;
			}
			.btn{
				margin-top: -5%;
			}
			#prof_pic{
				border-radius: 50%;
				height: 250px;
				width: 250px;
				padding: 10%;
				margin: 2% 4%;

			}

			#image{
				width: 170px; 
				height: 170px; 
				object-position: center; 
				object-fit: cover; 
				margin: auto;
			}

/*			#see_group > li > a{
				text-align: center;
				text-decoration: none;
				padding: 2%;
				margin-left: 0px;
				margin-right: -5px;
				border: none;
				background: #e84a5f;
			    color: black;

			}*/
			#see_group > li > label{
				font-family: 'Arca Majora 3 Bold', sans-serif;
				text-align:center;
				text-shadow: none;
				height: 50px;
				width: 250px;
				margin: 2%;
				font-size: 25px;

			}
			#see_group {
				list-style-type: none;
				height: 100%;
			}
			#see_group > label {
				text-shadow: none;
				text-align: left;
				color: #a10115;
				margin-left: 0%;
				font-size: 150%;
				clear: right;
				width: 100%;
			}
			#see_group > li{
				height: 300px;
				/*padding-bottom: 8%;*/
				width: 31.5%;
				margin-top: 3%;
				margin-right: 0.5%;
				margin-left: 0.5%;
				margin-bottom: 20px;
				text-align: center;
				display: inline-block;
				float: left;
				background-color: transparent;
				border: 2px solid #ff847c;
			}

			#searchbar{
				margin-left: 10%;
				margin-right: 10%;
				text-align: center;
				width: 80%;
			}

			#pagination{
				margin-left: auto;
				margin-top: 6.5%;
				margin-bottom: -4%;
				position: all;
			}

			.pagination:active{
				background-color: #a10115;
				color: white;
			}
			.pagination > li a:hover:not(.active){
				background-color: white;
			}	

			footer{
				position: relative;
				text-align: center;
				margin-top: 10%;
				background: #eaeaea;
				width: 100%;
				padding: 1%;
				margin-bottom: -18%;
		
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
		    <nav id="general" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		        <ul class="nav nav-pills nav-stacked" id="navigation" >
		            <?php 
		            $current_id = $_SESSION['user_id'];
		            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
		            while($current_user= mysqli_fetch_array($query2)){ ?>
		            <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
		            <li><img id = "prof_pic" src="../images/<?php echo $current_user['prof_pic'] ?>"/></li><?php } ?>
		            <!-- <li><input id="searchbar" type="search" name="search" placeholder="Search Orgs"></li> -->
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
			<div class="container" id="content">
				<div id="group_list">
					<div class="page-header">			
						<h2>ORGS JOINED</h2>
					</div>

					<ul id="see_group">
						<?php
							$userid = $_SESSION['user_id'];
							$result = groupListQuery($userid,$start,$lim,$connectdb);
							if(mysqli_num_rows($result)!=0){
								while(list($orgid,$orgName, $photo,$memType)=mysqli_fetch_row($result)){
						?>
								<li>
								<label style="font-size: 130%; padding: 1%; text-align: center;"><?=elipse($orgName)?></label>
								<img id="image" src="<?=$photo?>">
								<label style="font-size: 100%;"><?=detMemType($memType)?></label>
								<?php
									if ($memType!="pending") {
									?>
									<a href="bootgroup_page.php?orgID=<?=$orgid?>"><?=elipse($orgName)?></a>
									<?php
									}else{
									?>
									<a href="cancel.php?orgID=<?=$orgid?>&id=<?=$id?>">Cancel Request</a>
									<?php
									}
								?>
							</li>
							<?php
								}
							?>
					<?php	}
							else{
								echo "<p>You still haven't joined an org yet! Try <a href='explore.php'>Exploring</a> a bit.</p>";
							}
						?>
					</ul>
				</div>
				<?php
				$query = "SELECT * FROM joined, orgs WHERE joined.user_id = $userid AND joined.org_id = orgs.org_id";
				$result = mysqli_query($connectdb,$query);
				$rows=mysqli_num_rows($result);
				$total=ceil($rows/$lim);
				if($total!=0){
				?>
	</div>
	<div class="container">
				<div id="page-nav">
					<nav>		
					<ul id="pagination" class="pagination">
					<?php
					if($id>1){
						?>
						<li><a aria-label = "Previous" href="?id=<?php echo ($id-1)?>"><span aria-hidden="true">&laquo;</span></a></li>
					<?php }
					for($i=1; $i<=$total; $i++){
						if($i==$id){ ?>
							<li><a class="current" href="?id=<?php echo $i?>"><?=$i?></a></li>
						<?php 
						}
						else{
						?><li><a href="?id=<?php echo $i?>"><?=$i?></a></li>
						<?php 
						}
					}
					if($id!=$total){
					?>
						<li><a aria-label="Next" href="?id=<?php echo ($id+1)?>"><span aria-hidden="true">&raquo;</span></a></li>
					<?php 
					 }
					?>
					</ul>
					</nav>
				</div>
				<?php
				}
				?>
				<footer>CMSC 128 Section 1 | 2016</footer>
			</div>
		</div>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"</script>
	</body>


</html>