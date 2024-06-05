<?php
  session_start();
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
      $showLoginIcon = false;
  } else {
      $showLoginIcon = true;
  }
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>GoldenKey &mdash; О нас</title>

	
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
						<li><a href="services.php">Услуги</a></li>
						<li class="active"><a href="about.php">О нас</a></li>
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
	<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_3.jpg');">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-9 text-center mt-5">
					<h1 class="heading" data-aos="fade-up">О нас</h1>

					<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
						<ol class="breadcrumb text-center justify-content-center">
							<li class="breadcrumb-item "><a href="index.php">Главная</a></li>
							<li class="breadcrumb-item active text-white-50" aria-current="page">О нас</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
    <div class="container">
        <div class="row text-left mb-5">
            <div class="col-12">
                <h2 class="font-weight-bold heading text-primary mb-4">О нас</h2>
            </div>
            <div class="col-lg-6">
                <p class="text-black-50">Компания "GoldenKey" - это ведущий игрок на рынке недвижимости, специализирующийся на предоставлении качественных услуг по покупке, продаже и аренде недвижимости. Наша цель - помочь клиентам осуществить их мечты о жилье, предоставляя высокий уровень сервиса и профессиональное сопровождение на каждом этапе.</p>
                <p class="text-black-50">Мы гордимся нашим опытом работы на рынке недвижимости и стремимся к постоянному совершенствованию наших услуг, чтобы удовлетворить потребности наших клиентов в полной мере. Наша команда состоит из опытных и преданных профессионалов, готовых предложить вам индивидуальный подход и решения, соответствующие вашим потребностям.</p>
            </div>
            <div class="col-lg-6">
                <p class="text-black-50">Мы стремимся к превосходству во всем, что делаем, и уделяем особое внимание удовлетворенности наших клиентов. Наша миссия - быть вашим надежным партнером в мире недвижимости, предлагая вам не только широкий выбор объектов, но и доверие, прозрачность и профессионализм в каждой сделке.</p>
            </div>
        </div>
    </div>
</div>

	<div class="section pt-0">
		<div class="container">
			<div class="row justify-content-between mb-5">
				<div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
					<div class="img-about dots">
						<img src="images/hero_bg_3.jpg" alt="Image" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-home2"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">Качественная недвижимость</h3>
							<p class="text-black-50">Мы предлагаем только высококачественные объекты недвижимости, отобранные с особым вниманием к деталям и качеству.</p>
						</div>
					</div>
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-person"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">Топовые агенты</h3>
							<p class="text-black-50">Наши агенты - профессионалы своего дела с высокой репутацией и многолетним опытом работы в сфере недвижимости.</p>
						</div>
					</div>
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-security"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">Просто и безопасно</h3>
							<p class="text-black-50">Мы стремимся сделать процесс покупки и продажи недвижимости максимально простым и безопасным для наших клиентов.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section pt-0">
		<div class="container">
			<div class="row justify-content-between mb-5">
				<div class="col-lg-7 mb-5 mb-lg-0">
					<div class="img-about dots">
						<img src="images/hero_bg_2.jpg" alt="Image" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-map-marker"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">Удобное расположение</h3>
							<p class="text-black-50">Мы предлагаем недвижимость в удобных и привлекательных локациях, отвечающих потребностям наших клиентов.</p>
						</div>
					</div>
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-money"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">Гибкие финансовые условия</h3>
							<p class="text-black-50">Мы предлагаем разнообразные финансовые варианты, чтобы сделать покупку недвижимости доступной для каждого клиента.</p>
						</div>
					</div>
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-support"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">Профессиональная поддержка</h3>
							<p class="text-black-50">Наша команда готова предоставить вам высококачественную и индивидуальную поддержку на каждом этапе сделки с недвижимостью.</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
					<img src="images/img_1.jpg" alt="Image" class="img-fluid">
				</div>
				<div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
					<img src="images/img_3.jpg" alt="Image" class="img-fluid">
				</div>
				<div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
					<img src="images/img_2.jpg" alt="Image" class="img-fluid">
				</div>
			</div>
			<div class="row section-counter mt-5">
				<div class="col-6 col-sm-6 col-md-6 col-lg-3 data-aos-delay="300">
					<div class="counter-wrap mb-5 mb-lg-0">
						<span class="number"><span class="countup text-primary">3298</span></span>
						<span class="caption text-black-50"># Купленой недвижимости</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3 data-aos-delay="400">
					<div class="counter-wrap mb-5 mb-lg-0">
						<span class="number"><span class="countup text-primary">2181</span></span>
						<span class="caption text-black-50"># Закрытых сделок</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3 data-aos-delay="500">
					<div class="counter-wrap mb-5 mb-lg-0">
						<span class="number"><span class="countup text-primary">9316</span></span>
						<span class="caption text-black-50"># Клиентов</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3 data-aos-delay="600">
					<div class="counter-wrap mb-5 mb-lg-0">
						<span class="number"><span class="countup text-primary">712</span></span>
						<span class="caption text-black-50"># Агентов</span>
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
