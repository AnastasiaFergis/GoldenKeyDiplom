<?php
session_start();
include 'connect.php';

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $realEstatesName = $_POST['realEstatesName'];
    $countBedsRooms = $_POST['countBedsRooms'];
    $price = $_POST['price'];
    $countBathsRooms = $_POST['countBathsRooms'];
    $description = $_POST['description'];
    $city = $_POST['city'];
    $indexCity = $_POST['indexCity'];
    $street = $_POST['street'];
    $streetNum = $_POST['streetNum'];
    $clientIdOwner = $_SESSION['user_id'];

    // Вставка данных в таблицу Settlements
    $settlementQuery = "INSERT INTO Settlements (city, indexCity, street, streetNum) VALUES ('$city', '$indexCity', '$street', '$streetNum')";
    if (mysqli_query($connect, $settlementQuery)) {
        $settlementId = mysqli_insert_id($connect);

        // Вставка данных в таблицу RealEstates
        $realEstateQuery = "INSERT INTO RealEstates (realEstatesName, countBedsRooms, price, countBathsRooms, description, settlementId, clientId_owner) VALUES ('$realEstatesName', '$countBedsRooms', '$price', '$countBathsRooms', '$description', '$settlementId', '$clientIdOwner')";
        if (mysqli_query($connect, $realEstateQuery)) {
            $realEstatesId = mysqli_insert_id($connect);
            $datetime = date("Y-m-d H:i:s");
            $status = 'Ожидает подтверждение';

            // Вставка данных в таблицу SalesApplications
            $salesApplicationQuery = "INSERT INTO SalesApplications (realEstateId, clientId, datetime, status) VALUES ('$realEstatesId', '$clientIdOwner', '$datetime', '$status')";
            if (mysqli_query($connect, $salesApplicationQuery)) {
                $response['message'] = 'Заявка на продажу успешно отправлена!';
            } else {
                $response['message'] = 'Ошибка при отправке заявки: ' . mysqli_error($connect);
            }
        } else {
            $response['message'] = 'Ошибка при отправке заявки: ' . mysqli_error($connect);
        }
    } else {
        $response['message'] = 'Ошибка при отправке заявки: ' . mysqli_error($connect);
    }

    mysqli_close($connect);
} else {
    $response['message'] = 'Неверный метод запроса.';
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
