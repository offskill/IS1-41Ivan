<?php
// Подключаемся к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitnessclub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    // Выводим сообщение об ошибке
    die("Ошибка подключения: " . $conn->connect_error);
}

$trainerId = $_GET['trainer_id'];
$date = $_GET['date'];

// Получаем список доступных временных слотов из таблицы timetable
$timetableTimeSql = "SELECT time FROM timetable WHERE trainer_id = '$trainerId' AND date = '$date'";
$timetableTimeResult = $conn->query($timetableTimeSql);
$timetableTimeData = array();

if ($timetableTimeResult->num_rows > 0) {
    while ($timetableTimeRow = $timetableTimeResult->fetch_assoc()) {
        $timetableTimeData[] = $timetableTimeRow['time'];
    }
}

// Отправляем данные в формате JSON
echo json_encode($timetableTimeData);

$conn->close();
?>
