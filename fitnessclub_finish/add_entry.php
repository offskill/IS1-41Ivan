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

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем значения полей формы
    $timetableDate = $_POST['timetable_date'];
    $timetableTime = $_POST['timetable_time'];
    $clientId = $_POST['client_id'];
    $trainerId = $_POST['trainer_id'];

    // Проверяем, что все поля заполнены
    if (!empty($timetableDate) && !empty($timetableTime) && !empty($clientId) && !empty($trainerId)) {
        // Проверяем, существует ли timetable_id в таблице timetable
        $timetableIdQuery = "SELECT ID FROM timetable WHERE date = '$timetableDate' AND time = '$timetableTime' AND trainer_id = '$trainerId'";
        $timetableIdResult = $conn->query($timetableIdQuery);

        if ($timetableIdResult->num_rows > 0) {
            $timetableIdRow = $timetableIdResult->fetch_assoc();
            $timetableId = $timetableIdRow['ID'];

            // Создаем новую запись в базе данных
            $sql = "INSERT INTO entry (timetable_id, client_id, trainer_id) VALUES ('$timetableId', '$clientId', '$trainerId')";
            if ($conn->query($sql) === TRUE) {
                // Запись успешно добавлена, перенаправляем пользователя на страницу администратора
                header("Location: adminpanel.php");
                exit();
            } else {
                echo "Ошибка при добавлении записи: " . $conn->error;
            }
        } else {
            echo "Запись в расписании не найдена.";
        }
    } else {
        echo "Пожалуйста, заполните все поля формы.";
    }
}

// Получаем список тренеров из базы данных
$trainerSql = "SELECT * FROM trainers";
$trainerResult = $conn->query($trainerSql);

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
                                    <th class="head" scope="col">Клиент</th>
                                    <th class="head" scope="col">Тренер</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                                  <select name="timetable_date">
                                    <?php
                                    // Получаем список доступных дат из таблицы timetable
                                    $dateSql = "SELECT DISTINCT date FROM timetable";
                                    $dateResult = $conn->query($dateSql);
                                    if ($dateResult->num_rows > 0) {
                                        while ($dateRow = $dateResult->fetch_assoc()) {
                                            $date = date('Y-m-d', strtotime($dateRow['date']));
                                            echo '<option value="' . $date . '">' . $date . '</option>';
                                        }
                                    }
                                    ?>
                                  </select>
                                <input type="hidden" id="hidden_date" name="date" value="">
                                </td>

                                <td>
                                  <select name="timetable_time" id="timetable_time">
                                      <option value="">Выберите тренера для просмотра доступного времени</option>
                                  </select>
                                </td>
                                    <td>
                                        <select name="client_id">
                                            <?php
                                            // Получаем список клиентов из базы данных
                                            $clientSql = "SELECT * FROM clients";
                                            $clientResult = $conn->query($clientSql);
                                            if ($clientResult->num_rows > 0) {
                                                while ($clientRow = $clientResult->fetch_assoc()) {
                                                    echo '<option value="' . $clientRow['ID'] . '">' . $clientRow['full_name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="trainer_id" onchange="updateTimetableTime(this.value)">
                                            <option value="">Выберите тренера</option>
                                            <?php
                                            if ($trainerResult->num_rows > 0) {
                                                while ($trainerRow = $trainerResult->fetch_assoc()) {
                                                    echo '<option value="' . $trainerRow['ID'] . '">' . $trainerRow['full_name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
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
    <script>
function updateTimetableTime(trainerId) {
    var timetableTimeSelect = document.getElementById('timetable_time');
    timetableTimeSelect.innerHTML = '<option value="">Выберите время занятия</option>';

    if (trainerId !== '') {
        var timetableDateSelect = document.getElementsByName('timetable_date')[0];
        var timetableDate = timetableDateSelect.value;
        document.getElementById('hidden_date').value = timetableDate; // Добавлено

        if (timetableDate !== '') {
            var timetableTimeRequest = new XMLHttpRequest();
            timetableTimeRequest.open('GET', 'get_timetable_time.php?trainer_id=' + trainerId + '&date=' + timetableDate, true); // Изменено
            timetableTimeRequest.onload = function () {
                if (this.status >= 200 && this.status < 400) {
                    var timetableTimeData = JSON.parse(this.response);
                    timetableTimeData.forEach(function (time) {
                        var option = document.createElement('option');
                        var formattedTime = time.substr(0, 5); // Извлекаем только первые 5 символов времени
                        option.value = time;
                        option.text = formattedTime;
                        timetableTimeSelect.appendChild(option);
                    });
                }
            };
            timetableTimeRequest.send();
        }
    }
}
</script>
</body>
</html>
