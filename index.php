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
	<title>GoldenKey &mdash; Главная</title>

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
						<li class="active"><a href="index.php">Главная</a></li>
						<li class="has-children">
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
	<div class="hero">
		<div class="hero-slide">
			<div class="img overlay" style="background-image: url('images/hero_bg_3.jpg')"></div>
			<div class="img overlay" style="background-image: url('images/hero_bg_2.jpg')"></div>
			<div class="img overlay" style="background-image: url('images/hero_bg_1.jpg')"></div>
		</div>

		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-9 text-center">
					<h1 class="heading">Golden Key</h1>
					<h3 class="heading">Добро пожаловать в агентство недвижимости "Golden Key"! Мы - команда профессионалов, готовых открыть перед вами двери к вашему идеальному дому.</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container">
			<div class="row mb-5 align-items-center">
				<div class="col-lg-6">
					<h2 class="font-weight-bold text-primary heading align-items-center">Актуальная недвижимость</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="property-slider-wrap">
						<div class="property-slider">
							<?php
								// Подключение к базе данных
								include 'vendor/connect.php';
								// SQL-запрос для выбора данных из таблицы RealEstates с объединением с таблицей Settlements
								$sql = "SELECT r.*, s.city, s.street, s.streetNum
									FROM RealEstates AS r
									INNER JOIN Settlements AS s ON r.settlementId = s.settlementId
									WHERE r.image IS NOT NULL";
								// Выполнение запроса
								$result = mysqli_query($connect, $sql);
								// Проверка наличия результатов
								if (mysqli_num_rows($result) > 0) {
									// Цикл по каждой строке результата
									while ($row = mysqli_fetch_assoc($result)) {
										// Форматирование цены
										$formatted_price = number_format($row['price'], 0, ',', '.');
										// Формирование HTML-кода для каждого элемента недвижимости
										echo '<div class="property-item">';
										echo '<a href="property-buy.php?id=' . $row['realEstatesId'] . '" class="img">';
										echo '<img src="' . $row['image'] . '.jpg" alt="Image" class="img-fluid">';
										echo '</a>';
										echo '<div class="property-content">';
										echo '<div class="price mb-2"><span>' . $formatted_price .' руб</span></div>';
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
										echo '</div>';
										echo '</div>';
										echo '</div>';
									}
								} else {
									echo "База данных пуста!";
								}
								// Закрытие соединения с базой данных
								mysqli_close($connect);
							?>
						</div>
						<div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
							<span class="prev" data-controls="prev" aria-controls="property" tabindex="-1"><<<</span>
							<span class="next" data-controls="next" aria-controls="property" tabindex="-1">>>></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="features-1">
		<div class="container">
			<div class="row">
				<div class="col-6 col-lg-3" data-aos-delay="300">
					<div class="box-feature">
						<span class="flaticon-house"></span>
						<h3 class="mb-3">Недвижимость для продажи</h3>
						<p>Мы предлагаем широкий выбор недвижимости для продажи, от квартир в центре города до загородных домов. Независимо от ваших потребностей и предпочтений, у нас есть идеальный вариант для вас. Доверьтесь нам в поиске вашего будущего дома или инвестиционной возможности.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos-delay="500">
					<div class="box-feature">
						<span class="flaticon-building"></span>
						<h3 class="mb-3">Новостройки</h3>
						<p>Мы специализируемся на продаже новостроек, предлагая своим клиентам самые современные и высококачественные жилые комплексы. Сотрудничая с нами, вы получаете доступ к самым актуальным предложениям на рынке недвижимости, а также профессиональное сопровождение на всех этапах сделки.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos-delay="400">
					<div class="box-feature">
						<span class="flaticon-house-3"></span>
						<h3 class="mb-3">Наши агенты</h3>
						<p>Наша команда агентов - это наш главный ресурс. Мы гордимся тем, что наши сотрудники обладают высоким профессионализмом, экспертизой и опытом работы в сфере недвижимости. С нами вы можете быть уверены, что ваша сделка будет успешной и безопасной.</p>
					</div>
				</div>
				<div class="col-6 col-lg-3" data-aos-delay="600">
					<div class="box-feature">
						<span class="flaticon-house-1"></span>
						<h3 class="mb-3">Коттеджи</h3>
						<p>Мечтаете о жизни за городом? Мы предлагаем вам лучшие варианты коттеджей и загородной недвижимости. От уютных домов на берегу озера до элитных резиденций в окружении природы - мы поможем вам найти идеальное место для вашей семьи или отдыха.</p>
					</div>
				</div>	
			</div>
		</div>
	</section>
	<div class="section sec-testimonials">
		<div class="container">
			<div class="row mb-5 align-items-center">
				<div class="col-md-6">
					<h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">Отзывы клиентов</h2>
				</div>
				<div class="col-md-6 text-md-end">
					<div id="testimonial-nav">
						<span class="prev" data-controls="prev"><<<</span>
						<span class="next" data-controls="next">>>></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
				</div>
			</div>
			<div class="testimonial-slider-wrap">
				<div class="testimonial-slider">
					<div class="item">
						<div class="testimonial">
							<img src="images/person_1-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4">
							<div class="rate">
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
							</div>
							<h3 class="h5 text-primary mb-4">Валерий Винда</h3>
							<blockquote>
								<p>&ldquo;Сотрудничество с агентством 'Golden Key' превзошло все мои ожидания! Профессиональный и внимательный подход, а также огромный выбор недвижимости помогли нам быстро найти идеальный дом для нашей семьи. Благодарю за отличную работу!&rdquo;</p>
							</blockquote>
						</div>
					</div>
					<div class="item">
						<div class="testimonial">
							<img src="images/person_2-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4">
							<div class="rate">
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
							</div>
							<h3 class="h5 text-primary mb-4">Сергей Неподкупный</h3>
							<blockquote>
								<p>&ldquo;Я обратился в агентство 'Golden Key' для продажи своего дома, и не могу быть более доволен результатом! Их команда агентов продемонстрировала высочайший профессионализм, и в результате моя недвижимость была продана по выгодной цене. Очень рекомендую!&rdquo;</p>
							</blockquote>
						</div>
					</div>
					<div class="item">
						<div class="testimonial">
							<img src="images/person_3-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4">
							<div class="rate">
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
							</div>
							<h3 class="h5 text-primary mb-4">Даниил Малварка</h3>
							<blockquote>
								<p>&ldquo;За помощь в поиске квартиры хочу выразить благодарность агентству 'Golden Key'. Они подобрали мне идеальный вариант, который полностью соответствует моим требованиям и бюджету. Процесс был очень гладким и комфортным благодаря их профессионализму и внимательности к деталям&rdquo;</p>
							</blockquote>
						</div>
					</div>
					<div class="item">
						<div class="testimonial">
							<img src="images/person_4-min.jpg" alt="Image" class="img-fluid rounded-circle w-25 mb-4">
							<div class="rate">
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
								<span class="icon-star text-warning"></span>
							</div>
							<h3 class="h5 text-primary mb-4">Яна Сирка</h3>
							<blockquote>
								<p>&ldquo;Очень доволена работой агентства 'Golden Key'! Их команда агентов оперативно ответила на все мои вопросы и провела сделку с максимальной эффективностью. Спасибо за профессионализм и индивидуальный подход к каждому клиенту!&rdquo;</p>
							</blockquote>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section section-4 bg-light">
		<div class="container">
			<div class="row justify-content-center  text-center mb-5">
				<div class="col-lg-5">
					<h2 class="font-weight-bold heading text-primary mb-4">Найдем дом мечты для каждого!</h2>
					<p class="text-black-50">В агентстве недвижимости 'Golden Key' мы убеждены, что каждый человек заслуживает найти свой идеальный дом. Независимо от ваших желаний, потребностей или бюджета, наша цель - помочь вам обнаружить именно то, что подходит именно вам. Доверьтесь нам в поиске вашего дома мечты, и мы сделаем все возможное, чтобы сделать вашу мечту о доме реальностью.</p>
				</div>
			</div>
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
							<h3 class="heading">Более 10.000 обьектов недвижимости</h3>
							<p class="text-black-50">У нас в базе более 10.000 объектов недвижимости, чтобы удовлетворить любые потребности и предпочтения. Независимо от того, ищете ли вы уютное жилье для семьи или инвестиционную возможность, у нас есть идеальное решение для вас.</p>   
						</div>
					</div>
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-person"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">С нами работают лучшие агенты</h3>
							<p class="text-black-50">Мы гордимся тем, что наша команда состоит из лучших агентов, обладающих опытом и экспертизой в области недвижимости. Наши агенты готовы предоставить вам высококлассное обслуживание, индивидуальный подход и помощь на каждом этапе сделки.</p>   
						</div>
					</div>
					<div class="d-flex feature-h">
						<span class="wrap-icon me-3">
							<span class="icon-security"></span>
						</span>
						<div class="feature-text">
							<h3 class="heading">Надежность</h3>
							<p class="text-black-50">Надежность - это основа нашей работы. Мы стремимся к тому, чтобы каждый клиент чувствовал себя уверенно и защищенно в процессе сделки. Наше агентство заботится о вашем благополучии и гарантирует честные и прозрачные условия сотрудничества.</p>   
						</div>
					</div>
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
	<div class="section section-5 bg-light">
		<div class="container">
			<div class="row justify-content-center  text-center mb-5">
				<div class="col-lg-6 mb-5">
					<h2 class="font-weight-bold heading text-primary mb-4">Наши агенты</h2>
					<p class="text-black-50">Наша сильная команда - ключ к вашему успеху! Здесь каждый сотрудник агентства недвижимости "Golden Key" - профессионал своего дела, готовый помочь вам найти идеальное жилье или продать вашу недвижимость по максимально выгодным условиям. Познакомьтесь с нашими экспертами и узнайте, как они могут помочь вам достичь ваших целей в мире недвижимости.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
					<div class="h-100 person">
						<img src="images/person_1-min.jpg" alt="Image"
						class="img-fluid">
						<div class="person-contents">
							<h2 class="mb-0"><a href="#">Касперский Иван</a></h2>
							<span class="meta d-block mb-3">Агент по продажи недвижимости</span>
							<p>С неоспоримым чутьем для сделок и проницательным взглядом на рынок, Иван готов помочь вам найти ваше идеальное жилье или продать с максимальной выгодой.</p>
							<ul class="social list-unstyled list-inline dark-hover">
								<li class="list-inline-item"><a href="#"><span class="icon-twitter"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-facebook"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-linkedin"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-instagram"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
					<div class="h-100 person">
						<img src="images/person_2-min.jpg" alt="Image"
						class="img-fluid">
						<div class="person-contents">
							<h2 class="mb-0"><a href="#">Аваст Дмитрий</a></h2>
							<span class="meta d-block mb-3">Агент по продажи недвижимости</span>
							<p>Страсть Дмитрия к исследованию рынка и тщательный анализ помогут вам найти дом вашей мечты в самых изысканных уголках города</p>
							<ul class="social list-unstyled list-inline dark-hover">
								<li class="list-inline-item"><a href="#"><span class="icon-twitter"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-facebook"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-linkedin"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-instagram"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
					<div class="h-100 person">
						<img src="images/person_3-min.jpg" alt="Image"
						class="img-fluid">
						<div class="person-contents">
							<h2 class="mb-0"><a href="#">Амиго Кирилл</a></h2>
							<span class="meta d-block mb-3">Агент по продажи недвижимости</span>
							<p>Ваш Гид по Недвижимости: Обаятельная и внимательная к деталям, Кирилл всегда готов предложить вам недвижимость, соответствующую вашим требованиям и стилю жизни.</p>
							<ul class="social list-unstyled list-inline dark-hover">
								<li class="list-inline-item"><a href="#"><span class="icon-twitter"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-facebook"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-linkedin"></span></a></li>
								<li class="list-inline-item"><a href="#"><span class="icon-instagram"></span></a></li>
							</ul>
						</div>
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