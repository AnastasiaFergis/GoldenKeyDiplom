<?php
session_start();
include_once('connect.php');

$clientName = $_POST['clientName'];
$clientEmail = $_POST['clientEmail'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if (empty($clientName) || empty($clientEmail) || empty($subject) || empty($message)) {
    $_SESSION['message'] = '<p style="border: 2px solid #005555; color:black; font-size: 14px; background: white; border-radius: 10px; padding: 10px; margin-top: 20px; text-align: center; font-weight: bold;"> Все поля должны быть заполнены!</p>';
} else {
    mysqli_query($connect, "INSERT INTO AppealsOfCustomers (clientName, clientEmail, subject, message, appealStatus) VALUES ('$clientName', '$clientEmail', '$subject', '$message', 'Новый')");
    $_SESSION['message'] = '<p style="border: 2px solid #005555; color:black; font-size: 14px; background: white; border-radius: 10px; padding: 10px; margin-top: 20px; text-align: center; font-weight: bold;"> Обращение принято в работу! </br> В скором времени с Вами свяжется наш агент!</p>';
}
echo $_SESSION['message'];
?>
