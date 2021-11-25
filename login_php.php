<?php
require_once ('configuration.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


	var_dump($_POST['name']);
	var_dump($_POST['password']);
	$name = ($_POST['name']);
	$pass= ($_POST['password']);
	
	var_dump($name);
	var_dump($pass);
	if (empty($name)) {
		header("Location: index.php?error=user Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
        
		$query1 = "SELECT * FROM users WHERE name like'$name'";
		$result = $conn->query($query1);
		$result = $result->fetch();
		var_dump($result);
		if ($result['name']==$name &&  password_verify($_POST['password'],$result['password'])) {
			$_SESSION['name']=$name;

			header("Location: home.php");

            
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