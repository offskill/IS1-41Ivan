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
<header id="header">
        <div class="container main-menu">
            <div class="row align-items-center justify-content-center">
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="index.php"><h2>IvanFitness</h2></a></li>
                        <li class="menu-active"><a href="index.php">Главная</a></li>
                        <li class="menu-active"><a href="about.php">О нас</a></li>
                        <li class="menu-active"><a href="services.php">Наши услуги</a></li>
                        <li class="menu-active"><a href="trainers.php">Тренеры</a></li>
                        <li class="menu-active"><a href="contact.php">Контакты</a></li>

                        <?php									
                        session_start();
                        if (isset($_SESSION['user_id'])) {
                            // Пользователь авторизован
                            if ($_SESSION['user_login'] === 'admin') {
                                // Показать ссылку на админ-панель для администратора
                                echo '<li class="menu-active"><a href="adminpanel.php">Личный кабинет</a></li>';
                            } else {
                                // Показать ссылку на личный кабинет для обычного пользователя
                                echo '<li class="menu-active"><a href="profile.php">Личный кабинет</a></li>';
                            }
                            echo '<li class="menu-active"><a href="logout.php">Выход</a></li>'; // Добавленная кнопка выхода
                        } else {
                            // Пользователь не авторизован
                            echo '<li class="menu-active"><a class="reg-click" href="reg.php">Регистрация</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header><!-- #header -->	

    <!-- start banner Area -->
    <section class="banner-area relative about-banner" id="home">	
        <div class="overlay overlay-bg"></div>
        <div class="container">				
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        Админ панель		
                    </h1>	
                    <p class="text-white link-nav"><a href="index.php">Главная </a>  <span class="lnr lnr-arrow-right"></span>  <a href="profile.php">Личный кабинет</a></p>
                </div>	
            </div>
        </div>
    </section>
    <section class="trainer-area section-gap" id="trainer">
    <div class="container">
    <?php
// Проверяем, авторизован ли пользователь
// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    // Если пользователь не авторизован, перенаправляем на страницу авторизации
    header("Location: auth.php");
    exit();
}

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

// Получаем данные всех клиентов из базы данных
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

// Проверяем, есть ли данные клиентов
if ($result->num_rows > 0) {
    // Отображаем таблицу всех клиентов
    echo '<div class="row">
            <h1>Клиенты <a href="add_client.php" class="btn btn-success mr-5">Добавить</a>
            </h1>
            <div class="table-wrap col-lg-12">
                <table class="schedule-table table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th class="head" scope="col">Логин</th>
                            <th class="head" scope="col">Полное имя</th>
                            <th class="head" scope="col">Телефон</th>
                            <th class="head" scope="col" style="width: 300px;">Действие</th>
                        </tr>
                    </thead>
                    <tbody>';

    while ($row = $result->fetch_assoc()) {
        $clientID = $row['ID'];
        $login = $row['login'];
        $fullName = $row['full_name'];
        $phone = $row['phone'];

        echo '<tr>
                <td>'.$login.'</td>
                <td>'.$fullName.'</td>
                <td>+7 '.$phone.'</td>
                <td>
                    <a href="edit_client.php?id='.$clientID.'" class="btn btn-primary">Редактировать</a>
                    <button class="btn btn-danger" onclick="deleteClient(' . $clientID . ')">Удалить</button>
                </td>
            </tr>';
    }

    echo '</tbody>
        </table>
    </div>
</div>';
} else {
    echo "Нет данных о клиентах.";
}

// Получаем данные всех тренеров из базы данных
$sql = "SELECT * FROM trainers";
$result = $conn->query($sql);

// Проверяем, есть ли данные тренеров
if ($result->num_rows > 0) {
    // Отображаем таблицу всех тренеров
    echo '<div class="row">
            <h1>Тренеры <a href="add_trainer.php" class="btn btn-success mr-5">Добавить</a></h1>
            <div class="table-wrap col-lg-12">
                <table class="schedule-table table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th class="head" scope="col">Полное имя</th>
                            <th class="head" scope="col">Занятие</th>
                            <th class="head" scope="col">Телефон</th>
                            <th class="head" scope="col">Описание</th>
                            <th class="head" scope="col" style="width: 300px;">Действие</th>
                        </tr>
                    </thead>
                    <tbody>';

    while ($row = $result->fetch_assoc()) {
        $trainerID = $row['ID']; 
        $full_name = $row['full_name'];
        $overview = $row['overview'];
        $phone = $row['phone'];
        $description = $row['description'];
        echo '<tr>
                <td>'.$full_name.'</td>
                <td>'.$overview.'</td>
                <td>+7 '.$phone.'</td>
                <td>'.$description.'</td>
                <td>
                    <a href="edit_trainer.php?id='.$trainerID.'" class="btn btn-primary">Редактировать</a>
                    <button class="btn btn-danger" onclick="deleteTrainer('.$trainerID.')">Удалить</button>
                </td>
            </tr>';
    }

    echo '</tbody>
        </table>
    </div>
</div>';
} else {
    echo "Нет данных о тренерах.";
}

// Получаем данные о расписании клиентов из базы данных
$sql = "SELECT entry.*, clients.full_name AS client_name, trainers.full_name AS trainer_name, trainers.phone AS trainer_phone 
    FROM entry 
    JOIN clients ON entry.client_id = clients.ID 
    JOIN trainers ON entry.trainer_id = trainers.ID";
$result = $conn->query($sql);

// Отображаем данные о расписании клиентов в таблице
echo '<div class="row">
        <h1>Записи клиентов <a href="add_entry.php" class="btn btn-success mr-5">Добавить</a></h1>
        <div class="table-wrap col-lg-12">
            <table class="schedule-table table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th class="head" scope="col">Дата занятия</th>
                        <th class="head" scope="col">Время занятия</th>
                        <th class="head" scope="col">Имя клиента</th>
                        <th class="head" scope="col">Имя тренера</th>
                        <th class="head" scope="col">Телефон тренера</th>
                        <th class="head" scope="col" style="width: 300px;">Действие</th>
                    </tr>
                </thead>
                <tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $timetableDate = $row['timetable_date'];
        $timetableTime = $row['timetable_time'];
        $clientName = $row['client_name'];
        $trainerName = $row['trainer_name'];
        $trainerPhone = $row['trainer_phone'];
        // Remove time from the date
        $timetableDate = explode(' ', $timetableDate)[0];
        $entryID = $row['ID']; 

        echo '<tr>
                <td>'.$timetableDate.'</td>
                <td>'.date("g:i", strtotime($timetableTime)).'</td>
                <td>'.$clientName.'</td>
                <td>'.$trainerName.'</td>
                <td>+7 '.$trainerPhone.'</td>
                <td>
                <a href="edit_entry.php?id='.$entryID.'" class="btn btn-primary">Редактировать</a>
                <button class="btn btn-danger" onclick="deleteEntry('.$entryID.')">Удалить</button>
                </td>
            </tr>';
        }

        echo '</tbody>
            </table>
        </div>
    </div>';
    } else {
        echo "Нет данных о записях.";
    }

// Получаем данные о расписании из базы данных
$sql = "SELECT timetable.ID, timetable.trainer_id, trainers.full_name AS trainer_name, timetable.title, timetable.description, timetable.date, timetable.time
    FROM timetable
    JOIN trainers ON timetable.trainer_id = trainers.ID";
$result = $conn->query($sql);

// Отображаем данные о расписании в таблице
echo '<div class="row">
        <h1>Расписание тренеров <a href="add_timetable.php" class="btn btn-success mr-5">Добавить</a></h1>
        <div class="table-wrap col-lg-12">
            <table class="schedule-table table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th class="head" scope="col">Имя тренера</th>
                        <th class="head" scope="col">Название</th>
                        <th class="head" scope="col">Описание</th>
                        <th class="head" scope="col">Дата</th>
                        <th class="head" scope="col">Время</th>
                        <th class="head" scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trainerName = $row['trainer_name'];
        $title = $row['title'];
        $description = $row['description'];
        $date = $row['date'];
        $time = $row['time'];

        echo '<tr>
                <td>'.$trainerName.'</td>
                <td>'.$title.'</td>
                <td>'.$description.'</td>
                <td>'.$date.'</td>
                <td>'.date("H:i", strtotime($time)).'</td>
                <td>
                    <button class="btn btn-primary" onclick="editTimetable()">Редактировать</button>
                    <button class="btn btn-danger" onclick="deleteTimetable('.$row['ID'].')">Удалить</button>
                </td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="6">Нет доступных записей.</td></tr>';
}
echo '</tbody>
    </table>
</div>
</div>';


$conn->close();
?>
    </div>
    </section>
    <script>
    function deleteClient(clientID) {
        if (confirm("Вы уверены, что хотите удалить запись?")) {
            // Отправляем AJAX-запрос на сервер для удаления записи
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_client.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Обновляем страницу после успешного удаления записи
                    location.reload();
                }
            };
            xhr.send("id=" + clientID);
        }
    }
    function deleteTrainer(trainerID) {
    if (confirm("Вы уверены, что хотите удалить тренера?")) {
        // Отправляем AJAX-запрос на сервер для удаления тренера
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_trainer.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Обновляем страницу после успешного удаления тренера
                location.reload();
            }
        };
        xhr.send("id=" + trainerID);
    }
}
function deleteEntry(entryID) {
    if (confirm("Вы уверены, что хотите удалить запись?")) {
        // Отправляем AJAX-запрос на сервер для удаления записи
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_entry.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Обновляем страницу после успешного удаления записи
                location.reload();
            }
        };
        xhr.send("id=" + entryID);
    }
}
function deleteTimetable(timetableID) {
    if (confirm("Вы уверены, что хотите удалить запись?")) {
        // Отправляем AJAX-запрос на сервер для удаления записи
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_timetable.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Обновляем страницу после успешного удаления записи
                location.reload();
            }
        };
        xhr.send("id=" + timetableID);
    }
}
</script>
</body>
</html>