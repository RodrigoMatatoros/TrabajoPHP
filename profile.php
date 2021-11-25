<?php

session_start();
require_once('configuration.php');
require_once ('./functions.php');

if (isset($_GET['name']))
{
    $user = $_GET['name'];
}

$query1 = "select * from users where name='$user'";
$result = $conn->query($query1);
$rowCount = $result->fetch();
$name = $rowCount['name'];
$foto = $rowCount['picture'];
$birth = $rowCount['date'];
$mail = $rowCount['email'];


?>
    <html>
    <head>
    </head>
    <body>
        <div>
            User Name: <?=$user;?>
            <br>
            Profile picture:
            <?php
                if($foto!=NULL)
                {
                echo "<img width='500px' height='500px' src='$foto'>";
                }
            ?>
            <br>
            Date of Birth:<?=$birth;?>

        </div>
    </body>
</html>