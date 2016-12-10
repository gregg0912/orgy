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
	 $query1 = mysqli_query($connectdb, "select * from joined where org_id = $orgid and membership_type ='pending' ");
	 $result = mysqli_num_rows($query1);
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
				background: gray;
				width: 72%;
				margin-left: 24%;
				
				
	
			}
			#groups_joined > li > label{
				font-family: 'Arca Majora 3 Bold', sans-serif;
				text-align:center;
				text-shadow: none;
				height: 50px;
				width: 100%;
				margin: 2%;
				font-size: 25px;

			}
			#groups_joined {
				list-style-type: none;
			
			}
			#groups_joined > label {
				text-shadow: none;
				/*text-align: left;*/
				color: #a10115;
				margin-left: 0%;
				font-size: 150%;
				clear: right;
				width: 100%;
			}
			#groups_joined li{
				height: 300px;
				width: 31.5%;
				margin-top: 3%;
				margin-right: 1%;
				margin-left: 0.5%;
				margin-bottom: 20px;
				text-align: center;
				display: inline-block;
				float: left;
				background-color: transparent;
				border: 2px solid #ff847c;

				
			}

		/*	#announcements{
				height: auto;
			}

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
			
				width: 31.5%;
				margin-top: 3%;
				margin-right: 0.5%;
				margin-left: 0.5%;
				margin-bottom: 20px;
				text-align: center;
				display: block;
				float: none;
				background-color: transparent;
				border: 2px solid #ff847c;
			}
*/


			#image{
				height: 148px; 
				width: 170px;
				margin-left: 0;
				margin-bottom: 13%;
			}
			#grppage{
				margin: 1%;
			

			}
			#pagination{
				margin-left: 20%;
				margin-top: 0;
				margin-bottom: -4%;
				
			}
/*			footer{
				position: relative;
				text-align: center;
				margin-top: 10%;
				background: #eaeaea;
				width: 100%;
				padding: 1%;
				margin-bottom: -18%;
		
			}*/

			
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
		            <li><input id="searchbar" type="search" name="search" placeholder="Search Orgs"></li>
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
	<div id="demGroups" class="container">
			<div class="page-header">
				<h2>PENDING MEMBERS</h2>	
			</div>
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
			<a href="bootgroup_page.php?orgID=<?= $orgid ?>" id="grppage" class="btn btn-primary btn-md">Group Page</a>	
		<!-- <div id="group_list"> -->
		<div class="container">
				<ul id="groups_joined">
			
			<?php
				$query_penders = "select * from user,joined where user.user_id=joined.user_id and joined.org_id=$orgid and joined.membership_type='pending' limit $start,$lim";
				$penders = mysqli_query($connectdb,$query_penders);
				$count=0;
				while($pendering=mysqli_fetch_assoc($penders)){ ?>

							<li>
								<label><?=elipse($pendering['username'])?></label>
								<img style="height: 170px; width: 170px; object-fit: cover; object-position: center;" id="image" src="<?=$pendering['prof_pic']?>" >
								<form method="post">
								<button class="btn btn-danger btn-md" name="<?='Accept'."$count"?>" value="<?=$pendering['join_id']?>"> Accept </button>
								<button class="btn btn-danger btn-md" name="<?='Reject'."$count"?>" value="<?=$pendering['join_id']?>"> Reject </button>
								</form>
								 <?php $_SESSION['count']=$count; ?>
							</li>
			<!-- </div> -->
		<?php 	$count++; 
				}
			?>
						</ul>
		</div>
	</div>	


			<?php 
	        if($rows <= 0){ ?>
	            <p> No pending members. </p> <?php
	        }
	        else { ?>
	<div class="container">	        
	    <div id="page-nav">
	        <nav>	
	            <ul id="pagination" class="pagination">
	            <?php
	            if($total!= 1){
	                    if($id>1){
	                        ?>
	                        <li><a href="?orgID=<?= $orgid ?>&id=<?php echo ($id-1)?>">&laquo;</a></li>
	                    <?php }
	                    for($i=1; $i<=$total; $i++){
	                        if($i==$id){ ?>
	                            <li><a class="current" href="?orgID=<?= $orgid ?>&id=<?php echo $i?>"><?=$i?></a></li>
	                        <?php 
	                        }
	                        else{
	                        ?><li><a href="?orgID=<?= $orgid ?>&id=<?php echo $i?>"><?=$i?></a></li>
	                        <?php 
	                        }
	                    }
	                    if($id!=$total){
	                    ?>
	                        <li><a href="?orgID=<?= $orgid ?>&id=<?php echo ($id+1)?>">&raquo;</a></li>
	                    <?php 
	                     }
	                }
	            }
	            ?>
        		</ul>
	        </nav>
			</div>
			
		<footer>CMSC 128 Section 1 | 2016</footer>
	</div>
</div>	  

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"</script>

	</body>
</html>

<!-- PWNED BY AGENT P 
	________________________________________________
	|											    |
	|				lick 	pussy})    

	_______________________________________|

-->