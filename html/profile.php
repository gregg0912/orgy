<?php
    session_start();             
    include ("functions.php");
    $connectdb = connection();
    redirect();
    date_default_timezone_set("Asia/Singapore");
?>
<!DOCTYPE html>
<html>
<head>
    <title>ORG SYSTEM A.Y. 2016-2017</title>
        <style type="text/css">
         
        </style>
        <link rel="stylesheet" type="text/css" href="../css/stylemarba.css">
</head>
<body>
    <?php
       ?>
    <div id="wrapper">
        <nav id="general">
            <ul id="navigation">
                <?php 
                $current_id = $_SESSION['user_id'];
                $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
                while($current_user= mysqli_fetch_array($query2)){ ?>
                <li id="liTo"><span><?php echo $current_user['username'] ?></span></li>
                <li><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></li> <?php } ?>
                <li><a href="home.php" class="active">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li><a href="groups.php">Groups</a>
                    <ul id= "breadcrumbs">
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
                    $total = mysqli_num_rows($notifnum); ?>
                    <span class="notif-count"><?php echo $total2 ?></span>
                </a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
        <div id="content">
            <h2>Announcements</h2>
              
            <ul>
            <?php while($announcement = mysqli_fetch_array($query)){
                $org_id = $announcement['org_id'];
                $date = $announcement['date_posted'];
                $message = $announcement['content'];
                $user_id = $announcement['user_id'];
                $orgsy = mysqli_query($connectdb, "select org_name from orgs where org_id = $org_id");
                $org_name = mysqli_fetch_assoc($orgsy);
                $username = mysqli_query($connectdb, "select first_name, last_name from user where user_id = $user_id");
                $name = mysqli_fetch_assoc($username);

                ?>
                <li>
                    <dl>                
                        <dt>Organization</dt>
                        <dd><?php echo $org_name["org_name"];?></dd>
                        <dt>Date</dt>
                        <dd><?php echo $date;?></dd>
                        <dt>Message</dt>
                        <dd><q><?php echo $message;?></q></dd>
                        <dt>Posted By</dt>
                        <dd><?php echo $name["first_name"]." ".$name["last_name"];?></dd>
                    </dl>
                </li><?php
                } ?>

            </ul>

            <?php 
            if($rows <= 0){ ?>
                <p> No announcement yet. </p> <?php
            }
            else { ?>
                <ul id="pagination">
                <?php
                if($total!= 1){
                        if($id>1){
                            ?>
                            <li><a href="?id=<?php echo ($id-1)?>">&laquo;</a></li>
                        <?php }
                        for($i=1; $i<=$total; $i++){
                            if($i==$id){ ?>
                                <li><a class="current" href="?id=<?php echo $i?>"><?=$i?></a></li>
                            <?php 
                            }
                            else{
                            ?><li><a href="?id=<?php echo $i?>"><?=$i?></a></li>
                            <?php 
                            }
                        }
                        if($id!=$total){
                        ?>
                            <li><a href="?id=<?php echo ($id+1)?>">&raquo;</a></li>
                        <?php 
                         }
                    }
                }
                ?>
            </ul>

             <p style="color: red;"><?php echo "Today is ".date("m/d/Y")."<br>".date("l"); ?></p>
        </div>
        <footer>CMSC 128 Section 1 | 2016</footer>
    </div>
</body>
</html>