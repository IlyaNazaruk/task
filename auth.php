<?php
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
$mysql = new mysqli('localhost','IlyaNazaruk','570023Dom','task');

$id = (isset($_POST['id']) && !empty($_POST['id'])) ? $_POST['id'] : "" ;

$login = (isset($_POST['login']) && !empty($_POST['login'])) ? $_POST['login'] : "" ;

$pass = (isset($_POST['pass']) && !empty($_POST['pass'])) ? $_POST['pass'] : "" ;

$pass = password_hash($pass, PASSWORD_DEFAULT);

$result = $mysql -> query("SELECT * FROM `users` WHERE `login` = '$_POST[login]' AND `pass` = '$_POST[pass]'");

$user = $result -> fetch_assoc();


if ($user == false){
    header("Location: auth.html");
}


$mysql -> close();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/auth.css">
    <script src="js/checkbox.js"></script>
    <title>Сайт!</title>
</head>
<body>

<header class="clearfix">
    <div class="header-auth">
        <p>
            <?= $user['name']?> <?= $user['surname']?>
        </p>
    </div>

    <div class="header-exit">
        <a href="auth.html">
            <button class="btn btn-danger">Выйти</button>
        </a>
    </div>
</header>

<section>
    <div class="container">
        <h5>Все пользователи:</h5>

        <?php
        $db_server = "localhost";
        $db_user = "IlyaNazaruk";
        $db_password = "570023Dom!";
        $db_name = "task";
        try {
            /// Открываем соединение, указываем адрес сервера, имя бд, имя пользователя и пароль,
            // также сообщаем серверу в какой кодировке должны вводится данные в таблицу бд.
            $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
            // Устанавливаем атрибут сообщений об ошибках (выбрасывать исключения)
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Запрос на вывод записей из таблицы
            $sql = "SELECT `id`, `login`, `email`, `name`, `surname` FROM `users`";
            // Подготовка запроса
            $statement = $db->prepare($sql);
            // Выполняем запрос
            $statement->execute();
            // Получаем массив строк
            $result_array = $statement->fetchAll();

            // Создаем таблицу вывода и форму для удаления записей
            echo "<form action='delete.php' method='POST' name='form_name1'>";
            echo "<div class='toolbar'>";
            echo "<div class=\"btn-group toolbar-btn\">";
            echo "<input class='btn btn-secondary' type='submit' value='Delete'>";
            echo "<input class='btn btn-secondary' type='submit' value='Block'>";
            echo "<input class='btn btn-secondary' type='submit' value='Unblock'>";
            echo "</div>";
            echo "</div>";
            echo "<table class='table table-hover'>";
            echo "<tr class='thead-dark'><th><a href=\"javascript:sel_all()\" id='select_all'>Select all</a></th><th>Login</th><th>email</th><th>Name</th><th>Surname</th></tr>";
            foreach ($result_array as $result_row) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='delete_row[]' value='" . $result_row["id"] . "'></td>";
                echo "<td>" . $result_row["login"] . "</td>";
                echo "<td>" . $result_row["email"] . "</td>";
                echo "<td>" . $result_row["name"] . "</td>";
                echo "<td>" . $result_row["surname"] . "</td>";
                echo "</tr>";
            }
            echo "</table></form>";
        }

        catch(PDOException $e) {
            echo "Ошибка при удалении записи в базе данных: " . $e->getMessage();
        }

        // Закрываем соединение
        $db = null;
        ?>

    </div>
</section>

</body>
</html>