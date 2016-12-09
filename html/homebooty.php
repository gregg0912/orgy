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
    <title>ORG SYSTEM A.Y. 2016-2017</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/stylebooty.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        #inner{
            background-color: rgba(132, 178, 249, 0.4);
            color: rgb(249, 243, 243);
            list-style-type: none;
            margin: 2%;
            padding: 1%;
        }
        dl > dt{
            font-size: 110%;
            margin: 1%;
            font-family: 'Arca Majora 3 Bold', sans-serif;
            /*text-transform: uppercase;*/
            color: #CFCBCB;
        }
        dl > dd{
            font-size: 100%;
            font-family: 'PT Sans', sans-serif;
        }
        #pagination{
            display: inline-block;
            padding: 0;
            clear: both;
            margin: auto;
        }
        #pagination > li{
            display: inline;
        }
        #pagination > li > a{
            color: black;
            /*float: left;*/
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }
        #pagination > li a.active{
            background-color: #a10115;
            color: white;
        }
        #pagination > li a:hover:not(.active){
            background-color: white;
        }
        p{
            clear: both;
            margin: auto;
        }
    </style>
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
        <div class="container-fluid">
                <!-- <nav id="general"> -->
                <ul id="navigation" class="nav nav-pills nav-stacked">
                    <?php 
                        $current_id = $_SESSION['user_id'];
                        $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
                        while($current_user= mysqli_fetch_array($query2)){ ?>
                            <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
                            <li><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></li><?php } ?>
                            <li><input id="searchbar" type="search" name="search" placeholder="Search Orgs"></li>
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
                    <!-- </nav> -->
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
                        
                        <fieldset id="inner">              
                        <legend><?php echo $org_name["org_name"];?></legend>
                        <dl>
                            <dt style="font-size: 100%; text-align: center;"><?php echo $name["first_name"]." ".$name["last_name"];?></dt>
                            <dt><p>"<?=$message;?>"</p></dt>
                            <dt style="font-size: 50%; text-align: right;"><?= $date ?></dt>
                            
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

                            <form method="post" action="">
                            <button type="submit" name="<?='Button'."$count" ?>" value="<?="$announcement[announcement_id]"?>"> Delete </button> 
                            <?php $_SESSION['count']=$count; ?>
                            </form>
                            <?php } ?>  
                            
                        </dl>
                    </fieldset>
                    <?php $count++; }  ?>
                    </ul>
                    
                    <?php 
                    if($rows = 0){ ?>
                        <p> No announcement yet. </p> <?php
                    } ?>
                    
                    <ul id="pagination">
                        <?php
                        if($total > 1){
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
                        ?>
                    </ul>
                    <p style="color: #740000; font-family: 'Arca Majora 3 Bold', sans-serif; text-align: center;"><?php echo "Today is ".date("m/d/Y")."<br>".date("l"); ?></p>
                </div>
        </div>
        <footer class="container-fluid">CMSC 128 Section 1 | 2016</footer>
    </body>
</html>