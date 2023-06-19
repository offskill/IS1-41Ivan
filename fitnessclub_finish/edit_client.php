<?php
// Проверяем, передан ли идентификатор клиента в URL
if (!isset($_GET['id'])) {
    echo "Идентификатор клиента не указан.";
    exit();
}

// Получаем идентификатор клиента из URL
$clientID = $_GET['id'];

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

// Получаем данные выбранного клиента из базы данных
$sql = "SELECT * FROM clients WHERE id = '$clientID'";
$result = $conn->query($sql);

// Проверяем, найден ли клиент
if ($result->num_rows == 1) {
    // Извлекаем данные клиента
    $row = $result->fetch_assoc();
    $login = $row['login'];
    $fullName = $row['full_name'];
    $phone = $row['phone'];

    // Обрабатываем отправку формы для обновления данных клиента
    if (isset($_POST['submit'])) {
        $newLogin = $_POST['login'];
        $newFullName = $_POST['full_name'];
        $newPhone = $_POST['phone'];

        // Обновляем данные клиента в базе данных
        $updateSql = "UPDATE clients SET login = '$newLogin', full_name = '$newFullName', phone = '$newPhone' WHERE id = '$clientID'";

        if ($conn->query($updateSql) === TRUE) {
            // Перенаправляем на страницу с клиентами после успешного обновления
            header("Location: adminpanel.php");
            exit();
        } else {
            echo "Ошибка при обновлении данных клиента: " . $conn->error;
        }
    }
} else {
    echo "Клиент не найден.";
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