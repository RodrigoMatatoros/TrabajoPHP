<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form method="post" action="login_php.php">
            <h1>Login</h1>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <input type="text" name="mail">Mail name
            <br>
            <input type="password" name="password">Password
            <br>
            <input type="submit" name="logeo" value="logeo">
        </form>
    </body>
</html>