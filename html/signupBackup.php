<!-- If the user haven't login yet it would redirect back to login.php -->
<?php
	session_start();
	include ("functions.php");
	redirect();
?>
<!-- If the user haven't login yet it would redirect back to login.php -->
<!DOCTYPE html>
<html>
<head>
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
			
		$newusernameScs = $prompt = "";
		$currentpwd = "";

		$query_info="SELECT * FROM user WHERE user_id=$_SESSION[user_id]";
		$info=mysqli_fetch_assoc(querySignUp($query_info));

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(!empty($_POST["newpwd"]) && !empty($_POST["renewpwd"])){

				$getoldpassword = $_POST["currentpwd"]; 
				$getnewpassword = $_POST["newpwd"]; 
				$getretypenewpassword = $_POST["renewpwd"];

				$checknewusername = $checkoldpassword = $checknewpassword = $checkretypenewpassword = false; 
		       
		        $sql_username = "SELECT username FROM user WHERE username = '$getusername'";
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
								SET password='".md5($getnewpassword)."', first_name='$getfname', last_name='$getlname', course='$getdegree', 
								date_joined='$getbirthdate', year_level='$getyear', prof_pic='$getpic' 
									WHERE user_id='$getuserid'";

	        		if (mysqli_query($dbconn, $sql)) {
					   $prompt = "You have successfully updated yourself!";
					   header('Location: edit.php');
					} 
		        }
			}
			else{
				$passwordErr = "Current password, new password, and password retype confirmation must be filled out to make changes to your current password";
			}

			if(empty($_POST['currentpwd'])){
				$passwordErr="You must input you current password to make changes to your account!";
			}
			else{
				$getuserid = $_SESSION['user_id'];
				$getusername = $_SESSION['username'];
				$getfname = $_POST["fname"];
				$getlname = $_POST["lname"];

				$getbirthdate = date('Y,m,d', strtotime($_POST["bdate"]));
				$getdegree = $_POST["degree"];
				$getyear = $_POST["year"];
				$getemail = $_POST["email"];
				$getpic = $_POST["img"];

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
	            while($current_user= mysqli_fetch_array($query2)){ ?>
	            <li><?php echo $current_user['username'] ?></li>
	            <li><img src="../images/<?php echo $current_user['prof_pic'] ?>"/></li> <?php } ?>
				<li><input type="search" name="search" placeholder="Search For Your Orgs Here..."></li>
				<li><a href="home.php">Home</a></li>
				<li><a href="explore.php">Explore</a></li>
				<li><a href="groups.php">Groups</a></li>
				<li><a href="edit.php" class="active">Edit Profile</a></li>
				<li><a href="notif.php">Notifications</a></li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</nav>
		<div id="content">
			<div id="wrapper">
			  <label>edit your profile</label>
			  	<p><span class="error"><?php echo $duplicateErr . $passwordErr . $oldpasswordErr . $newpasswordErr . $retypenewpasswordErr . $submitErr;?></span><span class="success"><?php echo $newusernameScs . $prompt;?></span></p>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				   <div id="edit_profile">
					  <ul>					  	
					  	<li>
					      	<label id="currentuname_label" for="username">Username:</label>
	          	  			<input id="currentuname_input" type="text" name="username" value="<?= $info['username']?>" disabled/>
					    </li>			    
					  	<li>
					      	<label id="currentpwd_label" for="currentpwd">Current Password:</label>
	          	  			<input id="currentpwd_input" type="password" name="currentpwd"/>
					    </li>
					    <li>
					      	<label id="newpwd_label" for="newpwd">New Password:</label>
	          	  			<input id="newpwd_input" type="password" name="newpwd"/>
					    </li>
					    <li>
	            			<label id="renewpwd_label" for="renewpwd">Retype New Password:</label>
	          	 			<input id="renewpwd_input" type="password" name="renewpwd" />
					    </li>
					    <li>
					    	<label for="fname">First Name:</label>
							<input type="text" name="fname" value="<?= $info['first_name'] ?>"/>
						</li>
						<li>
					    	<label for="lname">Last Name:</label>
							<input type="text" name="lname" value="<?= $info['last_name'] ?>"/>
						</li>
						<li>
					    	<label for="student_no">Student No.:</label>
							<input type="text" name="student_no" placeholder="20xx-xxxxx" value="<?= $info['student_no'] ?>" disabled/> 
						</li>
						<li>
					    	<label for="bdate">Date of Birth:</label>
							<input type="date" name="bdate" value="<?= $info['birthday'] ?>" />
						</li>
						<li>
						    <label id="profilepic_label" for="img">Select New Profile Picture:</label>
		  					<input id="profilepic_input" type="file" name="img"  placeholder="<?= $info['prof_pic']?>" />
					    </li>
					    <li>
					    	<label for="degree">Degree Program:</label>
					    </li>
					    <li>
							
							<select name="degree">
								<option><?= $info['course'] ?></option>
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

							<select name="year">
							<optgroup label="Year Level">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 and above</option>
							</optgroup>
							</select><br><br>
					    </li>
					    <li>
					    	
					    </li>
					    <li>
					    	<label for="email">E-mail Address:</label>
							<input type="email" name="email"/>
					    </li>
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