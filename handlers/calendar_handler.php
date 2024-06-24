<?php
    include '../session.php';
    include '../db.php';

    $query = "SELECT * FROM tasks WHERE user_id = {$_SESSION['userid']}";
    $result = mysqli_query($db, $query);
    while($array = mysqli_fetch_array($result)){
        $ev[] = $array['date'];
    }
    $query = "SELECT * FROM notes WHERE user_id = {$_SESSION['userid']}";
    $result = mysqli_query($db, $query);
    while($array = mysqli_fetch_array($result)){
        if ($array['text'] != ''){
            $ev[] = $array['day'];
        }
    }
    $query = "SELECT * FROM moments WHERE user_id = {$_SESSION['userid']}";
    $result = mysqli_query($db, $query);
    while($array = mysqli_fetch_array($result)){
        $ev[] = $array['day'];
    }
    $unique = array_unique($ev);

    $array = ([
        'unique' => $unique
    ]);

    echo json_encode($array);
?>