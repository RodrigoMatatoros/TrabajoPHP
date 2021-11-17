<?php

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

        //Aqui para checkear que el usuario no esta ya creado
        $res = load_config(dirname(__FILE__)."/conexion.xml", dirname(__FILE__)."/conexion.xsd");
	    $db = new PDO($res[0], $res[1], $res[2]);
	    
        $query1 = "SELECT * FROM users WHERE mail_Name ='$correo'";
        
            $result= mysqli_query($res,$query1);

            if(mysqli_num_rows($result)>0)
            {
                header("Location: RegistrarseFormulario.html?error=The mail you try to use is taken try another&$correo")
                exit();
            }else
            {
                $query2 ="INSERT INTO users(mail_Name,username,password,name,surname,date_Of_Birth) 
                VALUES('$correo','$nombreU','$contraseña','$nombre','$apellido','$fecha',)";

                $result2=  mysqli_query($res,$query2);
                if($result2)
                {
                    header("Location: RegistrarseFormulario.html?error=The mail you try to use is taken try another&$correo")
                }
                else{
                    header("Location: RegistrarseFormulario.html?error=The information cannot be uploaded&$correo")
                    exit();
                }
            }
    }else
    {
        header()
    }
function
?>