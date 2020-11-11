<?php
session_start();
//$_SESSION['db-connect'] = 'registration';
?>
<!doctype html>
<br lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body>

<form action="logic/reg.php" method="post">
    <div align="center">
        <h2>Страница регистрации</h2>
        <input type="text" name="login" placeholder="Придумайте логин"><br><br>
        <input type="password" name="password" placeholder="Придумайте пароль"><br><br>
        <input type="password" name="password-confirm" placeholder="Подтвердите пароль"><br><br>
        <button type="submit">Зарегистрироваться</button>
        <br><br>
        <a href="authorization.php">Страница авторизации</a><br><br>
        <?php
        if ($_SESSION['reg-message']) {
            echo $_SESSION['reg-message'];
            unset($_SESSION['reg-message']);
        }
        ?>
    </div>

</form>

</body>
</html>