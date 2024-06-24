<?
    include 'session.php';
    include 'db.php';
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
        <div class="calendar">
            <table class="table">
                <thead>
                    <tr>
                        <td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td>
                    </tr>
                </thead>
                <tbody id="calendarBody">
                    <tr class="tr"></tr>
                    <tr class="tr"></tr>
                    <tr class="tr"></tr>
                    <tr class="tr"></tr>
                    <tr class="tr"></tr>
                </tbody>
            </table>
            <div class="calendar__controls">
                <button id="prevMonth">&lt;</button>
                <span id="monthYear"></span>
                <button id="nextMonth">&gt;</button>
            </div>
        </div>
    </main>
    <script src="js/jq.js"></script>
    <script src="js/calendar.js"></script>
</body>
</html>