<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_POST['submit'])) {
    $trainer_id = $_POST['trainer_id'];
    $timetable_id = $_POST['timetable_id'];
    $user_id = $_SESSION['user_id'];

    // Подключение к базе данных
    $servername = "localhost"; // Имя сервера базы данных
    $username = "root"; // Имя пользователя базы данных
    $password = ""; // Пароль пользователя базы данных
    $dbname = "fitnessclub"; // Имя базы данных

    // Создание соединения
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения на ошибки
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Проверка на авторизацию пользователя
    $authSql = "SELECT * FROM clients WHERE id = ?";
    $authStmt = $conn->prepare($authSql);
    $authStmt->bind_param("i", $user_id);
    $authStmt->execute();
    $authResult = $authStmt->get_result();

    if ($authResult->num_rows > 0) {
        // Пользователь авторизован

        // Получение данных о занятии из таблицы timetable
        $timetableSql = "SELECT DATE_FORMAT(`date`, '%Y-%m-%d') AS timetable_date, TIME_FORMAT(`time`, '%H:%i') AS timetable_time FROM timetable WHERE ID = ?";
        $timetableStmt = $conn->prepare($timetableSql);
        $timetableStmt->bind_param("i", $timetable_id);
        $timetableStmt->execute();
        $timetableResult = $timetableStmt->get_result();

        if ($timetableResult->num_rows > 0) {
            $timetableRow = $timetableResult->fetch_assoc();
            $timetable_date = $timetableRow['timetable_date'];
            $timetable_time = $timetableRow['timetable_time'];

            // Проверка, существует ли уже запись для данного тренера, расписания и пользователя
            $checkEntrySql = "SELECT * FROM entry WHERE trainer_id = ? AND timetable_id = ? AND client_id = ?";
            $checkEntryStmt = $conn->prepare($checkEntrySql);
            $checkEntryStmt->bind_param("iii", $trainer_id, $timetable_id, $user_id);
            $checkEntryStmt->execute();
            $checkEntryResult = $checkEntryStmt->get_result();

            if ($checkEntryResult->num_rows > 0) {
                // Запись уже существует
                echo "Вы уже записаны на данное занятие с данным тренером.";
            } else {
                // Запись не существует, добавляем новую запись в таблицу entry
                $insertEntrySql = "INSERT INTO entry (trainer_id, timetable_id, client_id, timetable_date, timetable_time) VALUES (?, ?, ?, ?, ?)";
                $insertEntryStmt = $conn->prepare($insertEntrySql);
                $insertEntryStmt->bind_param("iiiss", $trainer_id, $timetable_id, $user_id, $timetable_date, $timetable_time);

                if ($insertEntryStmt->execute()) {
                    echo "Вы успешно записались на данное занятие с данным тренером.";
                } else {
                    echo "Ошибка при записи на занятие: " . $conn->error;
                }
            }
        } else {
            echo "Ошибка при получении данных о занятии.";
        }
    } else {
        echo "Вы не авторизованы. Необходимо войти в систему.";
    }

    // Закрытие соединения с базой данных
    $conn->close();
}
?>