<?php
    include 'db.php';
    include 'session.php';

    $array = array();
    if(isset($_GET['id']) && isset($_GET['day'])){
        $id = $_GET['id'];
        $day = $_GET['day'];
        $user = $_SESSION['userid'];
    
        $array = ([
            "id" => $id,
            "day" => $day
        ]);

        $query = "SELECT * FROM tasks WHERE id = $id";
        $res = mysqli_query($db, $query);
        $array['deleted'] =[];
        if($value = mysqli_fetch_array($res)){
            array_push($array['deleted'], (['title' => $value['title'], 'date' => $value['date']]));
        }
    
        $query = "DELETE FROM tasks WHERE id = $id";
    
        if(mysqli_query($db, $query)){
            $array["info"] = "Данные успешно удалились";
        }
        else{
            $array["info"] = "Не удалось удалить данные";
        }
    
        $query = "SELECT * FROM tasks WHERE user_id = $user AND date = '$day'";
    
        if($res = mysqli_query($db, $query)){
            $array['tasks'] = [];
            while($arr = mysqli_fetch_array($res)){
                array_push($array['tasks'], (['id' => $arr['id'], 'title' => $arr['title'], 'date' => $arr['date']]));
            }
        }
    
    }

    if(isset($_GET['note']) && isset($_GET['day'])){
        $note = $_GET['note'];
        $day = $_GET['day'];
        $user = $_SESSION['userid'];

        $array = ([
            "note" => $note,
            "day" => $day,
            "user" => $user
        ]);

        $query = "UPDATE notes SET text = '$note' WHERE day = '$day' AND user_id = $user";

        if(mysqli_query($db, $query)){
            $array["info"] = "Данные изменены";
        }
        else{
            $array["info"] = "Данные не были изменены(";
        }
    }

    if(isset($_GET['emotion']) && isset($_GET['day'])){
        $em = $_GET['emotion'];
        $day = $_GET['day'];
        $user = $_GET['user'];

        $array = ([
            "emotion" => $em,
            "day" => $day,
            "user" => $user
        ]);

        $query = "SELECT * FROM moments WHERE day = '$day' AND user_id = $user";
        $result = mysqli_query($db, $query);

        if(! ($arr = mysqli_fetch_array($result))){
            $query = "INSERT INTO moments (id, user_id, day, photo, emotion) VALUES (NULL, $user, '$day', '', '$em')";
            if(mysqli_query($db, $query)){
                $array["info"] = "Данные были добавлены";
            }
        }
        else{
            $query = "UPDATE moments SET emotion = '$em' WHERE day = '$day'";
            if(mysqli_query($db, $query)){
                $array["info"] = "Данные были изменены";
            }
        }
    }

    echo json_encode($array);
?>