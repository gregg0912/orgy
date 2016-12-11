<?php
  include 'functions.php';
  connection();
  session_start();
  redirect2();
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
  <style type="text/css">
   body
        {
        background-image: url(../images/sample_background.jpg);
        background-attachment: fixed;
        }

    .form-login{
      background-color: #F9F4F4;
      /*border: 1px solid rgba(0, 0, 0, 0.5);*/
      border: 1px solid #333;
      padding: 1%;
      /*padding-bottom: 3%;*/

      /*border-radius: 6%;*/
      
      width: 28%;
      float: right;
      margin: 0%;
      margin-top: 5%;
      
    }

    #login-form > input
      {
      margin-bottom: 5%;
      }

    #orgy{
      font-size: 1200%;
      font-family: 'Lobster', cursive !important;
      /*font-family: 'Arca Majora 3 Bold', sans-serif !important;*/
      /*text-align: center;*/
      /*margin-top: 50%;*/
      margin-top: 5%;
      margin-right: -5%;
      color: rgba(255, 255, 255, 0.5);
      font-weight: normal;
      /*width: 25%;*/
    }
    #tag{
      width: 10%;
      margin-right: 0%;
    }
    /*#signup_link{
      margin-top: 5%;
      margin-left: 75%;
      
      float: right;

    } */

    #signup_link
      {
      margin-top: 5%;
      }

    .container{
      /*margin-top: 1%;*/
      margin-right: 12%;
      display: block;
      float: right;
    }
    #loginh2{
      color: #F8A241;
      margin-top: 1%;
    }
    #submit
      {
      border-radius: 0;
      width: 91%;
      }
    #signUp{
      color: #DF4040;
    }
    #signup_label{
      color: black;
    }
  </style>
  <title>ORG SYSTEM A.Y. 2016-2017</title>
</head>
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
  <body>
    <div class="container">
        <label id="orgy">Org_y</label><!-- 
        <label id='tag'>Sama-sama tayo!</label> -->
      <!-- <div class="row"> -->
        <!-- <div class="col-md-offset-5 col-md-3"> -->
          <div class="form-login">
            <h2 id="loginh2">Log in</h2>
            <form method="post" id="login-form">
              <p style="margin-top: 5%; text-align: center; color: black; width: 100%;"><?php echo $message; echo "<br>"; ?></p>
              <span class="input input--hideo">
                <input class="input__field input__field--hideo" type="text" id="input-41" name="username" placeholder="Username" value="" />
                <label class="input__label input__label--hideo" for="input-41">
                <i class="fa fa-fw fa-user icon icon--hideo"></i>
                <span class="input__label-content input__label-content--hideo">Username</span>
              </label>
            </span>
            <span style="margin-top: -1%" class="input input--hideo">
              <input class="input__field input__field--hideo" type="password" id="input-43" name="password" placeholder="Password" value="" />
              <label class="input__label input__label--hideo" for="input-43">
                <i class="fa fa-fw fa-lock icon icon--hideo"></i>
                <span class="input__label-content input__label-content--hideo">Password</span>
              </label>
            </span>
              <!-- <input type="text" class="form-control input-sm chat-input" name="username" value="" placeholder="Username"/><br>
              <input type="password" class="form-control input-sm chat-input" name="password" value="" placeholder="Password"/> --><br>
              <div class="wrapper_login">
                <span class="group_btn">
                  <input  class="btn btn-default btn-md" type="submit" id="submit" name="submit" value="Log In">
                </span>
              </div>
            </form>
            <div id="signup_link">
                <p id="signUp_label">Don't have an account?</p>
                <a style="" href="signup.php" id = "signUp"> Sign Up </a>
            </div>

          </div>
        <!-- </div> -->
      <!-- </div> -->
    </div>
    
    <script src="../js/classie.js"></script>
    <script>
      (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
          (function() {
            // Make sure we trim BOM and NBSP
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
              return this.replace(rtrim, '');
            };
          })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
          // in case the input is already filled..
          if( inputEl.value.trim() !== '' ) {
            classie.add( inputEl.parentNode, 'input--filled' );
          }

          // events:
          inputEl.addEventListener( 'focus', onInputFocus );
          inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
          classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
          if( ev.target.value.trim() === '' ) {
            classie.remove( ev.target.parentNode, 'input--filled' );
          }
        }
      })();
    </script>
  </body>
</html>