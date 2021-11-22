<?php
require_once('configuration.php');
session_start();

    if(isset($_POST['nombre'])&& isset($_POST['apellido'])&& isset($_POST['nombreUsuario'])
    && isset($_POST['fechaNacimiento'])&& isset($_POST['correo'])&& isset($_POST['contraseña']))
    {
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $nombre = validate($_POST['nombre']);
        $apellido = validate($_POST['apellido']);
        $nombreU = validate($_POST['nombreUsuario']);
        $fecha = validate($_POST['fechaNacimiento']);
        $correo = validate($_POST['correo']);
        $contraseña = validate($_POST['contraseña']);

        $contraseña = md5($contraseña);
        //connection to the database
        
       var_dump($correo);
	    
        $query1 = "SELECT * FROM users WHERE mail_Name like '$correo'";
        
            $result= $bd->query($query1);

            if($result->rowCount()>0)
            {
                header("Location: RegistraseFormulario.php?error=The mail you try to use is taken try another&$correo");
                
            }else
            {
                $query2 ="INSERT INTO users(mail_Name,username,password,name,surname,date_Of_Birth)
                VALUES('$correo','$nombreU','$contraseña','$nombre','$apellido','$fecha')";

                $result2= $bd->query($query2);
                if($result2)
                {
                    header("Location: RegistraseFormulario.php?error=Your account has been uploaded&$correo")
                    or die();
                }
                else{
                    header("Location: RegistraseFormulario.php?error=The information cannot be uploaded&$correo")
                    or die();
                }
            }
    }else
    {
        header("FormularioInicial.html");
    }


?>
