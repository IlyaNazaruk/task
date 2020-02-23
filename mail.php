<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$login = (isset($_POST['login']) && !empty($_POST['login'])) ? $_POST['login'] : "" ;

$email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : "" ;

$name = (isset($_POST['name']) && !empty($_POST['name'])) ? $_POST['name'] : "" ;

$surname = (isset($_POST['surname']) && !empty($_POST['surname'])) ? $_POST['surname'] : "" ;

$pass = (isset($_POST['pass']) && !empty($_POST['pass'])) ? $_POST['pass'] : "" ;

//echo $login,' , ', $email,' , ', $name,' , ', $surname,' , ', $pass;


if (strlen($login) === 0 || strlen($login) > 100) {
    echo "Недопустимая длина логина";
    exit();
} else if (strlen($name) === 0 || strlen($name) > 100) {
    echo "Недопустимая длина имени";
    exit();
} else if (strlen($pass) === 0 || strlen($pass) > 32) {
    echo "Недопустимая длина пароля";
    exit();
}


$pass = password_hash($pass, PASSWORD_DEFAULT);

$mysql = new mysqli('localhost','root','','register');


if (mysqli_connect_error()) {
    die('Ошибка подключения (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
}

echo 'Соединение установлено... ' . $mysql->host_info . "\n";

if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
}


$mysql -> query("INSERT INTO `users` (`login`, `email`, `name`, `surname`, `pass`) VALUES('$_POST[login]', '$_POST[email]', '$_POST[name]', '$_POST[surname]', '$_POST[pass]')");

$mysql -> close();

header('Location: index.html');