<?php
require ('configuration.php');
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
        try
        {
            $connection_data=configBD("conexion.xml");
            $bd= new PDO($connection_data[0],$connection_data[1],$connection_data[2]);
            //echo "Connected
        }catch(PDOException $e)
        {
            echo 'Database error:'.
            $e->getMessage();
        }
       
	    
        $query1 = "SELECT * FROM users WHERE mail_Name ='$correo'";
        
            $result= mysqli_query($bd,$query1);

            if(mysqli_num_rows($result)>0)
            {
                header("Location: RegistraseFormulario.php?error=The mail you try to use is taken try another&$correo");
                
            }else
            {
                $query2 ="INSERT INTO users(mail_Name,username,password,name,surname,date_Of_Birth)
                VALUES('$correo','$nombreU','$contraseña','$nombre','$apellido','$fecha')";

                $result2=  mysqli_query($bd,$query2);
                if($result2)
                {
                    header("Location: RegistraseFormulario.php?error=The mail you try to use is taken try another&$correo")
                    or die();
                }
                else{
                    header("Location: RegistraseFormulario.php?error=The information cannot be uploaded&$correo")
                    or die();
                }
            }
    }else
    {
        header();
    }


?>
