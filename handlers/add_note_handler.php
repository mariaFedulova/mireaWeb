<?php
    include '../db.php';
    if(isset($_GET['update'])){
        $id = $_GET['update'];
        
        $query = "SELECT * FROM notes WHERE id = $id";
        $res = mysqli_query($db, $query);

        if($res){
            $array = mysqli_fetch_array($res);     
            $result = ([
                "text" => $array['text'],
                "day" => $array['day']
            ]);                   
        }

        echo json_encode($result);
    }
?>