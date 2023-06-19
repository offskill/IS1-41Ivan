<?php
// Проверяем, передан ли идентификатор записи в URL
if (!isset($_GET['id'])) {
    echo "Идентификатор записи не указан.";
    exit();
}

// Получаем идентификатор записи из URL
$entryID = $_GET['id'];

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

// Получаем данные выбранной записи из базы данных
$sql = "SELECT * FROM entry WHERE ID = '$entryID'";
$result = $conn->query($sql);

// Проверяем, найдена ли запись
if ($result->num_rows == 1) {
    // Извлекаем данные записи
    $row = $result->fetch_assoc();
    $timetableDate = $row['timetable_date'];
    $timetableTime = $row['timetable_time'];
    $clientID = $row['client_id'];
    $trainerID = $row['trainer_id'];

    // Получаем данные клиента
    $clientSql = "SELECT full_name FROM clients WHERE ID = '$clientID'";
    $clientResult = $conn->query($clientSql);
    $clientRow = $clientResult->fetch_assoc();
    $clientName = $clientRow['full_name'];

    // Получаем данные тренера
    $trainerSql = "SELECT full_name, phone FROM trainers WHERE ID = '$trainerID'";
    $trainerResult = $conn->query($trainerSql);
    $trainerRow = $trainerResult->fetch_assoc();
    $trainerName = $trainerRow['full_name'];
    $trainerPhone = $trainerRow['phone'];

    // Обрабатываем отправку формы для обновления данных записи
    if (isset($_POST['submit'])) {
        $newTimetableDate = $_POST['timetable_date'];
        $newTimetableTime = $_POST['timetable_time'];

        // Обновляем данные записи в базе данных
// Обновляем данные записи в базе данных
          $updateSql = "UPDATE entry SET timetable_date = '$newTimetableDate', timetable_time = '$newTimetableTime' WHERE ID = '$entryID'";


        if ($conn->query($updateSql) === TRUE) {
            // Перенаправляем на страницу с записями после успешного обновления
            header("Location: adminpanel.php");
            exit();
        } else {
            echo "Ошибка при обновлении данных записи: " . $conn->error;
        }
    }
} else {
    echo "Запись не найдена.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru" class="no-js">
<head>
    <!-- Для мобильных устройств -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/ico.png">
    <!-- Meta Description -->
    <meta name="description" content="Фитнес клуб IvanFitness">
    <!-- Ключевые слова для seo оптимизации -->
    <meta name="keywords" content="Фитнес, Тренировка, Тренажерный зал, Групповые занятия, Кроссфит, Силовые тренировки, Личный тренер">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Название сайта -->
    <title>IvanFitness</title>
    <!--подключение шрифтов -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--CSS -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <section class="trainer-area section-gap" id="trainer">
        <div class="container">
            <div class="row">
                <div class="table-wrap col-lg-12">
                    <form method="POST" action="">
                        <table class="schdule-table table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th class="head" scope="col">Дата занятия</th>
                                    <th class="head" scope="col">Время занятия</th>
                                    <th class="head" scope="col">Имя клиента</th>
                                    <th class="head" scope="col">Имя тренера</th>
                                    <th class="head" scope="col">Телефон тренера</th>
                                    <th class="head" scope="col">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <input type="text" name="timetable_date" value="<?php echo date('Y-m-d', strtotime($timetableDate)); ?>">
                                    </td>
                                    <td>
                                    <input type="text" name="timetable_time" value="<?php echo date('h:i', strtotime($timetableTime)); ?>">
                                    </td>
                                    <td><?php echo $clientName; ?></td>
                                    <td><?php echo $trainerName; ?></td>
                                    <td>+7 <?php echo $trainerPhone; ?></td>
                                    <td>
                                        <button type="submit" name="submit" class="btn btn-primary">Сохранить</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
