
<html>
    <head>
        <title>Registrarse</title>
    </head>
    <body>
        <form method="post"  action="register_php.php" enctype="multipart/form-data">
            <h1>Insert your data</h1>
             <?php if (isset($_GET['error'])){?>
                <p class ="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <input type="text" name="user_name">Name
            <br>
            <input type="text" name="mail">New mail name
            <br>
            <input type="date" name="date_of_birth">Date of Birth
            <br>
            <input type="password" name="password">Password
            <br>
            <input type="file" name="fileToUpload">Profile Picture
            <br>
            <a href= "home.php"><input type="submit" name="subirUsuario"></a>
        </form>
    </body>
</html>
