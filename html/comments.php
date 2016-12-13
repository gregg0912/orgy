<?php
	//include('connect.php');
	session_start();
	include('functions.php');
	$dbconn = connection();
	$connectdb = connection();
	redirect();
    date_default_timezone_set("Asia/Singapore");
    $user_id = $_SESSION['user_id'];    

    if(isset($_POST['cancel_edit'])){
    	header('Location: comments.php?org_id='.$_GET['org_id'].'&sort_id='.$_GET['sort_id'].'&disc_id='.$_GET['disc_id'].'#'.$_GET['edit']);
    }
    if(isset($_POST['submit_edit'])){
    	$body=$_POST['content_edit'];
		$today = date('Y-m-d H:i:s');
    	$edit_query="UPDATE comments 
    	    SET body='$body', date_c='$today'
    	    	WHERE comment_id='$_GET[edit]'";
    	if(querySignUp($edit_query)){
	    	header('Location: comments.php?org_id='.$_GET['org_id'].'&sort_id='.$_GET['sort_id'].'&disc_id='.$_GET['disc_id'].'#'.$_GET['edit']);
    	}
    	else{
    		echo $disc_id;
    	}
    }
	if(isset($_POST['delete'])){
		$comment_id=$_POST['delete'];
    	$delete_query="DELETE FROM comments WHERE comment_id='$comment_id' ";
    	querySignUp($delete_query);
    	header('Location: comments.php?org_id='.$_GET['org_id'].'&sort_id='.$_GET['sort_id'].'&disc_id='.$_GET['disc_id']);
    }
    $org_id=$_GET['org_id'];
    $org_query="SELECT * FROM orgs WHERE org_id='$org_id'";
    $org_info=mysqli_fetch_assoc(querySignUp($org_query));
?>

<!DOCTYPE html>
<html>
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/group_page.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" type="text/css" href="../css/comments.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css">
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
                <li><a href="notif.php">Notifications
                  <?php
                    $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
                    $total2 = mysqli_num_rows($notifnum); ?>
					<span class="notif-count"><?php echo $total2 ?></span>
                </a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
   		</nav>
		<div id="content">
			<?php
			$current_userid = $_SESSION['user_id'];
			$checker_query = "SELECT * FROM joined,orgs WHERE joined.org_id = $org_id AND joined.user_id = $current_userid AND orgs.org_id = $org_id";
			$check_result = mysqli_query($connectdb, $checker_query);
			if(mysqli_num_rows($check_result)>=1){
			?>
			<div class="header">
				<center>
					<img class="img-absolute" onerror="this.src = '../images/janina.PNG'" src="<?=$org_info['photo']?>"/>
				</center>
				<h1 class="title"><?=$org_info['org_name']?></h1>
				<h2 class="currpage">Comments</h2>
			</div>
			<div id="discussions">
				<?php
					$get_topic="SELECT * FROM discuss, user WHERE discuss.disc_id='$_GET[disc_id]' AND discuss.user_id=user.user_id";
					$disc=mysqli_fetch_assoc(querySignUp($get_topic));
					$phpdate = strtotime( $disc['date_posted'] );
					$datec = date( 'F d, Y h:i:s a', $phpdate );
				?>
				
				<a href="discussions.php?orgID=<?=$_GET['org_id']?>" class="buttoncustom return"><span class="glyphicon glyphicon-chevron-left"></span>Back</a><br>
				<div class='discussion'>
					<legend>
						<a class='title' href="discussions.php?orgID=<?=$_GET['org_id']?>"><?=$disc['title']?></a>
						<span class="date"><?=$datec?></span>
					</legend>
						<a class='user' href="viewprofile.php?user_id=<?=$disc['user_id']?>"><?=$disc['username']?></a>
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
					
					$sql = "SELECT u.username, c.body, c.date_c, c.comment_id, u.user_id 
								FROM comments c 
								INNER JOIN user u on c.user_id = u.user_id 
								INNER JOIN discuss d on c.disc_id = d.disc_id 
									WHERE c.disc_id=$disc_id ORDER BY comment_id DESC $limit";
							    $query = mysqli_query($dbconn, $sql);

					$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

					$paginationCtrls = '';
					
					if($last != 1)
					{
						if ($pagenum > 1) 
						{
							$previous = $pagenum - 1;
							$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&sort_id='.$_GET['sort_id'].'&disc_id='.$disc_id.'&pn='.$previous.'"><span class="glyphicon glyphicon-triangle-left"></span></a>&nbsp; &nbsp; ';
						
							for($i = $pagenum-4; $i < $pagenum; $i++)
							{
								if($i > 0)
								{
									$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&sort_id='.$_GET['sort_id'].'&disc_id='.$disc_id.'&pn='.$i.'">'.$i.'</a> &nbsp; ';
								}
							}
						}
						
						$paginationCtrls .= '<a class="active"><b> '.$pagenum.'</b></a>';
						
						for($i = $pagenum+1; $i <= $last; $i++)
						{
							$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&sort_id='.$_GET['sort_id'].'&disc_id='.$disc_id.'&pn='.$i.'">'.$i.'</a>&nbsp; ';
							if($i >= $pagenum+4)
							{
								break;
							}
						}
						
						if ($pagenum != $last) 
						{
							$next = $pagenum + 1;
							$paginationCtrls .= ' &nbsp;&nbsp; <a href="'.$_SERVER['PHP_SELF'].'?org_id='.$org_id.'&sort_id='.$_GET['sort_id'].'&disc_id='.$disc_id.'&pn='.$next.'"><span class="glyphicon glyphicon-triangle-right"></span></a> &nbsp;';
						}
					}

					
					while($row = mysqli_fetch_assoc($query))
					{
						$commenter = $row["username"];
						$body = $row["body"];
						$comment_id = $row["comment_id"];
						$date_c = $row["date_c"];
						$phpdate = strtotime( $date_c );
						$datec = date( 'F d, Y h:i:s a', $phpdate );
						if(!isset($_GET['edit'])){?>
							<div class='discussion' id='<?=$comment_id?>'>
								<legend>
									<a class='user' href='viewprofile.php?user_id=<?=$row['user_id']?>'><?=$commenter?></a>
									<span class="date"><?=$datec?></span>
								</legend>
								<?php 
								if($_SESSION['user_id'] ==$row['user_id']){?>
									<form method="post" action=""><button name='delete' class="remove" onClick="return confirm('Are you sure you want to delete this comment?')" type="submit" value="<?=$comment_id?>"><span class="glyphicon glyphicon-remove"></span> </button></form>


									<a href="comments.php?org_id=<?=$_GET['org_id']?>&sort_id=<?=$_GET['sort_id']?>&disc_id=<?=$_GET['disc_id']?>&edit=<?=$row['comment_id']?>#<?=$row['comment_id']?>"><button class="edit"><span class="glyphicon glyphicon-pencil"></span> </button></a>
								<?php }?>
								<dl>
									<dt><p><?=nl2br($body)?></p></dt>
								</dl>
							</div>
				<?php
						}
						else{ 
							if($comment_id==$_GET['edit']) {?>							
								<div class='newdiscussion' id='<?=$comment_id?>'>
									<legend>
										<a class='user' href='viewprofile.php?user_id=<?=$row['user_id']?>'><?=$commenter?></a>
										<span class="date"><?=$datec?></span>
									</legend>
									<form method="post" action="">
										<dl>
											<dt><textarea name='content_edit'><?=nl2br($body)?></textarea></dt>
										</dl>
										<input name='submit_edit' type='submit' value='Submit'/>
										<input name='cancel_edit' type='submit' value='Cancel' />
									</form>
								</div>
				<?php 		}
							else{?>
								<div class='discussion' id='<?=$comment_id?>'>
									<legend>
										<a class='user'><?=$commenter?></a>
										<span class="date"><?=$datec?></span>
									</legend>
									<dl>
										<dt><p><?=nl2br($body)?></p></dt>
									</dl>
								</div>
						<?php }
						}
					}
				}

				else
				{
					echo "<h4>Error, does not exist.</h4>";
				}

				?>
				

				<div>
					<!-- <p><?php echo $textline2; ?></p> -->
					<div class="pagination">
					<ul>
						<li><?php echo $paginationCtrls; ?></li>
						</ul>
					</div>						
				</div>


		        <?php
		        	//echo "$body, $today, $disc_id, $user_id";
					if(isset($_POST['submit']))
					{
						if($_POST['discussion_text'] != "")
						{
							$body = $_POST['discussion_text'];

							$today = date('Y-m-d H:i:s');
							$sql = "INSERT INTO `comments` (`comment_id`, `body`, `date_c`, `disc_id`, `user_id`) VALUES (NULL, '$body', '$today', '$disc_id', '$user_id')";

							   
							    $query = mysqli_query($dbconn, $sql);

							    //AGENT PROXY
							if($disc['user_id']!=$_SESSION['user_id']){
								$content = $_SESSION['username']." commented on your post entitled ".$disc['title'];
								$query = "INSERT INTO announcement(announcement_id,date_posted,topic,content,user_id,org_id) VALUES (null,'$today','Commented','$content','$disc[user_id]',$org_id)";
								$result = mysqli_query($dbconn, $query);

								$ann=mysqli_query($connectdb,"SELECT * FROM announcement WHERE org_id=$org_id order by announcement_id desc limit 1");
					        	$ann_id= mysqli_fetch_assoc($ann);
					        	$announcement_id=$ann_id['announcement_id'];
								$query = "INSERT INTO seen_announcement(seen_id,seen,user_id,announcement_id) VALUES (null,'not_seen','$disc[user_id]','$announcement_id')";
								$result = mysqli_query($dbconn, $query);
							}

	         				echo "<meta http-equiv='refresh' content='0'>";							
							
						}
						else
						{
							echo "<script type='text/javascript'>alert('Please input field')</script>";
						}
					} 
				?>
			</div>
			<?php
			}else{
				$date = date("Y-m-d H:i:s");
				$phpdate = strtotime( $date );
				$datec = date( 'F d, Y h:i:s a', $phpdate );
			?>
			<div class="header">
				<center>
					<img class="img-absolute" onerror="this.src = '../images/janina.PNG'" src="<?=$result['photo']?>"/>
				</center>
				<h1 class="title">ORG_Y</h1>
				<h2 class="currpage">Error Message</h2>
			</div>
			<div id="announcement">
				<ul class="posted">
					<li class="posted-content">
						<h2 class="type">Something Wrong</h2>
						<span class="date"><span class="glyphicon glyphicon-time"></span> <?=$datec?></span>
						<h3 class="name">System</h3>
						<p class="caption">"You are not a member of this group! If you are interested in joining, you can try looking for it using the Explore button."</p>
					</li>
				</ul>
			</div>
			<?php
			}
			?>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	</div>
</body>
</html>
