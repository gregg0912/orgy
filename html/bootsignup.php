<?php 
	session_start();
	include 'functions.php';
	connection();
	ob_start();
	redirect2();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/newstyle.css" />
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/set1.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
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

		body
	      {
	      background-image: url(../images/sample_background.jpg);
	      background-attachment: fixed;
	      }
		.jumbotron, #content >.container{
			/*background: rgba(44, 62, 80, 0.2);*/
			background-color: #F9F4F4;
      		border: 1px solid #333;
			/*height: auto;
			margin-left: 60%;
			width: 28%;
			padding: 5%;*/
			padding: 1%;
			width: 28%;
		    float: right;
		    margin: 0%;
		    margin-top: 3%;
		    margin-right: 10%;
		}

		.page-header{
			color: #740000;
		    line-height: 100%;
		    background-color: rgba(249, 243, 243, 0.5);
		    font-size: 150%;
		    margin: auto;
		    margin-bottom: 7%;
		    text-align: center;
		    font-family: 'Arca Majora 3 Bold', sans-serif;
		    padding: 1%;
		}
		.btn{
			display: inline-block;
			margin: 2%;
		}

		.form-group{
			margin-top: 2%;
			width: 80%;
		}

		#submit-btn{
			margin-top: -4%;
			margin-bottom: 6%;
			margin-left: auto;
		}
		#login-btn{
			margin-left: 90%;
			margin-top: 10%;
			margin-bottom: -6%;
		}
		#submit-btn
			{
			border-radius: 0%;
			width: 91%;
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

<body>
	 <div class="jumbotron">
		<div id="sign_up" class="container">
		<!-- <div class="page-header"> -->
		<h2 style="">Sign up</h2>
		<!-- </div> -->
<!-- 		<form method="post" id = "signup-form" style="position: relative;">
			<h3 id="someting">With</h3>
			<div id="sign-up_buttons">
				<button style="padding: 1%; background-color: transparent; border: none;"><img id="signimg" src="../images/fb4.png"/></button>
				<button  style="padding: 1%; background-color: transparent; border: none;"><img id="signimg" src="../images/twitter2.png"></button>
				<button style="padding: 1%; background-color: transparent; border: none;"><img id="signimg" src="../images/gm2.png"></button>
			</div>
		</form>	
		<h3>Or</h3>	 -->
			<form id="signup-form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				
			<div class="form-group">
				<span style="width: 112%;" class="input input--isao">
					<label><?php
						if(isset($error_username)){
							echo "$error_username";	
						}
						else{
							echo nl2br("\n");
						}?>
					</label>
					<input type="text" name="username" class="input__field input__field--isao" id="username" value="<?= isset($_POST['username'])? $_POST['username']:""?>" placeholder="Username" required/>
					<label class="input__label input__label--isao" for="username">
						<span class="input__label-content input__label-content--isao"><!-- Username --></span>
					</label>
				</span>
			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<label><?php
						if(isset($error_password)){
							echo "$error_password";	
						}
						else{
							echo nl2br("\n");
						}?>
					</label>
					<input type="password" class="input__field input__field--isao" name="password" id="password" value="" placeholder="Password" required/>
					<label class="input__label input__label--isao" for="password">
						<span class="input__label-content input__label-content--isao"><!-- Password --></span>
					</label>
				</span>
			</div>
			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<label><?php
						if(isset($error_newpassword)){
						echo "$error_newpassword";	
						}
						else{
							echo nl2br("\n");
						}?>
					</label>
					<input type="password" class="input__field input__field--isao" name="newpassword" placeholder="Confirm Password" id="password" value="" required/>
					<label class="input__label input__label--isao" for="newpassword">
						<span class="input__label-content input__label-content--isao"><!-- Confirm Password --></span>
					</label>
				</span>
			</div>
			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<label><?php
						if(isset($error_email)){
							echo "$error_email";	
						}
						else{
							echo nl2br("\n");
						}?>
					</label>
					<input class="input__field input__field--isao" type="email" name="email" placeholder="E-mail" value="<?= isset($_POST['email'])? $_POST['email']:null?>" required />
					<label class="input__label input__label--isao" for="e-mail">
						<span class="input__label-content input__label-content--isao"></span>
					</label>
				</span>
			</div>

			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<label><?php
						if(isset($error_fname)){
							echo "$error_fname";	
						}
						else{
							echo nl2br("\n");
						}?>
					</label>
					<input class="input__field input__field--isao" placeholder="First Name" type="text" name="fname" id="fname"  value="<?= isset($_POST['fname'])? $_POST['fname']:""?>" required />
					<label class="input__label input__label--isao" for="fname">
						<span class="input__label-content input__label-content--isao"></span>
					</label>
				</span><br>
			</div>
			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<label><?php
						if(isset($error_lname)){
							echo "$error_lname";	
						}
						else{
							echo nl2br("\n");
						}?>
					</label>
					<input class="input__field input__field--isao" placeholder="Last Name" type="text" name="lname" id="lname" value="<?= isset($_POST['lname'])? $_POST['lname']:""?>" required/>
					<label class="input__label input__label--isao" for="lname">
						<span class="input__label-content input__label-content--isao"></span>
						</label>
				</span><br>
			</div>
			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<label><?php
							if(isset($error_message)){
								echo "$error_message";	
							}
							else{
								echo nl2br("\n");
						}?>
					</label>
					<input class="input__field input__field--isao" type="text" name="student_no" id="student_no" value="<?= isset($_POST['student_no'])? $_POST['student_no']:null?>" placeholder="20XX-XXXXX" required />
					<label class="input__label input__label--isao" for="student_no">
						<span class="input__label-content input__label-content--isao"></span>
					</label>
				</span><br> 
			</div>				

			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<input class="input__field input__field--isao" type="date" name="bdate" id="bdate" placeholder="Date of Birth" value="<?= isset($_POST['bdate'])? $_POST['bdate']:null?>" required/><br>
					<label class="input__label input__label--isao" for="bdate">
						<span class="input__label-content input__label-content--isao"></span>
					</label>
				</span>
			</div>
			<div class="form-group">
				<span style="width: 140%;" class="input input--isao">
					<input class="inputfile inputfile-6" type="file" name="fileToUpload" id="fileToUpload" value="<?= isset($_POST['fileToUpload'])? $_POST['fileToUpload']:null?>"/>
					<label class="input__label input__label--isao" for="pic">
						<span class="input__label-content input__label-content--isao">Profile Picture</span>
					</label>
				</span>
			</div>	

			<div class="form-group">
				<span style="width: 140%" class="input input--isao">
					<select name="degree" class="form-control" id="degree" value="<?= isset($_POST['degree'])? $_POST['degree']:null?>">
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
					<label class="input__label input__label--isao" for="degree">
						<span class="input__label-content input__label-content--isao">Degree and Year</span>
					</label>
				</span>
			</div>
			<div class="form-group">
				<span style="width: 140%" class="input input--isao">
				<select name="year" class="form-control" id="year" value="<?= isset($_POST['year'])? $_POST['year']:null?>">
					<optgroup label="Year Level">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5 and above</option>
					</optgroup>
				</select>
				<label class="input__label input__label--isao" for="year">
				<span class="input__label-content input__label-content--isao">Year Level</span>
					</label>
				</span>
				<br><br>
			</div>	

				<span style="width: 113%" class="input input--isao">
				<button type="submit" class="btn btn-primary btn-lg" id="submit-btn" value="submit" name="Submit"> Submit </button>
				</span>
			</form>
			<a href="login.php"><button id="login-btn" role="button" class="btn btn-danger btn-md">Back</button></a>
		</div>
	</div>	
	<script src="../bootstrap/js/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"</script>	
</body>
</html>