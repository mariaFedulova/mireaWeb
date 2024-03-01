<?php
    include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О проекте</title>
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
    <main class="container">
        <h1 class="about_h1">О проекте</h1>
        <p class="about_p">&nbsp;&nbsp;&nbsp;&nbsp;Cайт-ежедневник - это удивительная возможность для людей вести свой
            дневник
            онлайн.
            Этот
            сайт
            предоставляет пользователям удобную платформу, где они могут записывать свои мысли, чувства, события и
            достижения каждый день.</p>
        <p class="about_p">&nbsp;&nbsp;&nbsp;&nbsp;На сайте ежедневника пользователи могут создавать записи, добавлять
            фотографии, а
            также
            делиться своими мыслями. Кроме того, сайт предлагает различные инструменты для
            организации и анализа информации, такие как статистика.</p>
        <p class="about_p">&nbsp;&nbsp;&nbsp;&nbsp;Этот проект стимулирует людей вести более осознанную жизнь, сохранять
            воспоминания и
            достижения, а также
            делиться
            своими мыслями с другими.</p>

        <section class="images">
            <img class="about_img" src="images/happy1.jpeg" alt="happy" width="350px" height="200px">
            <img class="about_img" src="images/happy2.jpeg" alt="happy" width="300px" height="200px">
            <img class="about_img" src="images/happy3.jpeg" alt="happy" width="350px" height="200px">
        </section>
    </main>

</body>

</html>