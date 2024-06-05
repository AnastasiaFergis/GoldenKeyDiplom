document.getElementById('appealsForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Предотвращаем стандартное действие отправки формы (перенаправление на другую страницу)

    var formData = new FormData(this); // Создаем объект FormData для передачи данных формы

    var xhr = new XMLHttpRequest(); // Создаем объект XMLHttpRequest
    xhr.open('POST', 'vendor/appealsOfCustomers.php', true); // Устанавливаем метод и URL для отправки запроса

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) { // Проверяем статус запроса
            var messageDiv = document.getElementById('messageDiv');
            messageDiv.innerHTML = xhr.responseText; // Обновляем содержимое div
            messageDiv.style.display = 'block'; // Показываем блок после отправки формы

            // Скрытие блока через 6.5 секунд
            setTimeout(function() {
                messageDiv.style.display = 'none';
                document.getElementById('appealsForm').reset();
            }, 6500);
        }
    };
    xhr.send(formData); // Отправляем запрос с данными формы
});
