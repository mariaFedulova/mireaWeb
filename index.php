<?php
    include 'session.php';
    include 'db.php';

    $week=['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье'];
    $months=['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
    

    $day = date('Y-m-d');
    if(isset($_SESSION['userid'])){
        $user = $_SESSION['userid'];
    }
    else{
        header('location:login.php');
        exit;
    }


    if(isset($_GET['day'])){
        $day = $_GET['day'];
    }

    $query = "SELECT * FROM tasks WHERE user_id = $user AND date = '$day'";
    $res = mysqli_query($db, $query);


    $N = date("N", strtotime($day));
    $M = date("n", strtotime($day));
    $J = date("j", strtotime($day));

    $dayofweek = $week[$N - 1];
    $month = $months[$M - 1];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ежедневник</title>
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
        <h1 class="main-heading"><?php echo "$J $month, $dayofweek" ;?></h1>
        <div class="main-wrapper container">
            <div class="alert">
                <p class="alert__p"></p>
                <button class="alert__button" type="button">Ок</button>
            </div>
            <section class="tasks">
                <ul class="tasks__list">
                    <?php
                        while($arr = mysqli_fetch_array($res)){
                            echo"
                                <li class='tasks__item'>
                                    <div class='task__item-left'>
                                        <p class='tasks__name'>{$arr['title']}</p>
                                        <p class='tasks__deadline'>{$arr['date']}</p>
                                    </div>
                                    <p class='task__item-right'><a class='task__done' data-title={$arr['title']} data-id={$arr['id']} data-day=$day>+</a></p>
                                </li>
                            ";
                        }
                    
                    ?>
                </ul>
                <p class="task__add"><a class="add__link">+</a></p>
                <div id="addtask">
                    <form class="add-form"> 
                        <p>Название</p> <input class="add-input" type="text" name="name" required>
                        <input hidden type="text" name="dayADD" value = <?php echo $day;?>>
                        <button class="add-submit" data-id=<?php echo $user;?> type="button">Добавить<button>
                    </form>
                </div>
            </section>
            <section class="moments">
                <div class="moments__photo">
                    <p class="moments__photo-heading">Фото дня</p>
                    <div class="photo__place">
                        <?
                            $query = "SELECT * FROM moments WHERE user_id = $user AND day = '$day'";
                            $res = mysqli_query($db, $query);
                            if($res){
                                $arr = mysqli_fetch_array($res);
                                if($arr['photo'] != null){
                                    echo " <div class='img-div'><img class='moments__photo-img' src='{$arr['photo']}' alt='photo' width='200px' height='250px'>
                                            <br><img id='delete-photo' data-day={$day} src='images/trash.png' alt='delete' width='40px' height='50px'></div>
                                    ";
                                }
                                else{
                                    echo "
                                    <form class='uploadForm' enctype='multipart/form-data' data-day='$day' data-img='{$arr['id']}'>
                                        <input class='input-file' name='userfile' type='file' required/>
                                        <button class='file-submit' type='submit'>Добавить фото</button>
                                    </form>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="moments__emotion">
                    <p class="moments__emotion-heading">Эмоция дня</p>
                    <div class="emotion__place">
                        <?php
                            if($arr['emotion'] != null){
                                echo "<img class='moments__emotion-img' src='images/{$arr['emotion']}.png' alt='emotion' width='100px' height='110px'>";
                            }
                        ?>
                    </div>
                    <form class="emotion_form">
                        <p class="radio-p"><input type="radio" id="good" name="emotion" value="good" checked/> хорошо</p>
                        <p class="radio-p"><input type="radio" id="normal" name="emotion" value="normal" /> нормально</p>
                        <p class="radio-p"><input type="radio" id="bad" name="emotion" value="bad" /> плохо</p>
                        <input class="input-select" data-day=<?php echo $day;?> data-user=<?php echo $user;?> type="button" value="записать эмоцию">
                    </form>
                </div>
            </section>
            <section class="notes">
                    <?php
                        $query = "SELECT * FROM notes WHERE user_id = $user AND day = '$day'";
                        $res = mysqli_query($db, $query);
                        if($res){
                            if($arr = mysqli_fetch_array($res)){}
                            else{
                                $query = "INSERT INTO notes (id, user_id, day, text) VALUES (NULL, '$user', '$day', '')";
                                $res = mysqli_query($db, $query);
                                $query = "SELECT * FROM notes WHERE user_id = $user AND day = '$day'";
                                $res = mysqli_query($db, $query);
                                $arr = mysqli_fetch_array($res);
                            }  
                        }
                    ?>
                <div class="notes__flex">
                    <p class="notes__heading">Заметки</p>
                    <a class="notes__pen" data-update=<?php echo "{$arr['id']}";?> data-user=<?php echo $user;?>><img class="pen-img" src="images/pen.png" alt="update" width='30px' height='30px'></a>
                </div>
                <p class="notes__record">
                    <?php echo $arr['text']; ?>
                </p>
                <div id="upnotes"></div>            
            </section> 
        </div>
        <section class="index__info">
                    <div class="info__div">
                        
                    </div>
        </section>
    </main>
    <script src="js/jq.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>