<?php
    session_start();
    include ("functions.php");
    $connectdb = connection();
    date_default_timezone_set("Asia/Singapore");
    redirect();
     $count=0;

     /*
    Accepted
    Rejected
    Kicked
    Rejected
    Request
    Upvote
    Downvote

     */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORG SYSTEM A.Y. 2016-2017</title>
    <link rel="stylesheet" type="text/css" href="../css/navigation.css">
    <link rel="stylesheet" type="text/css" href="../css/notif.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php
        $start=0;
        $lim=6;
        $current_id = $_SESSION['user_id'];
        $query = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.user_id='".$current_id."' ORDER BY date_posted DESC" );
        $rows=mysqli_num_rows($query);
        $total=ceil($rows/$lim);
        if(isset($_GET['id'])){
          $id=$_GET['id'];
          $start=($id-1)*$lim;
        }
        else{
          $id=1;
        }
    ?>
    
        <?php
             if($_POST){       
                for($x=0;$x<=$_SESSION['count'];$x++){
                    if(isset($_POST['Button'.$x])){
                        $value = $_POST['Button'.$x];
                        $query_seen= "UPDATE seen_announcement SET seen='seen' WHERE announcement_id='$value' AND user_id='$_SESSION[user_id]'";
                        $result=mysqli_query($connectdb,$query_seen);
                        header("Location:notif.php");
                      }
                    }
                        
                    if(isset($_POST["allread"])){
                        $read_update= "UPDATE seen_announcement SET seen='seen' WHERE user_id='$_SESSION[user_id]'";
                        $result=mysqli_query($connectdb,$read_update);
                        header("Location:notif.php");
                    }
            }
        ?>
        

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
                <li class="dropbtn"><a class="dropbtn" href="groups.php">Groups</a>
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
                <li><a class="active" href="notif.php">Notifications
                  <?php
                    $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
                    $total2 = mysqli_num_rows($notifnum); ?>
          <span class="notif-count"><?php echo $total2 ?></span>
                </a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    <div id="content">
        <h1 class="title">Notifications</h1>
        <p style="color: #740000; font-family: 'Arca Majora 3 Bold', sans-serif; text-align: center;"><?php echo "Today is ".date("m/d/Y")."<br>".date("l"); ?></p>
        <form method="post" action="">
        <button type="submit" name="allread" class="btn btn-1 btn-1a" id="allread"> Mark All as Read </button>
        </form>
            
        <ul class="notification-container">  
         <?php
            $query = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.user_id='".$current_id."' ORDER BY date_posted DESC LIMIT $start, $lim" );
            if($total>=1){
                  while($announcement = mysqli_fetch_array($query)){
                  $org_id = $announcement['org_id'];
                  $date = $announcement['date_posted'];
                  $date = strtotime($date);
                  $date = date('F d, Y h:i:s a', $date);
                  $message = $announcement['content'];
                  $user_id = $announcement['user_id'];
                  $orgsy = mysqli_query($connectdb, "select org_name from orgs where org_id = $org_id");
                  $org_name = mysqli_fetch_assoc($orgsy);
                  $username = mysqli_query($connectdb, "select first_name, last_name from user where user_id = $user_id");
                  $name = mysqli_fetch_assoc($username);
                  $topic = $announcement['topic'];
                  $seenstatus = $announcement['seen']
              ?>
                  <li class="notification">
                      <a href="group_page.php?orgID=<?=$org_id?>"><h2 class="org-name"><?php echo $org_name["org_name"];?></h2></a>
                      <span class="date"><span class="glyphicon glyphicon-time"></span><?= $date ?></span>
                      <h3 class="topic">
                        <?php
                          if($topic=="Request"){
                            echo "<span style='color: #3dd83c' class='glyphicon glyphicon-question-sign'></span>";
                          }
                          else if($topic=="Rejected"){
                            echo "<span style='color: #c10000' class='glyphicon glyphicon-remove-circle'></span>";
                          }
                          else if($topic=="Upvote"){
                            echo "<span style='color: #3498db' class='glyphicon glyphicon-thumbs-up'></span>";
                          }
                          else if($topic=="Downvote"){
                            echo "<span style='color: #c10000' class='glyphicon glyphicon-thumbs-down'></span>";
                          }
                          else if($topic=="Commented"){
                            // <span class="glyphicon glyphicon-edit"></span>
                            // <i class="fa fa-comment-o"></i>
                            echo '<span style="color: #6d69a5" class="fa fa-comment-o"></span>';
                          }
                          else if($topic=="Rejected"){
                            echo "<span class='glyphicon glyphicon-remove-sign'></span>";
                          }
                          else if($topic=="Accepted"){
                            echo '<span style="color: #73ff1e" class="glyphicon glyphicon-ok-sign"></span>';
                          }
                          else if($topic=='Kicked'){
                            echo '<span style="color: #a00404" class="glyphicon glyphicon-ban-circle"></span>';
                          }
                          else{
                            echo "<span style='color: #6d69a5' class='fa fa-comment-o'></span>";
                          }
                        ?>
                        <?php echo $topic;?>
                      </h3> 
                      <p class="message">"<?php echo $message;?>"</p>
                      <?php
                      if($seenstatus == 'not_seen'){ ?>
                        <form method="post" action="">
                        <button type="submit" name="<?='Button'."$count" ?>" value="<?=$announcement['announcement_id']?>" class="btn btn-1 btn-1a" id="read"> Mark as Read </button>
                      </form>
                      <?php $_SESSION['count']=$count; ?>
                      <?php } ?>
                  </li>
                  <?php $count++;
                  }
                  ?>
                  <?php
                  pagination($id,$rows,$lim,1,"notif.php?id=%d"); 
                }
                  else{
                  ?>
                  <p class="no-notif">No new notifications yet.</p>
                  <?php
                  }?>
        </ul>
        <footer>CMSC 128 Section 1 | 2016</footer>
    </div>
</div>
</body>
</html>
