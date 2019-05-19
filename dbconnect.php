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