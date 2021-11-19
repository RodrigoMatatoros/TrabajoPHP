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
        function configDB($file)
        {
            $data = simplexml_load_file($file);
            $dbname= $data->xpath('//dbname');
            $host = $data->xpath('//host');
            $port = $data->xpath('//port');
            $user = $data->xpath('//user');
            $password = $data->xpath('//password');
            return array('mysql:dbname='.$dbname[0].'host='.$host[0].'user='.$user[0].'password='.$password[0]);

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

    function load_config($name, $schema){
        $config = new DOMDocument();
        $config->load($name);
        $res = $config->schemaValidate($schema);
        if ($res===FALSE){ 
           throw new InvalidArgumentException("Check configuration file");
        } 		
        $data = simplexml_load_file($name);	
        $ip = $data->xpath("//ip");
        $name = $data->xpath("//name");
        $user = $data->xpath("//user");
        $password = $data->xpath("//password");	
        $conn_string = sprintf("mysql:dbname=%s;host=%s", $name[0], $ip[0]);
        $result = [];
        $result[] = $conn_string;
        $result[] = $user[0];
        $result[] = $password[0];
        return $result;
    }

?>
