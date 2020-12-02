<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    $login = $_POST["login"];
    $cryptedPassword = sha1(sha1($_POST["password"]) . SALT);
    $resultat = $_POST["calcul"];
    $verifyConnexion = $personneManager->getPersonneFromLoginPwd($login, $cryptedPassword);
?>
    <h1>Pour vous connecter</h1>
<?php
    #Contrôle si le résultat donné est conforme à celui attendu
    if ($resultat != $_SESSION['resultat']) {
?>
            <p><img src="image/erreur.png" alt="Error Cross"> Calcul d'authentification erroné</p>
<?php
            header('Refresh: 1.5; url=index.php?page=connexion');
    }
    #Contrôle si les informations de connexions données sont présentes en base
    else if (!$verifyConnexion) {
?>
            <p><img src="image/erreur.png" alt="Error Cross"> Cet utilisateur n'existe pas</p>
<?php
            header('Refresh: 1.5; url=index.php?page=connexion');
    }
    #Validation de la connexion
    else {
            $connexion = new Personne($verifyConnexion);
            $_SESSION['username'] = $connexion->getPrenom();
            $_SESSION['userid'] = $connexion->getNumero();
            header('Location: index.php');
    }
}
else {
    header('Location: ../../index.php');
}
?>
