
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
		<!-- <link rel="stylesheet" type="text/css" href="style.css" /> -->
		<style type="text/css">
			@import url('https://fonts.googleapis.com/css?family=Montserrat|PT+Sans');
			/*@import url(https://fonts.googleapis.com/css?family=Roboto:300);*/
			@font-face{
				font-family: "Arca Majora 3 Bold";
				src: url("../fonts/ArcaMajora3-Bold.otf") format("opentype");
			}
		    label{
		    	font-family:'PT Sans', sans-serif;
			    color: white;
			    /*text-shadow: 4px 4px 8px #000000;*/
			    font-size: 99%;
			    margin-right: 5%;
		    }
		    h1{
		     	font-size: 200%;
		      	color: #750412;
		      	/*text-shadow: 4px 4px 8px #000000;*/
		      	font-family: 'Arca Majora 3 Bold', sans-serif;
		      	/*margin: 2%;*/
		      	text-align: center;
		      	width: 100%; 
			   text-align: center; 
			   border-bottom: 1px solid #000; 
			   line-height: 0.1em;
			   margin-bottom: 8%;
			   /*margin: 10px 0 20px;*/
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
		    	margin-left: 23%;
		    	width: 40%;
		    	padding: 0.2%;
		    	border-radius: 2%;
		    	font-family: 'PT Sans', sans-serif;
		    }
		    p{
		    	margin-right: 1%;
		    	font-family: 'Calibri', arial;
		    	font-size: 100%;
		    	color: white;
		    	font-family: 'PT Sans', sans-serif;
		    }
			/*.orgy{
			    font-size: 900%;
			    float: left;
			    color: #760422;
			    margin-left: 4%;
			    margin-top: 1%;*/
			    /*position: fixed;*/
	      /*text-shadow: 100px 10px 10px 10px;*/
	      /*border: 1%;*/
	    	/*} */
    		#nuj{
			    background-image: url("../images/Oble1.png");
			    background-repeat: no-repeat;
			    background-size: 115%;
			    background-position: 110% 0%;
			    background-attachment: fixed;
			    /*background-color: #4D4341;*/
			    /*position: fixed;*/
			}

/*			#agentAss{
				display:inline-block;
			}
			#yummyProxy{
				text-align: left;
			}*/

			#sign_up{
			    background: #a12830;
			    background-color: rgba(161, 40, 48, 0.85);
			    border-radius: 1%;
			    float: right;
			    right: 15%;
			    padding: 1%;
			    margin: 2%;
			  	max-width: 29%;
			}
			#sign-up_buttons{
				margin-left: 28%;
				margin-bottom: 5%;
			}
			#submit-btn{
			  border: none;
		      float: right;
		      margin-right: 30%;
		      font-size: 100%;
		      padding: 3%;
		      margin-top: 3%;
		      margin-bottom: 3%;
		      min-width: 165px;
		      max-width: 250px;
		      background: #2a363b;
		      color: white;
		      border-radius: 5%;
			}
			input:focus{
				border-color:white;
				box-shadow:none;
			}
			#submit-btn:hover{ 
		      outline: none;
		      /*transition:200ms all ease;*/
		      /*border: 2px solid #fecea8;*/
		      background: #e84a5f;
		    }
/*
			#signup-form>label, #signup-form>input {
				display: inline-block;
			}

			#signup-form>input{
				white-space: pre;	
			}

			fieldset>input, fieldset>label{
				display: inline-block;
			}

			#sign-up_buttons{
				text-align: center;
			}
*/
	/*		.cb-slideshow, .cb-slideshow:after {
				position: fixed;
				width: 100%;
				height: 100%;
				top: 0px;
				left: 0px;
				z-index: 0;
			}

			.cb-slideshow: after{
				content: '';
				background-image: transparent url("../images/Oble.png"); ;
			}

			.cb-slideshow li span { 
			    width: 100%;
			    height: 100%;
			    position: absolute;
			    top: 0px;
			    left: 0px;
			    color: transparent;
			    background-size: cover;
			    background-position: 50% 50%;
			    background-repeat: none;
			    opacity: 0;
			    z-index: 0;
			    animation: imageAnimation 36s linear infinite 0s; 
			}

			.cb-slideshow li div { 
			    z-index: 1000;
			    position: absolute;
			    bottom: 30px;
			    left: 0px;
			    width: 100%;
			    text-align: center;
			    opacity: 0;
			    color: #fff;
			    animation: titleAnimation 36s linear infinite 0s; 
			}

			.cb-slideshow li div h2 { 
			    font-family: 'BebasNeueRegular', 'Arial Narrow', Arial, sans-serif;
			    font-size: 240px;
			    padding: 0;
			    line-height: 200px; 
			}

			.cb-slideshow li:nth-child(1) span { 
			    background-image: url(../images/Oble.png) 
			}

			.cb-slideshow li:nth-child(2) span { 
			    background-image: url(../images/1.jpg);
			    animation-delay: 6s; 
			}

			.cb-slideshow li:nth-child(3) span { 
			    background-image: url(../images/2.png);
			    animation-delay: 12s; 
			}

			.cb-slideshow li:nth-child(4) span { 
			    background-image: url(../images/5.jpg);
			    animation-delay: 18s; 
			}

			/*
			.cb-slideshow li:nth-child(5) span { 
			    background-image: url(../images/5.jpg);
			    animation-delay: 24s; 
			}*/
			/*
			.cb-slideshow li:nth-child(6) span { 
			    background-image: url(../images/6.jpg);
			    animation-delay: 30s; 
			}
			*/
		/* 	.cb-slideshow li:nth-child(2) div { 
			    animation-delay: 6s; 
			}

			.cb-slideshow li:nth-child(3) div { 
			    animation-delay: 12s; 
			}

			.cb-slideshow li:nth-child(4) div { 
			    animation-delay: 18s; 
			}*/

			/*}
			.cb-slideshow li:nth-child(5) div { 
			    animation-delay: 24s; 
			}
			.cb-slideshow li:nth-child(6) div { 
			    animation-delay: 30s; 
			}*/

/*			@keyframes imageAnimation { 
				    0% { opacity: 0; animation-timing-function: ease-in; }
				    8% { opacity: 1; animation-timing-function: ease-out; }
				    17% { opacity: 1 }
				    25% { opacity: 0 }
				    100% { opacity: 0 }
			}

			@keyframes titleAnimation { 
				    0% { opacity: 0 }
				    8% { opacity: 1 }
				    17% { opacity: 1 }
				    19% { opacity: 0 }
				    100% { opacity: 0 }
			}
*/
			p{
				font-size:10px;
				text-align:center;
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
			<h1><span>ORG_Y</span></h1>
			<form method="post" id = "signup-form">
				<!-- <fieldset id="field_set"> -->
					<h2>Sign Up With</h2>
					<div id="sign-up_buttons">
						<button style="padding: 1%; background-color: transparent; border: none;"><img src="../images/fb4.png"/></button>
						<button  style="padding: 1%; background-color: transparent; border: none;"><img src="../images/twitter2.png"></button>
						<button style="padding: 1%; background-color: transparent; border: none;"><img src="../images/gm2.png"></button>
					</div>
				<!-- </fieldset> -->
			</form>	
			<div>
				<h3>Or You Can</h3>	
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
						
						<input type="file"  style="margin-left: 4%;" name="fileToUpload" id="fileToUpload" value="<?= isset($_POST['fileToUpload'])? $_POST['fileToUpload']:null?>"/><br><br>
						<label for="degree">Degree Program:</label>
						<select name="degree" id="degree" style="width: 170px; border-radius: 2%;"> value="<?= isset($_POST['degree'])? $_POST['degree']:null?>">
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
						
						<select name="year" id="year" value="<?= isset($_POST['year'])? $_POST['year']:null?>" style="margin-left: 7%; width:10%; border-radius: 2%;">
							<optgroup label="Year Level">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5 and above</option>
							</optgroup>
						</select><br><br>
						<br>
						<button style="margin-left: 44%;" type="submit" id="submit-btn" value="submit" name="Submit"> Submit </button>
						<!-- <br> -->
					</fieldset>
				</form>
			</div>
		</div>
		<footer>CMSC 128 Section 1 | 2016</footer>

</body>
</html>