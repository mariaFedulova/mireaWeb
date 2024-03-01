<?php
    include 'db.php';
    include 'session.php';
    $query = "SELECT * FROM moments WHERE user_id = {$_SESSION['userid']} ORDER BY day";
    $result = mysqli_query($db, $query);
    while($array = mysqli_fetch_array($result)){
        if($array['emotion'] =='bad'){
            $emotion[]  = '1';
        }
        if($array['emotion'] =='normal'){
            $emotion[]  = '2';
        }
        if($array['emotion'] =='good'){
            $emotion[]  = '3';
        }
        $days[] = $array['day'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</head>
<body>
<header class="header">
        <div class="container">
            <ul class="menu">
                <li class="menu__item"><a class="menu__link " href="#">Выход</a></li>
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
    <div class="chart container">
        <canvas id="chart"></canvas>
    </div>
    

    </main>
    <script>
        const emotion = <?php echo json_encode($emotion); ?>;
        const data2 = {
        labels: <?php echo json_encode($days); ?>,
        datasets: [{
            label: 'Эмоция',
            data: emotion,
            fill: false,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            tension: 0.1
            }]
        };                      

        const config2 = {
        type: 'line',
        data: data2,
        };

        const chartTop3 = new Chart(
        document.getElementById('chart'),
        config2
        );
    </script>
</body>
</html>