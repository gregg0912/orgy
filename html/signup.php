<?php 
	session_start();
	include 'functions.php';
	connection();
	ob_start();
	redirect2();
	date_default_timezone_set("Asia/Singapore");
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/signup.css">
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	</head>
<?php
	
	$_SESSION['success']=0;
	if (isset($_POST['Submit'])){

		if(isset($_POST['username'])){

			$length=strlen($_POST['username']);
			$pattern=preg_match("/^[\w]+$/",$_POST['username']);

			if($pattern==true&&$length>5||$length<16) {

				$query="SELECT * FROM user WHERE username='$_POST[username]'";
				$result = querySignUp($query);

			
				if($result->num_rows==0){
					$_SESSION['success']++;		  
				}
			 
				else{
					$error_username="Username $_POST[username] is already taken! ";
				}
			}
			else{
				$error_username="Username should use letters,numbers,periods,or underscores. Min. length 6 and Max is 15.";
			}
		}

		if(isset($_POST['password'])){

			$length=strlen($_POST['password']);
			$pattern=preg_match("/^([\d]*[a-zA-Z]*)+$/",$_POST['password']);

			if($pattern==true&&$length>=6&&$length<=15) {
				$_SESSION['success']++;
			}	
			else{
				$error_password="Password should use letters or numbers only. Min. length 6 and Max is 15.";
			}
		}

			if(isset($_POST['newpassword'])){

			if($_POST['newpassword']==$_POST['password']) {
				$_SESSION['success']++;
			}	
			else{
				$error_newpassword="Passwords do not match! ";
			}
		}

		if(isset($_POST['student_no'])){
			$pattern= preg_match("/[20]{2}[\d]{2}-[\d]{5}/",$_POST['student_no']);
			if($pattern==false) {
				$error_message="Format should be 20xx-xxxxx";
			}	
			else{

				$query= "select * from user where student_no='$_POST[student_no]'";
				$result = querySignUp($query);
			
				if($result->num_rows==0){
					$_SESSION['success']++;		  
				}
			 
				else{
					$error_message="Student No. $_POST[student_no] is already taken! ";
					}	
			}
		}

		if(isset($_POST['fname'])){
			if(preg_match("/^[A-Z]([a-zA-Z-.]*[\ ]*)+$/",$_POST['fname'])) {
				$_SESSION['success']++;
			}	
			else{
				$error_fname="First name: First letter should be capitalized (formality) and no space before";
			}
		}

		if(isset($_POST['lname'])){
			if(preg_match("/^[A-Z]([a-zA-Z-.]*[\ ]*)+$/",$_POST['lname'])) {
				$_SESSION['success']++;
			}	
			else{
				$error_lname="Last name: First letter should be capitalized (formality) and no space before";
			}
		}


			$target_dir = "../images/";
			$pic_file=basename($_FILES["fileToUpload"]["name"]);	
			$target_file = $target_dir . $pic_file;			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);										
		

		if($_SESSION['success']==6){

			$pwordNuj=md5($_POST['password']);
			// $query="insert into user(username, password, first_name, last_name, birthday, prof_pic, course, student_no, email, date_joined, year_level) values('$_POST[username]', '$pwordNuj', '$_POST[fname]','$_POST[lname]', '$_POST[bdate]', '$_POST[fileToUpload]' '$_POST[degree]', '$_POST[student_no]', '$_POST[email]', CURDATE(), $_POST[year])";
			// $query="insert into user(student_no,first_name,last_name,username,password,course,date_joined,year_level,birthday,
			// 	prof_pic,email) values('$_POST[student_no]','$_POST[fname]','$_POST[lname]','$_POST[username]',md5($_POST[password]),'$_POST[degree]',CURDATE(),'$_POST[year]','$_POST[bdate]','$_POST[fileToUpload]','$_POST[email]')";
			$query="INSERT INTO user(student_no, first_name, last_name, username, password, course, date_joined, year_level, 
						birthday, prof_pic, email) 
						VALUES('$_POST[student_no]','$_POST[fname]','$_POST[lname]','$_POST[username]', '$pwordNuj','$_POST[degree]',
							CURDATE(),'$_POST[year]','$_POST[bdate]','$target_file','$_POST[email]')";

	 		if(querySignUp($query)){
				$uname=$_POST['username'];
				$pword=md5($_POST['password']);
		 		$user_id=mysqli_fetch_assoc(select($uname, $pword));
	      		$_SESSION['user_id']=$user_id['user_id'];
	      		$_SESSION['username']=$user_id['username'];

				header("Location: home.php"); //test
				echo $_SESSION['user_id'];
			}
		}
	}
?>

	<body>
		<div class="container flex">
			<form id="signup-form" class="flex" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<h2>Sign up</h2>
				<div>
					<label>Username</label>
					<input class="hundred" type="text" name="username" id="username" value="<?= isset($_POST['username'])? $_POST['username']:""?>" placeholder="Username" required/>
					<?php if(isset($error_username)){ ?>
						<p class="error"><?=$error_username?></p>	
					<?php } ?>
				</div>
				<div>
					<label>Password</label>
					<input class="fifty" type="password" name="password" id="password" value="" placeholder="Password" required/>
					<input class="fifty" type="password" name="newpassword" placeholder="Confirm Password" id="password" value="" required/>
					<?php if(isset($error_password)){ ?>
						<p class="error"><?=$error_password?></p>	
					<?php } ?>
					<?php if(isset($error_newpassword)){ ?>
						<p class="error"><?=$error_newpassword?></p>	
					<?php } ?>
				</div>
				<div>
					<label>Email</label>
					<input class="hundred" type="email" name="email" placeholder="E-mail" value="<?= isset($_POST['email'])? $_POST['email']:null?>" required />
					<?php if(isset($error_email)){ ?>
						<p class="error"><?=$error_email?></p>	
					<?php } ?>
				</div>

				<div>
					<label>Name</label>
					<input class="fifty" placeholder="First Name" type="text" name="fname" id="fname"  value="<?= isset($_POST['fname'])? $_POST['fname']:""?>" required />
					<input class="fifty" placeholder="Last Name" type="text" name="lname" id="lname" value="<?= isset($_POST['lname'])? $_POST['lname']:""?>" required/>
					<?php if(isset($error_fname)){ ?>
						<p class="error"><?=$error_fname?></p>	
					<?php } ?>
					<?php if(isset($error_lname)){ ?>
						<p class="error"><?=$error_lname?></p>	
					<?php } ?>
				</div>

				<div>
					<label for="student_no">Student Number</label>
					<input type="text" class="hundred" name="student_no" id="student_no" value="<?= isset($_POST['student_no'])? $_POST['student_no']:null?>" placeholder="20XX-XXXXX" required />
					<?php if(isset($error_message)){ ?>
						<p class="error"><?=$error_message?></p>	
					<?php } ?>
				</div>				

				<!-- <div>
					<input type="date" name="bdate" id="bdate" placeholder="Date of Birth" value="<?= isset($_POST['bdate'])? $_POST['bdate']:null?>" required/><br>
					<label for="bdate">
					<span></span>
					</label>
				</div> -->

				<div>
					<label>Profile Picture</label>
					<label for="fileToUpload" class="profile-pic-btn"><span class="glyphicon glyphicon-picture"></span> Choose Profile Picture</label>
					<input type="file" name="fileToUpload" id="fileToUpload" value="<?= isset($_POST['fileToUpload'])? $_POST['fileToUpload']:null?>"/>
				</div>	
				<div>
					<label for="degree">Degree and Year</label>
					<select class="eighty" name="degree" id="degree" value="<?= isset($_POST['degree'])? $_POST['degree']:null?>">
							<option>---</option>
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
					<select name="year" class="twenty" id="year" value="<?= isset($_POST['year'])? $_POST['year']:null?>" placeholder="Year">
						<optgroup label="Year Level">
							<option>---</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5 and above</option>
						</optgroup>
					</select>
				</div>	
				<button type="submit" value="submit" name="Submit"> Submit </button>
				<p class="has-acc">Already have an account?</p>
				<a href="login.php" id="login-btn" role="button">Login</a>
			</form>
		</div>
	</body>
</html>