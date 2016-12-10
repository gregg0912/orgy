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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORG SYSTEM A.Y. 2016-2017</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/navigation.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
    <?php
        $curnt_id = $_SESSION['user_id'];
        $query1 = mysqli_query($connectdb, "select * from announcement where org_id in (select org_id from joined where user_id = $curnt_id and membership_type!='pending') order by date_posted DESC ");
        $rows = mysqli_num_rows($query1);
        $start=0;
        $lim=5;

            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $start=($id-1)*$lim;
            }
            else{
                $id=1;
            } 
      $total=ceil($rows/$lim);
      $query = mysqli_query($connectdb, "select * from announcement where org_id in (select org_id from joined where user_id = $curnt_id and membership_type!='pending') order by date_posted DESC limit $start, $lim");
    ?>
    
    <?php
             if($_POST){       
                for($x=0;$x<=$_SESSION['count'];$x++){
                    if(isset($_POST['Button'.$x])){
                        $value = $_POST['Button'.$x];
                        $query_delete= "delete from seen_announcement where announcement_id='$value'";
                        $query_delete2= "delete from announcement where announcement_id='$value'";
                        $result=mysqli_query($connectdb,$query_delete);
                        $result=mysqli_query($connectdb,$query_delete2);
                        header("Location:home.php");
                    }
                   
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
                <li><a href="home.php" class="active">Home</a></li>
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
            <h1 class="title">Announcements</h1>
            <p class="current-date" style="color: #740000; font-family: 'Arca Majora 3 Bold', sans-serif; text-align: center;"><?php echo "Today is ".date("m/d/Y")."<br>".date("l"); ?></p>
            <ul class="announcements-container">  
            <?php
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
                    ?>
                    
                    <li class="announcement">          
                        <h2 class="org-name"><?php echo $org_name["org_name"];?></h2>
                        <h3 class="name"><?php echo $name["first_name"]." ".$name["last_name"];?></h3>
                        <span class="date"><?= $date ?></span>
                        <form method="post" action="">
                            <button class="remove" type="submit" name="<?='Button'."$count" ?>" value="<?="$announcement[announcement_id]"?>"><span class="glyphicon glyphicon-remove"></span></button> 
                        </form>
                        <p class="notif-content">"<?=$message;?>"</p>
                            
                        <?php
                            $current_userid = $_SESSION['user_id'];
                            $checker_query = "select * from joined where user_id = $current_userid and org_id = $org_id";
                            $check_result = mysqli_query($connectdb, $checker_query);
                          
                            while($result = mysqli_fetch_assoc($check_result)){
                                  $member = $result['membership_type'];
                            }
                        ?>

                        <?php
                            if($member =='admin'){ ?>

                            <?php $_SESSION['count']=$count; ?>
                        <?php } 
                        ?>
                    </li>
                <?php
                    $count++; 
                }
            }else{
            ?>
                <fieldset id="inner">
                <legend>System</legend>
                <dl>
                    <dt><p>You don't have any new announcements yet.</p></dt>
                </dl>
                </fieldset>
            <?php
            }
            ?>
            </ul>
            <?php pagination($id,$rows,$lim,1,"home.php?id=%d"); ?>
        <footer>CMSC 128 Section 1 | 2016</footer>
        </div>
    </div>
</body>
</html>
