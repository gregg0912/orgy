<?php
	//include('connect.php');
	session_start();
	include('functions.php');
	$dbconn = connection();
	$connectdb = connection();
	/*if(!isset($_SESSION['username']))
    {   
    	header("Location:signup.php");
    }*/

    $user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" type="text/css" href="../css/comments.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css">
</head>
<style type="text/css">
	body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
	div#pagination_controls{font-size:21px;}
	div#pagination_controls > a{ color:#06F; }
	div#pagination_controls > a:visited{ color:#06F; }
</style>
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
			<div id="discussions">
				<?php
					$get_topic="SELECT * FROM discuss, user WHERE discuss.disc_id='$_GET[disc_id]' AND discuss.user_id=user.user_id";
					$disc=mysqli_fetch_assoc(querySignUp($get_topic));
					$phpdate = strtotime( $disc['date_posted'] );
					$datec = date( 'F d, Y h:i:s a', $phpdate );
				?>
				<a href="discussions.php?orgID=<?=$_GET['org_id']?>"><button>Back </button></a>
				<h1 class='title'><?=$disc['title']?></h1>
				<div class='discussion'>
					<legend>
						<a class='user' href="viewprofile.php?user_id=<?=$disc['user_id']?>"><?=$disc['username']?></a>
						<span class="date"><?=$datec?></span>
					</legend>
					<dl>
						<dt><label>Message:</label></dt>
						<dt><p><?=nl2br($disc['content'])?></p></dt>
					</dl>
				</div>
				<form class='newtopic' method="post">
					<div class='newdiscussion'>
						<legend>Join the discussion!</legend>
						<textarea id="discussion_text" name = 'discussion_text' placeholder='Write a comment'></textarea>
						<input class="btn btn-1 btn-1a" type="submit" name="submit" value="Post">
		       		</div>
		        </form>

				<?php
				if(isset($_GET['disc_id']))
				{
					//echo "Disc id ".$_GET['disc_id'].'<br/>'; 
					$disc_id = $_GET['disc_id']; 
					//echo "Org id ".$_GET['org_id'].'<br/>'; 
					$org_id = $_GET['org_id']; //org_id to orgID
					
					$sql = "SELECT COUNT(comment_id) FROM comments WHERE comments.disc_id = $disc_id";
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
					
					/*$sql = "SELECT *
							FROM comments, discuss, user
							WHERE comments.disc_id = $disc_id
							AND comments.user_id = user.user_id $limit";*/

					$sql = "SELECT u.username, c.body, c.date_c, c.comment_id, u.user_id 
								FROM comments c 
								INNER JOIN user u on c.user_id = u.user_id 
								INNER JOIN discuss d on c.disc_id = d.disc_id 
									WHERE c.disc_id=$disc_id ORDER BY comment_id ASC $limit";
									
	//wait lang ha ga edit ako -jp 6:50pm
							   
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

					
					while($row = mysqli_fetch_assoc($query))
					{
						$commenter = $row["username"];
						$body = $row["body"];
						//$date_c = $row["date_c"];
						//$date_c = strftime("%b %d, %Y", strtotime($date_c));
						$comment_id = $row["comment_id"];
						// $commenter_id=$row["user_id"];
						$date_c = $row["date_c"];
						$phpdate = strtotime( $date_c );
						$datec = date( 'F d, Y h:i:s a', $phpdate );?>
						<div class='discussion'>
							<legend>
								<a class='user' href='viewprofile.php?user_id=<?=$row['user_id']?>'><?=$commenter?></a>
								<span class="date"><?=$datec?></span>
							</legend>
							<dl>
								<dt><label>Message:</label></dt>
								<dt><p><?=nl2br($body)?></p></dt>
							</dl>
						</div>
				<?php
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


		        <?php
		        	//echo "$body, $today, $disc_id, $user_id";
					if(isset($_POST['submit']))
					{
						if($_POST['discussion_text'] != "")
						{
							$body = $_POST['discussion_text'];
							



							//HEY! GAGANA ANG PAG ADD SA PHPMYADMID NA SQL TA NAGA INSERT NA BUT HINDI KO ALAM KUNG PAANO SILA I OUTPUT LAHAT SO YE ATLEAST NAG AADD NA SA DATABASE -jp
							


								$today = date('Y-m-d H:i:s');
							//$today=date("Y-m-d");

							$sql = "INSERT INTO `comments` (`comment_id`, `body`, `date_c`, `disc_id`, `user_id`) VALUES (NULL, '$body', '$today', '$disc_id', '$user_id')";

							   
							    $query = mysqli_query($dbconn, $sql);
							    header("Location: comments.php?org_id=".$_GET['org_id']."&sort_id=".$_GET['sort_id']."&disc_id=".$_GET['disc_id']);
								// echo "<script type='text/javascript'>alert('Reply posted')</script>";
							 
	       //    				echo "<meta http-equiv='refresh' content='0'>";
							
						}
						else
						{
							echo "<script type='text/javascript'>alert('Please input field')</script>";
						}
					}
				?>
		
			</div>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	</div>
</body>
</html>