<?php
require_once './functions.php';
session_start();
require_once('configuration.php');
$user = $_SESSION['name'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $sendToMail =$_POST['receptor'];
    $query = "select id from users where name = '$sendToMail'";
    $result = $conn ->query($query);
    $selectId = $result->fetch();
    $receiver = $selectId['id'];
    var_dump($receiver);
    $message =$_POST['message'];
    $date = date('Y-m-d H:i:s');

    if($user != $sendToMail)
    {
        $query2 = "INSERT INTO chat(sender_username,receiver_username,msg_content,msg_date) VALUES ('$user','$sendToMail','$message','$date')";
        $result2 = $conn->query($query2);
        header("Location: home.php");
    }
    /*if($_FILES['messageFile']['size']>0){
        $rutaArchivo = uploadFile($_FILES['messageFile'], "./files", $image);
        "insert into messages values(null, sender, receiver, msg content, $rutaArchivo)";
    }else
    {
        "insert into messages values(null, sender, receiver, msg content, null)";

    }*/
}




?>



<html>

<head>
    <style>
        .todo {
            display: grid;
            border: 1px solid black;

            width: 100%;
            height: 100%;
            grid-template-columns: repeat(5, 20%);
            grid-template-rows: repeat(5, 20%);
        }
        .list_friends
        {
            float:left;
        }

        .todo>div {
            border: 1px solid black;
        }

        .profile 
        {
            grid-column: span 5;
        }
        .list_friends
        {
            grid-row: span 4;
        }
        .chat_messages
        {
            grid-row: span 4;
            grid-column: span 3;
        }
        .bandeja_salida
        {
            grid-row: span 4;
        }
        .mensaje
        {
            position: relative;
            border: 1px solid black;
        }
    </style>

</head>

<body>
    <div class="todo">
        <div class="profile"> 
            <?php
                $user = $_SESSION['name'];
            // var_dump($user);
                $get_user = "select * from users where name like '$user'";
                $result = $conn->query($get_user);
                $rowCount = $result->fetch();
                // var_dump($rowCount['id']);
                $id = $rowCount['id'];
                $username = $rowCount['name'];
                $user_profile_pic =$rowCount['picture'];
        
            ?>
            <p><?php echo $username; ?></p>
                <img src="<?php echo $user_profile_pic; ?>">
                <a href="./logout.php"><button name="logout">Logout</button></a>
        </div>
        <div class="list_messages">
           <?php   
            $query_m = "select * from chat where receiver_username ='$user'";
            $result_m = $conn ->query($query_m);
            $select_m = $result_m->fetchAll(PDO::FETCH_ASSOC);
                  //$mensaje = $select_m['msg_content'];
           ?>
           <?php
            foreach($select_m as $message):
           ?>
           <a href="mensajes.php?id=<?=$message['msgId'];?>">
               <div class="mensaje">
                    <?=$message['sender_username'];?>
                    <br>
                    <?=$message['msg_content'];?>
                  
                </div>
           </a>
            <?php
            endforeach;
            ?>
        </div>
        
        <div class="chat_messages">


           <form action="" method="POST" autocomplete="off">
                <div class="message-box">
                    <textarea rows="10" cols="50" name="message" placeholder="Type your message here..." autofocus></textarea>
                </div>
                    <input type="text" name="receptor" placeholder="Send a message to...">
                    <button type="submit">Send</button>
            </form>
        </div>
        <div class="bandeja_salida">
        <?php   
            $query_m = "select * from chat where sender_username ='$user'";
            $result_m = $conn ->query($query_m);
            $select_m = $result_m->fetchAll(PDO::FETCH_ASSOC);
                  //$mensaje = $select_m['msg_content'];
           ?>
           <?php
            foreach($select_m as $message):
           ?>
           <div class="mensaje">
                <?=$message['sender_username'];?>
                <br>
                <?=$message['msg_content'];?>
                <br>
                <?=$message['leido'];?>
              
            </div>
            <?php
            endforeach;
            ?>
        </div>
        
    </div>
</body>

</html>