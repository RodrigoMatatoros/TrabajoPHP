<?php
require_once ('configuration.php');
session_start();

if (isset($_POST['mail']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$mail = validate($_POST['mail']);
	$pass = validate($_POST['password']);

	if (empty($mail)) {
		header("Location: index.php?error=Mail Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
        
		$query1 = "SELECT * FROM users WHERE email like'$mail' and password like '$pass'";
		$result = $conn->query($query1);
		$result = $result->fetch();
		if ($result['email']==$mail && $result['password']==$pass) {
			$_SESSION['email']=$mail;
			$user = $_SESSION['email'];

			echo "<script>window.open('home.php?email=$user','_self')</script>";

            
		}else{
			header("Location: index.php?error=Incorect mail_Name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}



?>