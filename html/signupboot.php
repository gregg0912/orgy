<?php 
	session_start();
	include 'functions.php';
	connection();
	ob_start();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/set1.css" />
    <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
	<style type="text/css">
		input{
			font-size: 150%;
		}
		span{
			font-size: 120%;
		}
	</style>
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
				$error_fname="First Letter should be capital(formality) and no space before";
			}
		}

		if(isset($_POST['lname'])){
			if(preg_match("/^[A-Z]([a-zA-Z-.]*[\ ]*)+$/",$_POST['lname'])) {
				$_SESSION['success']++;
			}	
			else{
				$error_lname="First Letter should be capital(formality) and no space before";
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
			querySignUp($query);
			$uname=$_POST['username'];
			$pword=md5($_POST['password']);
	 		$user_id=mysqli_fetch_assoc(select($uname, $pword));

	 		if(querySignUp($query)){
	      		$_SESSION['user_id']=$user_id['user_id'];
	      		$_SESSION['username']=$user_id['username'];
				header("Location: home.php"); //test
				echo $_SESSION['user_id'];
			}
		}
	}
?>

<body id='nuj'>

<!-- 	<ul class="cb-slideshow" style="display: block; list-style-type: none;">
		<li>
			<span>Image 01</span>
			<div>
				<h2> Orgy_Y </h2>
			</div>
		</li>

		<li>
			<span> Image 02 </span>
		</li>

		<li>
			<span> Image 03 </span>
		</li>

		<li>
			<span> Image 04 </span>

			<div>
				<h2 style="color:red; font-size:100%; text-align: left;"> PWNED BY AGENTPROXY </h2>
			</div>
		</li>
		
	</ul> -->
		<div class="container-fluid">
			<h2><span>Sign Up</span></h2>
			<div class="form-group">
				<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<span class="input input--isao">
					<input type="text" name="username" class="input__field input__field--isao" id="username" value="<?= isset($_POST['username'])? $_POST['username']:""?>" placeholder="Username" required/>
					<label class="input__label input__label--isao" for="username">
						<span class="input__label-content input__label-content--isao"></span>
					</label>
				</span>
				<p><?php
						if(isset($error_username)){
							echo "$error_username";	
						}
						else{
							echo nl2br("\n");
						}?>
					</p>
					<label for="password" class="info"></label>
					<input type="password" name="password" id="password" value="" placeholder="Password" required/>
					<p><?php
						if(isset($error_password)){
							echo "$error_password";	
						}
						else{
							echo nl2br("\n");
						}?>
					</p>
					<label for="newpassword" class="info"></label>
					<input type="password" name="newpassword" id="password" value="" placeholder="Confirm Password" required/>
					<p><?php
						if(isset($error_newpassword)){
							echo "$error_newpassword";	
						}
						else{
							echo nl2br("\n");
						}?>
					</p>
					<label for="e-mail"></label>
						<input type="email" name="email" placeholder="Email Address" value="<?= isset($_POST['email'])? $_POST['email']:null?>" required />
						<p><?php
						if(isset($error_email)){
							echo "$error_email";	
						}
						else{
							echo nl2br("\n");
						}?>
						</p>
					<!-- <fieldset> -->
						<!-- <legend>Personal Information</legend> -->
						<label for="fname"></label>
							<input type="text" name="fname" id="fname" placeholder="First Name" value="<?= isset($_POST['fname'])? $_POST['fname']:""?>" required /><br>
							<p><?php
								if(isset($error_fname)){
									echo "$error_fname";	
								}
								else{
									echo nl2br("\n");
								}?>
							</p>
						<label for="lname"></label>
							<input type="text" name="lname" id="lname" placeholder="Last Name" value="<?= isset($_POST['lname'])? $_POST['lname']:""?>" required/><br>
							<p><?php
								if(isset($error_lname)){
									echo "$error_lname";	
								}
								else{
									echo nl2br("\n");
								}?>
							</p>
						<label for="lname"></label>
						<input type="text" name="student_no" id="student_no" value="<?= isset($_POST['student_no'])? $_POST['student_no']:null?>" placeholder="20XX-XXXXX" required /><br> 
						<p><?php
								if(isset($error_message)){
									echo "$error_message";	
								}
								else{
									echo nl2br("\n");
							}?>
						</p>
						<label for="bdate"></label>
						<input type="date" name="bdate" id="bdate" placeholder="Enter Your Date of Birth" value="<?= isset($_POST['bdate'])? $_POST['bdate']:null?>" required/><br><br><br>
						<label for="pic">Profile Picture:</label>
						<input type="file" style = "margin-left: 10%;" name="fileToUpload" id="fileToUpload" value="<?= isset($_POST['fileToUpload'])? $_POST['fileToUpload']:null?>"/><br><br>
						<label for="degree"> Degree and Year:</label>
						<select name="degree" id="degree" style="width: 45%; margin-left: -100%; margin-right: 23%;"> value="<?= isset($_POST['degree'])? $_POST['degree']:null?>">
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
						
						<select name="year" id="year" value="<?= isset($_POST['year'])? $_POST['year']:null?>" style= "width:10%; margin-left: 5%;">
							<optgroup label="Year Level">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 and above</option>
							</optgroup>
						</select><br><br>
						<br>
						<button type="submit" id="submit-btn" value="submit" name="Submit"> Submit </button>
						<!-- <br> -->
					</fieldset>
				</form>
			</div>
		</div>
		<footer>CMSC 128 Section 1 | 2016</footer>

</body>
</html>