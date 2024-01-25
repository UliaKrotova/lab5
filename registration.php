<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    if (isset($_REQUEST['login'])) {
        $login = stripslashes($_REQUEST['login']);
        $login = mysqli_real_escape_string($con, $login);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $confirm_password = stripslashes($_REQUEST['confirm_password']);
        $confirm_password = mysqli_real_escape_string($con, $confirm_password);

        if ($password != $confirm_password) {
            echo "<div class='form'>
                  <h3>Пароли не совпадают.</h3><br/>
                  <p class='link'><a href='registration.php'>Повторить попытку</a> снова.</p>
                  </div>";
        } else {
            $query    = "INSERT into `users` (login, password)
                         VALUES ('$login', '" . md5($password) . "')";
            $result   = mysqli_query($con, $query);

            if ($result) {
                echo "<div class='form'>
                      <h3>Регистрация прошла успешно.</h3><br/>
                      <p class='link'><a href='index.php'>Вход</a></p>
                      </div>";
            } else {
                echo "<div class='form'>
                      <h3>Регистрация провалилась</h3><br/>
                      <p class='link'><a href='registration.php'>Повторить попытку</a> снова.</p>
                      </div>";
            }
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Регистрация</h1>
        <h4 class="login-title">Логин</h4>
        <input type="text" class="login-input" name="login" required />
        <h4 class="login-title">Пароль</h4>
        <input type="password" class="login-input" name="password" required />
        <h4 class="login-title">Подтвердите пароль</h4>
        <input type="password" class="login-input" name="confirm_password" required />
        <input type="submit" name="submit" value="Создать аккаунт" class="login-button">
        <p class="link"><a href="index.php">Вход</a></p>
    </form>
<?php
    }
?>
</body>
</html>
