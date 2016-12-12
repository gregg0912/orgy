w<?php
    session_start();             
    include ("functions.php");
    $connectdb = connection();
    redirect();
    date_default_timezone_set("Asia/Singapore");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORG SYSTEM A.Y. 2016-2017</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/navigation.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <link rel="stylesheet" type="text/css" href="../css/viewprofile.css">
</head>
<body> 
    <?php   
        $start=0;
        $lim=3;

        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $start=($id-1)*$lim;
        }
        else{
            $id=1;
        } 
    ?>
    <div id="wrapper">
        <nav>
            <ul>
                <?php
                    $current_id = $_SESSION['user_id'];
                    $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id");
                        while($current_user= mysqli_fetch_array($query2)){ ?>
                        <li><a href = 'viewprofile.php?user_id=<?=$current_id?>' class="username active"><?php echo $current_user['username'] ?></a></li>
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
                        <li><a href="notif.php">Notifications
                        <?php
                            $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
                            $total2 = mysqli_num_rows($notifnum); ?>
                    <span class="notif-count"><?php echo $total2 ?></span>
                        </a></li>
                        <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
        <?php
            $select_user="SELECT * FROM user WHERE user_id='$_GET[user_id]'";    
            $view_info=mysqli_fetch_assoc(querySignUp($select_user));
            $select_orgs="SELECT orgs.org_name, orgs.org_id FROM orgs, joined 
                            WHERE joined.user_id='".$_GET['user_id']."'
                            AND orgs.org_id=joined.org_id AND joined.membership_type!='pending'";
            $view_orgs=mysqli_query($connectdb,$select_orgs);
        ?>
        <div id="content">
            <h1 class="title"><?= $view_info['username'] ?></h1><br>
            <button class="orglink" id="back" onclick="history.go(-1);">Back</button>
            <div class="userProf">
                <div class="pic">
                    <img onerror="this.src = '../images/janina.PNG'" id="profile" alt="User Profile Picture" src="../images/<?php echo $view_info['prof_pic'] ?>"/><br>
                </div>
                <div class="orgsjoined">
                    <p style="font-weight: bold; font-size: 150%; color: #740000;"><?=$view_info['first_name'] ." ". $view_info['last_name']?></p>
                    <p style="font-weight: bold; font-size: 120%; color: #740000;"><?=$view_info['student_no']?></p>
                    <p><label>Degree Program</label>: <?=$view_info['course']?></p>
                    <p><label>Year Level</label>: <?=$view_info['year_level']?></p>
                    <p><label>Date Joined</label>: <?=$view_info['date_joined']?></p>
                    <div class="dropdown">
                        <button class="dropbtn"><i class="fa fa-users"></i> Orgs Joined</span></button>
                        <div class="dropdown-list">
                            <ul>
                                <?php
                                    while($org =mysqli_fetch_assoc($view_orgs)){
                                ?>
                                    <?php 
                                        $select_type="SELECT * FROM classification WHERE org_id='$org[org_id]'";
                                        $type=mysqli_fetch_assoc(querySignUp($select_type));
                                        $_SESSION['back']=true;
                                    ?>
                                    <li><a class="namev" href="view.php?org_id=<?=$org['org_id']?>&org_type=<?= $type['type_id']?>&id=1&user_id=<?=$_GET['user_id']?>"><?=$org['org_name']?></a></li>
                             <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <footer>CMSC 128 Section 1 | 2016</footer>
        </div>
    </div>
</body>
</html>