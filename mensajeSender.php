<?php

session_start();
require_once('configuration.php');
require_once ('./functions.php');

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
$stmt = $conn->prepare('SELECT * FROM chat where msgId = :messageid'); 
$stmt->execute(array('messageid' => $_GET['id'])); 
$message = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<div>
    Sender user:
    <a href="profile_configuration.php?name=<?=$message['sender_username'];?>"><?=$message['sender_username'];?></a>
    <br>
    Topic:
    <?=$message['topic'];?>
    <br>
    Message:
    <?=$message['msg_content'];?>
    <br>
    <div>
        <?php
        $foto = $message['picture'];
        if($message['picture']!=NULL)
        {
           echo "<img width='500px' height='500px' src='$foto'>";
        }
        ?>
    </div>
    Date:
    
    <?=$message['date'];?>
    <br>
    <?php
    if($message['readed']>0)
    {
        echo "The message has been readed";
    }
    ?>
</div>