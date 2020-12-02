<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    #Vide les variables de sessions
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    header('Location: index.php');
}
else {
    header('Location: ../../index.php');
}
?>
