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
$query1 = "UPDATE chat SET readed=1 where msgId =$msg ";
$result = $conn ->query($query1);
$stmt = $conn->prepare('SELECT * FROM chat where msgId = :messageid'); 
$stmt->execute(array('messageid' => $_GET['id'])); 
$message = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div>
    Sender user:
    <?=$message['sender_username'];?>
    <br>
    Message:
    <?=$message['msg_content'];?>
    <br>
    Date:
    <?=$message['msgId'];?>
    <br>
    <?php
    if($message['readed']>0)
    {
        echo "The message has been readed";
    }
    ?>
</div>