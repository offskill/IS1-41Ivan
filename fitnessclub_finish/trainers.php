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
								Тренеры				
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Главная </a>  <span class="lnr lnr-arrow-right"></span>  <a href="trainers.php"> Тренера</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start trainer Area -->
			<section class="trainer-area section-gap" id="trainer">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Наши опытные тренеры</h1>
                    <p>Познакомьтесь с нашей командой опытных тренеров, готовых помочь вам.</p>
                </div>
            </div>
        </div>
<?php
    // Подключение к базе данных
    $servername = "localhost"; // Имя сервера базы данных
    $username = "root"; // Имя пользователя базы данных
    $password = ""; // Пароль пользователя базы данных
    $dbname = "fitnessclub"; // Имя базы данных

    // Создание соединения
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка соединения на ошибки
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Запрос для получения данных из таблицы trainers
    $sql = "SELECT trainers.ID, trainers.full_name, trainers.overview, CONCAT('+7 ', trainers.phone) AS formatted_phone, trainers.description FROM trainers";
    $result = $conn->query($sql);

    // Проверка наличия данных
    if ($result->num_rows > 0) {
        // Вывод данных в таблицу
        echo '
        <div class="row">
            <div class="table-wrap col-lg-12">
                <table class="schdule-table table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th class="head" scope="col">Имя тренера</th>
                            <th class="head" scope="col">Занятие</th>
                            <th class="head" scope="col">Телефон</th>
                            <th class="head" scope="col">Описание</th>
                            <th class="head" scope="col">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
        ';

        // Вывод каждой строки данных в таблицу
        while ($row = $result->fetch_assoc()) {
            echo '
            <tr>
                <th class="name" scope="row">' . $row["full_name"] . '</th>
                <td>' . $row["overview"] . '</td>
                <td>' . str_replace(';0;0;0;00;', '', $row["formatted_phone"]) . '</td>
                <td>' . $row["description"] . '</td>
                <td><a href="?trainer_id=' . $row["ID"] . '" class="btn btn-primary">Показать расписание</a></td>
            </tr>
            ';

            // Проверка, был ли нажато кнопка "Показать расписание" для текущего тренера
            if (isset($_GET['trainer_id']) && $_GET['trainer_id'] == $row["ID"]) {
                // Запрос для получения расписания данного тренера
                $timetableSql = "SELECT timetable.ID, timetable.title, timetable.description AS timetable_description, timetable.date, DATE_FORMAT(timetable.time, '%k:%i') AS formatted_time, clients.full_name AS timetable_client_name FROM timetable LEFT JOIN clients ON timetable.client_id = clients.ID WHERE timetable.trainer_id = " . $row["ID"];
                $timetableResult = $conn->query($timetableSql);

                // Проверка наличия расписания
                if ($timetableResult->num_rows > 0) {
                    echo '
                        <tr class="sub-table">
                            <th colspan="5" class="sub-table-heading">Расписание тренера: ' . $row["full_name"] . '</th>
                        </tr>
                        <tr class="sub-table">
                            <th>Занятие</th>
                            <th>Описание</th>
                            <th>Дата</th>
                            <th>Время</th>
                            <th>Действие</th>
                        </tr>
                    ';

                    // Вывод каждой строки расписания в подтаблицу
                    while ($timetableRow = $timetableResult->fetch_assoc()) {
                        echo '
                            <tr class="sub-table">
                                <td>' . $timetableRow["title"] . '</td>
                                <td>' . $timetableRow["timetable_description"] . '</td>
                                <td>' . $timetableRow["date"] . '</td>
                                <td>' . $timetableRow["formatted_time"] . '</td>
                                <td>
                                    <form method="POST" action="process_entry.php">
                                        <input type="hidden" name="trainer_id" value="' . $row["ID"] . '">
                                        <input type="hidden" name="timetable_id" value="' . $timetableRow["ID"] . '">
                                        <button type="submit" class="btn btn-success" name="submit">Записаться</button>
                                    </form>
                                </td>
                            </tr>
                        ';
                    }
                } else {
                    echo '
                        <tr class="sub-table">
                            <th colspan="5">Нет доступного расписания для тренера: ' . $row["full_name"] . '</th>
                        </tr>
                    ';
                }
            }
        }

        echo '
                    </tbody>
                </table>
            </div>
        </div>
        ';
    } else {
        echo "No data found.";
    }

    // Закрытие соединения с базой данных
    $conn->close();
?>

    </div>
</section>
			<!-- End trainer Area -->

			<!-- Start cta Area -->
			<section class="cta-area">
				<div class="container-fluid">
					<div class="row no-padding">
						<div class="col-lg-6 single-cta cta1 no-padding section-gap relative">
							<div class="overlay overlay-bg"></div>
							<h6 class=text-uppercase>Приходи к нам!</h6>
							<h1>Начни уже сегодня</h1>
							<a href="#" class="primary-btn">Подобрать тренера</a>
						</div>
						<div class="col-lg-6 single-cta cta2 no-padding section-gap relative">
							<div class="overlay overlay-bg"></div>
							<h6 class=text-uppercase>Наша команда ждет тебя!</h6>
							<h1>Видео тренировки для вас</h1>
							<a href="#" class="primary-btn">Смотреть видео</a>			
		
						</div>
					</div>
				</div>	
			</section>
			<!-- End cta Area -->			
					    			
			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>О нас</h4>
								<p>
								Фитнес клуб расположен в центре Ярославля и предлагает широкий спектр услуг для занятий спортом и фитнесом.
								</p>
							</div>
						</div>
						<div class="col-lg-4  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Контакты</h4>
								<p>
									150040, г. Ярославль, ул. Чайковского, д. 55.
								</p>
								<p class="number">
									тел. 8(4852)23-71-77 <br>
									тел./факс 8(4852)23-16-05
								</p>
							</div>
						</div>						
						<div class="col-lg-5  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Рассылка</h4>
								<p>Вы можете доверять нам. мы рассылаем только предложения, ни единого спама..</p>
								<div class="d-flex flex-row" id="mc_embed_signup">


									  <form class="navbar-form" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get">
									    <div class="input-group add-on align-items-center d-flex">
									      	<input class="form-control" name="EMAIL" placeholder="Укажите Email адрес" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Укажите Email адрес'" required="" type="email">
											<div style="position: absolute; left: -5000px;">
												<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
											</div>
									      <div class="input-group-btn">
									        <button class="genric-btn"><span class="lnr lnr-arrow-right"></span></button>
									      </div>
									    </div>
									      <div class="info mt-20"></div>									    
									  </form>
								</div>
							</div>
						</div>						
					</div>
					<div class="footer-bottom row align-items-center">
						<p class="footer-text m-0 col-lg-6 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Все права защищены | IvanFitness</p>
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
 			<script src="js/jquery-ui.js"></script>								
			<script src="js/jquery.nice-select.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>									
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>