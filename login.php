<?php
 session_start();
 $servername = "localhost";
 $username = "root";
 $password = "qwerty";
 $dbname = "employeedb";
 //values from POST request
 $email = $psw = $hash="";
 $secret="qwerty";
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
	 $email=$_POST["email"];
	 $psw=$_POST["password"];
	 $hash=hash('sha256', $secret . $psw);  //get the hash value using sha256 algorithm!
	 //Insert values in database
	 
	 // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
		   die("Connection failed: " . $conn->connect_error);
     }
	 $sql = "SELECT * FROM account WHERE Email = '".$email."'";
	 $result = $conn->query($sql);
	 
	 if(!$result){
		 die("No result found!");
	 }else{
		 $row = mysqli_fetch_array($result);
		 if($row['Hash']==$hash){
			  $_SESSION['login'] = true;
			  $_SESSION['name'] = '  '. $row['Name'];
			  $_SESSION['email'] = $email;
			  header('Location:dashboard.php');
         }
	 }
	 
     $conn->close();
 }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login Page</title>
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" >
<link rel="stylesheet" type="text/css" href="css/login.css"></link>
</head>
<body>
<div class="container">
  <div class="alert-msg">
    <span>Incorrect Email or Password !</span>
  </div>
  <div class="cancelbtn">
   <a href="cancel.php"><button type="button">Cancel</button></a>
  </div>
</div>
</body>
</html>
