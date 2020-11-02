<?php
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
?>
<h1>Pour vous connecter</h1>
<?php
    if (empty($_POST["login"]) || empty($_POST["password"]) || empty($_POST["calcul"])) {
?>
        <form action="index.php?page=connexion" method="post">
            <div>
                <label for="login">Nom d'utilisateur : </label>
                <br>
                <input type="text" name="login" id="login">
            </div>
            <div>
                <label for="password">Mot de passe : </label>
                <br>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="calcul">
                <img src="image/nb/<?php echo $nombre1 = rand(1,9) ?>.jpg" alt="<?php echo $nombre1 ?>">
                +
                <img src="image/nb/<?php echo $nombre2= rand(1,9) ?>.jpg" alt="<?php echo $nombre2 ?>">
                =
                </label>
                <br>
                <input type="number" name="resultat" id="calcul" value="<?php echo $nombre1+$nombre2; ?>" hidden>
                <input type="number" name="calcul" id="calcul">
            </div>
            <input type="submit" value="Valider">
        </form>
<?php
    }
    else {
        $login = $_POST["login"];
        $cryptedPassword = sha1(sha1($_POST["password"]) . SALT);
        $resultat = $_POST["calcul"];
        $verifyConnexion = $personneManager->getPersonneFromLoginPwd($login, $cryptedPassword);
        if ($resultat != $_POST["resultat"]) {
?>
            <p><img src="image/erreur.png" alt="Error Cross"> Calcul d'authentification erroné</p>
<?php
            header('Refresh: 1.5; url=index.php?page=connexion');
        }
        else if (!$verifyConnexion) {
?>
            <p><img src="image/erreur.png" alt="Error Cross"> Cet utilisateur n'existe pas</p>
<?php
            header('Refresh: 1.5; url=index.php?page=connexion');
        }
        else {
            $connexion = new Personne($verifyConnexion);
            $_SESSION['username'] = $connexion->getPrenom();
            $_SESSION['userid'] = $connexion->getNumero();
            header('Location: index.php');
        }
    }
?>
