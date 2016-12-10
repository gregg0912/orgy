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

		header("Location: explore.php?searched=$searched");		//agent proxy pwning

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
<html lang="en">
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<style type="text/css">
			#content
				{
				border: 1px transparent; /*#a10115;*/
				border-radius: 0%;
				/*background: transparent;*/
				float: right;
				margin-right: 7%;
				padding: 3%;
				background: linear-gradient(-55deg, rgba(255, 0, 0, 0.0), rgba(255, 0, 0, 0.1), rgba(255, 0, 0, 0.2), rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.3), rgba(255, 0, 0, 0.2), rgba(255, 0, 0, 0.1), rgba(255, 0, 0, 0.0));
				/*background-color: rgba(255, 0, 0, 0.1);*/
				}

			#group_selection > ul > li > img
				{
				height: 50%;
				width: 70%;
				padding: 15%;
				}

			#group_selection > ul > li:hover
				{
				/*background-color: white;*/
				background: radial-gradient(circle, rgba(255, 255, 255, 0.0), rgba(255, 255, 255, 0.0), rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.8));
				border-color: white;
				}

			#group_selection > ul > li
				{
				background-color: rgba(100, 0, 0, 0.1);
				transition: 0.1s ease-in-out;
				/*border-color: #2A363B;*/
				}

			#group_selection > ul
				{
				/*margin-top: 0%;*/
				}

			#group_selection > ul > label
				{
				font-size: 150%;
				color: white;
				float: right;
				width: 50%;
				margin-left: 110%;
				padding-bottom: 1%;
				margin-right: -3%;
				opacity: 0.8;
				}
			#group_selection > ul > li > a
				{
				text-decoration: none;
				color: #a10115;/*white; #a10115;*/
				padding: 2%;
				margin-left: 0px;
				margin-right: -5px;
				border: 1px solid #a10115;
				/*background-color: transparent;*/
				transition: 0.2s ease-in-out;
				}

			#group_selection > ul > li > a:hover
				{
				/*background-color: #FECEAB;	
				border-color: #2A363B;*/
				}

            #pagination{
                margin-left: 0;
                padding: 5px;
                /*clear: both;*/
                float: right;
                top: 55%;
                left: 50%;
                /*font-family: "Arial";*/
                font-family: 'Arial', sans-serif;
                font-size: 99%;
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
    
        </style>


       <!--  <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
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
		<div id="group_selection">
			<ul>
				<label>discover organizations</label>
				<div class="dropdown">
					<?php
						$t_id = $_GET['org_type'];
						$filter_query = "SELECT type_name FROM org_type WHERE type_id='$t_id'";
						$f_result = mysqli_query($connectdb, $filter_query);
						$f_row = mysqli_fetch_assoc($f_result);
						$f_name = $f_row['type_name'];
						?>
						
					<button class="dropbtn"> <?php if(!isset($_POST["searchbtn"])){
						echo $f_name;
					}else{
					 echo "All";}?> <!-- Filter --></button>
					 <div class="dropdown-content">
						 <ul>
						 <?php while($rows = mysqli_fetch_array($filterlist)){?>
								<a href="explore.php?org_type=<?php echo $rows['type_id']?>"
						<?php		if($rows['type_id'] === $org_type){ ?>
									style="background-color:#a10115; color: white"
						<?php		} ?>
								><?=$rows['type_name']?></a>
							<?php } ?>
						</ul>
					 </div>
				</div>
				<form method="post">
		            <li><input id="searchbar" type="search" name="search" placeholder="Search Orgs"><button name="searchbtn">GO</button></li>
		        </form>
		        <label style="color: black;clear:both;"><?php echo "No of orgs: "; echo "$countRows";?></label>
				<?php 
				if($total>=1){
					while($orgs = mysqli_fetch_array($result)){//while($rows = mysqli_fetch_array($dbconn)){//while($rows = mysqli_fetch_array($result)){?>
						<li>
							<label style="font-size: 130%; padding: 1%; text-align: center;"><?=elipse($orgs['org_name'])?></label>
							<img onerror="this.src = '../images/janina.PNG'" id="image" src="../images/<?php echo $orgs['photo'] ?>">
							<a href="add.php?org_id=<?php echo $orgs['org_id']?>" class="add">Add Org</a>
							<a href="view.php?org_id=<?php echo $orgs['org_id']?>&org_type=<?php echo $org_type?>&id=<?=$id?>" class="view">View Org</a>
						</li>
					<?php }
					if(isset($_GET['searched'])){
						pagination($id,$total_items,$lim,1,"explore.php?searched=".$_GET['searched']."&id=%d");
					}
					else{
					pagination($id,$total_items,$lim,1,"explore.php?org_type=$org_type&id=%d");   
					}
				}else{
				?>
					<p>No match found!</p>
				<?php
				}
				?>

		</div> 
        <footer>CMSC 128 Section 1 | 2016</footer>
	</div> 
</div>
</body>
</html>