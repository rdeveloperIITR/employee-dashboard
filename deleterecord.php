<?php
session_start();
if(!$_SESSION['login']){
   header("location:account.php");
    die;
}

$q = intval($_GET['q']);
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
// sql to delete a record
$sql = "DELETE FROM details WHERE id = '".$q."'";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo  mysqli_error($conn);
}
$conn->close();
?>