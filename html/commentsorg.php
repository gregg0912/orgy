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
				<li><a href="notif.php">Notifications   |  
				  <?php
            $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
            $total = mysqli_num_rows($notifnum);
            echo "$total"
            ?>
          </a></li>
				<li><a href="login.html">                Log Out</a></li>
			</ul>
		</nav>
		<div id="content">
			<nav id="group_nav">
				<div id="forbread">
					<h2>ORGS JOINED</h2>
					<ul id="breadcrumbs">
						<li><a href="group_page_e.html" class="active">Elektrons</a></li>
						<li><a href="group_page_k.html">               Komsai.Org</a></li>
						<li><a href="group_page_a.html">               UP Akeanon</a></li>
					</ul>
				</div>
			</nav>
		<div id="discussions">
			<h2>Discussions</h2>

			<?php
			if(isset($_GET['disc_id']))
			{
				echo "Disc id ".$_GET['disc_id'].'<br/>'; 
				$disc_id = $_GET['disc_id']; 
				echo "Org id ".$_GET['orgID'].'<br/>'; 
				$org_id = $_GET['orgID'];
				
				$sql = "SELECT COUNT(comment_id) FROM comments natural join discuss WHERE org_id = $org_id AND disc_id = $disc_id";
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
				
				$sql = "SELECT * FROM discuss natural join comments natural join user natural join orgs WHERE org_id = $org_id AND disc_id = $disc_id ORDER BY disc_id ASC $limit";
				$query = mysqli_query($dbconn, $sql);

				$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

				$paginationCtrls = '';
				
				if($last != 1)
				{
					if ($pagenum > 1) 
					{
						$previous = $pagenum - 1;
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&disc_id='.$disc_id.'&pn='.$previous.'">Previous</a> &nbsp; &nbsp; ';
					
						for($i = $pagenum-4; $i < $pagenum; $i++)
						{
							if($i > 0)
							{
								$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&disc_id='.$disc_id.'&pn='.$i.'">'.$i.'</a> &nbsp; ';
							}
						}
					}
					
					$paginationCtrls .= ''.$pagenum.' &nbsp; ';
					
					for($i = $pagenum+1; $i <= $last; $i++)
					{
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&disc_id='.$disc_id.'&pn='.$i.'">'.$i.'</a> &nbsp; ';
						if($i >= $pagenum+4)
						{
							break;
						}
					}
					
					if ($pagenum != $last) 
					{
						$next = $pagenum + 1;
						$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&disc_id='.$disc_id.'&pn='.$next.'">Next</a> ';
					}
				}

				
				while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
				{
					$commenter = $row["username"];
					$body = $row["body"];
					$date_c = $row["date_c"];
					$date_c = strftime("%b %d, %Y", strtotime($date_c));
	
					echo " <hr>
						   <h5>Comment by: $commenter</h4>
						   <h5>Message: $body</h5>
						   <h6>Date: $date_c</h6>
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

			<form method="POST">
	        	<fieldset style="border:0;">
					<label for="discussion_text">Contribute to the discussion</label>
					<textarea id="discussion_text" name = 'discussion_text' style="margin:0px; height:100px; width:100%;"></textarea>
						<div id="PostButton">
							<input type="submit" name="submit" value="Post">
						</div>
				</fieldset>
	        </form>

	        <?php
				if(isset($_POST['submit']))
				{
					if($_POST['discussion_text'] != "")
					{
						$body = $_POST['discussion_text'];
						
						$today=date("Y/m/d");
						 $result = mysqli_query($dbconn,"INSERT INTO `comments` (`comment_id`, `body`, `date_c`, `disc_id`) VALUES (NULL, '$body', '$today', '$disc_id');");
          				echo "<meta http-equiv='refresh' content='0'>";
						
					}
					else
					{
						echo "Error";
					}
				}
			?>
	
		</div>
</div>
	<footer>CMSC 128 Section 1 | 2016</footer>
</div>
</body>
</html>