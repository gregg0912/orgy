 	<?php
	session_start();
	include ("functions.php");
	redirect();
?>
<!DOCTYPE html>
<html>
<head>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css" > -->
	<link rel="stylesheet" type="text/css" href="../css/navigation.css">
	<link rel="stylesheet" type="text/css" href="../css/edit.css">
</head>
<body>
	<?php
		$host = 'localhost';
		$uname = 'root';
		$password = '';
		$db = 'org_y';
		$dbconn = mysqli_connect($host,$uname,$password,$db) or die("Could not connect to database!");

		$line = "";
		$usernameErr = $passwordErr = $oldpasswordErr = $newpasswordErr = $retypenewpasswordErr = $submitErr = $duplicateErr = "";
			
		$prompt = "";
		$currentpwd = "";

		$query_info="SELECT * FROM user WHERE user_id=$_SESSION[user_id]";
		$info=mysqli_fetch_assoc(querySignUp($query_info));



	
		$getusername = $info['username'];
		$getfname = $info['first_name'];
		$getlname = $info['last_name'];
		$getstudentno = $info['student_no'];
		$getbirthdate = $info['birthday'];
		$getprofpic = $info['prof_pic'];
		$getdegree = $info['course'];
		$getyear= $info['year_level'];
		$getemail = $info['email'];
		

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			$getuserid = $_SESSION['user_id'];
			$getusername = $info['username'];
			$getnewusername = $_POST["username"];
			$getfname = $_POST["fname"];
			$getlname = $_POST["lname"];
			$getemail = $_POST["email"];
			/*$getbirthdate = $_POST["bdate"];*/
			$getdegree = $_POST["degree"];
			$getyear = $_POST["year"];
			$getemail = $_POST["email"];

			if(empty($_POST['currentpwd'])){
				$passwordErr="You must input your current password to make changes to your account!";
			}else{
				$checkoldpassword = false; 
				$getoldpassword = $_POST["currentpwd"]; 
		        $sql_password = "SELECT password FROM user WHERE password = '".md5($getoldpassword)."'";

		        if(mysqli_query($dbconn, $sql_password)){
		        	if(mysqli_affected_rows($dbconn)==0){
		        		$oldpasswordErr = " Sorry, that’s not your current password";  	
		        		$getusername = $getnewusername;		
		        	}
		        	else{

		        		if(!empty($_POST['username'])){

						$sql = "SELECT username FROM user WHERE username = '$getnewusername'";

				        if(mysqli_query($dbconn, $sql)){
					        	if(mysqli_affected_rows($dbconn)>0 && !($getusername == $getnewusername) ){
									$duplicateErr = "Sorry Username " . $getnewusername  ." has already been taken!";
									/*$getusername = $getnewusername;  */      		
					        	}
					        	else{

					        		/*$getbirthdate = date('Y,m,d', strtotime($_POST["bdate"]));*/

									$file=$_FILES['fileToUpload'];
									if(!isset($file)){
										$file=$info['prof_pic'];
									}
									
									$target_dir = "../images/";
									$target_file = $target_dir . basename($file["name"]);
									move_uploaded_file($file["tmp_name"], $target_file);
									$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
									$sql="UPDATE user 
											SET username='$getnewusername', first_name='$getfname', last_name='$getlname', course='$getdegree', birthday='$getbirthdate', year_level='$getyear', email = '$getemail', prof_pic = '$target_file'
												WHERE user_id='$getuserid'";
									querySignUp($sql);


									$prompt="You have successfully updated your account!";
									/*header('Location: edit.php');
						*/

					        		

					        		$sql_1 = "UPDATE user SET username = '$getnewusername' WHERE username = '$getusername' ";

					        		if (mysqli_query($dbconn, $sql_1)) {
									    $newusernameScs = "You have successfully updated your username!";
									} 
					        	}
					        }    
						}

		        		
						
						
		        	}
				}
			}


			if(!empty($_POST['currentpwd']) && !empty($_POST['newpwd']) && !empty($_POST['renewpwd'])){
				$getoldpassword = $_POST["currentpwd"]; 
				$getnewpassword = $_POST["newpwd"]; 
				$getretypenewpassword = $_POST["renewpwd"];

				$checkoldpassword = $checknewpassword = $checkretypenewpassword = false; 
		        $sql_password = "SELECT password FROM user WHERE password = '".md5($getoldpassword)."'";
		        if(mysqli_query($dbconn, $sql_password)){
		        	if(mysqli_affected_rows($dbconn)==0){
		        		$oldpasswordErr = " Sorry, that’s not your current password";  			
		        	}
		        	else{
		        		$checkoldpassword = true;
		        	}
				}

		        if($getnewpassword != $getretypenewpassword){
        			$newpasswordErr = " Oops, new password and confirmation don’t match!";
        		}
        		else{
        			$checknewpassword = true;
        		}

	        	if(!preg_match('/(?=.*\d)[A-Za-z\d]{6,}/', $getnewpassword) && !preg_match('/(?=.*\d)[A-Za-z\d]{6,}/', $getretypenewpassword)){
	        		$retypenewpasswordErr = " New password must at least be 8 characters long and should contain at least 1 integer";		        	
	        	}
	        	else{
	        		$checkretypenewpassword = true;
	        	}

				if($checkoldpassword && $checknewpassword && $checkretypenewpassword){
					$sql = "UPDATE user 
								SET password='".md5($getnewpassword)."'
									WHERE user_id='$getuserid'";

	        		querySignUp($sql);
				 	$prompt = "You have successfully updated your password!";
					header('Location: edit.php'); 
		        }
			}
			else if((empty($_POST["newpwd"]) && !empty($_POST["renewpwd"])) || (!empty($_POST["newpwd"]) && empty($_POST["renewpwd"]))) {
				$passwordErr = "Current password, new password, and password retype confirmation must be filled out to make changes to your current password";
			}

			 
		}
		else{
			echo $line;
		}

		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
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
                	<li class="image"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><img onerror="this.src = '../images/janina.PNG'" src="../images/<?php echo $current_user['prof_pic'] ?>"></a></li>
                <?php } ?>
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
                <li><a href="edit.php" class="active">Edit Profile</a></li>
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
			<h1 class="title">edit your profile</h1>
			<?php if($duplicateErr!="" || $passwordErr!="" || $oldpasswordErr!="" || $newpasswordErr!="" || $retypenewpasswordErr!="" || $submitErr!=""){ ?>
				<span class="error"><?php echo $duplicateErr . $passwordErr . $oldpasswordErr . $newpasswordErr . $retypenewpasswordErr . $submitErr;?></span>
			<?php } elseif ($prompt!="") { ?>
				<span class="success"><?php echo $prompt;?></span>
			<?php } ?>
			<form class="edit" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			    <label for="fileToUpload" class="buttoncustom change-picture"><span class="glyphicon glyphicon-picture"></span> Change Profile Picture </label>
				<input id="fileToUpload" type="file" name="fileToUpload"  value="<?= $getprofpic ?>"> 			

		      	<label for="username">Username</label>
  	  			<input type="text" name="username" value="<?= $getusername ?>" class="block">
		    
		    
		    	<label for="fname">Name</label>
				<input type="text" name="fname" value="<?= $getfname ?>" placeholder="First Name" class="fifty">
				<input type="text" name="lname" value="<?= $getlname ?>" placeholder="Last Name" class="fifty">
			

		    	<!-- <label for="student_no">Student No:</label>
				<input type="text" name="student_no" placeholder="20xx-xxxxx" value="<?= $getstudentno ?>" disabled> -->
			
			
		    	<!-- <label for="bdate">Date of Birth:</label>
				<input type="date" name="bdate" value="<?= $getbirthdate ?>" > -->
		    
		    	<label for="degree">Degree Program</label>
			
				<select name="degree">
					<option><?= $getdegree ?></option>
						<optgroup label="College of Fisheries and Ocean Sciences">
							<option>Bachelor of Science in Fisheries</option>
						</optgroup>
						<optgroup label="College of Arts and Science">
							<option>Bachelor of Arts in Communication and Media Studies</option>
							<option>Bachelor of Arts in Community Development</option>
							<option>Bachelor of Arts in History</option>
							<option>Bachelor of Arts in Literature</option>
							<option>Bachelor of Arts in Political Science</option>
							<option>Bachelor of Arts in Psychology</option>
							<option>Bachelor of Arts in Sociology</option>
							<option>Bachelor of Science in Applied Mathematics</option>
							<option>Bachelor of Science in Biology</option>
							<option>Bachelor of Science in Chemistry</option>
							<option>Bachelor of Science in Computer Science</option>
							<option>Bachelor of Science in Economics</option>
							<option>Bachelor of Science in Public Health</option>
							<option>Bachelor of Science in Statistics</option>
						</optgroup>
						<optgroup label="School of Technology">
							<option>Bachelor of Science in Chemical Engineering</option>
							<option>Bachelor of Science in Food Technology</option>
						</optgroup>
				</select>

				<select name="year" id="year">
					<option><?= $getyear?></option>
					<optgroup label="Year Level">
						<option <?=($getyear == '1')? "selected = 'selected'":"" ;?>>1</option>
						<option <?=($getyear == '2')? "selected = 'selected'":"" ;?>>2</option>
						<option <?=($getyear == '3')? "selected = 'selected'":"" ;?>>3</option>
						<option <?=($getyear == '4')? "selected = 'selected'":"" ;?>>4</option>
						<option <?=($getyear == '5 and above')? "selected = 'selected'":"" ;?>>5 and above</option>
					</optgroup>
				</select>
		    
		    	<label for="email">E-mail Address</label>
				<input type="email" name="email" value="<?= $getemail ?>" class="block">
		    
		      	<label for="newpwd">Password</label>
  	  			<input type="password" name="newpwd" placeholder="New Password" class="fifty">
  	 			<input type="password" name="renewpwd"  placeholder="Retype Password" class="fifty">

  	 			<span class="validation">To apply changes, please enter current password</span>
  	  			<input type="password" name="currentpwd" placeholder="Current Password" class="block">
		    
		    
		 		<input type="submit" name="changepwd" value="Save Changes" class="change-btn">
			</form>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	</div>
</body>
</html>