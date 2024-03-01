<?php   

    include "db.php";
    require_once "session.php";

    if(isset($_POST['login']) && isset($_POST['pass'])){

        if($_POST['login'] != null && $_POST['pass'] != null){
            
            $login = $_POST['login'];
            $pass = $_POST['pass'];

            $query = "SELECT * FROM users WHERE login = '$login' AND pass = '$pass'";
            $result = mysqli_query($db, $query);

            if($mas = mysqli_fetch_array($result)){
                $_SESSION["userid"] = $mas['id'];
                $_SESSION["user"] = $mas;
                if($login == 'admin')
                    header('location: admin.php');
                else
                    header('location: index.php');
                exit;   
            }
            else{
                echo"Неправильное имя пользователя или пароль";
            }
        }
        else{
            echo"Неправильное имя пользователя или пароль";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="white">
        <main class="container">
            <h1 class="logo">DAILY PLANNER</h1>
            <section class="login">
                <p class="login__heading">Войдите на сайт и планируйте с удовольствием</p>
                <form class="login__form" action="#" method="POST">
                    <div class="login__username">
                        <p class="login__username-p">Логин</p>
                        <input class="login__username-input input" type="text" name="login" required>
                    </div>
                    <div class="login__pass">
                        <p class="login__pass-p">Пароль</p>
                        <input class="login__pass-input input" type="password" name="pass" required>
                    </div>
                    <input class="login__submit" type="submit" value="Войти">
                </form>
            </section>
            <p class="toreg">Нет аккаунта? Тогда <a class="toreg__link" href="reg.php">зарегистрируйтесь</a></p>
        </main>
    </div>
    
</body>
</html>