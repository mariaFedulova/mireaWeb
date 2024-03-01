<?php
    include 'session.php';
    include 'db.php';
    if(!isset($_SESSION['userid'])){
        header('location:login.php');
        exit;
    }

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="header">
        <div class="container">
            <ul class="menu">
                <li class="menu__item"><a class="menu__link " href="logout.php">Выход</a></li>
                <div class="menu__left">
                    <?php
                        if(in_array('about', $display))
                            echo"<li class='menu__item'><a class='menu__link' href='about.php'>О проекте</a></li>";
                        if(in_array('index', $display))
                            echo"<li class='menu__item'><a class='menu__link' href='index.php'>Мои задачи</a></li>";
                        if(in_array('stat', $display))
                            echo"<li class='menu__item'><a class='menu__link' href='stat.php'>Статистика</a></li>";
                        if(in_array('calendar', $display))
                            echo"<li class='menu__item'><a class='menu__link' href='calendar.php'>Календарь</a></li>";
                    ?>
                </div>
            </ul>
        </div>
        <hr class="header-hr">
    </header>
    <main>
        <h1 class="calendar-heading">Декабрь 2023</h1>
        <div class="calendar container">
            <?php
                $days = ['ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ', 'ВС'];
                echo "<div class='row days'>
                        <div class='col radius-ltop'>ПН</div>";
                for($i = 1; $i<6; $i++){
                    echo "<div class='col'>{$days[$i]}</div>";
                }                       
                echo "<div class='col radius-rtop'>ВС</div>
                        </div>
                <div class='row'>";
                $day = 1;
                for($i = 1; $i<8; $i++){
                    if($i <5 ){
                        echo"<div class='col'> </div>";
                    }
                    else{   
                        $str = "2023-12-0".$day;
                        if(in_array($str, $unique))
                            echo"<div class='col '><a class='cal_link backlight' href='index.php?day=2023-12-$day'>$day</a></div>";
                        else
                            echo"<div class='col'><a class='cal_link' href='index.php?day=2023-12-$day'>$day</a></div>";
                        $day++;
                    }
                }
                echo "</div>";
                for($i = 0; $i<4; $i++){
                    echo"<div class='row'>";
                    for($j = 0; $j<7; $j++){
                        if($day == 25){
                            $str = "2023-12-".$day;
                            if(in_array($str, $unique))
                                echo"<div class='col radius-lbottom '><a class='cal_link backlight' href='index.php?day=2023-12-$day'>$day</a></div>";
                            else
                                echo"<div class='col radius-lbottom '><a class='cal_link' href='index.php?day=2023-12-$day'>$day</a></div>";
                            $day++;
                        }                          
                        elseif($day == 31){
                            $str = "2023-12-".$day;
                            if(in_array($str, $unique))
                                echo "<div class='col radius-rbottom '><a class='cal_link backlight' href='index.php?day=2023-12-$day'>$day</a></div>";
                            else
                                echo "<div class='col radius-rbottom'><a class='cal_link' href='index.php?day=2023-12-$day'>$day</a></div>";
                            $day++;
                        }                           
                        else{
                            if($day < 10)
                                $str = "2023-12-0".$day;
                            else
                                $str = "2023-12-".$day;
                            if(in_array($str, $unique))
                                echo"<div class='col ' ><a class='cal_link backlight' href='index.php?day=2023-12-$day'>$day</a></div>";
                            else
                                echo"<div class='col'><a class='cal_link' href='index.php?day=2023-12-$day'>$day</a></div>";
                            $day++;
                        }                           
                    }   
                    echo"</div>";
                }
            ?>
        </div>
    </main>
</body>
</html>