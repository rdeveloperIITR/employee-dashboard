<!DOCTYPE HTML>
<html>
<head>
<title>Login Page</title>
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" >
<link rel="stylesheet" type="text/css" href="css/account.css"></link>
</head>
<body>
<div class="imgcontainer">
    <img src="images/login.png" alt="Login" height="120px" width="120px">
</div>
<div class="login">
  <h3>Welcome</h3>
  <form  action="login.php" method="POST">
   <div class="loginform">
     <input type="email" name="email" placeholder="Enter Email" id="id_loginEmail" required> 
     <input type="password" name="password" placeholder="Enter Password" id="id_loginPsw" required>
     <button type="submit" class="loginbtn">Log In</button>
     <button type="button" class="signupbtn" onclick="document.getElementById('id_popUpWindow').style.display='block'">Sign Up</button>
   </div>
   </form>
</div>

<div id="id_popUpWindow" class="popUpWindow">
  <span onclick="document.getElementById('id_popUpWindow').style.display='none'" class="close-button" title="Close">x</span>
  <form class="popUpWindow-content animate" action="signup.php" method="POST">
    <div class="container">
      <input type="text" name="name" placeholder="Enter Name" id="id_SignUpName" required>
      <input type="email" name="email" placeholder="Enter Email" id="id_SignUpEmail" required>
      <input type="password" name="password" placeholder="Enter Password" id="id_SignUpPsw" required>
      <input type="password" name="password-repeat" placeholder="Repeat Password" id="id_SignUpPswRepeat" required>
      <input type="checkbox" id="id_SignUpChecked" checked="checked" required>By creating an account you agree to our <a href="#">Terms & Privacy</a>.
      <button type="submit">Sign Up</button>
    </div>
  </form>
</div>

</body>
</html>