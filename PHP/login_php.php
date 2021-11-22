<?php
require ('configuration.php');
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
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		// hashing the password
        $pass = md5($pass);

        $connection_data=configBD("conexion.xml");
        $bd= new PDO($connection_data[0],$connection_data[1],$connection_data[2]);

        
		$sql = "SELECT * FROM users WHERE mail_Name='$mail' AND password='$pass'";

		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) === 1) {
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