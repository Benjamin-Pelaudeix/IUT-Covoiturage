<?php
if (session_status() == PHP_SESSION_ACTIVE) {
    $db = new Mypdo();
    $villeManager = new VilleManager($db);
?>
<h1>Ajouter une ville</h1>
<?php
    #Contrôle si les données renvoyées par le formulaire sont vides
    if (empty($_POST["nom"])) {
?>
<form action="index.php?page=ajouterVille" method="post">
    <label for="nom">Nom : </label>
    <input type="text" name="nom" id="nom" pattern="[a-zA-ZÀ-ÿ]">
    <input type="submit" value="Valider">
</form>
<?php
    }
    else {
        $newVille = new Ville(
            array(
                'vil_nom' => $_POST["nom"]
            )
        );
        $villeManager->add($newVille);
?>
        <p><img src="image/valid.png" alt="Valid Check"> La ville <b>"<?php echo $newVille->getNom() ?></b>" a été ajoutée</p>
<?php
        header('Refresh: 1.5; url=index.php?page=ajouterVille');
    }
}
else {
    header('Location: ../../index.php');
}
?>
