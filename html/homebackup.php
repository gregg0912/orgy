<?php
    session_start();             
    include ("functions.php");
    $connectdb = connection();
    redirect();
?>

<!DOCTYPE html>
<html>
<head>
    <title>ORG SYSTEM A.Y. 2016-2017</title>
        <style type="text/css">
            #pagination{
                margin-left: 0;
                padding: 5px;
                clear: both;
                top: 55%;
                left: 50%;
            }
            #pagination > li{ display: inline-block;}
            #pagination > li > a{ }
            #pagination > li a.current{
                background-color: red;
                color: white;
            }
            #pagination > li a:hover:not(.current){
                background-color: red;
            }
    
        </style>
        <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>

    <?php 
        $curnt_id = $_SESSION['user_id'];
        $query1 = mysqli_query($connectdb, "select * from announcement where org_id in (select org_id from joined where user_id = $curnt_id) order by date_posted DESC ");
        $rows = mysqli_affected_rows($connectdb);
         
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
      $query = mysqli_query($connectdb, "select * from announcement where org_id in (select org_id from joined where user_id = $curnt_id) order by date_posted DESC limit $start, $lim");
    ?>

<div id="wrapper">
    <nav id="general">
        <ul id="navigation">
            <?php 
            $current_id = $_SESSION['user_id'];
            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
            while($current_user= mysqli_fetch_array($query2)){ ?>
            <li><?php echo $current_user['username'] ?></li>
            <li><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></li> <?php } ?>
            <li><input type="search" name="search" placeholder="Search For Your Orgs Here..."></li>
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
            <li><a href="notif.php">Notifications</a></li>
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