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
								Наши услуги				
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Главная </a>  <span class="lnr lnr-arrow-right"></span>  <a href="services.php"> Наши услуги</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start offred Area -->
			<section class="offred-area section-gap">
				<div class="container">
					<div class="row section-title">
						<h1>Мы предлагаем широкий спектр услуг</h1>
						<p> Чтобы помочь вам достичь ваших фитнес-целей и поддерживать здоровый образ жизни.</p>
					</div>					
					<div class="row">
						<div class="col-lg-4">
							<div class="single-offred">
								<img class="img-fluid" src="img/o1.jpg" alt="">
								<a href="#"><h4>Регулярные тренировки</h4></a>
								<p>
									Занимайтесь фитнесом регулярно и поддерживайте свою форму.
								</p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-offred">
								<img class="img-fluid" src="img/o2.jpg" alt="">
								<a href="#"><h4>Тренировки в любом месте</h4></a>
								<p>
								 Наш клуб предлагает гибкое расписание тренировок и возможность тренироваться в фитнес-зале, дома или даже на открытом воздухе.
								</p>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-offred">
								<img class="img-fluid" src="img/o3.jpg" alt="">
								<a href="#"><h4>Программы по наращиванию мышц</h4></a>
								<p>
								 Мы предлагаем специализированные тренировки, уделяя особое внимание силовым упражнениям и увеличению мышечной массы.
							</div>
						</div>
					</div>
			</section>
			<!-- End offred Area -->
			
									
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

			<!-- Start top-course Area -->
			<section class="top-course-area section-gap">
				<div class="container">
					<div class="row section-title">
						<h1>Откройте новые грани фитнеса c нашими тренировками</h1>
						<p>Несколько вариантов наших групповых занятий</p>
					</div>	
					<div class="row">
						<div class="active-topcourse-carusel">
						<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider7.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Танцевальные тренировки</h4>
									</a>
									<h4 class="price">800₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider8.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Йога</h4>
									</a>
									<h4 class="price">500₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider9.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Низкоударные тренировки</h4>
									</a>
									<h4 class="price">400₽/час</h4>
								</div>
							</div>			
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider4.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Аэробные нагрузки</h4>
									</a>
									<h4 class="price">600₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider5.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Силовые тренировки</h4>
									</a>
									<h4 class="price">700₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider6.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Кардио + силовые</h4>
									</a>
									<h4 class="price">600₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
                <div class="thumb">
                    <img class="img-fluid" src="img/slider1.jpg" alt="">
                    <div class="join-btn"><a href="#">Записаться</a></div>
                </div>
                <div class="title-price d-flex justify-content-between">
                    <a href="#">
                        <h4>Бег на свежем воздухе</h4>
                    </a>
                    <h4 class="price">400₽/час</h4>
                </div>
              </div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider2.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Пауэрлифтинг</h4>
									</a>
									<h4 class="price">600₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider3.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Кроссфит</h4>
									</a>
									<h4 class="price">500₽/час</h4>
								</div>
							</div>							

							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider10.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Круговой тренинг</h4>
									</a>
									<h4 class="price">900₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider11.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Смешанные тренировки</h4>
									</a>
									<h4 class="price">600₽/час</h4>
								</div>
							</div>
							<div class="single-carusel item">
								<div class="thumb">
									<img class="img-fluid" src="img/slider12.jpg" alt="">
									<div class="join-btn"><a href="#">Записаться</a></div>
								</div>
								<div class="title-price d-flex justify-content-between">
									<a href="#">
										<h4>Анаэробная нагрузка</h4>
									</a>
									<h4 class="price">400₽/час</h4>
								</div>
							</div>																												
						</div>
					</div>
				</div>	
			</section>
			<!-- End top-course Area -->		

			<!-- Start testomial Area -->
			<section class="testomial-area section-gap">
				<div class="container">
					<div class="row section-title">
						<h1>Отзывы наших клиентов</h1>
						<p>Поделись своим опытом и помоги другим достигнуть цели!</p>
					</div>			
					<?php
					// Подключаемся к базе данных
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "fitnessclub";
					
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
					  die("Ошибка подключения: " . $conn->connect_error);
					}
					
					// Выполняем запрос на выборку отзывов
					$sql = "SELECT description, full_name FROM reviews WHERE description IS NOT NULL AND full_name IS NOT NULL";
					$result = $conn->query($sql);
					
					// Выводим отзывы в виде слайдера с помощью библиотеки Owl Carousel
					if ($result->num_rows > 0) {
					  echo "<div class='active-testimonial-carusel'>";
					  $i = 0;
					  while ($row = $result->fetch_assoc()) {
					    if ($i % 1 == 0) {
					      echo "<div class='single-testimonial item'>";
					    }
					    echo "<div class='testimonial'><p class='desc'>" . $row["description"] . "</p><h4>" . $row["full_name"] . "</h4></div>";
					    if ($i % 1 == 0) {
					      echo "</div>";
					    }
					    $i++;
					  }
					  if ($i % 1 != 0) {
					    echo "</div>";
					  }
					  echo "</div>";
					} else {
					  echo "Нет отзывов.";
					}
					$conn->close();
					?>
		<!-- Другие блоки с отзывами будут добавлены здесь -->
						</div>
					</div>
				</div>	
			</section>
			<!-- End testomial Area -->	

			<!-- Start feature Area -->
			<section class="feature-area section-gap">
				<div class="container">
					<div class="row section-title">
						<h1>Наши преимущества</h1>
						<p>Отличное место для поддержания физической формы</p>
					</div>						
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-6 feature-left">
							<img class="img-fluid" src="img/f.jpg" alt="">
						</div>
						<div class="col-lg-6 feature-right">
							<div class="single-feature">
								<h4><strong>Здоровье и форма</strong></h4>
								<p>
									Идеальное место для тех, кто заботится о своем здоровье и стремится быть в форме. 
								</p>
							</div>
							<div class="single-feature">
								<h4><strong>Энергия и сила</strong></h4>
								<p>
									Тренировки в клубе не только укрепляют мышцы, но и повышают выносливость, улучшают координацию и гибкость.
								</p>
							</div>	
							<div class="single-feature">
								<h4><strong>Гибкость и результаты</strong></h4>
								<p>
									В клубе вы найдете все необходимые условия для развития гибкости и силы, а также индивидуальную поддержку тренера.     
								</p>
							</div>														
						</div>
					</div>
				</div>	
			</section>
			<!-- End feature Area -->																					
			<!-- Start callto Area -->
			<section class="callto-area section-gap relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row">
						<div class="call-wrap mx-auto">
							<h1>Никогда не поздно начать, присоединяйтесь к нам сегодня!</h1>
							<p>
							Превзойдите свои ожидания и достигните новых вершин с нашим фитнес клубом. Наша энергичная атмосфера и профессиональные тренеры помогут вам достичь своих целей и создать здоровый образ жизни.
							</p>
							<a href="#" class="primary-btn">Узнать больше</a>				
						</div>
					</div>
				</div>	
			</section>
			<!-- End callto Area -->			

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