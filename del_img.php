<?php
    include 'db.php';
    include 'session.php';

    if(isset($_POST['day'])){

        $day = $_POST['day'];
        $user = $_SESSION['userid'];
        $query = "SELECT * FROM moments WHERE day = '$day' AND user_id = $user";
        $res = mysqli_query($db, $query);
        $moment = mysqli_fetch_array($res);

        $query = "UPDATE moments SET photo = '' WHERE day = '$day' AND user_id = $user";

        $array = ([
            'day' => $day,
            'img' => $moment['photo']
        ]);
        
        if(mysqli_query($db, $query)){
            $array['info'] = "Фотография удалена";
        }
        else{
           $array['info'] = "При удалении произошла ошибка";
        }
        
        echo json_encode($array);
    }
?>