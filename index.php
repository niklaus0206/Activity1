 <?php   
session_start();
include("dbconnect.php");
if (isset($_SESSION["username"])) { 
  header('Location: success.php');
}
 ?>
 <!DOCTYPE html>  
 <html> 
      <head> 
           <title> APAS and Friends Login</title>  
           <link rel="stylesheet" type="text/css" href="newstyle.css">
      </head> 
      <body>  
                 <?php 
                     if(isset($message)) 
                     {  
                      echo '<label class="text-danger">'.$message.'</label>';  
                     } 
                 ?>   
 <div class="form-wrapper">
  
  <form method="post">
    <h3>Login here</h3>
	
    <div class="form-item">
		<input type="text" name="username" required="required" placeholder="Username" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="password" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
    <input type="submit" name="login" class="button" value="Login" /> 
    </div>
  </form>
      </body> 
 </html>
 <?php 
	 
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "login";
	$message = "";

	try {
		$connect = new PDO("mysql:host=$host; dbname=$database",$username,$password);
		 $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (isset($_POST["login"])) {
			# code...
			if(empty($_POST["username"])  || empty($_POST["password"]))
			{ 
        		$message = '<label>All field is required</lable>';
 
     		}
     		else
     		{
     			$query = "SELECT * FROM tbl_login WHERE username = :username AND password = :password";
     			$statement = $connect->prepare($query); 
          		$statement->execute(
          			array( 
                     'username'   =>   $_POST["username"], 
                     'password'   =>    $_POST["password"] 
                     ) 
          		);
          		$count = $statement->rowCount(); 
          			if($count > 0) 
          		{
          			$_SESSION["username"] = $_POST["username"]; 
              		header("location:success.php");
              	}
              	else
              	{
              		$message = '<label>Invalid Credentials</label>';
              	}
     		}
		}
	} catch (Exception $e) {
		
	}
?>