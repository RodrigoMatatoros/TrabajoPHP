<?php
require_once('configuration.php');
require_once('functions.php');
session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        $name = validate($_POST['user_name']);
        $mail = validate($_POST['mail']);
        $date = validate($_POST['date_of_birth']);
        $picture =upload();
        
        //encrypt password
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

        $query1 = "SELECT * FROM users WHERE email like '$mail'";
        //connection to the database
            $result = $conn->query($query1);
            if($result ->rowCount() >0)
            {
                header("Location: RegistraseFormulario.php?error=The mail you try to use is taken try another&$mail");
                
            }else
            {
                //insert values in the database
                $query2 = "insert into users(name,password,email,picture,date) values('$name','$password','$mail','$picture','$date')";
                $result2  = $conn->query($query2);
               
                if($result2)
                {
                    header("Location: LogearseFormulario.php");
                }
                else{
                    echo("okasda");
                    header("Location: RegistraseFormulario.php?error=The information cannot be uploaded&$mail");
                }
            }
    }else
    {
        header("FormularioInicial.html");
    }


?>
