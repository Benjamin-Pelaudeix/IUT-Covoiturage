<?php
    if (session_status() == PHP_SESSION_ACTIVE) {
?>
        <img class="centreImage" src="image/logo.gif" alt="Covoiturage IUT" title="Covoiturage de l'IUT Limousin" />
<?php
    }
    else {
        header('url= index.php');
    }
?>
	