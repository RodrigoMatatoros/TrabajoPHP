
<?php


try
{
    $conn = new PDO('mysql:host=localhost;dbname=dbname', "root",);
}catch(PDOException $e)
{
    echo '**Database error: ' . $e->getMessage();
}
    


