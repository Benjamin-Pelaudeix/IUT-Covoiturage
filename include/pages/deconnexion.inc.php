<?php
    #Vide les variables de sessions
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    header('Location: index.php');
?>
