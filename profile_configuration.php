<?php
session_start();
require_once('configuration.php');
require_once ('./functions.php');





if (isset($_GET['name']))
{
    $user = $_GET['name'];
    
}

$nombre = $_SESSION['name'];
$query1 = "select * from users where name='$nombre'";
$result = $conn->query($query1);
$rowCount = $result->fetch();

$name = $rowCount['name'];
$foto = $rowCount['picture'];
$birth = $rowCount['date'];
$mail = $rowCount['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $picture = upload();

    $query = "UPDATE users SET picture ='$picture' where name='$nombre'";
    $result = $conn->query($query);


}

?>
    <html>
    <head>
    </head>
    <body>
        <div>
            User Name: <?=$name;?>
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
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  
            method="POST" autocomplete="off" enctype="multipart/form-data">
                <input type="file" name="fileToUpload">Choose other avatar picture
                <button type="submit" name="foto">Change</button>
            </form>

            <a href = "home.php"><button type="submit">Go Back</button></a>
            

        </div>
    </body>
</html>