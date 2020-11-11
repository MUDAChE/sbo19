<?php
session_start();
require_once 'logic/db-connect.php';

if (!isset($_COOKIE['sign-in'])) {
    header('Location: authorization.php');
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Чатик SBO</title>
</head>
<body>

<div>
    <?php if ($_SESSION['user-login']) { ?>
        <p>Добро пожаловать <b><?= $_SESSION['user-login']; ?></b>!
        <form action="logic/out.php">
            <button type="submit">Выйти из аккаунта</button>
        </form>
        </p>
    <? } ?>

    <div>
        <?php
        if ($_SESSION['set-message']) {
            echo $_SESSION['set-message'];
            unset($_SESSION['set-message']);
        }
        ?>
    </div>

    <form action="logic/set-message.php" method="post">
        <textarea name="message" cols="30" rows="5" placeholder="Введите сообщение"></textarea></br>
        <button type="submit">Отправить</button>
    </form>

</div>
<hr color="black" size="5px">

<div>

    <?php
    $query = $connectDB->query('SELECT * FROM forumsbo.messages LEFT JOIN forumsbo.users ON messages.`user-id`=users.id ORDER BY messages.id DESC');

    while ($messages = $query->fetch(PDO::FETCH_OBJ)) { ?>
        <p>
            <?=
//            var_dump($messages);
            $messages->date . ' ' . '<b>'.$messages->login.':</b>' .  ' ' . $messages->message ?>
        </p>
        <hr color="blue" size="1px">

    <? } ?>

</div>

</body>
</html>