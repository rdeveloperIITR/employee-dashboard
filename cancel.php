<?php 
  session_start();
  if(!$_SESSION['login']){
     header("location:account.php");
    die;
  }
?>