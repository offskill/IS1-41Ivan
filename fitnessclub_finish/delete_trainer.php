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

// Получаем ID тренера, которого нужно удалить
$trainerID = $_POST['id'];

// Удаляем тренера из базы данных
$sql = "DELETE FROM trainers WHERE id = '$trainerID'";
$conn->query($sql);

$conn->close();
?>