<?php
    include 'db.php';
    include 'session.php';

    if(isset($_GET['day'])){

        $day = $_GET['day'];
        $user = $_SESSION['userid'];
        $query = "UPDATE moments SET photo = '' WHERE day = '$day' AND user_id = $user";
        
        if(mysqli_query($db, $query)){
            header("location: index.php?day=$day");
        }
        else{
            echo'something wrong(';
        }
        
    }
?>