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

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем значения полей формы
    $full_name = $_POST['full_name'];
    $overview = $_POST['overview'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];

    // Проверяем, что все поля заполнены
    if (!empty($full_name) && !empty($overview) && !empty($phone) && !empty($description)) {
        // Создаем новую запись в базе данных
        $sql = "INSERT INTO trainers (full_name, overview, phone, description) VALUES ('$full_name', '$overview', '$phone', '$description')";
        if ($conn->query($sql) === TRUE) {
            // Запись успешно добавлена, перенаправляем пользователя на страницу администратора
            header("Location: adminpanel.php");
            exit();
        } else {
            echo "Ошибка при добавлении тренера: " . $conn->error;
        }
    } else {
        echo "Пожалуйста, заполните все поля формы.";
    }
}

$conn->close();
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
                                    <th class="head" scope="col">Полное имя</th>
                                    <th class="head" scope="col">Занятие</th>
                                    <th class="head" scope="col">Телефон</th>
                                    <th class="head" scope="col">Описание</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="full_name">
                                    </td>
                                    <td>
                                        <input type="text" name="overview">
                                    </td>
                                    <td>
                                        <input type="text" name="phone">
                                    </td>
                                    <td>
                                        <textarea name="description"></textarea>
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
</body>
</html>
