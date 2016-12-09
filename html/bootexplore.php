
<?php
	session_start();
	include ("functions.php");
	redirect();
    $dbconn = connection();
	$filterQuery = "SELECT * from org_type";
	/*$dbconn = mysqli_connect($host, $username, $password) or die ("Cannot connect to Database");*/
	$filterlist = mysqli_query($dbconn, $filterQuery);
	/*$org_type = $_GET['id'];*/

	// echo  $_SESSION['user_id'];


	if(!empty($_GET['org_type'])){}
	else
		{$_GET['org_type'] = 14;}
	
	$org_type = $_GET['org_type'];
	//$query = "select orgs.org_id, orgs.org_name, orgs.photo from orgs";
	
	if(isset($_GET['searched'])){
		$search = $_GET['searched'];
		$search_var = "%".$search."%";
		//$org_type = "14";
		$query = "SELECT * FROM orgs as o2, classification, org_type where o2.org_id not in (select o1.org_id from joined as j1, orgs as o1 where j1.user_id ='{$_SESSION['user_id']}' and j1.org_id= o1.org_id) AND o2.org_id=classification.org_id AND org_type.type_id=classification.type_id AND o2.org_name like '$search_var' group by o2.org_id";
		$result = mysqli_query($dbconn, $query);
	}

	else if($org_type == "14"&&!isset($_GET['searched'])){//9 is the id of "all in the filter"
		$query = "SELECT * FROM orgs WHERE orgs.org_id NOT IN (SELECT o1.org_id FROM joined AS j1, orgs AS o1 WHERE j1.user_id = $_SESSION[user_id] AND j1.org_id = o1.org_id)";
		$result = mysqli_query($dbconn, $query);

	}
	
	else if ($org_type != null&&!isset($_GET['searched'])){
		$query = "SELECT * FROM orgs as o2, classification, org_type where o2.org_id not in (select o1.org_id from joined as j1, orgs as o1 where j1.user_id =$_SESSION[user_id] and j1.org_id= o1.org_id) AND o2.org_id=classification.org_id AND org_type.type_id=classification.type_id AND org_type.type_id = '$org_type';";
			$result = mysqli_query($dbconn, $query);

	}
	if(isset($_POST["searchbtn"])){
		$searched = $_POST["search"];
		$org_type = "14";
		$query = "SELECT * FROM orgs as o2, classification, org_type where o2.org_id not in (select o1.org_id from joined as j1, orgs as o1 where j1.user_id =$_SESSION[user_id] and j1.org_id= o1.org_id) AND o2.org_id=classification.org_id AND org_type.type_id=classification.type_id AND o2.org_name like '%$searched%' group by o2.org_id";
		$id = 1;
		$result = mysqli_query($dbconn, $query);

		header("Location: bootexplore.php?searched=$searched");		//agent proxy pwning

	}

	
	

	$total_items = mysqli_num_rows($result);
	$rows = mysqli_affected_rows($dbconn);
	$countRows = $rows;

	//------------------------------------------------------
	$start=0;
    $lim=6;

            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $start=($id-1)*$lim;
            }
            else{
                $id=1;
            } 
      $total=ceil($rows/$lim);
      $result = mysqli_query($dbconn, "SELECT * FROM orgs LIMIT $start, $lim");

      if(isset($_GET['searched'])){
		$search = $_GET['searched'];
		$search_var = "%".$search."%";
		//$org_type = "14";
		$query = "SELECT * FROM orgs as o2, classification, org_type where o2.org_id not in (select o1.org_id from joined as j1, orgs as o1 where j1.user_id ='{$_SESSION['user_id']}' and j1.org_id= o1.org_id) AND o2.org_id=classification.org_id AND org_type.type_id=classification.type_id AND o2.org_name like '$search_var' group by o2.org_id LIMIT $start, $lim";

		//$query = "SELECT * FROM orgs where org_name like '$search_var'";

		$result = mysqli_query($dbconn, $query);	
	}

      if($org_type == "14" &&!isset($_GET['searched'])){//9 is the id of "all in the filter"
		//$query = "SELECT * FROM orgs";
		$result = mysqli_query($dbconn, "SELECT * FROM orgs as o2 where o2.org_id not in (select o1.org_id from joined as j1, orgs as o1 where j1.user_id =$_SESSION[user_id] and j1.org_id= o1.org_id) LIMIT $start, $lim");
		}
	
	   else if ($org_type != null &&!isset($_GET['searched']))
	   		{
			$query = "SELECT * FROM orgs as o2, classification, org_type where o2.org_id not in (select o1.org_id from joined as j1, orgs as o1 where j1.user_id =$_SESSION[user_id] and j1.org_id= o1.org_id) AND o2.org_id=classification.org_id AND org_type.type_id=classification.type_id AND org_type.type_id = '$org_type' LIMIT $start, $lim";
			$result = mysqli_query($dbconn, $query);
			}
			if(isset($_POST["searchbtn"])){
				$searched = $_POST["search"];
				$org_type = "14";
				$query = "SELECT * FROM orgs as o2, classification, org_type where o2.org_id not in (select o1.org_id from joined as j1, orgs as o1 where j1.user_id =$_SESSION[user_id] and j1.org_id= o1.org_id) AND o2.org_id=classification.org_id AND org_type.type_id=classification.type_id AND o2.org_name like '%$searched%' group by o2.org_id LIMIT $start, $lim";
		$result = mysqli_query($dbconn, $query);
	}


       //-----------------------------------------------
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>ORG SYSTEM A.Y. 2016-2017</title>
	
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css">
	<style type="text/css">


	.jumbotron, #content >.container{
		background: #eaeaea;
		width: 72%;
		margin-left: 24%;
		/*margin-top: -0.5%;*/
		padding: 5%;
	}
		
	
/*--------DROPDOWN MENU FOR FILTERS / FOR EXPLORE ONLY------*/
		#filtBtn{
			background: #af484e;
			border: 1px #af484e;
		}

		#dropFilter{
			margin-top: 5%; 
		}
		.dropdown-menu.dropFilt{
			transition: 0.2s ease-in-out;
			margin-left: auto;
			margin-top: auto;
			position: absolute;
			height: 15%;
			
		}
		.dropdown-menu.dropFilt > ul{
			width: none;
			
		}

		.dropdown-menu.dropFilt ul > a{
		    color: #a10115;
		   margin-left: -30%;
		   margin-top: -3%;
		    padding: auto;
		    text-decoration: none;
		    border: 1px solid #a10115;
			width: auto;
			height: 100%;
			 font-size: 110%;
			 transition: 0.1s ease-in-out;
		}
		form.search{
			display: flex;
			width: 60%;
			margin: auto;
		}

/*-----------------------------------------------------------*/

		#image{
			border-radius: 50%;
			height: 100%;
			width: 100%;
			margin: auto;
		}

/*----- GROUPS INSIDE JUMBOTRON-----------*/

	#allOrgs > li{
		list-style-type: none;
		height: 300px;
		width: 31.5%;
		margin-top: 5%;
		margin-right: 6px;
		margin-left: 8px;
		border: 1px solid #a10115;
		text-align: center;
		display: block;
		float: left;
		background-color: transparent;/*white;*/
	}

	#allOrgs > li > label{
		text-align: center;
		margin-left: auto;
		font-size: 150%;
		display: block;
		text-shadow: none;
		/*height: 270px;*/
		width: 250px;
		color: #a10115;
		margin: 0px;
		font-size: 25px;
		
	}

	#allOrgs > li > img{
		padding: 3%;
		/*height: 200px;
		width: 200px;*/
		display: block;
		/*margin: 5px;*/
		margin-top: 15%;
		margin-bottom: 7%;
	}

	#allOrgs > li:hover
	{
	/*background-color: white;*/
	background: radial-gradient(circle, rgba(255, 255, 255, 0.0), rgba(255, 255, 255, 0.0), rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.8));
	border-color: white;
	}

	#allOrgs > li > a{
		text-decoration: none;
		color: #a10115;/*white; #a10115;*/
		padding: 2%;
		margin-left: 0px;
		margin-right: -5px;
		border: 1px solid #a10115;
		/*background-color: transparent;*/
		transition: 0.2s ease-in-out;
	}

	#allOrgs > li > a:hover{
		color: #a10115;/*white; #a10115;*/
		background: #af484e;
		/*padding: 2%;
		margin-left: 0px;
		margin-right: -5px;
		border: 1px solid #a10115;
		/*background-color: transparent;*/
		transition: 0.2s ease-in-out;
	}
/*--------------------------------------------*/


	#pagination{
		margin-left: 20%;
		margin-top: 6.5%;
		margin-bottom: auto;
		
	}
	#pagination li{
		display: inline-block;
	}

	footer{
		position: relative;
		text-align: center;
		margin-top: 10%;
		background: #eaeaea;
		width: 100%;
		padding: 1%;
		
	}


   
        </style>
 
</head>
<body>

<div class = "container">	
	
		<div id="wrapper">
		    <nav id="general" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		        <ul class="nav nav-pills nav-stacked" id="navigation" >
		            <?php 
		            $current_id = $_SESSION['user_id'];
		            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
		            while($current_user= mysqli_fetch_array($query2)){ ?>
		            <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
		            <li><img id = "prof_pic" src="../images/<?php echo $current_user['prof_pic'] ?>"/></li><?php } ?>
		            <li><a href="home.php">Home</a></li>
		            <li><a href="bootexplore.php">Explore</a></li>
		            <li class="dropdown"  id="dropFilter">
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
			<div id="group_selection">
					<div class="page-header">
						<label>Discover Organizations</label>
					</div>
				<div class="container">
					<div class="dropdown" id="dropFilter">
					<?php
						$t_id = $_GET['org_type'];
						$filter_query = "SELECT type_name FROM org_type WHERE type_id='$t_id'";
						$f_result = mysqli_query($connectdb, $filter_query);
						$f_row = mysqli_fetch_assoc($f_result);
						$f_name = $f_row['type_name'];
						?>

					<button class=" btn btn-primary dropdown-toggle btn-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <?php if(!isset($_POST["searchbtn"])){
						echo $f_name;
					}else{
					 echo "All";}?> <span class="caret"></span></button>
					 <div class="dropdown-menu dropFilt" id="dropMenuFilter">
						 <ul>
						 <?php while($rows = mysqli_fetch_array($filterlist)){?>
								<a href="bootexplore.php?org_type=<?php echo $rows['type_id']?>"
						<?php		if($rows['type_id'] === $org_type){ ?>
									style="background-color:#a10115; color: white"
						<?php		} ?>
								><?=$rows['type_name']?></a>
							<?php } ?>
						</ul>
					 </div>
				</div>
				<form method="post" class="search form-group">
		            <input id="searchbar" class="form-control" type="search" name="search" placeholder="Search Orgs">
		            <button name="searchbtn" class="btn btn-primary btn-md">GO</button>
		        </form>				

				</div>		

				<div id="allOrgs">
					
					<?php while($orgs = mysqli_fetch_array($result)){//while($rows = mysqli_fetch_array($dbconn)){//while($rows = mysqli_fetch_array($result)){?>
						<li>
							<label style="font-size: 130%; padding: 1%; text-align: center;"><?=elipse($orgs['org_name'])?></label>
							<img id="image" style="height: 170px; width: 170px; object-fit: cover; object-position: center;"  src="../images/<?php echo $orgs['photo'] ?>" onerror = "this.src = '../images/zeke.jpg'">
							<a href="add.php?org_id=<?php echo $orgs['org_id']?>" class="add">Add Org</a>
							<a href="view.php?org_id=<?php echo $orgs['org_id']?>&org_type=<?php echo $org_type?>&id=<?=$id?>" class="view">View Org</a>
						</li>
					<?php }?>
				</div>
			</div>
		</div>

	
	<div class="container">

		<div id="page-nav">
	            <?php 
				if($total>=1){
					while($orgs = mysqli_fetch_array($result)){?>
			<nav>
			<ul id="pagination" class="pagination">
						<li>
							<label style="font-size: 130%; padding: 1%; text-align: center;"><?=elipse($orgs['org_name'])?></label>
							<img id="image" src="../images/<?php echo $orgs['photo'] ?>">
							<a href="add.php?org_id=<?php echo $orgs['org_id']?>" class="add">Add Org</a>
							<a href="view.php?org_id=<?php echo $orgs['org_id']?>&org_type=<?php echo $org_type?>&id=<?=$id?>" class="view">View Org</a>
						</li>
					<?php }
					pagination($id,$total_items,$lim,1,"bootexplore.php?org_type=$org_type&id=%d");   
				}else{
				?>
					<p>No match found!</p>
				<?php
				}
				?>
	        </ul>
			</nav>
		</div>	

		<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"</script>	
	</body>
</html>