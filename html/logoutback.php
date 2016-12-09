<?php
  include 'functions.php';
  connection();
  session_start();
  redirect2();
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    .orgy{
      font-size: 1000%;
      float: left;
      margin-left: 10%;
      position: fixed;
    }
    h2{
      font-size: 500%;
      color: white;
      /*text-shadow: 4px 4px 8px #000000;*/
      font-family: 'Helvetica', sans-serif;
      margin: 0%;
      text-align: center;
    }
    label{
      display: inline; 
      font-family: 'Calibri', serif;
      color: white;
      /*text-shadow: 4px 4px 8px #000000;*/
      font-size: 150%;
      margin-right: 5%;
    }
    #nuj{
      background-image: url("../images/Oble.png");
      background-repeat: no-repeat;
      background-size: 60%;
      background-position: 33% 100%;
      background-attachment: fixed;
    }
    #login-form{
      margin-top: 20%;
      text-align: center;
    }
    #edit_login{
      background: #a12830;
      /*-o-box-shadow:0 3px 4px rgba(0,0,0,.5);*/
      /*-moz-box-shadow:0 3px 4px rgba(0,0,0,.5);*/
      /*-webkit-box-shadow:0 3px 4px rgba(0,0,0,.5);*/
      /*box-shadow: 0 3px 4px rgba(0,0,0,.5);*/
      border-radius: 2%;
      float: right;
      margin-top: 8%;
      padding: 2%;
      margin-right: 12%;
        
    }
    .username, .password{
      font-family: 'arial', sans-serif;
      padding-top: 2%;
      padding-bottom: 3%;
      float: right;
      border: 0;
      font-size: 100%;
      text-align: center;
    }
    #log{
      font-size: 100%;
      margin-top: 15%;
      padding-top: 3%;
      padding-left: 15%;
      padding-right: 15%;
      padding-bottom: 3%;
      margin-right: 25%;
      float: right;
      min-width: 150px;
      max-width: 250px;
      border: none;
      vertical-align: middle;
      position: relative;
      z-index: 1;
      background: #ECEFF1;
      color: #37474f;
    }
    #log, #signUp : focus{
      outline: none;
    }
    #log, #signUp > span{
      vertical-align: middle;
    }
    #signUp{
      border: none;
      float: right;
      margin-right: 25%;
      font-size: 100%;
      padding-top: 3%;
      padding-left: 15%;
      padding-right: 13%;
      padding-bottom: 3%;
      min-width: 150px;
      max-width: 250px;
      background: #ECEFF1;
      color: #37474f;
    }
    a{
      color: #37474f;
    }

  </style>
  <title>ORG SYSTEM A.Y. 2016-2017</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body id="nuj">
  <?php
    if(isset($_POST['submit'])){
      $uname=$_POST['username'];
      $pword=md5($_POST['password']); 

      if(empty($uname)||empty($pword)){
        $message="Please fill-up the fields below!";
      }
      else if(!empty($uname)&&!empty($pword)){
        $number=checker($uname, $pword);
        if($number==0){
          $message="Wrong username/password!";
        }
        else{
          $user_id=mysqli_fetch_assoc(select($uname, $pword));
          $_SESSION['user_id']=$user_id['user_id'];
          $_SESSION['username']=$user_id['username'];

          header("Location: home.php");
        }
      }
      else{
        $message=" ";

      }
    }
    else{
      $message=" ";   
    }
  ?>
  <h1 class="orgy">Org_y</h1>
  <div id="edit_login">
    <h2>Log in</h2>
    <p><?php echo $message ?></p>
    <form method="post" id="login-form">
      <label for="username">Username:</label>
      <input type="text" class="username" name="username" value="" placeholder="Username" autofocus/>
      <br><br>
      <label for="password">Password:</label>
      <input id = "username" type="password" class="password" name="password" value="" placeholder="Password"/>
      <br>
      <input id="log" type="submit" name="submit" value="Log In"/>
    </form>
    <button id="signUp"><a href="signup.php" style="text-decoration: none;"> Sign Up </a></button>
  </div>
</body>
</html>