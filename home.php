<?php
require_once './functions.php';
session_start();
require_once('configuration.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_FILES['messageFile']['size']>0){
        $rutaArchivo = uploadFile($_FILES['messageFile'], "./files", $image);
        "insert into messages values(null, sender, receiver, msg content, $rutaArchivo)";
    }else
    {
        "insert into messages values(null, sender, receiver, msg content, null)";

    }
}

?>



<html>

<head>
    <style>
        .todo {
            display: grid;
            position: absolute;
            border: 1px solid black;
            align-self: center;
            width: 100%;
            height: 100%;
            grid-template-columns: 30% 70%;
            grid-template-rows: 10% 90%;
        }

        .todo>div {
            border: 1px solid black;
        }

        .addFriend {
            top: 50%;
            left: 50%;
        }
    </style>

</head>

<body>
    <div class="todo">
        <div class="add_friend">
            <center><a href="add_friends.php"><input type="submit" value="Añadir amigo" name="add_friend" class="addFriend"></a></center>
        </div>
        <div class="user_profile">
            <?php
            $user = $_SESSION['email'];
            // var_dump($user);
            $get_user = "select * from users where email ='$user'";
            $result = $conn->query($get_user);
            $rowCount = $result->fetch();
            // var_dump($rowCount['id']);
            $id = $rowCount['id'];
            $user_name = $rowCount['name'];
            $username = "sample";
            if (isset($user_name)) {
                $query1 = "select * from users where name='$user_name'";
                $result2 = $conn->query($query1);
                $rowCount2 = $result2->fetch();
                $username = $rowCount2['name'];
                $user_profile_pic = $rowCount2['picture'];
            }
            ?>
            <div class="profile">
                <p><?php echo $username; ?></p>
                <img src="<?php echo $user_profile_pic; ?>">
                <a href="./logout.php"><button name="logout">Logout</button></a>
            </div>

        </div>
        <div class="friend_list">
            <?php

            $select_msg = "select * from chat where sender_username =$user_name";

            $url = "";
            ?>
        </div>
        <div class="chat_messages">
            <?php

            $select_msg = "select * from users where receiver = "
            $db->query($select_msg);

            ?>
        </div>
        <form action="" method="POST" autocomplete="off">
                <div class="message-box">
                    <input type="file" id="message-box" name="messageFile" placeholder="envia una imagen">
                    <textarea rows="10" cols="50" name="message" placeholder="Type your message here..." autofocus></textarea>
                </div>
                    <button type="submit">Send</button>
            </form>
    </div>
</body>

</html>