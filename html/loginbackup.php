<?php
  include 'functions.php';
  connection();
  session_start();
  redirect2();
?>
<!DOCTYPE html>
<html style="height: 100%; width: 62.5%;">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .orgy{
      font-size: 700%;
      /*float: left;*/
      /*margin-left: 10%;*/
      position: fixed;
      top: 16%;
      left: 28%;
      font-family: 'Arca Majora 3 Bold', sans-serif;
      color: #af484e;
       /*-webkit-text-stroke: 1px #FF847C;*/
    }

    h1{
      font-size: 400%;
      width: 100%;
      /*text-shadow: 4px 4px 8px #000000;*/
      border: none;
      font-family: 'Arca Majora 3 Bold', sans-serif;
      margin-top: -5%;
      margin-left: -46%; 
/*      margin-top: -20%;
      margin-left: -5%;*/
      padding: 5%;
      text-align: center;
    }

    h2{
      font-size: 400%;
      width: 100%;
      /*text-shadow: 4px 4px 8px #000000;*/
      font-family: 'Arca Majora 3 Bold', sans-serif;
      margin-top: -20%;
      margin-left: -5%;
      padding: 5%;
      text-align: center;
    }
    label{
      display: inline; 
      font-family: 'Calibri', serif;
      color: white;
      /*text-shadow: 4px 4px 8px blue;*/
      font-size: 120%;
      margin-right: 5%;
    }
    #nuj{
      background-image: url("../images/Oble1.png");
          background-repeat:no-repeat;
        background-position: 38% 100%;
        background-attachment: fixed;
        background-size: 110% 100%;
        color:#fff
    }
    #login-form{
      margin-top: 20%;
      text-align: center;
    }
    #edit_login{
     /* right: 15%;*/
     /* width: 303.469px;
      height: 208.234px;*/
      background: #a12830;
      background-color: rgba(161, 40, 48, 0.85);
      border-radius: 1%;
      float: right;
      padding: 5%;
      margin-top: 7%;
      margin-right: -53%;
      width: 25%;

    }

    #signup_link{

      padding: 1%;
      margin-left: 30%;
      padding-left: 7%;
      padding-right: 7%;
    }
    .username, .password{
      font-family: 'Calibri', sans-serif;
      padding: 2%;
      float: right;
      border: 0;
      font-size: 100%;
      width: 100%;
      margin-top: 4%;
      margin-bottom: 3%;
      margin-right: -3.5%;
      background-color: #af484e;
      text-align: center;
      border: 2px solid #ff847c;
      color: white;
      
    }


    #log{
      border: 2px solid #2a363b;
      float: right;
      margin-right: 13%;
      font-size: 100%;
      padding: 4.5%;
      margin-top: 17%;
      min-width: 165px;
      max-width: 250px;
      background: #2a363b;
      color: white;
      border-radius: 5%;
    }

   #log:hover{ 
      outline: none;
      transition:200ms all ease;
      border: 2px solid #fecea8;
      background: #e84a5f;
    }
    #log, #signUp > span{
      vertical-align: middle;  
    }
    #signUp{
      border: none;
     /* float: right;*/
      margin-right: -100%;
      /*font-size: 100%;*/
      margin-top: -7%;

    }

    p{
      font-family: 'Arca Majora 3 Bold', sans-serif;
      color: black;

    }
  

    #signUp, #log{
     /* display: inline-block;*/
      float: right;
      clear: both;
    
    }
    a{
      font-family: 'Arca Majora 3 Bold', sans-serif;
      color: black;
    }

    a:hover{
      color: #af484e;
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
    <h2 style="color: #2a363b;;">Log in</h2>
    
    <!-- Gin kakas ko ang label nga username kag password kay ka redundant sa iya, since may placeholder pa gd sya nga username kag password - L. -->

    <p style="margin-top: 30px; text-align: center; color: white; width: 100%;"><?php echo $message; echo "<br>"; ?></p>  
    <form method="post" id="login-form">
     <!--  <label for="username">Username:</label> -->
      <input type="text" class="username" name="username" value="" placeholder="Username" autofocus/>
      <br><br>
     <!--  <label for="password">Password:</label> -->
      <input id = "username" type="password" class="password" name="password" value="" placeholder="Password"/>
      <br>
      <input id="log" type="submit" name="submit" value="Log In"/>
    </form>
  </div>
      <!-- <button id="signUp"> -->
  <div id="signup_link">
      <p style="padding-top: 3%; padding-left: 65%; margin-left: 85% ; margin-top: 93%; width: 100%;">Don't have an account?</p>
      <a href="signup.php" style="text-decoration: none;" id = "signUp"> Sign Up </a></button>
  </div>
</body>
</html>