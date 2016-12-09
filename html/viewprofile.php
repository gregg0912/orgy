w<?php
    session_start();             
    include ("functions.php");
    $connectdb = connection();
    redirect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORG SYSTEM A.Y. 2016-2017</title>
        <style type="text/css">
            h3, p{
                color: black;}   
            #profile{
                margin-left: 36%;
              }
            a{
                text-decoration: none;
                color: black;
            }
            li{
                list-style-type: none;
            }
            #back{
                margin-left: 90%;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="../css/style.css">

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
            <nav id="general">
            <ul id="navigation">
                <?php 
                $current_id = $_SESSION['user_id'];
                $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
                while($current_user= mysqli_fetch_array($query2)){ ?>
                <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
                <li><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></li><?php } ?>
                <li><a href="home.php" class="active">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <div class="dropdownnuj">
                    <li><a id="dropA" class="dropbtnnuj" href="groups.php">Groups</a>
                        <div class="dropdown-contentnuj">
                        <?php
                        $pending = "%pending%";
                        $query2 = "SELECT orgs.org_id, orgs.org_name
                                    FROM joined, orgs
                                    WHERE joined.user_id = '".$_SESSION['user_id']."' AND joined.org_id = orgs.org_id AND joined.membership_type NOT LIKE '".$pending."'";
                        $result2 = mysqli_query($connectdb, $query2);
                        while(list($org_id2, $orgName2) = mysqli_fetch_row($result2)){
                        ?>
                            <a href="group_page.php?orgID=<?=$org_id2?>"><?=$orgName2?></a>
                        <?php
                        }
                        ?>
                        </div>
                    </li>
                </div>
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
        <?php
            $select_user="SELECT * FROM user WHERE user_id='$_GET[user_id]'";    
            $view_info=mysqli_fetch_assoc(querySignUp($select_user));
            $select_orgs="SELECT orgs.org_name, orgs.org_id FROM orgs, joined 
                            WHERE joined.user_id='".$_GET['user_id']."'
                            AND orgs.org_id=joined.org_id AND joined.membership_type!='pending'";
            $view_orgs=mysqli_query($connectdb,$select_orgs);
        ?>
        <div id="content">
            <h2><?= $view_info['username'] ?></h2>
            <img id="profile" src="../images/<?php echo $view_info['prof_pic'] ?>"/><br>
            <hr>
            <h3>Personal Information</h3>
            <p><label>Name</label>: <?=$view_info['first_name'] ." ". $view_info['last_name']?></p>
            <p><label>Student No.</label>: <?=$view_info['student_no']?></p>
            <p><label>Degree Program</label>: <?=$view_info['course']?></p>
            <p><label>Year Level</label>: <?=$view_info['year_level']?></p>
            <p><label>Date Joined</label>: <?=$view_info['date_joined']?></p>
            <hr>
            <h3>Orgs Joined</h3>
            <?php
                while($org =mysqli_fetch_assoc($view_orgs)){
            ?>
                <?php 
                    $select_type="SELECT * FROM classification WHERE org_id='$org[org_id]'";
                    $type=mysqli_fetch_assoc(querySignUp($select_type));
                    $_SESSION['back']=true;
                ?>
                <li><a href="view.php?org_id=<?=$org['org_id']?>&org_type=<?= $type['type_id']?>&id=1&user_id=<?=$_GET['user_id']?>"><?=$org['org_name']?></a></li>
            <?php
                }
            ?>
            <button class="btn btn-1 btn-1a" id="back" onclick="history.go(-1);">Back</button>
        </div>
        <footer>CMSC 128 Section 1 | 2016</footer>
    </div>
</body>
</html>