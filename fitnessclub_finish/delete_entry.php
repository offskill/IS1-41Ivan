<?php
// Подключаемся к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitnessclub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем ID записи, которую нужно удалить
$entryID = $_POST['id'];

// Удаляем запись из базы данных
$sql = "DELETE FROM entry WHERE ID = '$entryID'";
if ($conn->query($sql) === TRUE) {
    echo "Запись успешно удалена.";
} else {
    echo "Ошибка при удалении записи: " . $conn->error;
}

$conn->close();
?>
