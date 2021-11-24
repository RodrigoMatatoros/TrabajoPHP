<?php

session_start();
require_once('configuration.php');

if (isset($_GET['id']))
{
    $msg = $_GET['id'];
    
}
/*
    $query = "select * from chat where msg_id ='$msg'";
    $result_m = $conn ->query($query);
    $mensaje = $result_m->fetch();
*/
//Get the message 
$stmt = $conn->prepare('SELECT * FROM chat where msg_id = :messageid'); 
$stmt->execute(     array(         'messageid' => $_GET['id']     ) ); 
$message = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div>
    <p>Sender user</p>
    <?=$message['sender_username'];?>
    <br>
    <?=$message['msg_content'];?>                                        
</div>