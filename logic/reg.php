<?php
session_start();
require_once 'db-connect.php';

$login = trim($_POST['login']);
$password = htmlentities(trim($_POST['password']));
$passwordConfirm = htmlentities(trim($_POST['password-confirm']));

if (!empty($login) && !empty($password) && !empty($passwordConfirm)) {

    //проверка длины логина и пароля
    if (50 < mb_strlen($login)) {
        $_SESSION['reg-message'] = 'Логин не должен превышать 50 символов';
    } elseif (150 < mb_strlen($password)) {
        $_SESSION['reg-message'] = 'Пароль не должен превышать 150 символов';
    } else {
        if ($password === $passwordConfirm) {

            $queryCheckUser = $connectDB->prepare("SELECT EXISTS(SELECT login FROM forumsbo.users WHERE login = :login)");
            $queryCheckUser->execute([":login" => $login]);
            if ($queryCheckUser->fetchColumn()) {
                header('Location: ../registration.php');
                die($_SESSION['reg-message'] = 'Пользователь с таким логином уже существует');
            }

            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = $connectDB->prepare("INSERT INTO forumsbo.users(login, password) VALUE (:login, :password)");
            $query->execute([':login' => $login, ':password' => $password]);
            $_SESSION['auth-message'] = 'Вы успешно зарегистрировались';
            header('Location: ../authorization.php');

        } else {
            $_SESSION['reg-message'] = 'Пароли не совпадают';
            header('Location: ../registration.php');
        }
    }

} else {
    $_SESSION['reg-message'] = 'Пожалуйста заполните все поля';
    header('Location: ../registration.php');
}









