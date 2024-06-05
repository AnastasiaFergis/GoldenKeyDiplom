
<?php
  session_start();
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
      $showLoginIcon = false;
  } else {
      $showLoginIcon = true;
  }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>GoldenKey &mdash; Недвижимость</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap5" />
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<link rel="stylesheet" href="css/tiny-slider.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>
	<nav class="site-nav">
		<div class="container">
			<div class="menu-bg-wrap">
				<div class="site-navigation">
					<a href="index.php" class="logo m-0 float-start">Golden Key</a>
					<ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
						<li><a href="index.php">Главная</a></li>
						<li class="has-children active">
							<a href="properties.php">Недвижимость</a>
							<ul class="dropdown">
								<li><a href="properties.php">Купить недвижимость</a></li>
								<li><a href="property-sell.php" onclick="checkAuthorization(event)">Продать недвижимость</a></li>
								</li>
							</ul>
						</li>
						<li><a href="services.php">Услуги</a></li>
						<li><a href="about.php">О нас</a></li>
						<li><a href="contact.php">Наши контакты</a></li>
						<?php if($showLoginIcon): ?>
						<li>
							<a href="auth.php" >
								<div class="col-12 justify-content-center">
									<input type="submit" id="submitBtn" value="Войти" class="btn-signin">
								</div>
							</a>
						</li>
						<?php endif; ?>
						<?php if(!$showLoginIcon): ?>
						<li>
							<a href="vendor/logout.php">
								<img style="height: 26.5px; width: 26.5px;" src="images/exit.png"/>
							</a>
						</li>
						<?php endif; ?>
					</ul>
					<a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
						<span></span>
					</a>
				</div>
			</div>
		</div>
	</nav>
	<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg');">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-9 text-center mt-5">
					<h1 class="heading" data-aos="fade-up">Недвижимость</h1>

					<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
						<ol class="breadcrumb text-center justify-content-center">
							<li class="breadcrumb-item "><a href="index.php">Главная</a></li>
							<li class="breadcrumb-item active text-white-50" aria-current="page">Недвижимость</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-properties">
		<div class="container">
			<div class="row">
			<?php
			// Подключение к базе данных
			include 'vendor/connect.php';
			
			// Количество записей на одной странице
			$recordsPerPage = 6;

			// SQL-запрос для подсчета общего числа записей
			$sqlCount = "SELECT COUNT(*) AS total FROM RealEstates";
			$resultCount = mysqli_query($connect, $sqlCount);
			$rowCount = mysqli_fetch_assoc($resultCount);
			$totalRecords = $rowCount['total'];

			// Определение общего числа страниц
			$totalPages = ceil($totalRecords / $recordsPerPage);

			// Определение текущей страницы
			if (isset($_GET['page']) && is_numeric($_GET['page'])) {
				$currentPage = intval($_GET['page']);
			} else {
				$currentPage = 1;
			}

			// Рассчет начального смещения
			$offset = ($currentPage - 1) * $recordsPerPage;

			// SQL-запрос для выборки данных
			$sql = "SELECT r.*, s.city, s.street, s.streetNum
				FROM RealEstates AS r
				INNER JOIN Settlements AS s ON r.settlementId = s.settlementId
				WHERE r.image IS NOT NULL
				LIMIT $offset, $recordsPerPage";

			// Выполнение запроса к базе данных
			$result = mysqli_query($connect, $sql);

			// Проверка наличия результатов
			if (mysqli_num_rows($result) > 0) {
				// Вывод данных каждого объекта недвижимости
				while ($row = mysqli_fetch_assoc($result)) {
					echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">';
					echo '<div class="property-item mb-30">';
					echo '<a href="property-buy.php?id=' . $row['realEstatesId'] . '" class="img">';
					echo '<img src="' . $row['image'] . '.jpg" alt="Image" class="img-fluid">';
					echo '</a>';
					echo '<div class="property-content">';
					echo '<div class="price mb-2"><span>' . number_format($row['price'], 0, ',', '.') . ' руб.</span></div>';
					echo '<div>';
					echo '<span class="d-block mb-2 text-black-50">' . $row['street'] . ', ' . $row['streetNum'] . '</span>';
					echo '<span class="city d-block mb-3">г. ' . $row['city'] . '</span>';
					echo '<div class="specs d-flex mb-4">';
					echo '<span class="d-block d-flex align-items-center me-3">';
					echo '<span class="icon-bed me-2"></span>';
					echo '<span class="caption">' . $row['countBedsRooms'] . ' спален</span>';
					echo '</span>';
					echo '<span class="d-block d-flex align-items-center">';
					echo '<span class="icon-bath me-2"></span>';
					echo '<span class="caption">' . $row['countBathsRooms'] . ' ванных комнат</span>';
					echo '</span>';
					echo '</div>';
					echo '<a href="property-buy.php?id=' . $row['realEstatesId'] . '" class="btn btn-primary py-2 px-3">Подробнее</a>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
			} else {
				echo "0 результатов";
			}
			// Закрытие соединения с базой данных
			mysqli_close($connect);
			?>
			</div>
			<div class="row align-items-center py-5">
				<div class="col-lg-3">
					Страница (<?php echo $currentPage; ?> из <?php echo $totalPages; ?>)
				</div>
				<div class="col-lg-6 text-center">
					<div class="custom-pagination">
						<?php
						// Вывод ссылок на страницы
						for ($i = 1; $i <= $totalPages; $i++) {
							echo '<a href="?page=' . $i . '" ' . ($i == $currentPage ? 'class="active"' : '') . '>' . $i . '</a>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="widget">
						<h3>Контакты</h3>
						<ul class="list-unstyled">
							<li><a href="tel://79243196894">+7 (924) 319-68-94-90</a></li>
							<li><a href="tel://79243196894">+7 (924) 319-68-94-90</a></li>
							<li><a href="mailto:info@mydomain.com">goldenkey@mail.ru</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="widget">
						<h3>Ссылки</h3>
						<ul class="list-unstyled links ">
							<li><a href="about.html">О нас</a></li>
							<li><a href="contact.php">Наши контакты</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="widget">
						<h3>Соц Сети</h3>
						<ul class="list-unstyled social">
							<li><a href="#"><span class="icon-instagram"></span></a></li>
							<li><a href="#"><span class="icon-twitter"></span></a></li>
							<li><a href="#"><span class="icon-facebook"></span></a></li>
							<li><a href="#"><span class="icon-linkedin"></span></a></li>
							<li><a href="#"><span class="icon-pinterest"></span></a></li>
							<li><a href="#"><span class="icon-dribbble"></span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-12 text-center">
            		<p>© 2024-2024 «Golden Key» — агентство недвижимости. Все права защищены.</p>
				</div>
        </div>
      </div>
    </div>
    <div id="overlayer"></div>
    <div class="loader">
    	<div class="spinner-border" role="status">
    		<span class="visually-hidden">Загрузка..</span>
    	</div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
	<script>
        function checkAuthorization(event) {
            <?php if ($showLoginIcon): ?>
                event.preventDefault();
                alert("Пожалуйста, авторизуйтесь, чтобы продать недвижимость.");
            <?php else: ?>
                window.location.href = "property-sell.php";
            <?php endif; ?>
        }
    </script>
  </body>
  </html>
