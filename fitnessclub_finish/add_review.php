<?php
$servername = "localhost"; //имя сервера базы данных
$username = "root"; //имя пользователя базы данных
$password = ""; //пароль пользователя базы данных
$dbname = "fitnessclub"; //имя базы данных

// Создаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Получаем данные из формы
$full_name = $_POST['full_name'];
$description = $_POST['description'];

// SQL-запрос для записи данных в таблицу "reviews"
$sql = "INSERT INTO reviews (full_name, description) VALUES ('$full_name', '$description')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Отзыв успешно добавлен');window.location.href='index.php';</script>";
} else {
  echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>