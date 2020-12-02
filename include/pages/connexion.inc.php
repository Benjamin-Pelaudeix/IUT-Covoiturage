<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $db = new Mypdo();
    $personneManager = new PersonneManager($db);
    #Génération aléatoire des nombres pour le calcul d'authentification
    $nombre1 = rand(1,9);
    $nombre2 = rand(1,9);
    $_SESSION['resultat'] = $nombre1 + $nombre2;
?>
<h1>Pour vous connecter</h1>
<?php
    #Contrôle si les données renvoyées par le formulaire sont vides
    if (empty($_POST["login"]) || empty($_POST["password"]) || empty($_POST["calcul"])) {
?>
        <form action="index.php?page=validationConnexion" method="post">
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
                <img src="image/nb/<?php echo $nombre1 ?>.jpg" alt="<?php echo $nombre1 ?>">
                +
                <img src="image/nb/<?php echo $nombre2 ?>.jpg" alt="<?php echo $nombre2 ?>">
                =
                </label>
                <br>
                <input type="number" name="calcul" id="calcul">
            </div>
            <input type="submit" value="Valider">
        </form>
<?php
    }
}
else {
    header('Location: ../../index.php');
}
?>

