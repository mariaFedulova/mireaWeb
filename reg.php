<?php   
    include "db.php";
    require_once "session.php";

    if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['email'])){

        if($_POST['login'] != null && $_POST['pass'] != null && $_POST['email'] != null){
            
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            $query = "SELECT * FROM users WHERE login = '$login'";
            $result = mysqli_query($db, $query);

            if($mas = mysqli_fetch_array($result)){
                echo "Этот логин уже зарегистрирован";
            }
            else{
                $query = "INSERT INTO users (id, login, pass, email) VALUES (NULL, '$login', '$pass', '$email')";
                $result = mysqli_query($db, $query);

                $query = "SELECT * FROM users WHERE login = '$login'";
                $result = mysqli_query($db, $query);

                if($arr = mysqli_fetch_array($result)){

                    $_SESSION["userid"] = $arr['id'];
                    $_SESSION["user"] = $arr;
                    header('location: index.php');
                    exit;
                }
                else{
                    echo"xnj-nj gjikj yt nfr";
                }
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
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="white">
        <main class="container">
            <h1 class="logo reg-logo">DAILY PLANNER</h1>
            <section class="reg">
                <p class="reg__heading">Регистрация</p>
                <form class="reg__form" action="#" method="POST">
                    <div class="reg__username">
                        <p class="reg__username-p">Логин</p>
                        <input class="reg__username-input input" type="text" name="login" required>
                    </div>
                    <div class="reg__email">
                        <p class="reg__email-p">Email</p>
                        <input class="reg__email-input input" type="text" name="email" required>
                    </div>
                    <div class="reg__pass">
                        <p class="reg__pass-p">Придумайте пароль</p>
                        <input class="reg__pass-input input" type="password" name="pass" required>
                    </div>
                    <input class="reg__submit" type="submit" value="Зарегистрироваться">
                </form>
            </section>
            <p class="toreg">Уже есть аккаунт? Тогда <a class="toreg__link" href="login.php">войдите</a></p>
        </main>
    </div>
    
</body>
</html>