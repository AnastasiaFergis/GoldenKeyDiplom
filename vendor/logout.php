<?php
    session_start();
    unset($_SESSION['loggedIn']);
    header('Location: ../auth.php');
exit();
?>