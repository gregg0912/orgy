 	<?php
	session_start();
	include ("functions.php");
	redirect();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>ORG SYSTEM A.Y. 2016-2017</title>
	
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/newstyle.css">
 
	<style>
		.form-group{
			width: 50%;
			margin-left: 5%;
			margin-top: 2%;
		}
		.btn{
			margin-top: 3%;
			margin-left: 5%;
		}

		/*body{
			margin-top: -0.75%;
		}
		input[type=text], input[type=password], input[type=date], input[type=email]{
			font-family: 'PT Sans', serif;
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
		select{
			font-family: 'PT Sans', serif;
			font-size: 100%;
		    background-color: white;
		    color: black;
		    border: none;
		    padding: 10px  10px;
		    border-radius: 4px;
		    width: 70%;
		    margin-bottom: 20px;

		}
		#year{
			font-family: 'PT Sans', serif;
			width: 20%;
		}
		#fileToUpload{
			font-family: 'PT Sans', serif;
		}
		.btn2{
		border: none;
		cursor: pointer;
		padding: 2%;
		display: inline-block;
		text-transform: uppercase;
		outline: none;
		-webkit-transition: all 0.3s;
		-moz-transition: all 0.3s;
		transition: all 0.3s;
		font-family: 'Montserrat', sans-serif;
		}
		.btn2:after {
			position: absolute;
			z-index: -1;
			-webkit-transition: all 0.3s;
			-moz-transition: all 0.3s;
			transition: all 0.3
		}
		.btn-2a:hover, .btn-2a:active {
			color: black;
			background: #fff;
		}*/
	</style>
	<title>ORG SYSTEM A.Y. 2016-2017</title>
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

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
		        	}
		        	else{
						$getuserid = $_SESSION['user_id'];
						$getusername = $_SESSION['username'];
						$getfname = $_POST["fname"];
						$getlname = $_POST["lname"];
						$getemail = $_POST["email"];
						$getbirthdate = date('Y,m,d', strtotime($_POST["bdate"]));
						$getdegree = $_POST["degree"];
						$getyear = $_POST["year"];
						$getemail = $_POST["email"];

						$file=$_FILES['fileToUpload'];
						if(!isset($file)){
							$file=$info['prof_pic'];
						}
						
						$target_dir = "../images/";
						$target_file = $target_dir . basename($file["name"]);
						move_uploaded_file($file["tmp_name"], $target_file);
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
						$sql="UPDATE user 
								SET first_name='$getfname', last_name='$getlname', course='$getdegree', birthday='$getbirthdate', year_level='$getyear', email = '$getemail', prof_pic = '$target_file'
									WHERE user_id='$getuserid'";
						querySignUp($sql);


						$prompt="You have successfully updated your account!";
						header('Location: edit.php');
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
<div class = "container">	

		<?php	$start=0;
				$lim=3;

				if(isset($_GET['id'])){
					$id=$_GET['id'];
					$start=($id-1)*$lim;
				}
				else{
					$id=1;
				} ?>
		<div id="wrapper">
		    <nav id="general" class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		        <ul class="nav nav-pills nav-stacked" id="navigation" >
		            <?php 
		            $current_id = $_SESSION['user_id'];
		            $query2 = mysqli_query($connectdb, "select * from user where user_id = $current_id"); 
		            while($current_user= mysqli_fetch_array($query2)){ ?>
		            <li id="liTo"><a href = 'viewprofile.php?user_id=<?=$current_id?>'><?php echo $current_user['username'] ?></a></li>
		            <li><img id = "prof_pic" src="../images/<?php echo $current_user['prof_pic'] ?>"/></li><?php } ?>
		            <li><input id="searchbar" type="search" name="search" placeholder="Search Orgs"></li>
		            <li><a href="home.php">Home</a></li>
		            <li><a href="bootexplore.php">Explore</a></li>
		            <li class="dropdown" id="dropFilter">
		                <a class="dropdown-toggle" data-toggle="dropdown" href="bootgroups.php">Groups<span class="caret caret-right "></span></a>
		                    <ul class="dropdown-menu">
		                    <?php
		                    $pending = "%pending%";
		                    $query2 = "SELECT orgs.org_id, orgs.org_name
		                                FROM joined, orgs
		                                WHERE joined.user_id = '".$_SESSION['user_id']."' AND joined.org_id = orgs.org_id AND joined.membership_type NOT LIKE '".$pending."'";
		                    $result2 = mysqli_query($connectdb, $query2);
		                    while(list($org_id2, $orgName2) = mysqli_fetch_row($result2)){
		                    ?>
		                      <li><a href="bootgroup_page.php?orgID=<?=$org_id2?>"><?=$orgName2?></a></li>
		                    <?php
		                    }
		                    ?>
		                    </ul>
		                
		            </li>
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
		    </nav>
		</div>	    
	</div>	
	<div class="jumbotron">
		<div id="content" class="container">
			<div id="wrapper">
				<div class="page-header">
				<h2>Edit Your Profile</h2>
				</div>
				<p>
					<span class="error"><?php echo $duplicateErr . $passwordErr . $oldpasswordErr . $newpasswordErr . $retypenewpasswordErr . $submitErr;?></span>
					<span class="success"><?php echo $prompt;?></span>
				</p>
				<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				   <div id="edit_profile">
					  <ul>					  	
					  	<!-- add class = "form-control" in select and input -->
					  	<div class="form-group">
					      	<label id="currentuname_label" for="username">Username</label><br>
	          	  			<input class="form-control" id="currentuname_input" type="text" name="username" value="<?= $info['username']?>" disabled/><br>
					  	</div>
					    
					    <div class="form-group">
					    	
					    	<label for="fname">First Name</label><br>
							<input class="form-control"type="text" name="fname" value="<?= $info['first_name'] ?>"/><br>
					    </div>
						
						<div class="form-group">
							
					    	<label for="lname">Last Name</label><br>
							<input class="form-control"type="text" name="lname" value="<?= $info['last_name'] ?>"/><br>
						</div>
						
						<div class="form-group">
							
					    	<label for="student_no">Student Number</label><br>
							<input class="form-control"type="text" name="student_no" placeholder="20xx-xxxxx" value="<?= $info['student_no'] ?>" disabled/><br>
						</div>
						
						<div class="form-group">
							
					    	<label for="bdate">Date of Birth</label><br>
							<input class="form-control" type="date" name="bdate" value="<?= $info['birthday'] ?>" /><br>
						</div>
						
						<div class="form-group">
							
						    <label id="profilepic_label" for="img">Select New Profile Picture</label><br>
		  					<input class="form-control-file"id="fileToUpload" type="file" name="fileToUpload"  value="<?= $info['prof_pic']?>" /><br><br>			
						</div>
					    
					    <div class="form-group">
					    	<label for="degree">Degree Program</label><br>
					 				    		
							<select name="degree" class="form-control">
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
						</div>	
						<div class="form-group">
							<select name="year" id="year">
								<option><?= $info['year_level'] ?></option>
								<optgroup label="Year Level">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5 and above</option>
								</optgroup>
							</select><br>
						</div>	
					    
					    <div class="form-group">
					    	<label for="email">E-mail Address</label><br>
							<input class="form-control"type="email" name="email" value="<?= $info['email']?>"/><br>
						</div>	
					    
					    <div class="form-group">
					      	<label id="newpwd_label" for="newpwd">New Password</label><br>
	          	  			<input class="form-control"id="newpwd_input" type="password" name="newpwd" value=""/><br>
					    </div>
					    <div class="form-group">
	            			<label id="renewpwd_label" for="renewpwd">Retype New Password</label><br>
	          	 			<input class="form-control"id="renewpwd_input" type="password" name="renewpwd"  value=""/><br>
	          	 			<p style="font-size: 12px; margin-top: 4%;">To apply changes, please enter current password.</p>
	          	 		</div>
	          	 		<div class="form-group">
	          	 			<label id="currentpwd_label" for="currentpwd">Current Password</label><br>
	          	  			<input class="form-control"id="currentpwd_input" type="password" name="currentpwd" value=""/><br>
					    </div>
					    
					 		<input id="submit" class="btn btn-primary" type="submit" name="changepwd" value="Save Changes" />
					  </ul>
					</div>
				</form>
			</div>
		</div>
		<footer>CMSC 128 Section 1 | 2016</footer>
	</div>
		<script src="../bootstrap/js/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"</script>	
</body>
</html>