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
                        Ваши данные				
                    </h1>	
                    <p class="text-white link-nav"><a href="index.php">Главная </a>  <span class="lnr lnr-arrow-right"></span>  <a href="profile.php">Личный кабинет</a></p>
                </div>	
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- Start trainer Area -->
    <section class="trainer-area section-gap" id="trainer">
    <div class="container">
    <?php
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

    // Получаем данные пользователя из базы данных
    $userID = $_SESSION['user_id'];
    $sql = "SELECT * FROM clients WHERE ID='$userID'";
    $result = $conn->query($sql);

    // Проверяем, есть ли данные пользователя
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login = $row['login'];
        $fullName = $row['full_name'];
        $phone = $row['phone'];

        // Отображаем данные пользователя в таблице
        echo '<div class="row">
                <div class="table-wrap col-lg-12">
                    <h1>Ваши данные</h1>
                    <table class="schdule-table table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="head" scope="col">Логин</th>
                                <th class="head" scope="col">Полное имя</th>
                                <th class="head" scope="col">Телефон</th>
                                <th class="head" scope="col">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>'.$login.'</td>
                                <td>'.$fullName.'</td>
                                <td>+7 '.$phone.'</td>
                                <td><a href="edit_profile.php" class="btn btn-primary">Редактировать</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>';

        // Получаем данные о расписании пользователя и тренерах из базы данных
        $sql = "SELECT entry.*, trainers.full_name, trainers.phone 
            FROM entry 
            JOIN clients ON entry.client_id = clients.ID 
            JOIN trainers ON entry.trainer_id = trainers.ID 
            WHERE clients.ID = '$userID'";
        $result = $conn->query($sql);

        // Отображаем данные о расписании пользователя в таблице
        echo '<div class="row">
                <div class="table-wrap col-lg-12">
                <h1>Ваши записи</h1>
                    <table class="schdule-table table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="head" scope="col">Дата занятия</th>
                                <th class="head" scope="col">Время занятия</th>
                                <th class="head" scope="col">Имя тренера</th>
                                <th class="head" scope="col">Телефон тренера</th>
                                <th class="head" scope="col">Действие</th>
                            </tr>
                        </thead>
                        <tbody>';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $timetableDate = $row['timetable_date'];
                $timetableTime = $row['timetable_time'];
                $trainerName = $row['full_name'];
                $trainerPhone = $row['phone'];

                

                // Remove time from the date
                $timetableDate = explode(' ', $timetableDate)[0];

                echo '<tr>
                        <td>'.$timetableDate.'</td>
                        <td>'.date("g:i", strtotime($timetableTime)).'</td>
                        <td>'.$trainerName.'</td>
                        <td>+7 '.$trainerPhone.'</td>
                        <td><button class="btn btn-danger" onclick="deleteEntry(' . $row['ID'] . ')">Удалить</button></td>
                    </tr>';
            }
        } else {
            echo '<tr><td colspan="6">Нет доступных записей.</td></tr>';
        }

        echo '</tbody>
            </table>
        </div>
    </div>';
    } else {
        echo "Данные пользователя не найдены.";
    }

    $conn->close();
    ?>
</div>
    </section>
</body>
<script>
    function deleteEntry(entryID) {
        if (confirm("Вы уверены, что хотите удалить запись?")) {
            // Отправляем AJAX-запрос на сервер для удаления записи
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_entryprofile.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Обновляем страницу после успешного удаления записи
                    location.reload();
                }
            };
            xhr.send("entryID=" + entryID);
        }
    }
</script>

</html>
