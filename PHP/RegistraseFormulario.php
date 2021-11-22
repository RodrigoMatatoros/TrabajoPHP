
<html>
    <head>
        <title>Registrarse</title>
    </head>
    <body>
        <form method="post" action="register_php.php">
            <h1>Insert your data</h1>
             <?php if (isset($_GET['error'])){?>
                <p class ="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <input type="text" name="nombre">Name
            <br>
            <input type="text" name="apellido">Surname
            <br>
            <input type="text" name="nombreUsuario">User
            <br>
            <input type="date" name="fechaNacimiento">Date of Birth
            <br>
            <input type="text" name="correo">New mail name
            <br>
            <input type="password" name="contraseña">Password
            <br>
            <a href= "home.php"><input type="submit" name="subirUsuario"></a>
        </form>
    </body>
</html>
