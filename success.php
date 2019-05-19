<?php 
include("dbconnect.php");

 session_start(); 
 if(isset($_SESSION["username"])) 
 { 
 	?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="newstyle.css">
</head>
<body>
<div class="form-wrapper"> 
    <center><h3>Welcome!</h3></center>
	 <div class="reminder">
    <p><a href="logout.php">Log out</a></p>
  </div>
</div>

</body>
</html>
<?php
 	
 }else{ 
 	
 	header("location:index.php"); 
 } 
?>
