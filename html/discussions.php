<?php

	//include('connect.php');
	include('functions.php');
	session_start();
	$dbconn = connection();
	$connectdb = connection();
	redirect();
	$orgid = intval($_GET['orgID']);
    $user_id = $_SESSION['user_id'];
    // $set_timezone = mysqli_query(connection(), "set time_zone = '+08:00'");
    date_default_timezone_set("Asia/Singapore");
    if(isset($_SESSION['voted'])){
    	if($_SESSION['voted']=="voted"){
    		echo "<script type='text/javascript'>alert('You already voted for that comment!')</script>";
    	}elseif ($_SESSION['voted']=="added") {
    		echo "<script type='text/javascript'>alert('Your vote has been added!')</script>";
    	}elseif($_SESSION['voted']=="error"){
    		echo "<script type='text/javascript'>alert('Something went wrong. Try voting again.')</script>";
    	}elseif($_SESSION['voted']=="updated"){
    		echo "<script type='text/javascript'>alert('Your vote has been updated!')</script>";
    	}
    	unset($_SESSION['voted']);
    }
    if(isset($_POST['cancel_edit'])){
    	header('Location: discussions.php?orgID='.$_GET['orgID'].'&pn='.$_GET['pn'].'#'.$_GET['edit']);
    }
    if(isset($_POST['submit_edit'])){
		$today = date('Y-m-d H:i:s');
    	$disc_id=$_GET['edit'];
		$today = date('Y-m-d H:i:s');
    	$edit_query="UPDATE discuss 
    	    SET title='$_POST[edit_title]', content='$_POST[edit_content]', date_posted='$today'
    	    	WHERE disc_id=$disc_id";
    	mysqli_query(connection(), $edit_query);
    	if(mysqli_affected_rows($dbconn)>0){
	    	header('Location: discussions.php?orgID='.$_GET['orgID'].'&pn='.$_GET['pn'].'#'.$_GET['edit']);
    	}
    	else{
    		echo $disc_id;
    	}
    }
    $org_id=$_GET['orgID'];
    $org_query="SELECT * FROM orgs WHERE org_id='$org_id'";
    $org_info=mysqli_fetch_assoc(querySignUp($org_query));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" type="text/css" href="../css/discussions.css">
	<link rel="stylesheet" type="text/css" href="../css/group_page.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>		


<body>
	<div id="wrapper">
	<nav>
    	<ul>
    	<?php 
    		$current_id = $_SESSION['user_id'];
            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
                while($current_user= mysqli_fetch_array($query2)){ ?>
                <li><a href = 'viewprofile.php?user_id=<?=$current_id?>' class="username"><?php echo $current_user['username'] ?></a></li>
                <li class="image"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><img src="../images/<?php echo $current_user['prof_pic'] ?>" onerror="this.src = '../images/janina.PNG'"/></a></li><?php } ?>
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
			$checker_query = "SELECT *
								FROM joined,orgs
								WHERE joined.org_id = $orgid AND joined.user_id = $current_userid
								AND orgs.org_id = $orgid AND joined.org_id = orgs.org_id AND joined.membership_type IN ('admin','member')";
			$check_result = mysqli_query($connectdb, $checker_query);
			if(mysqli_num_rows($check_result)>=1){
			?>
				<div class="header">
				<center>
					<img class="img-absolute" onerror="this.src = '../images/janina.PNG'" src="<?=$org_info['photo']?>"/>
				</center>
				<h1 class="title"><?=$org_info['org_name']?></h1>
				<h2 class="currpage">Discussions</h2>
			</div>
			<div id="discussions">


				<a href="group_page.php?orgID=<?=$orgid?>" class="buttoncustom return"><span class="glyphicon glyphicon-chevron-left"></span> Back </a><br>


				<form method="post" action="" class="sort">
					<span><span class="glyphicon glyphicon-sort"></span> Sort by </span> 
					 <!-- <button id="sortdate" type="submit" name="date" value="date" class="btnsort"> Date </button>
	            	<button id="sortvote" type="submit" name="votes" value="votes" class="btnsort"> Votes </button> -->
	            	<?php if(!isset($_GET['sort_id'])){$_GET['sort_id'] = 1;} ?>
	            	<button id="sortdate" type="submit" name="date" value="date" class="btnsort <?php if($_GET['sort_id'] == 1){echo "active";}?>"> Date </button>
	            	<button id="sortvote" type="submit" name="votes" value="votes" class="btnsort <?php if($_GET['sort_id'] == 2){echo "active";}?>"> Votes </button>

	            </form>
	            <?php
	            if(!isset($_GET['edit'])){
				?>
					<form class="newtopic" method="POST" >
						<div class="newdiscussion">
							<legend><input type="text" name="topicname" placeholder="Topic"/></legend>
							<textarea name="discussion_text" placeholder="Write something to discuss..."></textarea>
							<input class="btn btn-1 btn-1a" type="submit" name="submit" value="Post">
						</div>
					</form>
				<?php
				} 
				?>
				<?php
				if(!empty($org_id)){				
					$sql = "SELECT COUNT(disc_id) FROM discuss WHERE org_id = $org_id";
					
					$query = mysqli_query($dbconn, $sql);
					$row = mysqli_fetch_row($query);

					$rows = $row[0];
					$page_rows = 10;
					

					$last = ceil($rows/$page_rows);

					if($last < 1){
						$last = 1;
					}

					$pagenum = 1;
					
					if(isset($_GET['pn'])){
						$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
					}

					if ($pagenum < 1) { 
						$pagenum = 1; 
					} 
					else if ($pagenum > $last) { 
						$pagenum = $last; 
					}

					$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

					if(!isset($_POST['date']) && !isset($_POST['votes'])){
		            	$sort_id=1;
		            }
					if(isset($_POST['date'])){
		            	$sort_id=1;
		    	       	//AGENTPROXY[069]
						header("Location: discussions.php?orgID=$org_id&pn=1&sort_id=$sort_id");
						// //
		            }
		            if(isset($_POST['votes'])){
		            	$sort_id=2;
		            	//AGENTPROXY[069]
						header("Location: discussions.php?orgID=$org_id&pn=1&sort_id=$sort_id");
						// //
		            }
		            if(isset($_GET['sort_id'])){
		            	$sort_id = $_GET['sort_id'];
		            }
	              
					
					
					if($sort_id==1)
					{
						$sql = "SELECT * FROM discuss natural join user natural join orgs WHERE org_id = $org_id ORDER BY date_posted DESC $limit";
						//AGENTPROXY[069]
						//header("Location: discussions.php?orgID=$orgID&sort_id=$sort_id&pn=1");
						//
					}
					if($sort_id==2)
					{
						$sql = "SELECT * FROM discuss natural join user natural join orgs WHERE org_id = $org_id ORDER BY votes DESC $limit";
						//AGENTPROXY[069]
						//header("Location: discussions.php?orgID=$orgID&sort_id=$sort_id&pn=1");
						
					}
					$query = mysqli_query($dbconn, $sql);

					$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
					
					$paginationCtrls = '';

					if($last != 1)
					{
						if ($pagenum > 1) 
						{
							$previous = $pagenum - 1;
							// $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$previous.'&sort_id='.$sort_id.'">Previous</a> &nbsp; &nbsp; ';
							$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$previous.'&sort_id='.$sort_id.'"><span class="glyphicon glyphicon-triangle-left"></span></a>';
						
							for($i = $pagenum-4; $i < $pagenum; $i++)
							{
								if($i > 0)
								{
									$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$i.'&sort_id='.$sort_id.'">'.$i.'</a>';
								}
							}
						}	
						
						// $paginationCtrls .= ''.$pagenum.' &nbsp; ';
						$paginationCtrls .= '<a class="active"><b>'.$pagenum.'</b></a>';


						
						for($i = $pagenum+1; $i <= $last; $i++)
						{
							$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$i.'&sort_id='.$sort_id.'">'.$i.'</a>';
							if($i >= $pagenum+4)
							{
								break;
							}
						}
						
						if ($pagenum != $last) 
						{
							$next = $pagenum + 1;
							// $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$next.'&sort_id='.$sort_id.'">Next</a> ';
							$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$next.'&sort_id='.$sort_id.'"><span class="glyphicon glyphicon-triangle-right"></span></a> ';
						}
					}


					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
						$disc_id = $row["disc_id"];
						$content = $row["content"];
						$username = $row["username"];
						$org_name = $row["org_name"];
						$title = $row["title"];
						$disc_user_id = $row["user_id"];
						$date_posted = $row["date_posted"];
						$dateposted = date('F d, Y h:i:s a', strtotime($date_posted));
						if(!isset($_GET['pn']))
							$pn = 1;
						else
							$pn = $_GET['pn'];
						if(!isset($_GET['edit'])){ ?>
							<div class="discussion">
								<legend id="<?=$disc_id?>">

									<a class='title' href = "comments.php?org_id=<?=$org_id?>&sort_id=<?=$sort_id?>&disc_id=<?=$disc_id?>"><?=$title?></a>
									<?php
									$sql = "SELECT COUNT(comment_id) FROM comments WHERE comments.disc_id = $disc_id";
									$query_comments = mysqli_query($dbconn,$sql);
									$query_comments = mysqli_fetch_assoc($query_comments);
									?>

									<span class="date"><span class="glyphicon glyphicon-time"></span> <?=$dateposted?></span>
								</legend>
								<?php
									if($user_id==$disc_user_id){
									?>
										<form method="post" action=""><button name='delete' onClick="return confirm('Are you sure you want to delete this post?')" class="remove" type="submit" value="<?=$disc_id?>"><span class="glyphicon glyphicon-remove"></span></button></form>
										<a href="discussions.php?orgID=<?=$org_id?>&pn=<?=$pn?>&edit=<?=$row['disc_id']?>#<?=$row['disc_id']?>"><button class="edit"><span class="glyphicon glyphicon-pencil"></span></button></a>
										
									<?php
									}
									?>
									<a class='user' href = "viewprofile.php?user_id=<?=$row['user_id']?>"><?=$username?></a>
									<p>"<?=nl2br($content)?>"</p></dt>
									<?php
										$up_query = "SELECT * FROM disc_upvote WHERE disc_id = '".$disc_id."' AND approval = 'upvote'";
										$up_result = querySignUp($up_query);
										$upvote = mysqli_num_rows($up_result);
										$down_query = "SELECT * FROM disc_upvote WHERE disc_id = '".$disc_id."'AND approval = 'downvote'";
										$down_result = mysqli_query($connectdb, $down_query);
										$downvote = mysqli_num_rows($down_result);
										$total_vote = $upvote - $downvote;
										$update_vote="UPDATE discuss SET votes='".$total_vote."' WHERE disc_id='".$disc_id."'";
										querySignUp($update_vote);
									?>
									<form method='post'>
										<div class="app">
											<a class="up" href="vote.php?approval=upvote&orgID=<?=$_GET['orgID']?>&pn=<?=$pn?>&disc_user_id=<?=$row['user_id']?>&disc_id=<?=$disc_id?>&sort_id=<?=$sort_id?>&title=<?=$title?>&dateposted=<?=$dateposted?>"><span class="glyphicon glyphicon-thumbs-up up"> </span></a>
											<label class="votes">Discussion Points: <?=$total_vote?></label>
											<a class="down" href="vote.php?approval=downvote&orgID=<?=$_GET['orgID']?>&pn=<?=$pn?>&disc_user_id=<?=$row['user_id']?>&disc_id=<?=$disc_id?>&sort_id=<?=$sort_id?>&title=<?=$title?>&dateposted=<?=$dateposted?>"><span class="glyphicon glyphicon-thumbs-down down"></span></a>
											<a href = "comments.php?org_id=<?=$org_id?>&sort_id=<?=$sort_id?>&disc_id=<?=$disc_id?>"><label class='comments'> <?= $query_comments['COUNT(comment_id)']." comments "?> </label></a>
										</div>
									</form>
							</div>
					<?php				
						}
						else{
							if($_GET['edit']==$disc_id){?>
								<form method='post' id='<?=$disc_id?>'>
									<div class="newdiscussion" id="inner">
										<legend>
											<input type='text' name='edit_title' value='<?=$title?>' />
											<span class="date"><?=$dateposted?></span>
										</legend>
										<dl>
											<dt class="user">
												<?=$username?>
											</dt>
											<dt>
												<textarea id="discussion_text" name="edit_content"><?=$content?></textarea>
											</dt>
											<input type='submit' name='submit_edit' value='Submit'/>
											<input type='submit' name='cancel_edit' value='Cancel'/>
										</dl>
									</div>
								</form>
				<?php
							}
							else{
								?>

								<div class="newdiscussion" id="inner">
									<legend>
										<h2 class="disctitle"><?=$title?></h2>
										<span class="date"><?=$dateposted?></span>
									</legend>
									<dl>
										<dt class="user">
											<?=$username?>
										</dt>
										<dt><p>"<?=nl2br($content)?>"</p></dt>
									</dl>
								</div><br>
						<?php 
							}
						}
					}
				}
				else{?>
					<p>No other discussions yet.<a href="group_page.php?orgID=<?=$_GET['orgID']?>"><button class="btn btn-1 btn-1a">Back</button></a></p>
				<?php 

				}
				?>

				<div>
					<!-- <p class="pagination-text"><?php echo $textline2; ?></p> -->
					<!-- <div id="pagination_controls"><?php echo $paginationCtrls; ?></div> -->
					<div id="pagination_controls">
						<ul class="pagination">
							<li><?php echo $paginationCtrls; ?></li>
						</ul>
					</div>
				</div>
				
				
			
				<?php
					if(isset($_POST['submit']))
					{
						if($_POST['topicname'] != "" && $_POST['discussion_text'] != "")
						{
							$title1 = $_POST['topicname'];
							$body1 = $_POST['discussion_text'];
							$title =htmlspecialchars($title1, ENT_QUOTES);
							$body = htmlspecialchars($body1, ENT_QUOTES);

							$today = date('Y-m-d H:i:s');
							$result = mysqli_query($dbconn, "INSERT INTO `discuss`(`disc_id`, `title`, `content`, `date_posted`, `user_id`, `org_id`) VALUES (NULL,'$title','$body','$today','$user_id','$org_id');");
							// echo "<script type='text/javascript'>alert('Thread posted')</script>";
	         				echo "<meta http-equiv='refresh' content='0'>";
							
						}
						else
						{
							echo "Error!";
						}
					}
					if(isset($_POST['delete']))
					{
							$delete_id = $_POST['delete'];
							$result1 = mysqli_query($dbconn, "DELETE FROM disc_upvote WHERE disc_id=$delete_id");
							$result2 = mysqli_query($dbconn, "DELETE FROM comments WHERE disc_id=$delete_id");
							$result3 = mysqli_query($dbconn, "DELETE FROM discuss WHERE disc_id=$delete_id");
							// echo "<script type='text/javascript'>alert('Thread deleted')</script>";
	         				echo "<meta http-equiv='refresh' content='0'>";
						
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
</body>
</html>