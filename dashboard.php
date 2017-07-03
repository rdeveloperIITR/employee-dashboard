<?php 
  session_start();
   if(!$_SESSION['login']){
    header("location:account.php");
    die;
   }
 ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard</title>
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" >
<link rel="stylesheet" type="text/css" href="css/dashboard.css"></link>
</head>
<body>
<header class="headerSection">
 <nav class="profile">
    <li class="profile-logout">
	   <a href="logout.php"><input type="button" name="logout" value="Logout"></a>
	</li>
    <li class="profile-avatar">
	    <img src="images/avatar.png" height="60px" width="60px">
	</li>
	<li class="profile-info">
	   <span id="info-name">Welcome<?php echo  $_SESSION['name']; ?></span><br>
	   <span id="info-email"><?php echo  $_SESSION['email']; ?></span>
	</li> 
 </nav>
</header>

<section class="contentSection">
  <div class="employeeForm">
    <h3>Employee Details</h3>
    <form action="insertrecord.php" method="POST" >
      <input type="text" maxlength="20" name="name" placeholder="Employee Name" required>
      <input type="text" maxlength="20" name="designation" placeholder="Designation" required>
      <input type="number" name="salary" placeholder="0" required>
      <input type="submit" value="Save">
    </form>
  </div>

  <div class="search-container">
    <div class="box"> 
        <div class="search-box" >
         <input type="search" id="searchQuery" name="search" placeholder="Search.." onkeyup="updateDataTable(this.value)" onsearch="getFilterRecords(this.value)" >
        </div>
         <div class="search-button">
          <button type="submit" onclick="getFilterRecords(document.getElementById('searchQuery').value)">
          	<img src="images/searchicon.png"  height="15px" width="15px">
          </button>
        </div>
    </div>   
  </div>
  <div class="container" id="records">
  	 <h3 id="noRecords">No Records</h3>
  </div>
</section>
<!--script to retrieve,delete data from database using ajax in asynchronous manner-->
<script src="js/dashboard.js"></script>

</body>  
</html>