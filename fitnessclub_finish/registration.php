<?php
    $host='localhost';
    $database='fitnessclub';
    $user='root';
    $password='';
    $query = '';
    $result = '';
    $link = mysqli_connect($host, $user, $password, $database) or die ("Ошибка".mysqli_error($link));

    if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['full_name']) && isset($_POST['phone']))
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $full_name = $_POST['full_name'];
        $phone = $_POST['phone'];

            $query = "INSERT INTO clients (login, password, password2, full_name, phone) values('$login', '$password', '$password2', '$full_name', '$phone')";
            $result = mysqli_query($link, $query) or die("Ошибка".mysqli_error($link));



        echo "<script>alert(\"Вы зарегистрированы!\");
location.href='http://localhost/fitnessclub_finish/index.php';</script>";
exit;
    }
    else{
        echo "<script>alert(\"Сбой в регистрации!\")";
    }
?>