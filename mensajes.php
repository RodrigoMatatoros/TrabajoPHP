<?php

session_start();
require_once('configuration.php');
require_once ('./functions.php');

if (isset($_GET['id']))
{
    $msg = $_GET['id'];
    
}

$query1 = "UPDATE chat SET readed=1 where msgId ='$msg'";
$result = $conn ->query($query1);
$stmt = $conn->prepare('SELECT * FROM chat where msgId = :messageid'); 
$stmt->execute(array('messageid' => $_GET['id'])); 
$message = $stmt->fetch(PDO::FETCH_ASSOC);
$sender = $message['sender_username'];

?>
<div>
    Sender user:
    <a href="profile.php?name=<?=$sender;?>"><?=$sender;?></a>
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