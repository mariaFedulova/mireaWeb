<?php
    include '../db.php';
    $name = $_GET['name'];
    $day = $_GET['day'];
    $user = $_GET['user'];

    $query = "INSERT INTO tasks (id, user_id, title, date) VALUES (NULL, $user, '$name', '$day')";

    $array = ([
        'name' => $name,
        'day' => $day
    ]);

    if(mysqli_query($db, $query)){
        $array['info'] = 'Данные успешно добавлены';
    }
    else{
        $array['info'] = 'При добавлении данных произошла ошибка';
    }

    $query = "SELECT * FROM tasks WHERE user_id = $user AND date = '$day'";

    if($res = mysqli_query($db, $query)){
        $array['tasks'] = [];
        while($arr = mysqli_fetch_array($res)){
            array_push($array['tasks'], (['id' => $arr['id'], 'title' => $arr['title'], 'date' => $arr['date']]));
        }
    }
    echo json_encode($array);
?>