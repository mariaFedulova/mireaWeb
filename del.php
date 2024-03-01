<?php
    include 'db.php';
    include 'session.php';

    if(isset($_GET['id']) && isset($_GET['day'])){
        $id = $_GET['id'];
        $day = $_GET['day'];
        echo $id;
   
        $query = "DELETE FROM tasks WHERE id = $id";

        if(mysqli_query($db, $query)){
            echo"Данные успешно удалились";
            header("location: index.php?day=$day");
        }
        else{
            echo'something wrong(';
        }
        
    }

    if(isset($_GET['note']) && isset($_GET['day'])){
        $note = $_GET['note'];
        $day = $_GET['day'];
        $user = $_SESSION['userid'];

        $query = "UPDATE notes SET text = '$note' WHERE day = '$day' AND user_id = $user";

        if(mysqli_query($db, $query)){
            echo "Данные изменены";
            header("location: index.php?day=$day");
            exit;
        }
        else{
            echo"cringe!!!!!!!!!!!!!!!!!!";
        }
    }

    if(isset($_GET['emotion']) && isset($_GET['day'])){
        $em = $_GET['emotion'];
        $day = $_GET['day'];
        $user = $_SESSION['userid'];

        $query = "SELECT * FROM moments WHERE day = '$day' AND user_id = $user";
        $result = mysqli_query($db, $query);

        if(! ($array = mysqli_fetch_array($result))){
            $query = "INSERT INTO moments (id, user_id, day, photo, emotion) VALUES (NULL, $user, '$day', '', '$em')";
            if(mysqli_query($db, $query)){
                echo'все вставилось';
                header("location: index.php?day=$day");
                exit;
            }
        }
        else{
            $query = "UPDATE moments SET emotion = '$em' WHERE day = '$day'";
            if(mysqli_query($db, $query)){
                echo'чет не так';
                header("location: index.php?day=$day");
                exit;
            }
        }
    }
?>