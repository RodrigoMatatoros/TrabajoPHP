
<?php


try
{
    $conn = new PDO('mysql:host=localhost;dbname=dbname', "root",);
}catch(PDOException $e)
{
    echo '**Database error: ' . $e->getMessage();
}
    


/*
$conn = mysqli_connect("localhost","root","","dbname") or die("Connection is not established");
if($conn)
{
    return true;
}
else
{
    echo("fdsf");
    return false;
}
/*
function configBD($file)
{
    $data = simplexml_load_file($file);
    $dbname= $data->xpath('//database');
    $host = $data->xpath('//host');
    $port = $data->xpath('//port');
    $user = $data->xpath('//username');
    $password = $data->xpath('//password');
    return array('mysql:dbname=' . $dbname[0] . ';host=' . $host[0], $user[0], $password[0]);

}*/
/*
function load_config($name, $schema)
{
    $config = new DOMDocument();
    $config->load($name);
    $res = $config->schemaValidate($schema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Check configuration file");
    }
    $data = simplexml_load_file($name);
    $host = $data->xpath("//host")[0];
    $dbname = $data->xpath("//database")[0];
    $user = $data->xpath("//username")[0];
    $password = $data->xpath("//password")[0];
    $data = array();
    $constr = "mysql:dbname=" . $dbname . ";host=" . $host;
    $data[0] = $constr;
    $data[1] = $user;
    $data[2] = $password;
    return $data;
}

function validateXML()
{
    $dept = new DOMDocument();
    $dept->load('conexion.xml');
    $res = $dept->schemaValidate('conexion.xsd');
    if ($res) {
        echo "<br/>The file is valid";
    } else {
        echo "<br/>The file is not valid";
    }
}

try {
    $connection_data = load_config("conexion.xml", "conexion.xsd");
    var_dump($connection_data);
    $bd = new PDO($connection_data[0], $connection_data[1], $connection_data[2]);
    //echo "Connected
} catch (PDOException $e) {
    echo 'Database error:' .
        $e->getMessage();
}
*/
?>