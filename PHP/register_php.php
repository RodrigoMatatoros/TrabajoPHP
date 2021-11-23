<?php
require_once('configuration.php');
session_start();

    if(isset($_POST['name'])&& isset($_POST['mail'])&& isset($_POST['date_of_birth'])
    && isset($_POST['password'])&& isset($_POST['picture']))
    {
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $name = validate($_POST['name']);
        $mail = validate($_POST['mail']);
        $date = validate($_POST['date_of_birth']);
        $password = validate($_POST['password']);
        $picture = validate($_POST['picture']);

        
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
                $autoincrement = "ALTER TABLE users
                MODIFY `id` MEDIUMINT NOT NULL AUTO_INCREMENT";
                $auto = $conn ->query($autoincrement);
                $query2 = "insert into users(name,password,email,picture,date) values('$name','$password','$mail','$picture','$date')";
                $result2  = $conn->query($query2);
                //$result2=mysqli_query($conn,$query2);
                var_dump($result2);
                if($result2)
                {
                   echo("ok");
                    ///header("Location: RegistraseFormulario.php?error=Your account has been uploaded&$mail");
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
