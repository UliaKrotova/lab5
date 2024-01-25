<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Вход</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();
    if (isset($_POST['login'])) {
        $login = stripslashes($_REQUEST['login']);
        $login = mysqli_real_escape_string($con, $login);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "SELECT * FROM `users` WHERE login='$login'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['login'] = $login;
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <a href='index.php'>Войти</a> Снова.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Вход</h1>
        <h4 class="password-title">Логин</h4>
        <input type="text" class="login-input" name="login" autofocus="true"/>
        <h4 class="password-title">Пароль</h4>
        <input type="password" class="login-input" name="password"/>
        <input type="submit" name="submit" value="Войти" class="login-button">
        <p class="link"><a href="registration.php">Регистрация</a></p>
  </form>
<?php
    }
?>
</body>
</html>
