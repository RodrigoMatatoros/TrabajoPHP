<?php
require_once('configuration.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = ($_POST['user']);
	$password = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
    $query1 = "SELECT * FROM users WHERE name like'$name'";
	$result = $conn->query($query1);
    $result = $result->fetch(PDO::FETCH_ASSOC);
    if($result['name']==$name)
    {
        $query = "UPDATE users SET password ='$password' where name='$name'";
        $result = $conn->query($query);
        header("Location: LogearseFormulario.php");
    }else
    {
        echo "esta mal";
    }
}
?>
<html>
    <head>
    </head>
    <body>
        <h1>Change Password</h1>
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="POST" autocomplete="off">
                <input type = "text" name="user">User you want to change password
                <br>
                <input type="password" name="new_password">New Password
                <br>
                    <button type="submit">Send</button>
            </form>
    </body>
</html>