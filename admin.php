<?php
    include 'session.php';
    include 'db.php';
    if(!isset($_SESSION['userid'])){
        header('location: login.php');
        exit;
    }
    
    if(isset($_GET['disp'])){
        $id = $_GET['disp'];
        $query = "SELECT * FROM pages WHERE id = $id";
        $res = mysqli_query($db, $query);
        if($page = mysqli_fetch_array($res)){
            echo"super";
            if($page['displayed'] == 1)
                $set = 0;
            else
                $set = 1;
            $query ="UPDATE pages SET displayed = $set WHERE id = $id";
            if(mysqli_query($db, $query)){
                header('location: admin.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class='admin__header'>
        <div class=" admin__menu container">
            <a class="menu__link" href="logout.php">Выход</a>
        </div>

        <hr class="header-hr">
    </header>
    <main>
        <div class="admin__container">
            <table class="admin__table">
                <tr>
                    <td>#</td>
                    <td>Страница</td>
                    <td>Показать</td>
                    <td></td>
                </tr>
                <?php
                    $query = "SELECT * FROM pages";
                    $result = mysqli_query($db, $query);
                    $i = 1;
                    while($pages = mysqli_fetch_array($result)){
                        echo"<tr>
                            <td>$i</td>
                            <td>{$pages['name']}</td>";
                            if($pages['displayed'] == 1){
                                $text = 'убрать';
                                echo "<td>да</td>"; 
                            }
                            else{
                                $text = 'показать';
                                echo"<td>нет</td>";
                            }
                        echo "<td><a class='disp_link' href='?disp={$pages['id']}' >$text</a></td>
                            </tr>";
                        $i++;
                    }
                ?>
            </table>
        </div>
    </main>
</body>
</html>