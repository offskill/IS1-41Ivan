  <?php
  // Проверяем, передан ли идентификатор тренера в URL
  if (!isset($_GET['id'])) {
      echo "Идентификатор тренера не указан.";
      exit();
  }

  // Получаем идентификатор тренера из URL
  $trainerID = $_GET['id'];

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

  // Получаем данные выбранного тренера из базы данных
  $sql = "SELECT * FROM trainers WHERE id = '$trainerID'";
  $result = $conn->query($sql);

  // Проверяем, найден ли тренер
  if ($result->num_rows == 1) {
      // Извлекаем данные тренера
      $row = $result->fetch_assoc();
      $fullName = $row['full_name'];
      $overview = $row['overview'];
      $phone = $row['phone'];
      $description = $row['description'];

      // Обрабатываем отправку формы для обновления данных тренера
      if (isset($_POST['submit'])) {
          $newFullName = $_POST['full_name'];
          $newOverview = $_POST['overview'];
          $newPhone = $_POST['phone'];
          $newDescription = $_POST['description'];

          // Обновляем данные тренера в базе данных
          $updateSql = "UPDATE trainers SET full_name = '$newFullName', overview = '$newOverview', phone = '$newPhone', description = '$newDescription' WHERE id = '$trainerID'";

          if ($conn->query($updateSql) === TRUE) {
              // Перенаправляем на страницу с тренерами после успешного обновления
              header("Location: adminpanel.php");
              exit();
          } else {
              echo "Ошибка при обновлении данных тренера: " . $conn->error;
          }
      }
  } else {
      echo "Тренер не найден.";
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
                                      <th class="head" scope="col">Полное имя</th>
                                      <th class="head" scope="col">Обзор</th>
                                      <th class="head" scope="col">Телефон</th>
                                      <th class="head" scope="col">Описание</th>
                                      <th class="head" scope="col">Действие</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <input type="text" name="full_name" value="<?php echo $fullName; ?>">
                                      </td>
                                      <td>
                                          <input type="text" name="overview" value="<?php echo $overview; ?>">
                                      </td>
                                      <td>
                                          <input type="text" name="phone" value="<?php echo $phone; ?>">
                                      </td>
                                      <td>
                                          <textarea name="description"><?php echo $description; ?></textarea>
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
