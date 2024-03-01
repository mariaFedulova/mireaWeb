<?php
    $db = mysqli_connect('localhost', 'root');
    mysqli_select_db($db, 'dailyplanner');
    mysqli_set_charset($db,'utf8');
    $query = "SELECT * FROM pages WHERE displayed = 1";
    $result = mysqli_query($db, $query);
    while($pages = mysqli_fetch_array($result)){
        $display[] = $pages['name'];
    }
?>