
<?php
function configBD($file)
{
    $data = simplexml_load_file($file);
    $dbname= $data->xpath('//dbname');
    $host = $data->xpath('//host');
    $port = $data->xpath('//port');
    $user = $data->xpath('//user');
    $password = $data->xpath('//password');
    return array('mysql:dbname='.$dbname[0].'host='.$host[0].'user='.$user[0].'password='.$password[0]);

}

function validateXML()
    {
        $dept = new DOMDocument();
        $dept->load('conexion.xml');
        $res = $dept->schemaValidate('conexion.xsd');
        if ($res){ 
            echo "<br/>The file is valid";
        } 
        else { 
            echo "<br/>The file is not valid"; 
        }
    }
?>