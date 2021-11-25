<?php
session_start();
require_once ('./functions.php');

require_once('configuration.php');
$user = $_SESSION['name'];

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $sendToMail =$_POST['receptor'];
    $query = "select id from users where name = '$sendToMail'";
    $result = $conn ->query($query);
    $selectId = $result->fetch();
    $receiver = $selectId['id'];
    $picture = upload();
    var_dump($picture);
    var_dump($receiver);
    $message =$_POST['message'];
    $date = date('Y-m-d H:i:s');
    $topic = $_POST['topic'];
    if($user != $sendToMail)
    {
        $query2 = "INSERT INTO chat(sender_username,receiver_username,msg_content,date,picture,topic) 
        VALUES ('$user','$sendToMail','$message','$date','$picture','$topic')";
        $result2 = $conn->query($query2);
        header("Location: home.php");
    }
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
            grid-auto-flow:column;
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
            display:flex;
            grid-column: span 5;
            justify-content:space-between;
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
                
                <a href="./profile_configuration.php?name=<?=$user;?>"><button name="change">Configuration</button></a>
        </div>
        <div class="list_messages">
        <h1>Inbox</h1>
           <?php   
            $query_m = "select * from chat where receiver_username ='$user' ORDER BY date DESC";
            $result_m = $conn ->query($query_m);
            $select_m = $result_m->fetchAll(PDO::FETCH_ASSOC);
                  //$mensaje = $select_m['msg_content'];
           ?>
           <?php
            foreach($select_m as $message):
           ?>
           <a href="mensajes.php?id=<?=$message['msgId'];?>">
               <div class="mensaje">
                   <br>
                    <?=$message['sender_username'];?>
                    <br>
                    Topic:
                    <?=$message['topic'];?>
                    <br>
                    <?php
                    if($message['readed']>0)
                    {
                        echo "The message has been readed";
                    }else
                    {
                        echo "The message isnt readed";
                    }
                    ?>
                    <?=$message['date'];?>
                    <br>
                  
                </div>
           </a>
            <?php
            endforeach;
            ?>
        </div>
        
        <div class="chat_messages">
        <h1>Send Messages</h1>

           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="POST" autocomplete="off" enctype="multipart/form-data">
                
                    <textarea rows="2" cols="100" name="topic" placeholder="Type the topic here..." autofocus></textarea>
                <div class="message-box2">
                    <textarea rows="20" cols="100" name="message" placeholder="Type your message here..." autofocus></textarea>
                </div>
                <br>
                <input type="file" name="fileToUpload">Add image
                <br>
                    <input type="text" name="receptor" placeholder="Send a message to...">
                    <button type="submit">Send</button>
            </form>
        </div>
        <div class="bandeja_salida">
        <h1>Outbox</h1>
        <?php   
            $query_m = "select * from chat where sender_username ='$user'  ORDER BY date DESC";
            $result_m = $conn ->query($query_m);
            $select_m = $result_m->fetchAll(PDO::FETCH_ASSOC);
                  //$mensaje = $select_m['msg_content'];
           ?>
           <?php
            foreach($select_m as $message):
           ?>
           <a href="mensajeSender.php?id=<?=$message['msgId'];?>">
           <div class="mensaje">
                <?=$message['sender_username'];?>
                <br>
                Topic:
                <?=$message['topic'];?>
                <br>
                <?php
                    if($message['readed']>0)
                    {
                        echo "The message has been readed";
                    }else
                    {
                        echo "The message isnt readed";
                    }
                ?>
              <br>
              <?=$message['date'];?>
                    <br>
            </div>
                </a>
            <?php
            endforeach;
            ?>
        </div>
        
    </div>
</body>

</html>