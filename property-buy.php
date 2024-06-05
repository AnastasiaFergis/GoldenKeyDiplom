<?php
session_start();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
	$showLoginIcon = false;
} else {
	$showLoginIcon = true;
}
$isAuthorized = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
include 'vendor/connect.php';

// Проверка наличия идентификатора недвижимости в URL
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Получение идентификатора недвижимости из URL
    $realEstateId = intval($_GET['id']);
    
	// SQL-запрос для выборки данных выбранной недвижимости
    $sql = "SELECT r.*, s.city, s.street, s.streetNum, c.firstName, c.lastName, c.surName, c.phone, c.email
            FROM RealEstates AS r
            INNER JOIN Settlements AS s ON r.settlementId = s.settlementId
            INNER JOIN Clients AS c ON r.clientId_owner = c.clientId
            WHERE r.realEstatesId = $realEstateId";

            
    // Выполнение запроса к базе данных
    $result = mysqli_query($connect, $sql);
    
    // Проверка наличия результатов
    if(mysqli_num_rows($result) > 0) {
        // Вывод данных выбранной недвижимости
        $row = mysqli_fetch_assoc($result);
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
    <div class="hero page-inner overlay" style="background-image: url('images/hero_bg_3.jpg');">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center mt-5">
                    <h1 class="heading" data-aos="fade-up"><?php echo $row['realEstatesName']; ?></h1>
                    <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                        <ol class="breadcrumb text-center justify-content-center">
                            <li class="breadcrumb-item "><a href="index.php">Главная</a></li>
                            <li class="breadcrumb-item "><a href="properties.php">Недвижимость</a></li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page"><?php echo $row['street'] . ', ' . $row['streetNum']; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <div class="img--slide-wrap mb-4">
                        <img class="img-per" src="<?php echo $row['image']; ?>.jpg" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-12 text-center justify-content-center">
                        <input type="submit" id="submitBtnn" data-authorized="<?php echo $isAuthorized ? 'true' : 'false'; ?>" value="Желаю приобрести" class="btn btn-primary">
                        <p id="successMessage" style="border: 2px solid #005555; color:black; font-size: 14px; background: white; border-radius: 10px; padding: 10px; margin-top: 20px; text-align: center; font-weight: bold; display: none;">В скором времени с вами свяжется наш агент!</p>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <h2 class="heading text-primary"><?php echo $row['realEstatesName']; ?></h2>
                    <p class="meta mb-2"><?php echo "г. " . $row['city']; ?>, <?php echo $row['street']; ?> <?php echo $row['streetNum']; ?></p>
                    <div class="price mb-3"><h5><?php echo number_format($row['price'], 0, ',', '.') . " руб"?></h5></div>
                    <div class="specs d-flex mb-2 justify-content-center">
                        <span class="d-block d-flex align-items-center me-3">
                            <span class="icon-bed me-2"></span>
                            <span class="caption"><?php echo $row['countBedsRooms'] . ' спален'?></span>
                        </span>
                        <span class="d-block d-flex align-items-center">
                            <span class="icon-bath me-2"></span>
                            <span class="caption"><?php echo $row['countBathsRooms'] . ' ванных комнат'?></span>
                        </span>
                    </div>
                    <p class="text-black-50"><?php echo $row['description']; ?></p>
                    <div class="d-block agent-box p-3">
                        <div class="img mb-4">
                            <img src="images/person.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="text">
                            <h3 class="mb-1"><?php echo $row['firstName'] . ' ' . $row['lastName'] . ' ' . $row['surName']?></h3>
                            <div class="meta mb-3">Владелец недвижимости</div>
                            <p class="mb-1"><?php echo $row['phone']; ?></p>
                            <p class="mb-0"><?php echo $row['email']; ?></p>
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
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const submitBtnn = document.getElementById('submitBtnn');
    const successMessage = document.getElementById('successMessage');

    submitBtnn.addEventListener('click', function(event) {
        const isAuthorized = submitBtnn.getAttribute('data-authorized') === 'true';
        
        if (!isAuthorized) {
            event.preventDefault();
            alert("Пожалуйста, авторизуйтесь, чтобы приобрести недвижимость.");
        } else {
            successMessage.style.display = 'block';
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    });
});

    </script>
</body>
</html>
<?php
    } else {
        echo "Недвижимость не найдена.";
    }
} else {
    echo "Идентификатор недвижимости отсутствует в URL.";
}
mysqli_close($connect);
?>