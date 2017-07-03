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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM details";
$result = $conn->query($sql);
$emparray = array();
while($row =mysqli_fetch_assoc($result)){
    $emparray[] = $row;
}
echo json_encode($emparray);
$conn->close();
?>