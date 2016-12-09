 	<?php
	session_start();
	include ("functions.php");
	redirect();
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		input[type=text], input[type=password], input[type=date], input[type=email]{
			font-family: 'Pridi', serif;
			font-size: 100%;
		    background-color: white;
		    color: black;
		    border: none;
		    padding: 10px  10px;
		    border-radius: 4px;
		    width: 50%;

		    margin-bottom: 20px;

		}
		input:focus{
			outline: none;
		}
		label{
			font-family: 'Pridi', serif;
			color: #740000;
		}
		select{
			font-family: 'Pridi', serif;
			font-size: 100%;
		    background-color: white;
		    color: blackzz;
		    border: none;
		    padding: 10px  10px;
		    border-radius: 4px;
		    width: 70%;
		    margin-bottom: 20px;

		}
		#year{
			font-family: 'Pridi', serif;
			width: 20%;
		}


	</style>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
	<?php
		$host = 'localhost';
		$uname = 'root';
		$password = '';
		$db = 'org_y';
		$dbconn = mysqli_connect($host,$uname,$password,$db) or die("Could not connect to database!");

		$line = "<br>";
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
			$getbirthdate = $_POST["bdate"];
			$getdegree = $_POST["degree"];
			$getyear = $_POST["year"];
			$getemail = $_POST["email"];

			if(empty($_POST['currentpwd'])){
				$passwordErr="You must input your current password to make changes to your account!";
			}

			

			
			else{

				




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

					        		$getbirthdate = date('Y,m,d', strtotime($_POST["bdate"]));

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
		<nav id="general">
			<ul id="navigation">
				<?php 
	            $current_id = $_SESSION['user_id'];
	            $query2 = mysqli_query($dbconn, "select * from user where user_id = $current_id"); 
	            while($current_user= mysqli_fetch_array($query2)){ 
	            	$image = $current_user['prof_pic'];
					if ($image = '../images/'){
						$image = "default.jpg";	
					} 
	            	?>
	            <li id="liTo"><span><?php echo $current_user['username'] ?></span></li>
	            <li><img src="../images/<?php echo $image ?>"/></li> <?php } ?>
				<li><input type="search" name="search" placeholder="Search For Your Orgs Here..."></li>
				<li><a href="home.php">Home</a></li>
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
				<li><a href="edit.php" class="active">Edit Profile</a></li>
				<li><a href="notif.php">Notifications   |  
				  <?php
            $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
            $total = mysqli_num_rows($notifnum);
            echo "$total"
            ?>
          </a></li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</nav>
		<div id="content">
			<div id="wrapper">
				<h2>edit your profile</h2>
				<p>
					<span class="error"><?php echo $duplicateErr . $passwordErr . $oldpasswordErr . $newpasswordErr . $retypenewpasswordErr . $submitErr;?></span>
					<span class="success"><?php echo $prompt;?></span>
				</p>
				<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				   <div id="edit_profile">
					  <ul>					  	
					  	
					      	<label id="currentuname_label" for="username">Username:</label><br>
	          	  			<input id="currentuname_input" type="text" name="username" value="<?= $getusername ?>"/><br>
					    
					    
					    	<label for="fname">First Name:</label><br>
							<input type="text" name="fname" value="<?= $getfname ?>"/><br>
						
						
					    	<label for="lname">Last Name:</label><br>
							<input type="text" name="lname" value="<?= $getlname ?>"/><br>
						
	
					    	<label for="student_no">Student No:</label><br>
							<input type="text" name="student_no" placeholder="20xx-xxxxx" value="<?= $getstudentno ?>" disabled/><br>
						
						
					    	<label for="bdate">Date of Birth:</label><br>
							<input type="date" name="bdate" value="<?= $getbirthdate ?>" /><br>
						
						
						    <label id="profilepic_label" for="img">Select New Profile Picture:</label><br>
		  					<input id="fileToUpload" type="file" name="fileToUpload"  value="<?= $getprofpic ?>" /><br><br>			
					    
					    	<label for="degree">Degree Program:</label><br>
						
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

									<option <?= ($getyear == '1')? "selected = 'selected'":"" ;?>>1</option>
									<option <?= ($getyear == '2')? "selected = 'selected'":"" ;?>>2</option>
									<option <?= ($getyear == '3')? "selected = 'selected'":"" ;?>>3</option>
									<option <?= ($getyear == '4')? "selected = 'selected'":"" ;?>>4</option>
									<option <?= ($getyear == '5 and above')? "selected = 'selected'":"" ;?>>5 and above</option>
								</optgroup>
							</select><br>
					    
					    
					    	<label for="email">E-mail Address:</label><br>
							<input type="email" name="email" value="<?= $getemail ?>"/><br>
					    
					      	<label id="newpwd_label" for="newpwd">New Password:</label><br>
	          	  			<input id="newpwd_input" type="password" name="newpwd" value=""/><br>
					    
					    
	            			<label id="renewpwd_label" for="renewpwd">Retype New Password:</label><br>
	          	 			<input id="renewpwd_input" type="password" name="renewpwd"  value=""/><br>

	          	 			<p>To apply changes, please enter current password</p>

	          	 			<label id="currentpwd_label" for="currentpwd">Current Password:</label><br>
	          	  			<input id="currentpwd_input" type="password" name="currentpwd" value=""/><br>
					    
					    
					 		<input id="submit" type="submit" name="changepwd" value="Save Changes" />
					  </ul>
					</div>
				</form>
			</div>
		</div>
		<footer>CMSC 128 Section 1 | 2016</footer>
	</div>
</body>
</html>