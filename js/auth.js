var log=document.getElementById("loginForm"),
reg=document.getElementById("registerForm"),
box=document.getElementById("box"),
btn=document.getElementById("btn");

function register(){
    log.style.left="-540px";
    reg.style.left="50px";
    btn.style.left="170px";
    box.style.height="500px";
}
function login(){
    log.style.left="50px";
    reg.style.left="450px";
    btn.style.left="0"
    box.style.height="330px";
}

function registerUser() {
    // Получаем данные из формы
    var firstName = document.getElementsByName('firstName')[0].value;
    var lastName = document.getElementsByName('lastName')[0].value;
    var surName = document.getElementsByName('surName')[0].value;
    var phone = document.getElementsByName('phonereg')[0].value;
    var email = document.getElementsByName('email')[0].value;
    var password = document.getElementsByName('passwordreg')[0].value;

    if (firstName === "" || lastName === "" || surName === "" || phone === "" || email === "" || password === "" || !email.includes("@")) {
        return;
    }

    // Создаем объект FormData и добавляем в него данные формы
    var formData = new FormData();
    formData.append('firstName', firstName);
    formData.append('lastName', lastName);
    formData.append('surName', surName);
    formData.append('phonereg', phone);
    formData.append('email', email);
    formData.append('passwordreg', password);
    formData.append('register', 'register'); // Добавляем параметр register

    // Создаем объект XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'vendor/auth_process.php', true);

    // Отправляем данные на сервер
    xhr.send(formData);

    // Очищаем форму после отправки данных
    document.getElementById("registerForm").reset();

    // Показываем сообщение о успешной регистрации
    var messageDiv = document.getElementById('messageReg');
    box.style.height="610px";
    messageDiv.innerHTML = "Регистрация прошла успешно. Теперь вы можете войти.";
    messageDiv.style.display = 'block';

    // Скрываем сообщение через 5 секунд
    setTimeout(function(){
        messageDiv.style.display = 'none';
        window.location.href = "auth.php";
    }, 5000);
}