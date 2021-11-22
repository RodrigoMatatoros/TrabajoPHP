<?php
require_once ('configuration.php');
session_start();

if (isset($_POST['correo']) && isset($_POST['contraseña'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$mail = validate($_POST['correo']);
	$pass = validate($_POST['contraseña']);

	if (empty($mail)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($password)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		// hashing the password
        $pass = md5($pass);
        
		$sql = "SELECT * FROM users WHERE mail_Name='$mail' AND password='$password'";

		$result = $bd->query($sql);

		if ($result->rowCount() === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['mail_Name'] === $mail && $row['password'] === $pass) {
            	$_SESSION['mail_Name'] = $row['mail_Name'];
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['date_Of_Birth'] = $row['date_Of_Birth'];
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect mail name or password");
		        exit();
			}
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