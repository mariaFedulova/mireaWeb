<?php
    include 'db.php';
    include 'session.php';
    $uploaddir = 'images/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $array = array();
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $array['info'] = "Файл добавился";
        } else {
            $array['info'] = "Файл не добавился";
        }
        $id = $_POST['imgId'];
        $day = $_POST['day'];
        $img = $uploaddir.$_FILES['userfile']['name'];

        $array = ([
            'imgId' => $id,
            'day' => $day,
            'img' => $img
        ]);

        $query = "SELECT * FROM moments WHERE id = $id";
        if(mysqli_query($db, $query)){
            $query = "UPDATE moments SET photo =  '$img' WHERE id = $id";
            if(mysqli_query($db, $query)){
                $array['info'] = 'Фотография была обновлена';
            }
        }
        else{
            $user_id = $_SESSION['userid'];
            $query = "INSERT INTO moments (id, user_id, day, photo, emotion) VALUES (NULL, $user_id, '$day', '$img', '')";
            if(mysqli_query($db, $query)){
                $array['info'] = 'Фотография была добавлена';
            }
        }

    echo json_encode($array);
?>