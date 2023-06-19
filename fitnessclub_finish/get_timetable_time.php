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
    die("Connection failed: " . $conn->connect_error);
}

// Получаем значение тренера и даты из GET-параметров
$trainerId = $_GET['trainer_id'];

// Проверяем, что тренер не пустой
if (!empty($trainerId)) {
    // Получаем список доступного времени для выбранного тренера
    $timeSql = "SELECT time FROM timetable WHERE trainer_id = '$trainerId'";
    $timeResult = $conn->query($timeSql);

    $timetableTime = array();

    if ($timeResult->num_rows > 0) {
        while ($timeRow = $timeResult->fetch_assoc()) {
            $timetableTime[] = $timeRow['time'];
        }
    }

    // Возвращаем список времени в формате JSON
    echo json_encode($timetableTime);
}
?>
