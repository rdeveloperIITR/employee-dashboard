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
 //values from POST request
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $name=$_POST["name"];
	 $designation=$_POST["designation"];
	 $salary=$_POST["salary"];
	 
	 //Insert values in database
	 // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
     }
	 
	 $sql = "INSERT INTO details (EmployeeName,Designation,Salary) VALUES ('$name', '$designation', '$salary')";
     if ($conn->query($sql) === TRUE){
			header('Location:dashboard.php');
     } else {
            echo $conn->error;
     }

     $conn->close(); 
 }
?>
