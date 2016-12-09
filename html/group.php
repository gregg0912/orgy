
<?php 
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = 'org_y';
	$dbcon = mysqli_connect($host,$username,$password, $db) or die("Could not connect to database!");


	$query = "SELECT Org_Name FROM org join member join joined, WHERE 'member.member_id' = 'joined.member_id' and 'org.org_id = joined.org_id'";

	$result = mysqli_query($dbcon, $query);

	$orgname = mysqli_fetch_array($result); 

	echo $result;
?>


<!DOCTYPE html>
<html>
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<style type="text/css">
	
/*	#group_nav > ul{
		margin-left: 25%;
	}*/

	/*label{
		text-align: center;
		color: white;	
	}*/
#content > #group_list > h2{
		color: #740000;
		font-weight: normal;
		line-height: 48px;
		background-color: #eaeaea;
		border: 1px solid #cfbea9;
		border-radius: 34px 34px 34px 34px;
		width: 100%;
	  -moz-border-radius: 34px 34px 34px 34px;
	  -webkit-border-radius: 34px 34px 34px 34px;
	  font-family: amazingInfographic;
		font-size: 50px;
		margin: auto 0 20px 0;
		text-align: center;
	}
	/*Linc, gin copy ko yung nasa baba sa style.css para easy i-edit hahaha - Hanweh*/
/*	#content > 	#group_list > #see_group > ul > li > a{
		display: block;
		margin-left: 0 auto;
		margin-right: 0 auto;
	}

	#content > 	#group_list > #see_group > ul > li > label{
		display: inline-block;
		margin-left: auto;
		margin-right: auto;
	}	

	#group_list > #see_group > a {
		   background: #c4352a;
	    padding: .7em 1em;
	    float: left;
	    text-decoration: none;
	    color: white;
	    text-shadow: 0 1px 0 rgba(255,255,255,.5);
	    position: relative;
	}*/
</style>
<body>
<div id="wrapper">
	<nav id="general">
		<ul id="navigation">
			<li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
			<li><img src="../images/image.jpg"/></li>
			<li><input type="search" name="search" placeholder="Search For Your Orgs Here..."></li>
			<li><a href="home.html">Home</a></li>
			<li><a href="explore.html">Explore</a></li>
			<li><a href="groups.html" class="active">Groups</a></li>
			<li><a href="edit.html">Edit Profile</a></li>
			<li><a href="notif.php">Notifications   |  
				  <?php
            $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
            $total = mysqli_num_rows($notifnum);
            echo "$total"
            ?>
          </a></li>
			<li><a href="login.html">Log Out</a></li>
		</ul>
	</nav>
	<div id="content">
		<div id="group_list">
			<h2>ORGS JOINED</h2>
			<ul id="see_group">
			<ul>
				<li>
					<label>Elektrons</label>
					<img id="image" src="../images/elek.jpg"/>
					<a href="group_page_e.html">Elektrons</a>
				</li>
				<li>
					<label>Komsai.Org</label>
					<img id="image" src="../images/komsai.jpg"/>
					<a href="group_page_k.html">Komsai.Org</a>
				</li>
				<li>
					<label>UP Akeanon</label>
					<img id="image" src="../images/janina.PNG"/>
					<a href="group_page_a.html">UP Akeanon</a>
				</li>
			</ul>
		</div>
		<div id="pagee">
			<ul id="pagination">
				<li><a href="#">&laquo;</a></li>
				<li><a class="active" href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</div>
	</div>
	<footer>CMSC 128 Section 1 | 2016</footer>
</div>
</body>
</html>