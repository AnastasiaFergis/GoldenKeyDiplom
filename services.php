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
	<title>GoldenKey &mdash; Услуги</title>

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
						<li class="has-children">
							<a href="properties.php">Недвижимость</a>
							<ul class="dropdown">
								<li><a href="properties.php">Купить недвижимость</a></li>
								<li><a href="property-sell.php" onclick="checkAuthorization(event)">Продать недвижимость</a></li>
								</li>
							</ul>
						</li>
						<li class="active"><a href="services.php">Услуги</a></li>
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
					<h1 class="heading" data-aos="fade-up">Услуги</h1>

					<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
						<ol class="breadcrumb text-center justify-content-center">
							<li class="breadcrumb-item "><a href="index.php">Главная</a></li>
							<li class="breadcrumb-item active text-white-50" aria-current="page">Услуги</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="section bg-light">
    <div class="container">
			<div class="row">
				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
					<div class="box-feature mb-4">
						<span class="flaticon-house-2 mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Качественная недвижимость</h3>
						<p class="text-black-50">Мы предлагаем только качественные объекты недвижимости, отобранные с особым вниманием к деталям и состоянию.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
					<div class="box-feature mb-4">
						<span class="flaticon-house-4 mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Аренда недвижимости</h3>
						<p class="text-black-50">Предлагаем широкий выбор объектов для аренды, чтобы удовлетворить различные потребности наших клиентов.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
					<div class="box-feature mb-4">
						<span class="flaticon-house-1 mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Дома на продажу</h3>
						<p class="text-black-50">Найдите свой идеальный дом из нашего разнообразного списка доступных домов на продажу.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
					<div class="box-feature mb-4">
						<span class="flaticon-house-3 mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Коммерческая недвижимость</h3>
						<p class="text-black-50">Мы предлагаем широкий выбор коммерческой недвижимости для инвесторов и бизнеса.</p>
					</div>
				</div>

				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
					<div class="box-feature mb-4">
						<span class="flaticon-building mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Поиск недвижимости</h3>
						<p class="text-black-50">Поможем вам найти идеальный вариант недвижимости, соответствующий вашим потребностям и бюджету.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
					<div class="box-feature mb-4">
						<span class="flaticon-house mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Продажа жилых комплексов</h3>
						<p class="text-black-50">Мы предлагаем инвестиционные возможности в продаже жилых комплексов и квартирных зданий.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
					<div class="box-feature mb-4">
						<span class="flaticon-house mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Квартиры на продажу</h3>
						<p class="text-black-50">Предлагаем широкий выбор квартир на продажу в различных районах и ценовых категориях.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
					<div class="box-feature mb-4">
						<span class="flaticon-building mb-4 d-block"></span>
						<h3 class="text-black mb-3 font-weight-bold">Ипотечное кредитование</h3>
						<p class="text-black-50">Поможем вам с оформлением ипотечного кредита для приобретения жилья по выгодным условиям.</p>
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
