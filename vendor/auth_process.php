<?php
    session_start();
    include 'connect.php';

if(isset($_POST['login'])) {
    $phoneNumber = $_POST['phone'];
    $password = md5($_POST['password']);

    $check_user = mysqli_query($connect, "SELECT * FROM Clients WHERE phone='$phoneNumber' AND password='$password'"); 

    if(mysqli_num_rows($check_user) == 1) {
        $user_data = mysqli_fetch_assoc($check_user);
        $_SESSION['user_id'] = $user_data['clientId'];
        $_SESSION['loggedIn'] = true; 
        $_SESSION['clientName'] = $user_data['firstName'];
        $_SESSION['clientEmail'] = $user_data['email'];
        header('Location: ../index.php');
    } else {
        $_SESSION['messageLogin'] = '<p class="msgBad">Такой пользователь не найден!</p>';
        header('Location: ../auth.php');
    }
    
}
else if(isset($_POST['register'])) {
    $clientFirstName = $_POST['firstName'];
    $clientLastName = $_POST['lastName'];
    $clientSurName = $_POST['surName'];
    $phoneNumber = $_POST['phonereg'];
    $email = $_POST['email'];
    $password = md5($_POST['passwordreg']); 

    $query = "INSERT INTO Clients (firstName, lastName, surName, phone, email, password) VALUES ('$clientFirstName', '$clientLastName', '$clientSurName', '$phoneNumber', '$email', '$password')";
    $result = mysqli_query($connect, $query);
}
?>