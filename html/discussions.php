<?php

	//include('connect.php');
	include('functions.php');
	session_start();
	$dbconn = connection();
	$connectdb = connection();
	redirect();
    $user_id = $_SESSION['user_id'];
    $set_timezone = mysqli_query($dbconn, "set time_zone = '+08:00'");
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
    	header('Location: discussions.php?orgID='.$_GET['orgID'].'&pn='.$_GET['pn']);
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
	    	header('Location: discussions.php?orgID='.$_GET['orgID'].'&pn='.$_GET['pn']);
    	}
    	else{
    		echo $disc_id;
    	}
    }
    $org_id=$_GET['orgID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
	div#pagination_controls{font-size:21px;}
	div#pagination_controls > a{ color:#06F; }
	div#pagination_controls > a:visited{ color:#06F; }
	
    .btn {
		border: none;
		cursor: pointer;
		padding: 2%;
		display: inline-block;
		margin: 2%;
		text-transform: uppercase;
		outline: none;
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		transition: all 0.3s;
		float: right;
	}
	.btn:after {
		position: absolute;
		z-index: -1;
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		transition: all 0.3
	}
	.btn-1a:hover, .btn-1a:active {
		color: black;
		background: #fff;
	}
	legend > a{
		color: #740000;
		text-decoration: underline;
	}
	dt > a{
		color: #251108;
		text-decoration: underline;
	}
	i{
		color: rgba(246,40,4,1);
		color:  -moz-linear-gradient(top, rgba(246,40,4,1) 0%, rgba(216,28,3,0.83) 30%, rgba(215,33,9,0.69) 55%, rgba(240,67,40,0.56) 79%, rgba(210,35,20,0.44) 100%);
		color:  -webkit-gradient(left top, left bottom, color-stop(0%, rgba(246,40,4,1)), color-stop(30%, rgba(216,28,3,0.83)), color-stop(55%, rgba(215,33,9,0.69)), color-stop(79%, rgba(240,67,40,0.56)), color-stop(100%, rgba(210,35,20,0.44)));
		color:  -webkit-linear-gradient(top, rgba(246,40,4,1) 0%, rgba(216,28,3,0.83) 30%, rgba(215,33,9,0.69) 55%, rgba(240,67,40,0.56) 79%, rgba(210,35,20,0.44) 100%);
		color:  -o-linear-gradient(top, rgba(246,40,4,1) 0%, rgba(216,28,3,0.83) 30%, rgba(215,33,9,0.69) 55%, rgba(240,67,40,0.56) 79%, rgba(210,35,20,0.44) 100%);
		color:  -ms-linear-gradient(top, rgba(246,40,4,1) 0%, rgba(216,28,3,0.83) 30%, rgba(215,33,9,0.69) 55%, rgba(240,67,40,0.56) 79%, rgba(210,35,20,0.44) 100%);
		color:  linear-gradient(to bottom, rgba(246,40,4,1) 0%, rgba(216,28,3,0.83) 30%, rgba(215,33,9,0.69) 55%, rgba(240,67,40,0.56) 79%, rgba(210,35,20,0.44) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f62804', endColorstr='#d22314', GradientType=0 );
	}
	
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
			<h2>Discussions</h2>
			Sort by: 
			<form method="post" action="">
				<button type="submit" name="date" value="date"> Date </button>
            	<button type="submit" name="votes" value="votes"> Votes </button>
            </form>

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
	            }
	            if(isset($_POST['votes'])){
	            	$sort_id=2;
	            }
	            if(isset($_GET['sort_id'])){
	            	$sort_id = $_GET['sort_id'];
	            }
              
				
				
				if($sort_id==1)
				{
					$sql = "SELECT * FROM discuss natural join user natural join orgs WHERE org_id = $org_id ORDER BY date_posted DESC $limit";
				}
				if($sort_id==2)
				{
					$sql = "SELECT * FROM discuss natural join user natural join orgs WHERE org_id = $org_id ORDER BY votes DESC $limit";
				}
				$query = mysqli_query($dbconn, $sql);

				$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";

				$paginationCtrls = '';
				
				if($last != 1)
				{
					if ($pagenum > 1) 
					{
						$previous = $pagenum - 1;
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$previous.'&sort_id='.$sort_id.'">Previous</a> &nbsp; &nbsp; ';
					
						for($i = $pagenum-4; $i < $pagenum; $i++)
						{
							if($i > 0)
							{
								$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$i.'&sort_id='.$sort_id.'">'.$i.'</a> &nbsp; ';
							}
						}
					}
					
					$paginationCtrls .= ''.$pagenum.' &nbsp; ';
					
					for($i = $pagenum+1; $i <= $last; $i++)
					{
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$i.'&sort_id='.$sort_id.'">'.$i.'</a> &nbsp; ';
						if($i >= $pagenum+4)
						{
							break;
						}
					}
					
					if ($pagenum != $last) 
					{
						$next = $pagenum + 1;
						$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?orgID='.$org_id.'&pn='.$next.'&sort_id='.$sort_id.'">Next</a> ';
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
					if(!isset($_GET['edit'])){?>
						<fieldset id="inner">
							<legend>
								<a href = "comments.php?user_id=<?=$user_id?>&org_id=<?=$org_id?>&disc_id=<?=$disc_id?>"><?=$title?></a>
							</legend>
							<?php
								if($user_id==$disc_user_id){
								?>
									<a href="discussions.php?orgID=<?=$org_id?>&pn=<?=$pn?>&edit=<?=$row['disc_id']?>#<?=$row['disc_id']?>"><button>Edit</button></a>
									<form method="post" action="">
									<button type="submit" name="delete" value="<?=$disc_id?>"> Delete </button>
									</form>
								<?php
								}
								?>
							<dl>
								<dt>
									<a href = "viewprofile.php?user_id=<?=$row['user_id']?>"><?=$username?></a>
								</dt>
								<dt><p><?=nl2br($content)?></p></dt>
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
									if(!isset($_GET['pn']))
										$pn = 1;
									else
										$pn = $_GET['pn'];
								?>
								<a href="vote.php?approval=upvote&orgID=<?=$_GET['orgID']?>&pn=<?=$pn?>&user_id=<?=$user_id?>&disc_id=<?=$disc_id?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
								<label>Discussion Points:<?=$total_vote?></label>
								<a href="vote.php?approval=downvote&orgID=<?=$_GET['orgID']?>&pn=<?=$pn?>&user_id=<?=$user_id?>&disc_id=<?=$disc_id?>"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
								<dt><?=$dateposted?></dt>
							</dl>
						</fieldset><br>
				<?php				
					}
					else{
						if($_GET['edit']==$disc_id){?>
							<form method='post' id='<?=$disc_id?>'>
								<fieldset id="inner">
									<legend>
										<input type='text' name='edit_title' value='<?=$title?>' />
									</legend>
									<dl>
										<dt>
											<?=$username?>
										</dt>
										<dt>
											<textarea id="discussion_text" name="edit_content"><?=$content?></textarea>
										</dt>
										<input type='submit' name='submit_edit' value='Submit'/>
										<input type='submit' name='cancel_edit' value='Cancel'/>
										<dt><?=$dateposted?></dt>
									</dl>
								</fieldset><br>
							</form>
			<?php
						}
						else{
							?>
							<fieldset id="inner">
								<legend>
									<?=$title?>
								</legend>
								<dl>
									<dt>
										<?=$username?>
									</dt>
									<dt><p><?=$content?></p></dt>
									<dt><?=$dateposted?></dt>
								</dl>
							</fieldset><br>
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
				<p><?php echo $textline2; ?></p>
				<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
			</div>

			<form method="POST" >
				<fieldset>
					<legend><input type="text" name="topicname" placeholder="Topic"/></legend>
					<textarea id="discussion_text" name="discussion_text" placeholder="Write something to discuss..."></textarea>
					<input class="btn btn-1 btn-1a" type="submit" name="submit" value="Post">
				</fieldset>
			</form>
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
			
			?>
			
			<?php
				if(isset($_POST['delete']))
				{
						$delete_id = $_POST['delete'];
						$result1 = mysqli_query($dbconn, "DELETE FROM disc_upvote WHERE disc_id=$delete_id");
						$result2 = mysqli_query($dbconn, "DELETE FROM comments WHERE disc_id=$delete_id");
						$result3 = mysqli_query($dbconn, "DELETE FROM discuss WHERE disc_id=$delete_id");
						echo "<script type='text/javascript'>alert('Thread deleted')</script>";
         				echo "<meta http-equiv='refresh' content='0'>";
					
				}
			?>
		</div>
		<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
</body>
</html>