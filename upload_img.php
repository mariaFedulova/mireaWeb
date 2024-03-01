<?php

    include 'db.php';
    include 'session.php';
    $uploaddir = 'images/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    echo '<pre>';
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {

        echo $uploadfile;
        print_r($_FILES);
        exit;
    }

    if(isset($_POST['imgid']) && isset($_POST['day'])){
        $id = $_POST['imgid'];
        $day = $_POST['day'];
        $img = $uploaddir.$_FILES['userfile']['name'];

        $query = "SELECT * FROM moments WHERE id = $id";
        if(mysqli_query($db, $query)){
            $query = "UPDATE moments SET photo =  '$img' WHERE id = $id";
            if(mysqli_query($db, $query)){
                header("location: index.php?day=$day");
                exit;
            }
        }
        else{
            $user_id = $_SESSION['userid'];
            $query = "INSERT INTO moments (id, user_id, day, photo, emotion) VALUES (NULL, $user_id, '$day', '$img', '')";
            if(mysqli_query($db, $query)){
                header("location: index.php?day=$day");
                exit;
            }
        }
    }

?>