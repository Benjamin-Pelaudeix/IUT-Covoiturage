<?php
    $db = new Mypdo();
    $villeManager = new VilleManager($db);
?>
<h1>Ajouter une ville</h1>
<?php
    if (empty($_POST["nom"])) {
?>
<form action="index.php?page=ajouterVille" method="post">
    <label for="nom">Nom : </label>
    <input type="text" name="nom" id="nom">
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
        $villeManager->addVille($newVille);
?>
        <p><img src="image/valid.png" alt="Valid Check"> La ville <b>"<?php echo $newVille->getNom() ?></b>" a été ajoutée</p>
<?php
        header('Refresh: 1.5; url=index.php?page=ajouterVille');
    }
?>
