<?php
  include 'functions.php';
  connection();
  session_start();
  redirect2();
  date_default_timezone_set("Asia/Singapore");
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>ORG SYSTEM A.Y. 2016-2017</title>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/login.css">
		<!-- <link rel="stylesheet" type="text/css" href="../css/newstyle.css" />
		<link rel="stylesheet" type="text/css" href="../css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../css/set1.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	</head>
	<?php
	if(isset($_POST['submit'])){
		$uname=$_POST['username'];
		$pword=md5($_POST['password']); 
		if(empty($uname)||empty($pword)){
			$message="Please fill-up the fields below!";
		} else if(!empty($uname)&&!empty($pword)){
			$number=checker($uname, $pword);
			if($number==0){
				$message="Wrong username/password!";
			} else{
				$user_id=mysqli_fetch_assoc(select($uname, $pword));
				$_SESSION['user_id']=$user_id['user_id'];
				$_SESSION['username']=$user_id['username'];
				header("Location: home.php");
			}
		} else{ $message=""; }
	} else{ $message=""; } ?>
	<body>
		<div class="container flex">
			<h1 class="title">Org-y</h1>
			<div class="form-box flex">
				<h2>Login</h2>
				<form method="post" class="form flex">
					<?php if($message!=""){ ?>
						<p class="message"><?php echo $message;?></p>
					<?php } ?>
					<div>
						<label for="username"><span class="glyphicon glyphicon-user"></span></label>
						<input type="text" name="username" placeholder="Username" autocomplete="off"/>
					</div>
					<div>
						<label for="password"><span class="glyphicon glyphicon-lock"></span></label>
						<input type="password" name="password" placeholder="Password" placeholder="Password"/>
					</div>
					<input type="submit" name="submit" value="Log In">
				</form>
				<p class="signup-text">Don't have an account?</p>
				<a href="signup.php" class="signup-link"> Sign Up </a>
			</div>
		</div>
	</body>
</html>