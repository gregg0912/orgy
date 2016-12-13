 	<?php
	session_start();
	include ("functions.php");
	redirect();
	date_default_timezone_set("Asia/Singapore");
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
		$error_username = $error_fname = $error_lname = $error_newpassword = $error_renewpassword  = $error_currentpassword= "";
		$success_username = $success_fname = $success_lname = $success_email = $success_newpassword  = $success_degree= $success_yearlevel= "";
			
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
		$getpassword = $info['password'];



		
		// if ($_SERVER["REQUEST_METHOD"] == "POST" &&$_POST['currentpwd']!=""){
		// 		if(md5($_POST['currentpwd'])!=$info['password']){
		// 		$prompt="Current password not correct";
		// 	}
		// }

		
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['currentpwd'])&&$_POST['username']==$info['username']&&$_POST['fname']==$info['first_name']&&$_POST['lname']==$info['last_name']&&$_POST['degree']==$info['course']&&$_POST['year']==$info['year_level']&&$_POST['email']==$info['email']&&empty($_POST['newpwd'])&&empty($_POST['renewpwd'])&&$_FILES['fileToUpload']['size'] == 0){
				$prompt="No changes were made";
		}

		else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['currentpwd'])&&$_POST['username']==$info['username']&&$_POST['fname']==$info['first_name']&&$_POST['lname']==$info['last_name']&&$_POST['degree']==$info['course']&&$_POST['year']==$info['year_level']&&$_POST['email']==$info['email']&&empty($_POST['newpwd'])&&empty($_POST['renewpwd'])&&$_FILES['fileToUpload']['size'] == 0){
				$prompt="No changes were made";
		}

		
		else if ($_SERVER["REQUEST_METHOD"] == "POST" &&isset($_POST['currentpwd'])&&md5($_POST['currentpwd'])==$info['password']) {
			$file=$_FILES['fileToUpload'];
			$target_dir = "../images/";
			$target_file = $target_dir . basename($file["name"]);
			
			if($_FILES["fileToUpload"]["error"] != 0){
				$target_file=$info['prof_pic'];
			}
			move_uploaded_file($file["tmp_name"], $target_file);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$sql= "UPDATE user set prof_pic='$target_file' where user_id='$_SESSION[user_id]'";
			querySignUp($sql);

			if(isset($_POST['username'])&&$_POST['username']!=$info['username']){
				$length=strlen($_POST['username']);
				$pattern=preg_match("/^[\w]+$/",$_POST['username']);
				
				if($pattern==true&&$length>5||$length<16) {
					$query="SELECT * FROM user WHERE username='$_POST[username]'";
					$result = querySignUp($query);
					if($result->num_rows>0&&!($_POST['username']==$info['username'])){
						$error_username="Username $_POST[username] is already taken! ";		  
					}
					else{
						$query="UPDATE user set username='$_POST[username]' where user_id='$_SESSION[user_id]' ";
						$result = querySignUp($query);
						if($result){
							$success_username="Username changed successfully ";	
						}
					}
				}
				else{
					$error_username="Username should use letters,numbers,periods,or underscores. Min. length 6 and Max is 15.";
				}
			}

			if(isset($_POST['fname'])&&$_POST['fname']!=$info['first_name']){
				if(preg_match("/^[A-Z]([a-zA-Z-.]*[\ ]*)+$/",$_POST['fname'])) {
					$query="UPDATE user set first_name='$_POST[fname]' where user_id='$_SESSION[user_id]' ";
					$result = querySignUp($query);
						if($result){
							$success_fname="First name changed successfully ";	
						}
				}	
				else{
					$error_fname="First name: First letter should be capitalized (formality) and no space before";
				}
			}

			if(isset($_POST['lname'])&&$_POST['lname']!=$info['last_name']){
				if(preg_match("/^[A-Z]([a-zA-Z-.]*[\ ]*)+$/",$_POST['lname'])) {
					$query="UPDATE user set last_name='$_POST[lname]' where user_id='$_SESSION[user_id]' ";
					$result = querySignUp($query);
						if($result){
							$success_lname="Last name changed successfully ";	
						}
				}	
				else{
					$error_lname="Last name: First letter should be capitalized (formality) and no space before";
				}
			}

			if($_POST['newpwd']!=""){
				$length=strlen($_POST['newpwd']);
				$pattern=preg_match("/^([\d]*[a-zA-Z]*)+$/",$_POST['newpwd']);

				if($pattern==true&&$length>=6&&$length<=15) {
					// $success_newpassword="Password changed successfully";
					if($_POST['renewpwd']!=""){
						if($_POST['renewpwd']==$_POST['newpwd']) {
							$query="UPDATE user set password='$_POST[newpwd]' where user_id='$_SESSION[user_id]' ";
							$result = querySignUp($query);
							if($result){
								$success_newpassword="Password changed successfully";
							}
						}	
						else{
							$error_renewpassword="Passwords do not match! ";
						}
					}
					else{
						$error_renewpassword="Retype password";
					}
				}	
				else{
					$error_newpassword="Password should use letters or numbers only. Min. length 6 and Max is 15.";
				}
			}

			if(isset($_POST['email'])&&$_POST['email']!=$info['email']){
					$query="UPDATE user set email='$_POST[email]' where user_id='$_SESSION[user_id]' ";
					$result = querySignUp($query);
					if($result){
						$success_lname="Email changed successfully ";	
					}		
					else{
						//$error_lname="Last name: First letter should be capitalized (formality) and no space before";
					}
			}

			if(isset($_POST['degree'])&&$_POST['degree']!=$info['course']){
				
				$query="UPDATE user set course='$_POST[degree]' where user_id='$_SESSION[user_id]' ";
				$result = querySignUp($query);
					if($result){
						$success_lname="Course changed successfully ";	
					}
				else{
				}
			}

			if(isset($_POST['year'])&&$_POST['year']!=$info['year_level']){
				
				$query="UPDATE user set year_level='$_POST[year]' where user_id='$_SESSION[user_id]' ";
				$result = querySignUp($query);
					if($result){
						$success_lname="Year Level changed successfully ";	
					}
				else{
				}
			}
		
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
                <li><a href="notif.php">Notifications
                  <?php
                    $notifnum = mysqli_query($connectdb,"select * from announcement, seen_announcement where announcement.announcement_id = seen_announcement.announcement_id and seen_announcement.seen = 'not_seen'and seen_announcement.user_id='".$current_id."'");
                    $total2 = mysqli_num_rows($notifnum); ?>
					<span class="notif-count"><?php echo $total2 ?></span>
                </a></li>
                <li><a href="logout.php">Log Out</a></li>
	        </ul>
        </nav>   
		<div id="content">
			<h1 class="title">edit your profile</h1>
				<span class="success"><?php echo $prompt;?></span>
			<form class="edit" name="signup_form" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			    <label for="fileToUpload" class="buttoncustom change-picture"><span class="glyphicon glyphicon-picture"></span> Change Profile Picture </label>
				<input id="fileToUpload" type="file" name="fileToUpload"  value="<?= $getprofpic ?>"> 			

		      	<label for="username">Username</label>
  	  			<input type="text" name="username" value="<?= $getusername ?>" class="block">
  	  			<p> <?=$error_username?> </p>
  	  			<p> <?=$success_username?> </p>
		    
		    
		    	<label for="fname">Name</label>
				<input type="text" name="fname" value="<?= $getfname ?>" placeholder="First Name" class="fifty">
				<p> <?=$error_fname?> </p>
				<p> <?=$success_fname?> </p>
				<input type="text" name="lname" value="<?= $getlname ?>" placeholder="Last Name" class="fifty">
				<p> <?=$error_lname?> </p>
				<p> <?=$success_lname?> </p>
		    
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
		    	<p> <?=$success_yearlevel?> </p>
		    	<p> <?=$success_degree?> </p>
		    	<label for="email">E-mail Address</label>
				<input type="email" name="email" value="<?= $getemail ?>" class="block">
		    	<p> <?=$success_email?> </p>
		      	<label for="newpwd">Password</label>
  	  			<input type="password" name="newpwd" placeholder="New Password" class="fifty">
  	  			<p> <?= $error_newpassword ?> </p>
  	 			<input type="password" name="renewpwd"  placeholder="Retype Password" class="fifty">
  	 			<p> <?= $error_renewpassword ?> </p>
  	 			<p> <?=$success_newpassword?> </p>
  	 			<span class="validation">To apply changes, please enter current password</span>
  	  			<input type="password" name="currentpwd" placeholder="Current Password" class="block">
  	  			<p> <?= $error_currentpassword ?> </p>
		    
		    
		 		<input type="submit" name="changepwd" value="Save Changes" class="change-btn">
			</form>
			<footer>CMSC 128 Section 1 | 2016</footer>
		</div>
	</div>
</body>
</html>