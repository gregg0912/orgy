<?php 
	session_start();
	include 'functions.php';
	connection();
	ob_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ORG SYSTEM A.Y. 2016-2017</title>
		<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
		<style type="text/css">
			@import url('https://fonts.googleapis.com/css?family=Montserrat|PT+Sans');
			@font-face{
				font-family: "Arca Majora 3 Bold";
				src: url("../fonts/ArcaMajora3-Bold.otf") format("opentype");
			}
		    label{
		    	font-family:'PT Sans', sans-serif;
			    color: white;
			    font-size: 80%;
			   /* margin-right: 5%;*/
		    }
		    h1{
		     	font-size: 200%;
		      	color: #750412;
		      	font-family: 'Arca Majora 3 Bold', sans-serif;
		      	text-align: center;
		      	width: 100%; 
			   text-align: center; 
			   border-bottom: 1px solid #000; 
			   line-height: 0.1em;
			   margin-bottom: 8%;
		    }
		    h1 span{
			    background:#fff; 
	    		padding:0 10px;
			}
			h2, h3{
		    	font-size: 99%;
			    color: white;
			    font-family: 'Arca Majora 3 Bold', sans-serif;
			    margin-bottom: 4%;
			    /*padding: 2%;*/
			    text-align: center;
		    }
		    legend{
		     	font-size: 150%;
		      	color: white;
		      	/*text-shadow: 4px 4px 8px #000000;*/
		      	font-family: 'Arca Majora 3 Bold', sans-serif;
		      	margin: 0%;
		      	text-align: center;
		    }
		    input{
		    	font-size: 90%;
		    	margin-left: 20%;
		    	width: 50%;
		    	padding: 0.2%;
		    	border-radius: 3%;
		    	font-family: 'PT Sans', sans-serif;
		    	border-color:white;
		    	box-shadow: none;
		    }
		    input:focus{
		    	border-color:red;
		    	box-shadow:none;
		    }
		    p{
		    	margin-right: 1%;
		    	font-size: 100%;
		    	color: white;
		    	font-family: 'PT Sans', sans-serif;
		    }
    		#nuj{
			    background-image: url("../images/Oble1.png");
			    background-repeat:no-repeat;
		 		background-position: 38% 100%;
		 		background-attachment: fixed;
		 		background-size: 110% 100%;
		 		color:#fff
			}
			#sign_up{
			    background: #a12830;
			    background-color: rgba(161, 40, 48, 0.85);
			    border-radius: 1%;
			    float: right;
			    right: 15%;
			    padding: 1%;
			    margin: 2%;
			  	max-width: 25%;
			}
			#sign-up_buttons{
				margin-left: 23%;
				margin-bottom: 5%;
			}
			#submit-btn{
			  border: none;
		      font-size: 100%;
		      padding: 3%;
		      margin-top: 2%;
		      border: 2px solid #2a363b;
		      margin-bottom: 2%;
		      margin-left: 25%;
		      min-width: 165px;
		      max-width: 250px;
		      background: #2a363b;
		      color: white;
		      border-radius: 5%;
		      font-family: 'PT Sans', sans-serif;
			}
			input[type="file"]{
				border: none;
		      font-size: 100%;
		      padding: 1%;
		      margin-top: 2%;
		      width: 50.5%;
		      /*border: 2px solid #2a363b;*/
		      margin-bottom: 2%;
		   /*   margin-left: -10%;*/
		      /*margin-right: 20%;*/
		      background: #af484e;
		      color: white;
		      border-radius: 5%;
		      font-family: 'PT Sans', sans-serif;
			}
			input:focus{
				border-color:white;
				box-shadow:none;
			}
			select{
				font-family: 'PT Sans', sans-serif;
			}
			#submit-btn:hover{ 
		      outline: none;
		      background: #e84a5f;
		       border: 2px solid #fecea8;
		    }
		    footer{
				margin: 10px 20px 0 0;
				text-align: center;
				font-family: Arial;
				padding: 10px 0 10px;
				height: 20px;
				background-color: #892b38;
				color: white;
				width: 100%;
				float: left;
				margin-top: 10%;
				position: fixed;
			}
			p{
				font-size:10px;
				text-align:center;
				font-family: 'PT Sans', sans-serif;
			}
			input[type="text"], input[type="password"], input[type="email"], input[type="date"]{
				font-family: 'Calibri', sans-serif;
		      padding: 2%;
		      float: right;
		      border: 0;
		      font-size: 100%;
		      width: 70%;
		      /*margin-top: 4%;*/
		      margin-bottom: 2.5%;
		      margin-right: 12%;
		      background-color: #af484e;
		      text-align: center;
		      border: 2px solid #ff847c;
		      color: white;
			}
			#degree, #year{
/*				padding: 2%;*/
		      float: right;
		      border: 0;
		      font-size: 100%;
		      /*width: 40%;*/
		      /*margin-top: 4%;*/
		      margin-bottom: 2.5%;
		      margin-left: 1%;
		      margin-right: 12%;
		      background-color: #af484e;
		      text-align: center;
		      border: 2px solid #ff847c;
		      color: white;
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
		<div id="sign_up">
			<h1><span>SIGN UP</span></h1>
			<form method="post" id = "signup-form">
				<!-- <fieldset id="field_set"> -->
					<h3 id="someting">With</h3>
					<div id="sign-up_buttons">
						<button style="padding: 1%; background-color: transparent; border: none;"><img id="signimg" src="../images/fb4.png"/></button>
						<button  style="padding: 1%; background-color: transparent; border: none;"><img id="signimg" src="../images/twitter2.png"></button>
						<button style="padding: 1%; background-color: transparent; border: none;"><img id="signimg" src="../images/gm2.png"></button>
					</div>
				<!-- </fieldset> -->
			</form>	
			<div>
				<h3>Or</h3>	
				<form id="signup-form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<label for="username" class="info"></label>
					<input type="text" name="username" id="username" value="<?= isset($_POST['username'])? $_POST['username']:""?>" placeholder="Username" autofocus required/>
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
								<option>--</option>
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