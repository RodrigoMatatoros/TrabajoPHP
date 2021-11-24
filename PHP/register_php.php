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
        $password = validate($_POST['password']);
        //$picture = validate($_POST['fileToUpload']);
        /*$salt = "codephp";
        $password_encrypted= sha1($pass,$salt);*/
        $picture =upload();
        
        //connection to the database
        

        $query1 = "SELECT * FROM users WHERE email like '$mail'";
        
            $result = $conn->query($query1);
            if($result ->rowCount() >0)
            {
                header("Location: RegistraseFormulario.php?error=The mail you try to use is taken try another&$mail");
                
            }else
            {
                //$query2 ="INSERT INTO users(name,password,email,picture,date)
                // VALUES($name,$password,$mail,$picture,$date)";
                
                $query2 = "insert into users(name,password,email,picture,date) values('$name','$password','$mail','$picture','$date')";
                $result2  = $conn->query($query2);
                //$result2=mysqli_query($conn,$query2);
                if($result2)
                {
                    header("Location: LogearseFormulario.php");
                }
                else{
                    echo("okasda");
                    //header("Location: RegistraseFormulario.php?error=The information cannot be uploaded&$mail");
                }
            }
    }else
    {
        header("FormularioInicial.html");
    }


?>
