<?php
  session_start();
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
      $showLoginIcon = false;
  } else {
      $showLoginIcon = true;
  }
include 'vendor/connect.php';
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>GoldenKey &mdash; Наши контакты</title>

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
	<style>
   		.alert {
            border: 2px solid #005555; 
            color: black; 
            font-size: 14px; 
            background: white; 
            border-radius: 10px; 
            padding: 10px; 
            margin-top: 20px; 
            text-align: center; 
            font-weight: bold; 
            display: none;
        }
    </style>
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
						<li><a href="about.php">О нас</a></li>
						<li class="active"><a href="contact.php">Наши контакты</a></li>
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
					<h1 class="heading" data-aos="fade-up">Продайте свою недвижимость</h1>
					<nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
						<ol class="breadcrumb text-center justify-content-center">
							<li class="breadcrumb-item "><a href="index.php">Главная</a></li>
							<li class="breadcrumb-item active text-white-50" aria-current="page">Продать недвижимость</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="container text-center">
			<div class="row">
			<form id="propertySellForm" method="post">
				<h2 class="font-weight-bold text-primary heading align-items-center mb-2">Информация о недвижимости</h2>
				<div class="row">
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="realEstatesName" placeholder="Название недвижимости" required>
					</div>
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="countBedsRooms" placeholder="Кол-во спален" required>
					</div>
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="price" placeholder="Стоимость" required>
					</div>
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="countBathsRooms" placeholder="Кол-во ванных комнат" required>
					</div>
					<div class="col-12 mb-3">
						<textarea name="description" cols="30" rows="7" class="form-control" placeholder="Описание..." required></textarea>
					</div>
					<h2 class="font-weight-bold text-primary heading align-items-center mt-3 mb-2">Информация об адресе</h2>
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="city" placeholder="Город" required>
					</div>
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="indexCity" placeholder="Индекс" required>
					</div>
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="street" placeholder="Улица" required>
					</div>
					<div class="col-6 mb-3">
						<input type="text" class="form-control" name="streetNum" placeholder="Номер улицы" required>
					</div>
					<div class="col-12">
						<input style="top: 20px;" type="submit" id="submitBtnRequest" value="Отправить заявку на продажу" class="btn btn-primary">
					</div>
				</div>
				<div style="margin-top: 40px; margin-bottom: 0px" id="messageContainer" class="alert"></div>
			</form>
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
    		<span class="visually-hidden">Загрузка...</span>
    	</div>
    </div>
	<script src="js/app.js"></script>>
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
    <script>
        document.getElementById('propertySellForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Предотвращаем отправку формы по умолчанию

            var formData = new FormData(this);

            fetch('vendor/property_sell_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                var messageContainer = document.getElementById('messageContainer');
                messageContainer.innerHTML = data.message;
                messageContainer.style.display = 'block';

                setTimeout(function() {
                    messageContainer.style.display = 'none';
                }, 5000);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
  </body>
  </html>