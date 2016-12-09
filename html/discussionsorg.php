<?php
	include('connect.php');
	session_start();

	/*if(!isset($_SESSION['username']))
    {   
    	header("Location:signup.php");
    }*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<style type="text/css">
	body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
	div#pagination_controls{font-size:21px;}
	div#pagination_controls > a{ color:#06F; }
	div#pagination_controls > a:visited{ color:#06F; }
</style>
<body>
	<div id="wrapper">
		<nav id="general">
			<ul id="navigation">
				<li>USERNAME</li>
				<li><img src="../images/image.jpg"/></li>
				<li><input type="search" name="search" placeholder="Search For Your Orgs Here..."></li>
				<li><a href="home.html">                 Home</a></li>
				<li><a href="explore.html">              Explore</a></li>
				<li><a href="groups.html" class="active">Groups</a></li>
				<li><a href="edit.html">                 Edit Profile</a></li>
				<li><a href="notif.html">				 Notifications</a></li>
				<li><a href="login.html">                Log Out</a></li>
			</ul>
		</nav>
		<div id="content">
			<nav id="group_nav">
				<div id="forbread">
					<h2>ORGS JOINED</h2>
					<ul id="breadcrumbs">
						<li><a href="group_page_e.html">Elektrons</a></li>
						<li><a href="group_page_k.html">Komsai.Org</a></li>
						<li><a href="group_page_a.html">UP Akeanon</a></li>
					</ul>
				</div>
			</nav>
		<div id="discussions">
			<h2>Discussions</h2>

			<?php
			if(isset($_GET['org_id']))
			{ 
				echo "Org id ".$_GET['org_id'].'<br/>'; 
				$org_id = $_GET['org_id']; 
				
				$sql = "SELECT COUNT(disc_id) FROM discuss WHERE org_id = $org_id";
				$query = mysqli_query($dbconn, $sql);
				$row = mysqli_fetch_row($query);

				$rows = $row[0];

				$page_rows = 10;
				

				$last = ceil($rows/$page_rows);

				if($last < 1)
				{
					$last = 1;
				}

				$pagenum = 1;
				
				if(isset($_GET['pn']))
				{
					$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
				}

				if ($pagenum < 1) 
				{ 
					$pagenum = 1; 
				} 
				else if ($pagenum > $last) 
				{ 
					$pagenum = $last; 
				}

				$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				
				$sql = "SELECT * FROM discuss natural join user natural join orgs WHERE org_id = $org_id ORDER BY disc_id ASC $limit";
				$query = mysqli_query($dbconn, $sql);

				$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

				$paginationCtrls = '';
				
				if($last != 1)
				{
					if ($pagenum > 1) 
					{
						$previous = $pagenum - 1;
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
					
						for($i = $pagenum-4; $i < $pagenum; $i++)
						{
							if($i > 0)
							{
								$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&pn='.$i.'">'.$i.'</a> &nbsp; ';
							}
						}
					}
					
					$paginationCtrls .= ''.$pagenum.' &nbsp; ';
					
					for($i = $pagenum+1; $i <= $last; $i++)
					{
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&pn='.$i.'">'.$i.'</a> &nbsp; ';
						if($i >= $pagenum+4)
						{
							break;
						}
					}
					
					if ($pagenum != $last) 
					{
						$next = $pagenum + 1;
						$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&pn='.$next.'">Next</a> ';
					}
				}

				
				while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
				{
					$disc_id = $row["disc_id"];
					$content = $row["content"];
					$username = $row["username"];
					$org_name = $row["org_name"];
					$title = $row["title"];
					$date_posted = $row["date_posted"];
					$date_posted = strftime("%b %d, %Y", strtotime($date_posted));

					echo	"<hr>
							$disc_id
							<a href = 'comments.php?org_id=$org_id&disc_id=$disc_id' <h4>Title: $title</h4> </a>
							<h5>Content: $content</h5>
							<h6>Posted by: $username || Date: $date_posted || Org: $org_name</h6>
							<hr>";
				}

			}

			else
			{
				echo "<h4>Error, does not exist.</h4>";
			}

			?>
			
			<div>
				<p><?php echo $textline2; ?></p>
				<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
			</div>

			<form method="POST" >
				<fieldset>
					<legend>Start A New Discussion:</legend>
					<label for="topicname">Topic:</label>
					<input type="text" name="topicname" id="topicname"/>
					<label>Contents:</label>
					<textarea id="discussion_text" name="discussion_text" style="margin: 0px; height:100px; width:100%;"></textarea>
					<div id="PostButton">
						<input type="submit" name="submit" value="Post">
					</div>
				</fieldset>
			</form>
			<?php
				if(isset($_POST['submit']))
				{
					if($_POST['topicname'] != "" && $_POST['discussion_text'] != "")
					{
						$title = $_POST['topicname'];
						$body = $_POST['discussion_text'];
						//$sql_store = "INSERT into discuss (disc_id, title, content, approval, date_posted, user_id, org_id) values(NULL, '$topicname', '$discussion_text', NULL, CURDATE(), 1, $org_id)";
						//$sql = mysqli_query($dbconn, $sql_store) or die(mysql_error());
						$today=date("Y/m/d");
						$result = mysqli_query($dbconn, "INSERT INTO `discuss`(`disc_id`, `title`, `content`, `approval`, `date_posted`, `user_id`, `org_id`) VALUES (NULL,'$title','$body','approve','$today','1','$org_id');");
         				echo "<meta http-equiv='refresh' content='0'>";
						
					}
					else
					{
						echo "Error";
					}
				}
			?>
			<p>No other discussions yet.</p>
		</div>
</div>
	<footer>CMSC 128 Section 1 | 2016</footer>
</div>
</body>
</html>