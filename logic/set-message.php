<?php

require_once 'db-connect.php';

session_start();

$userId = $_SESSION['user-id'];
$date = date('Y-m-d H:i:s');
$message = htmlentities($_POST['message']);

if ($message) {

    if (mb_strlen($message) > 500) {

        $_SESSION['set-message'] = 'Длинна сообщения не должна превышать 500 символов!';
        header('Location: ../index.php');

    } else {

        $query = $connectDB->prepare('INSERT INTO forumsbo.messages(message, date, `user-id`) VALUE (:message, :date, :userId)');
        $query->execute([':message' => $message, ':date' => $date, ':userId' => $userId]);
        $_SESSION['set-message'] = 'Сообщение отправлено!';
        header('Location: ../index.php');

    }

} else {

    $_SESSION['set-message'] = 'Пожалуйста введите сообщение!';
    header('Location: ../index.php');

}