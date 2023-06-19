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

// Получаем ID расписания, которое нужно удалить
$timetableID = $_POST['id'];

// Удаляем связанные записи из других таблиц (если необходимо)
// ...

// Удаляем расписание из таблицы timetable
$sql = "DELETE FROM timetable WHERE id = '$timetableID'";
$conn->query($sql);

$conn->close();
?>
