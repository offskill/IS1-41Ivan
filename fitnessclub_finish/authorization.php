<?php
session_start(); // начинаем сессию для сохранения данных о пользователе

// Подключаемся к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitnessclub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    // Выводим диалоговое окно с сообщением об ошибке
    echo "<script>alert('Connection failed: " . $conn->connect_error . "')</script>";
    // Перенаправляем пользователя на страницу авторизации
    echo "<script>window.location.href='login.php'</script>";
    exit(); // Прерываем выполнение скрипта
}

// Проверяем, были ли отправлены данные из формы авторизации
if (isset($_POST['login']) && isset($_POST['password'])) {
    // Получаем данные, отправленные пользователем из формы авторизации
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Ищем пользователя в таблице clients
    $sql = "SELECT * FROM clients WHERE login='$login'";
    $result = $conn->query($sql);

    // Если пользователь найден
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Проверяем соответствие хешированного пароля
        if ($password === $hashedPassword) {
            $_SESSION['user_id'] = $row['ID'];
            $_SESSION['user_login'] = $row['login'];
            $_SESSION['user_fullname'] = $row['full_name'];

            // Проверяем, является ли пользователь администратором
            if ($login === 'admin' && $password === 'admin') {
                $_SESSION['is_admin'] = true;
                header('Location: adminpanel.php');
                exit();
            } elseif ($row['is_admin'] == 1) {
                $_SESSION['is_admin'] = true;
                header('Location: adminpanel.php');
                exit();
            } else {
                header('Location: index.php');
                exit();
            }
        } else {
            echo "<script>alert('Ошибка авторизации. Проверьте правильность введенных данных.')</script>";
            // Перенаправляем пользователя на страницу авторизации
            echo "<script>window.location.href='auth.php'</script>";
            exit(); // Прерываем выполнение скрипта
        }
    } else {
        echo "<script>alert('Ошибка авторизации. Проверьте правильность введенных данных.')</script>";
        // Перенаправляем пользователя на страницу авторизации
        echo "<script>window.location.href='auth.php'</script>";
        exit(); // Прерываем выполнение скрипта
    }
}

$conn->close();
