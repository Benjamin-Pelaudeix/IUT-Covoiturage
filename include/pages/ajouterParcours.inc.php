<?php
    $db = new Mypdo();
    $villeManager = new VilleManager($db);
    $parcoursManager = new ParcoursManager($db);
    $listeVille = $villeManager->getAllVille();
?>
<h1>Ajouter un parcours</h1>
<?php
    if (empty($_POST["ville1"]) || empty($_POST["ville2"]) || empty($_POST["kilometrage"])) {
?>
<form action="index.php?page=ajouterParcours" method="post">
    <label for="ville1">Ville 1 : </label>
    <select name="ville1" id="ville1">
        <?php
            foreach ($listeVille as $ville) {
        ?>
                <option value="<?php echo $ville->getNumero() ?>"><?php echo $ville->getNom() ?></option>
        <?php
            }
        ?>
    </select>
    <label for="ville2">Ville 2 : </label>
    <select name="ville2" id="ville2">
        <?php
        foreach ($listeVille as $ville) {
            ?>
            <option value="<?php echo $ville->getNumero() ?>"><?php echo $ville->getNom() ?></option>
            <?php
        }
        ?>
    </select>
    <label for="kilometrage">Nombre de kilomètre(s) </label>
    <input type="number" name="kilometrage" id="kilometrage" min="0" value="0">
    <br>
    <input type="submit" value="Valider">
</form>
<?php
    }
    else {
        $existParcours = $parcoursManager->getParcours($_POST["ville1"], $_POST["ville2"]) || $parcoursManager->getParcours($_POST["ville2"], $_POST["ville1"]);
        if ($existParcours) {
?>
            <p><img src="image/erreur.png" alt="Error Cross"> Le parcours existe déjà</p>
<?php
            header('Refresh: 1.5; url=index.php?page=ajouterParcours');
        }
        else {
            $newParcours = new Parcours(
                array(
                    'par_km' => $_POST["kilometrage"],
                    'vil_num1' => $_POST["ville1"],
                    'vil_num2' => $_POST["ville2"]
                )
            );
            $parcoursManager->add($newParcours);
?>
            <p><img src="image/valid.png" alt="Valid Check"> Le parcours a été ajouté</p>
<?php
            header('Refresh: 1.5; url=index.php?ajouterParcours');
        }
    }
