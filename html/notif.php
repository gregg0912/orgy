<?php
    session_start();
    include ("functions.php");
    $connectdb = connection();
    redirect();
     $count=0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        #pagination{
          margin-left: 0;
          padding: 5px;
          float: left;
          top: 55%;
          left: 50%;
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
        #read{
          float: right;
        }
        p{
          clear:both;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORG SYSTEM A.Y. 2016-2017</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/navigation.css">
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
                        $query_seen= "update seen_announcement set seen='seen' where announcement_id='$value' and user_id='$_SESSION[user_id]'";
                        $result=mysqli_query($connectdb,$query_seen);
                        header("Location:notif.php");
                      }
                    }
                        
                    if(isset($_POST["allread"])){
                        $read_update= "update seen_announcement set seen='seen'";
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
                <li><a class="active" href="notif.php">Notifications   |  
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
        <h1 class="title">Notifications</h1>
        
        <form method="post" action="">
        <button type="submit" name="allread" class="btn btn-1 btn-1a" id="allread"> Mark All as Read </button>
        </form>
            
        <ul>  
         <?php
            $query = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.user_id='".$current_id."' ORDER BY date_posted DESC LIMIT $start, $lim" );
            if($total>=1){
                  while($announcement = mysqli_fetch_array($query)){
                  $org_id = $announcement['org_id'];
                  $date = $announcement['date_posted'];
                  $message = $announcement['content'];
                  $user_id = $announcement['user_id'];
                  $orgsy = mysqli_query($connectdb, "select org_name from orgs where org_id = $org_id");
                  $org_name = mysqli_fetch_assoc($orgsy);
                  $username = mysqli_query($connectdb, "select first_name, last_name from user where user_id = $user_id");
                  $name = mysqli_fetch_assoc($username);
                  $topic = $announcement['topic'];
                  $seenstatus = $announcement['seen']
              ?>
                  <fieldset id="inner">              
                      <legend><?php echo $org_name["org_name"];?></legend>
                      <dl>  
                          <dt style="font-size: 130%; text-align: center;"><?php echo $topic;?></dt>
                          <dt>"<?php echo $message;?>"</dt>
                          
                          <?php
                          if($seenstatus == 'not_seen'){ ?>
                          <form method="post" action="">
                          <button type="submit" name="<?='Button'."$count" ?>" value="<?=$announcement['announcement_id']?>" class="btn btn-1 btn-1a" id="read"> Mark as Read </button>
                          <?php $_SESSION['count']=$count; ?>
                          </form>
                          <?php } ?>
                          
                      </dl>
                  </fieldset>
              <?php $count++;
              }
              pagination($id,$rows,$lim,1,"notif.php?id=%d");
              ?>
              <?php }
              else{
              ?>
                <fieldset id="inner">
                  <legend style="font-size: 200%; text-align: center;">System</legend>
                  <dl>
                    <dt>No new notifications yet.</dt>
                  </dl>
                </fieldset>
              <?php
              }?>
        </ul>
             <p style="color: #740000; font-family: 'Arca Majora 3 Bold', sans-serif; text-align: center;"><?php echo "Today is ".date("m/d/Y")."<br>".date("l"); ?></p>
        <footer>CMSC 128 Section 1 | 2016</footer>
    </div>
</div>
</body>
</html>
