<?php
session_start();
require_once 'db-connect.php';

$login = htmlentities(trim($_POST['login']));
$password = htmlentities(trim($_POST['password']));

if (!empty($login) && !empty($password)) {

    $query = $connectDB->prepare("SELECT * FROM forumsbo.users WHERE login = :login");
    $query->execute([":login" => $login]);
    $user = $query->fetch(PDO::FETCH_OBJ);

    if ($user) {

        if (password_verify($password, $user->password)) {
            setcookie('sign-in', $login, 0, '/');
            $_SESSION['user-login'] = $user->login;
            $_SESSION['user-id'] = $user->id;
            header('Location: ../index.php');

        } else {
            $_SESSION['auth-message'] = 'Неверный логин или пароль';
            header('Location: ../authorization.php');
        }

    } else {
        $_SESSION['auth-message'] = 'Неверный логин или пароль';
        header('Location: ../authorization.php');
    }

} else {
    $_SESSION['auth-message'] = 'Пожалуйста заполните все поля';
    header('Location: ../authorization.php');
}