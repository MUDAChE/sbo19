<?php
session_start();
?>
<!doctype html>
<br lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
</head>
<body>

<form action="logic/auth.php" method="post">

    <div align="center">
        <h2>Страница авторизации</h2>
        <input type="text" name="login" placeholder="Введите логин"><br><br>
        <input type="password" name="password" placeholder="Введите пароль"><br><br>
        <button type="submit">Войти</button>
        <br><br>
        <a href="registration.php">Страница регистрации</a><br><br>
        <?php
        if ($_SESSION['auth-message']) {
            echo $_SESSION['auth-message'];
            unset($_SESSION['auth-message']);
        }
        ?>
    </div>

</form>

</body>
</html>