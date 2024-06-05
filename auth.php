<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/auth.css"/>
    <title>Уютный домик - Авторизация</title>
</head>
<body>
<div class="hero">
    <div class="form-box" id="box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick=login()>Авторизация</button>
            <button type="button" class="toggle-btn" onclick="register()">Регистрация</button>
        </div>
        <form id="loginForm" class="form-group" method="post" action="vendor/auth_process.php">
            <input type="text" class="input-field" name="phone" placeholder="Введите номер телефона" required/>
            <input type="password" class="input-field" name="password" placeholder="Введите пароль" required/>
            <div class="mainbtn">
                <button type="submit" class="submmit-btn" name="login">Войти</button>
            </div>
            <?php 
                if($_SESSION['messageLogin']) {
                    echo '<div> ' . $_SESSION['messageLogin'] . ' </div>';
                }
                unset($_SESSION['messageLogin']);
            ?>
        </form> 
        <form id="registerForm" class="form-group" method="post" action="vendor/auth_process.php">
            <input type="text" class="input-field" name="firstName" placeholder="Введите имя" required/>
            <input type="text" class="input-field" name="lastName" placeholder="Введите фамилию" required/>
            <input type="text" class="input-field" name="surName" placeholder="Введите отчество" required/>
            <input type="text" class="input-field" name="phonereg" placeholder="Введите номер телефона" required/>
            <input type="email" class="input-field" name="email" placeholder="Введите email" required/>
            <input type="password" class="input-field" name="passwordreg" placeholder="Введите пароль" required/>
            <div class="mainbtn">
                <button type="submit" class="submmit-btn" name="register" onclick="registerUser()">Регистрация</button>
            </div>
            <div class="msg" id="messageReg" style="display: none;"></div> 
        </form>
    </div>
</div> 
<script src="js/auth.js"></script>
</body>
</html>
