<?php
session_start();

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['user_id'])) {
    // Если пользователь не авторизован, перенаправляем на страницу авторизации
    header("Location: auth.php");
    exit();
}

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitnessclub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение значения переменной из сессии
$userID = $_SESSION['user_id'];

// Обработка сохранения данных пользователя
if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $fullName = $_POST['full_name'];
    $phone = $_POST['phone'];

    // Обновление данных пользователя в базе данных
    $updateSql = "UPDATE clients SET login=?, full_name=?, phone=? WHERE ID=?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssi", $login, $fullName, $phone, $userID);

    if ($updateStmt->execute()) {
        echo "Данные пользователя успешно обновлены.";
    } else {
        echo "Ошибка при обновлении данных пользователя: " . $conn->error;
    }
}

// Выполнение запроса к базе данных
$sql = "SELECT login, full_name, phone FROM clients WHERE ID='$userID'";
$result = $conn->query($sql);

// Проверка результата запроса
if ($result && $result->num_rows > 0) {
    // Обработка результатов запроса
    $row = $result->fetch_assoc();
    $login = $row['login'];
    $fullName = $row['full_name'];
    $phone = $row['phone'];
} else {
    echo "Данные пользователя не найдены.";
}

// Закрытие соединения с базой данных
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
                                    <th class="head" scope="col">Логин</th>
                                    <th class="head" scope="col">Полное имя</th>
                                    <th class="head" scope="col">Телефон</th>
                                    <th class="head" scope="col">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="login" value="<?php echo $login; ?>">
                                    </td>
                                    <td>
                                        <input type="text" name="full_name" value="<?php echo $fullName; ?>">
                                    </td>
                                    <td>
                                        <input type="text" name="phone" value="<?php echo $phone; ?>">
                                    </td>
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