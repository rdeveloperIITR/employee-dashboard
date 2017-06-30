<?php
 session_start();
 if(!$_SESSION['login']){
   header("location:account.php");
    die;
 }

 $servername = "localhost";
 $username = "root";
 $password = "qwerty";
 $dbname = "employeedb";
 
 //values from GET request
 $name = $email = $psw = $hash="";
 $secret="qwerty";
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $name=$_POST["name"];
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
	 
     $sql = "INSERT INTO account (Email,Name,Hash) VALUES ('$email', '$name', '$hash')";
     if ($conn->query($sql) === TRUE){
            echo "Success";
     } else {
            echo $conn->error;
     }  
	 
     $conn->close(); 
 }
?>
