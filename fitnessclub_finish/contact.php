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
		</header>

			<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Контакты				
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Главная </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.php"> Контакты</a></p>
						</div>	
					</div>
				</div>
			</section>


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